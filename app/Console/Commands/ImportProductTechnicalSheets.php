<?php

namespace App\Console\Commands;

use App\Models\Product;
use DOMDocument;
use DOMXPath;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportProductTechnicalSheets extends Command
{
    protected $signature = 'products:import-technical-sheets
                            {--source= : Carpeta con PDFs locales (default: storage/app/imports/technical-sheets)}
                            {--from-web : Descargar fichas desde sitios oficiales de Mapei y Sika}
                            {--brand= : Filtrar por marca (mapei, sika, metic, corona)}
                            {--limit= : Limitar cantidad de productos a procesar}
                            {--threshold=70 : Puntaje minimo (0-100) para emparejar PDF local con producto}
                            {--force : Reemplazar fichas tecnicas ya asignadas}
                            {--dry-run : Mostrar acciones sin guardar cambios}';

    protected $description = 'Importa fichas tecnicas PDF para productos sin ficha (carpeta local o sitios Mapei/Sika)';

    private array $baseUrls = [
        'mapei' => 'https://www.mapei.com',
        'sika' => 'https://col.sika.com',
    ];

    public function handle(): int
    {
        $products = $this->getProductsToProcess();

        if ($products->isEmpty()) {
            $this->info('No hay productos pendientes de ficha tecnica.');

            return Command::SUCCESS;
        }

        $this->info("Productos a procesar: {$products->count()}");

        if ($this->option('dry-run')) {
            $this->warn('Modo dry-run: no se guardaran archivos ni cambios en BD.');
        }

        if ($this->option('from-web')) {
            return $this->importFromWeb($products);
        }

        return $this->importFromLocalFolder($products);
    }

    private function getProductsToProcess(): Collection
    {
        $query = Product::query()->with('brand')->orderBy('id');

        if (! $this->option('force')) {
            $query->where(function ($q) {
                $q->whereNull('technical_sheet_file')
                    ->orWhere('technical_sheet_file', '');
            });
        }

        $brandFilter = $this->option('brand');
        if ($brandFilter) {
            $brandFilter = strtolower($brandFilter);
            $query->whereHas('brand', function ($q) use ($brandFilter) {
                $q->where('name', 'LIKE', "%{$brandFilter}%");
            });
        }

        $limit = $this->option('limit');
        if ($limit) {
            $query->limit((int) $limit);
        }

        return $query->get();
    }

    private function importFromLocalFolder(Collection $products): int
    {
        $source = $this->option('source') ?: storage_path('app/imports/technical-sheets');

        if (! File::isDirectory($source)) {
            File::makeDirectory($source, 0755, true);
            $this->warn("Se creo la carpeta de importacion: {$source}");
            $this->line('Coloca los PDFs ahi y vuelve a ejecutar el comando.');

            return Command::SUCCESS;
        }

        $pdfFiles = collect(File::files($source))
            ->filter(fn ($file) => strtolower($file->getExtension()) === 'pdf')
            ->values();

        if ($pdfFiles->isEmpty()) {
            $this->warn("No se encontraron PDFs en: {$source}");

            return Command::SUCCESS;
        }

        $this->info("PDFs encontrados: {$pdfFiles->count()}");
        $this->newLine();

        $threshold = (float) $this->option('threshold');
        $usedPdfPaths = [];
        $successCount = 0;
        $failedCount = 0;
        $skippedCount = 0;

        $progressBar = $this->output->createProgressBar($products->count());
        $progressBar->start();

        foreach ($products as $product) {
            $progressBar->advance();

            $match = $this->findBestPdfMatch($product, $pdfFiles, $usedPdfPaths, $threshold);

            if (! $match) {
                $failedCount++;

                if ($this->option('verbose')) {
                    $this->newLine();
                    $this->line("  Sin coincidencia: {$product->name}");
                }

                continue;
            }

            if ($this->option('dry-run')) {
                $successCount++;
                $this->newLine();
                $this->line("  [dry-run] {$product->name} <= {$match['file']->getFilename()} ({$match['score']}%)");

                continue;
            }

            $savedPath = $this->copyPdfToStorage($match['file']->getPathname(), $product);

            if (! $savedPath) {
                $failedCount++;
                continue;
            }

            $product->technical_sheet_file = $savedPath;
            $product->save();

            $usedPdfPaths[] = $match['file']->getPathname();
            $successCount++;
        }

        $progressBar->finish();
        $this->newLine(2);
        $this->printSummary($successCount, $failedCount, $skippedCount, $products->count());

        return Command::SUCCESS;
    }

    private function importFromWeb(Collection $products): int
    {
        $successCount = 0;
        $failedCount = 0;
        $skippedCount = 0;

        $progressBar = $this->output->createProgressBar($products->count());
        $progressBar->start();

        foreach ($products as $product) {
            $progressBar->advance();

            $brandType = $this->resolveBrandType($product);

            if (! $brandType) {
                $skippedCount++;

                if ($this->option('verbose')) {
                    $this->newLine();
                    $this->line("  Marca no soportada para web: {$product->name}");
                }

                continue;
            }

            if ($this->option('dry-run')) {
                $successCount++;
                $this->newLine();
                $this->line("  [dry-run] {$product->name} ({$brandType})");

                continue;
            }

            $pdfUrl = $this->searchTechnicalSheetUrl($product, $brandType);

            if (! $pdfUrl) {
                $failedCount++;

                if ($this->option('verbose')) {
                    $this->newLine();
                    $this->line("  PDF no encontrado: {$product->name}");
                }

                continue;
            }

            $savedPath = $this->downloadAndSavePdf($pdfUrl, $product, $brandType);

            if (! $savedPath) {
                $failedCount++;
                continue;
            }

            $product->technical_sheet_file = $savedPath;
            $product->save();
            $successCount++;

            usleep(500000);
        }

        $progressBar->finish();
        $this->newLine(2);
        $this->printSummary($successCount, $failedCount, $skippedCount, $products->count());

        return Command::SUCCESS;
    }

    private function findBestPdfMatch(Product $product, Collection $pdfFiles, array $usedPdfPaths, float $threshold): ?array
    {
        $bestMatch = null;
        $bestScore = 0.0;

        foreach ($pdfFiles as $pdfFile) {
            if (in_array($pdfFile->getPathname(), $usedPdfPaths, true)) {
                continue;
            }

            $score = $this->calculateMatchScore($pdfFile->getFilename(), $product);

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestMatch = $pdfFile;
            }
        }

        if (! $bestMatch || $bestScore < $threshold) {
            return null;
        }

        return [
            'file' => $bestMatch,
            'score' => round($bestScore, 1),
        ];
    }

    private function calculateMatchScore(string $pdfFilename, Product $product): float
    {
        $pdfBase = pathinfo($pdfFilename, PATHINFO_FILENAME);
        $pdfNorm = $this->normalizeString($pdfBase);
        $nameNorm = $this->normalizeString($product->name);
        $slugNorm = $this->normalizeString($product->slug);

        if ($pdfNorm === $nameNorm || $pdfNorm === $slugNorm) {
            return 100.0;
        }

        if ($nameNorm !== '' && (str_contains($pdfNorm, $nameNorm) || str_contains($nameNorm, $pdfNorm))) {
            return 95.0;
        }

        similar_text($pdfNorm, $nameNorm, $namePercent);
        similar_text($pdfNorm, $slugNorm, $slugPercent);

        return max((float) $namePercent, (float) $slugPercent);
    }

    private function normalizeString(string $value): string
    {
        $value = Str::ascii(mb_strtolower($value));

        return preg_replace('/[^a-z0-9]+/', '', $value) ?? '';
    }

    private function copyPdfToStorage(string $sourcePath, Product $product): ?string
    {
        try {
            $content = File::get($sourcePath);

            if (! $this->isPdfContent($content)) {
                return null;
            }

            $year = date('Y');
            $month = date('m');
            $fileName = Str::slug($product->name).'_'.time().'_'.Str::random(6).'.pdf';
            $path = "products/documents/{$year}/{$month}/{$fileName}";

            if (! Storage::disk('public')->put($path, $content)) {
                return null;
            }

            return $path;
        } catch (\Throwable) {
            return null;
        }
    }

    private function resolveBrandType(Product $product): ?string
    {
        $brandName = strtolower($product->brand->name ?? '');

        if (str_contains($brandName, 'mapei')) {
            return 'mapei';
        }

        if (str_contains($brandName, 'sika')) {
            return 'sika';
        }

        return null;
    }

    private function searchTechnicalSheetUrl(Product $product, string $brandType): ?string
    {
        $searchUrl = $this->buildSearchUrl($product, $brandType);

        if (! $searchUrl) {
            return null;
        }

        $html = $this->fetchHtml($searchUrl);

        if (! $html) {
            return null;
        }

        return $this->extractPdfUrlFromHtml($html, $this->baseUrls[$brandType]);
    }

    private function buildSearchUrl(Product $product, string $brandType): ?string
    {
        $productName = $product->name;
        $baseUrl = $this->baseUrls[$brandType];

        if ($brandType === 'mapei') {
            $slug = Str::slug($productName);

            return "{$baseUrl}/co/es-co/productos/{$slug}";
        }

        if ($brandType === 'sika') {
            $searchQuery = urlencode($productName);

            return "{$baseUrl}/search?q={$searchQuery}";
        }

        return null;
    }

    private function fetchHtml(string $url): ?string
    {
        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                    'Accept-Language' => 'es-ES,es;q=0.9,en;q=0.8',
                ])
                ->get($url);

            if (! $response->successful()) {
                return null;
            }

            return $response->body();
        } catch (\Throwable) {
            return null;
        }
    }

    private function extractPdfUrlFromHtml(string $html, string $baseUrl): ?string
    {
        try {
            libxml_use_internal_errors(true);

            $dom = new DOMDocument();
            @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

            $xpath = new DOMXPath($dom);
            $nodes = $xpath->query('//a[@href]');

            $candidates = [];

            foreach ($nodes as $node) {
                if (! $node instanceof \DOMElement) {
                    continue;
                }

                $href = trim($node->getAttribute('href'));
                $text = strtolower(trim($node->textContent));

                if ($href === '') {
                    continue;
                }

                $absoluteUrl = $this->makeAbsoluteUrl($href, $baseUrl);
                $urlLower = strtolower($absoluteUrl);

                if (! str_contains($urlLower, '.pdf')) {
                    continue;
                }

                $score = 10;

                foreach (['ficha', 'tecnica', 'technical', 'datasheet', 'data-sheet', 'hoja', 'tds', 'ft_'] as $keyword) {
                    if (str_contains($urlLower, $keyword) || str_contains($text, $keyword)) {
                        $score += 20;
                    }
                }

                $candidates[] = [
                    'url' => $absoluteUrl,
                    'score' => $score,
                ];
            }

            if (empty($candidates)) {
                return null;
            }

            usort($candidates, fn ($a, $b) => $b['score'] <=> $a['score']);

            return $candidates[0]['url'];
        } catch (\Throwable) {
            return null;
        }
    }

    private function makeAbsoluteUrl(string $url, string $baseUrl): string
    {
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        if (str_starts_with($url, '//')) {
            return 'https:'.$url;
        }

        if (str_starts_with($url, '/')) {
            $parsed = parse_url($baseUrl);

            return ($parsed['scheme'] ?? 'https').'://'.($parsed['host'] ?? '').$url;
        }

        return rtrim($baseUrl, '/').'/'.ltrim($url, '/');
    }

    private function downloadAndSavePdf(string $pdfUrl, Product $product, string $brandType): ?string
    {
        try {
            $response = Http::timeout(45)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                ])
                ->get($pdfUrl);

            if (! $response->successful()) {
                return null;
            }

            $content = $response->body();

            if (! $this->isPdfContent($content)) {
                return null;
            }

            $year = date('Y');
            $month = date('m');
            $fileName = Str::slug($product->name)."_{$brandType}_".time().'_'.Str::random(6).'.pdf';
            $path = "products/documents/{$year}/{$month}/{$fileName}";

            if (! Storage::disk('public')->put($path, $content)) {
                return null;
            }

            return $path;
        } catch (\Throwable) {
            return null;
        }
    }

    private function isPdfContent(string $content): bool
    {
        return str_starts_with($content, '%PDF');
    }

    private function printSummary(int $successCount, int $failedCount, int $skippedCount, int $total): void
    {
        $this->info('Resumen:');
        $this->table(
            ['Estado', 'Cantidad'],
            [
                ['Exitosos', $successCount],
                ['Fallidos', $failedCount],
                ['Omitidos', $skippedCount],
                ['Total', $total],
            ]
        );
    }
}
