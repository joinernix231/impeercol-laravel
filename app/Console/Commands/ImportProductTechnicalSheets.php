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
                            {--from-folder : Importar desde carpeta local en lugar de buscar en internet}
                            {--source= : Carpeta con PDFs locales (solo con --from-folder)}
                            {--brand= : Filtrar por marca (mapei, sika, metic, corona)}
                            {--limit= : Limitar cantidad de productos a procesar}
                            {--threshold=70 : Puntaje minimo (0-100) para emparejar PDF local con producto}
                            {--force : Reemplazar fichas tecnicas ya asignadas}
                            {--dry-run : Mostrar acciones sin guardar cambios}';

    protected $description = 'Busca e importa fichas tecnicas PDF desde internet para productos sin ficha';

    private array $baseUrls = [
        'mapei' => 'https://www.mapei.com',
        'sika' => 'https://col.sika.com',
    ];

    private array $searchDomains = [
        'mapei' => ['cdnmedia.mapei.com', 'mapei.com'],
        'sika' => ['col.sika.com'],
        'metic' => ['metic.com.co', 'metic.com'],
        'corona' => ['corona.co', 'corona.com'],
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

        if ($this->option('from-folder')) {
            return $this->importFromLocalFolder($products);
        }

        $this->info('Buscando fichas tecnicas en internet...');

        return $this->importFromWeb($products);
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
            $this->line('Coloca los PDFs ahi y vuelve a ejecutar el comando con --from-folder.');

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
            $pdfUrl = $this->searchTechnicalSheetUrl($product, $brandType);

            if (! $pdfUrl) {
                $failedCount++;

                if ($this->option('verbose')) {
                    $this->newLine();
                    $this->line("  PDF no encontrado: {$product->name}");
                }

                usleep(300000);
                continue;
            }

            if ($this->option('dry-run')) {
                $successCount++;
                $this->newLine();
                $this->line("  [dry-run] {$product->name}");
                $this->line("            -> {$pdfUrl}");

                usleep(300000);
                continue;
            }

            $savedPath = $this->downloadAndSavePdf($pdfUrl, $product, $brandType ?? 'web');

            if (! $savedPath) {
                $failedCount++;

                if ($this->option('verbose')) {
                    $this->newLine();
                    $this->line("  Error al descargar: {$product->name}");
                }

                usleep(300000);
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

    private function searchTechnicalSheetUrl(Product $product, ?string $brandType): ?string
    {
        $candidates = [];

        if ($brandType === 'sika') {
            $candidates = array_merge($candidates, $this->probeSikaDirectPdfUrls($product));
            $candidates = array_merge($candidates, $this->extractPdfUrlsFromPages($this->buildSikaProductPageUrls($product)));
        }

        if ($brandType === 'mapei') {
            $candidates = array_merge($candidates, $this->extractPdfUrlsFromPages($this->buildMapeiProductPageUrls($product)));
        }

        $domains = $brandType ? ($this->searchDomains[$brandType] ?? []) : [];
        $candidates = array_merge($candidates, $this->searchPdfViaWeb($product, $domains));

        if (empty($domains)) {
            $brandName = $product->brand->name ?? '';
            $candidates = array_merge($candidates, $this->searchPdfViaWeb($product, [], $brandName));
        }

        return $this->pickBestPdfCandidate($candidates, $product);
    }

    private function buildSikaProductPageUrls(Product $product): array
    {
        $slug = $this->buildProductSlug($product->name);
        $baseUrl = $this->baseUrls['sika'];

        return array_unique([
            "{$baseUrl}/es/productos/{$slug}.html",
            "{$baseUrl}/es/productos/{$slug}",
            "{$baseUrl}/es/search.html?search=".urlencode($product->name),
        ]);
    }

    private function buildMapeiProductPageUrls(Product $product): array
    {
        $slug = $this->buildProductSlug($product->name);
        $baseUrl = $this->baseUrls['mapei'];

        return array_unique([
            "{$baseUrl}/co/es-co/productos/{$slug}",
            "{$baseUrl}/co/es-co/productos/{$slug}.html",
            "{$baseUrl}/co/es-co/search?q=".urlencode($product->name),
        ]);
    }

    private function probeSikaDirectPdfUrls(Product $product): array
    {
        $slug = $this->buildProductSlug($product->name);
        $folders = array_unique([
            substr($slug, 0, 1),
            strtolower(substr($product->name, 0, 1)),
        ]);

        $candidates = [];

        foreach ($folders as $folder) {
            if ($folder === '') {
                continue;
            }

            $url = "https://col.sika.com/dam/dms/co01/{$folder}/{$slug}.pdf";
            if ($this->urlReturnsPdf($url)) {
                $candidates[] = $url;
            }
        }

        return $candidates;
    }

    private function extractPdfUrlsFromPages(array $urls): array
    {
        $found = [];

        foreach ($urls as $url) {
            $html = $this->fetchHtml($url);

            if (! $html) {
                continue;
            }

            $found = array_merge($found, $this->extractPdfUrlsFromText($html, $url));
        }

        return array_unique($found);
    }

    private function extractPdfUrlsFromText(string $text, string $baseUrl): array
    {
        $urls = [];

        preg_match_all('/https?:\/\/[^\s"\'<>]+\.pdf[^\s"\'<>]*/i', $text, $absoluteMatches);
        preg_match_all('/(?:href|src)=["\']([^"\']+\.pdf[^"\']*)["\']/i', $text, $attributeMatches);
        preg_match_all('/uddg=([^&"\']+)/i', $text, $duckMatches);

        foreach (array_merge($absoluteMatches[0] ?? [], $attributeMatches[1] ?? []) as $match) {
            $urls[] = $this->makeAbsoluteUrl(html_entity_decode($match), $baseUrl);
        }

        foreach ($duckMatches[1] ?? [] as $encodedUrl) {
            $decoded = urldecode($encodedUrl);
            if (str_contains(strtolower($decoded), '.pdf')) {
                $urls[] = $decoded;
            }
        }

        return array_values(array_unique(array_filter($urls)));
    }

    private function searchPdfViaWeb(Product $product, array $domains, ?string $brandName = null): array
    {
        $queries = [];
        $cleanName = $this->cleanProductName($product->name);
        $brand = $brandName ?: ($product->brand->name ?? '');

        if (! empty($domains)) {
            foreach ($domains as $domain) {
                $queries[] = "site:{$domain} filetype:pdf \"{$cleanName}\"";
            }
        }

        $queries[] = "\"{$brand}\" \"{$cleanName}\" ficha tecnica filetype:pdf";
        $queries[] = "\"{$cleanName}\" ficha tecnica filetype:pdf";

        $found = [];

        foreach (array_unique($queries) as $query) {
            $found = array_merge($found, $this->searchDuckDuckGo($query));
            $found = array_merge($found, $this->searchBing($query));

            if (! empty($found)) {
                break;
            }

            usleep(250000);
        }

        return array_unique($found);
    }

    private function searchDuckDuckGo(string $query): array
    {
        $html = $this->fetchHtml('https://html.duckduckgo.com/html/?q='.urlencode($query));

        if (! $html) {
            return [];
        }

        return $this->extractPdfUrlsFromText($html, 'https://duckduckgo.com');
    }

    private function searchBing(string $query): array
    {
        $html = $this->fetchHtml('https://www.bing.com/search?q='.urlencode($query));

        if (! $html) {
            return [];
        }

        return $this->extractPdfUrlsFromText($html, 'https://www.bing.com');
    }

    private function pickBestPdfCandidate(array $urls, Product $product): ?string
    {
        $bestUrl = null;
        $bestScore = 0.0;

        foreach (array_unique($urls) as $url) {
            if (! $this->looksLikePdfUrl($url)) {
                continue;
            }

            $score = $this->scorePdfUrl($url, $product);

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestUrl = $url;
            }
        }

        if ($bestScore < 35) {
            return null;
        }

        return $bestUrl;
    }

    private function scorePdfUrl(string $url, Product $product): float
    {
        $urlNorm = $this->normalizeString(urldecode(basename(parse_url($url, PHP_URL_PATH) ?? '')));
        $nameNorm = $this->normalizeString($this->cleanProductName($product->name));
        $slugNorm = $this->normalizeString($product->slug);
        $score = 0.0;

        if ($urlNorm === $nameNorm || $urlNorm === $slugNorm) {
            return 100.0;
        }

        if ($nameNorm !== '' && (str_contains($urlNorm, $nameNorm) || str_contains($nameNorm, $urlNorm))) {
            $score = 90.0;
        } else {
            similar_text($urlNorm, $nameNorm, $namePercent);
            similar_text($urlNorm, $slugNorm, $slugPercent);
            $score = max((float) $namePercent, (float) $slugPercent);
        }

        $urlLower = strtolower($url);

        foreach (['col.sika.com', 'cdnmedia.mapei.com', 'mapei.com', 'metic', 'corona'] as $trustedHost) {
            if (str_contains($urlLower, $trustedHost)) {
                $score += 10;
                break;
            }
        }

        foreach (['ficha', 'tecnica', 'technical', 'datasheet', 'hoja', 'tds', 'pds'] as $keyword) {
            if (str_contains($urlLower, $keyword)) {
                $score += 5;
            }
        }

        return min($score, 100.0);
    }

    private function urlReturnsPdf(string $url): bool
    {
        try {
            $response = Http::timeout(15)
                ->withHeaders($this->httpHeaders())
                ->head($url);

            if (! $response->successful()) {
                return false;
            }

            $contentType = strtolower($response->header('Content-Type') ?? '');

            return str_contains($contentType, 'pdf');
        } catch (\Throwable) {
            return false;
        }
    }

    private function looksLikePdfUrl(string $url): bool
    {
        $lower = strtolower($url);

        return str_contains($lower, '.pdf') || str_contains($lower, 'getdocument.get');
    }

    private function buildProductSlug(string $name): string
    {
        $clean = $this->cleanProductName($name);

        return Str::slug($clean);
    }

    private function cleanProductName(string $name): string
    {
        $name = str_replace(['®', '™', '©'], '', $name);
        $name = preg_replace('/\s+/', ' ', trim($name)) ?? $name;

        return $name;
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

            return $this->storePdfContent($content, $product, 'local');
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

        if (str_contains($brandName, 'metic')) {
            return 'metic';
        }

        if (str_contains($brandName, 'corona')) {
            return 'corona';
        }

        return null;
    }

    private function fetchHtml(string $url): ?string
    {
        try {
            $response = Http::timeout(30)
                ->withHeaders($this->httpHeaders())
                ->get($url);

            if (! $response->successful()) {
                return null;
            }

            $body = $response->body();

            if (str_contains(strtolower($body), 'you have been blocked')) {
                return null;
            }

            return $body;
        } catch (\Throwable) {
            return null;
        }
    }

    private function httpHeaders(): array
    {
        return [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language' => 'es-CO,es;q=0.9,en;q=0.8',
        ];
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

    private function downloadAndSavePdf(string $pdfUrl, Product $product, string $sourceTag): ?string
    {
        try {
            $response = Http::timeout(45)
                ->withHeaders($this->httpHeaders())
                ->get($pdfUrl);

            if (! $response->successful()) {
                return null;
            }

            $content = $response->body();

            if (! $this->isPdfContent($content)) {
                return null;
            }

            return $this->storePdfContent($content, $product, $sourceTag);
        } catch (\Throwable) {
            return null;
        }
    }

    private function storePdfContent(string $content, Product $product, string $sourceTag): ?string
    {
        $year = date('Y');
        $month = date('m');
        $fileName = Str::slug($this->cleanProductName($product->name))."_{$sourceTag}_".time().'_'.Str::random(6).'.pdf';
        $path = "products/documents/{$year}/{$month}/{$fileName}";

        if (! Storage::disk('public')->put($path, $content)) {
            return null;
        }

        return $path;
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
