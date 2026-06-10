<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\TechnicalSheetImportService;
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
                            {--dry-run : Mostrar acciones sin guardar cambios}
                            {--export-failures= : Exportar fallidos a CSV (default: storage/app/imports/fallidos-fichas.csv)}';

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

    private array $mapeiLinePdfCache = [];

    public function __construct(
        private readonly TechnicalSheetImportService $importService
    ) {
        parent::__construct();
    }

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
        $failures = [];

        $progressBar = $this->output->createProgressBar($products->count());
        $progressBar->start();

        foreach ($products as $product) {
            $progressBar->advance();

            $brandType = $this->resolveBrandType($product);
            $pdfUrl = $this->searchTechnicalSheetUrl($product, $brandType);

            if (! $pdfUrl) {
                $failedCount++;
                $failures[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'brand' => $product->brand->name ?? '',
                ];

                if ($this->option('verbose')) {
                    $this->newLine();
                    $baseName = $this->resolveBrandType($product) === 'mapei'
                        ? $this->getPrimaryBaseName($product)
                        : $product->name;
                    $this->line("  PDF no encontrado: {$product->name} ({$product->brand->name}) [base: {$baseName}]");
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
                $failures[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'brand' => $product->brand->name ?? '',
                    'error' => 'download_failed',
                ];

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

        if (! empty($failures) && ! $this->option('dry-run')) {
            $this->exportFailures($failures);
        }

        if ($failedCount > 0) {
            $this->newLine();
            $this->line('Si Mapei bloquea el servidor, usa la API de agente: /api/agent/technical-sheets');
        }

        return Command::SUCCESS;
    }

    private function exportFailures(array $failures): void
    {
        $path = $this->option('export-failures') ?: storage_path('app/imports/fallidos-fichas.csv');
        File::ensureDirectoryExists(dirname($path));

        $handle = fopen($path, 'w');
        fputcsv($handle, ['id', 'nombre', 'slug', 'marca', 'error']);

        foreach ($failures as $failure) {
            fputcsv($handle, [
                $failure['id'],
                $failure['name'],
                $failure['slug'],
                $failure['brand'],
                $failure['error'] ?? 'not_found',
            ]);
        }

        fclose($handle);

        $this->newLine();
        $this->warn("Fallidos exportados: {$path}");
        $this->line('Ver pendientes: php artisan products:missing-technical-sheets');
    }

    private function searchTechnicalSheetUrl(Product $product, ?string $brandType): ?string
    {
        $candidates = [];

        if ($brandType === 'sika') {
            $typeaheadCandidates = $this->searchSikaViaTypeahead($product);
            $typeaheadMatch = $this->pickBestScoredCandidate($typeaheadCandidates);

            if ($typeaheadMatch) {
                return $typeaheadMatch;
            }

            $candidates = array_merge($candidates, $typeaheadCandidates);
            $candidates = array_merge($candidates, $this->mapUrlsToCandidates(
                $this->probeSikaDirectPdfUrls($product),
                $product,
                75
            ));
            $candidates = array_merge($candidates, $this->mapUrlsToCandidates(
                $this->extractPdfUrlsFromPages($this->buildSikaProductPageUrls($product)),
                $product,
                60
            ));
        }

        if ($brandType === 'mapei') {
            $cachedUrl = $this->getCachedMapeiLinePdf($product);

            if ($cachedUrl) {
                return $cachedUrl;
            }

            $mapeiCandidates = $this->searchMapeiCandidates($product);
            $mapeiMatch = $this->pickBestScoredCandidate($mapeiCandidates);

            if ($mapeiMatch) {
                $this->cacheMapeiLinePdf($product, $mapeiMatch);

                return $mapeiMatch;
            }

            $candidates = array_merge($candidates, $mapeiCandidates);
        }

        $domains = $this->resolveSearchDomains($product, $brandType);
        $candidates = array_merge($candidates, $this->mapUrlsToCandidates(
            $this->searchPdfViaWeb($product, $domains),
            $product,
            50
        ));

        if ($brandType === null) {
            $brandName = $product->brand->name ?? '';
            $candidates = array_merge($candidates, $this->mapUrlsToCandidates(
                $this->searchPdfViaWeb($product, [], $brandName),
                $product,
                45
            ));
        }

        return $this->pickBestScoredCandidate($candidates);
    }

    private function searchSikaViaTypeahead(Product $product): array
    {
        $candidates = [];

        foreach ($this->buildSearchQueries($product, 'sika') as $query) {
            try {
                $response = Http::timeout(20)
                    ->withHeaders($this->httpHeaders())
                    ->get('https://col.sika.com/content/co/main/es/serp/_jcr_content.typeahead.json', [
                        'q' => $query,
                        'language' => 'es',
                    ]);

                if (! $response->successful()) {
                    continue;
                }

                $data = $response->json();

                foreach ($data['topResults'] ?? [] as $result) {
                    $candidate = $this->parseSikaTypeaheadResult($result, $product);

                    if ($candidate) {
                        $candidates[] = $candidate;
                    }
                }
            } catch (\Throwable) {
                continue;
            }

            if (! empty($candidates)) {
                break;
            }
        }

        return $candidates;
    }

    private function parseSikaTypeaheadResult(array $result, Product $product): ?array
    {
        $link = $result['link'] ?? '';
        $description = html_entity_decode(strip_tags($result['description'] ?? ''), ENT_QUOTES, 'UTF-8');
        $title = html_entity_decode(strip_tags($result['title'] ?? ''), ENT_QUOTES, 'UTF-8');
        $linkLower = strtolower($link);
        $descLower = strtolower($description);

        if (! $this->looksLikePdfUrl($link)) {
            return null;
        }

        if ($this->isSafetyDataSheet($linkLower, $descLower)) {
            return null;
        }

        $score = $this->scoreTitleMatch($title, $product) + 20;

        if (str_contains($descLower, 'hoja de datos del producto')
            || str_contains($descLower, 'product data sheet')
            || str_contains($descLower, 'ficha tecnica')) {
            $score += 30;
        }

        return [
            'url' => $link,
            'score' => min($score, 100),
        ];
    }

    private function buildSearchQueries(Product $product, ?string $brandType = null): array
    {
        $cleanName = $this->cleanProductName($product->name);
        $queries = [
            $cleanName,
            "{$cleanName} hoja producto",
            "{$cleanName} ficha tecnica",
        ];

        if ($brandType === 'sika' && ! preg_match('/^sika\b/i', $cleanName)) {
            $queries[] = "Sika {$cleanName}";
        }

        $withoutBrand = preg_replace('/^sika[\s®™-]*/i', '', $cleanName) ?? $cleanName;
        $withoutBrand = trim($withoutBrand);

        if ($withoutBrand !== '' && $withoutBrand !== $cleanName) {
            $queries[] = $withoutBrand;
            $queries[] = "Sika {$withoutBrand}";
            $queries[] = "{$withoutBrand} hoja producto";
        }

        $parts = preg_split('/\s+/', $cleanName) ?: [];
        if (count($parts) >= 2) {
            $queries[] = implode(' ', array_slice($parts, 0, 2));
        }

        return array_values(array_unique(array_filter($queries)));
    }

    private function isSafetyDataSheet(string $linkLower, string $descLower): bool
    {
        foreach (['seguridad', 'safety data', 'co-hs_', '/sds', 'msds', 'hoja de datos de seguridad'] as $marker) {
            if (str_contains($linkLower, $marker) || str_contains($descLower, $marker)) {
                return true;
            }
        }

        return false;
    }

    private function scoreTitleMatch(string $title, Product $product): float
    {
        $titleNorm = $this->normalizeString($this->cleanProductName($title));
        $nameNorm = $this->normalizeString($this->cleanProductName($product->name));

        if ($titleNorm === $nameNorm) {
            return 100.0;
        }

        if ($nameNorm !== '' && (str_contains($titleNorm, $nameNorm) || str_contains($nameNorm, $titleNorm))) {
            return 90.0;
        }

        similar_text($titleNorm, $nameNorm, $percent);

        return (float) $percent;
    }

    private function mapUrlsToCandidates(array $urls, Product $product, float $baseScore): array
    {
        return array_map(function (string $url) use ($product, $baseScore) {
            return [
                'url' => $url,
                'score' => max($baseScore, $this->scorePdfUrl($url, $product)),
            ];
        }, $urls);
    }

    private function pickBestScoredCandidate(array $candidates): ?string
    {
        $bestUrl = null;
        $bestScore = 0.0;

        foreach ($candidates as $candidate) {
            $url = $candidate['url'] ?? null;
            $score = (float) ($candidate['score'] ?? 0);

            if (! $url || ! $this->looksLikePdfUrl($url)) {
                continue;
            }

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestUrl = $url;
            }
        }

        if ($bestScore < 40) {
            return null;
        }

        return $bestUrl;
    }

    private function buildSikaProductPageUrls(Product $product): array
    {
        $slug = $this->buildProductSlug($product->name);
        $baseUrl = $this->baseUrls['sika'];

        return array_unique([
            "{$baseUrl}/es/products/{$slug}.html",
            "{$baseUrl}/es/products/{$slug}",
        ]);
    }

    private function searchMapeiCandidates(Product $product): array
    {
        $candidates = [];

        foreach ($this->deriveProductNameVariants($product->name) as $variantName) {
            foreach ($this->buildMapeiProductPageUrls($variantName) as $pageUrl) {
                $statusCode = null;
                $tdsUrl = $this->fetchMapeiProductTdsUrl($pageUrl, $statusCode);

                if ($this->option('verbose') && ! $tdsUrl) {
                    $this->newLine();
                    $this->line("  Mapei page HTTP {$statusCode}: {$pageUrl}");
                }

                if ($tdsUrl) {
                    $candidates[] = [
                        'url' => $tdsUrl,
                        'score' => min($this->scorePdfUrl($tdsUrl, $product) + 20, 100),
                    ];
                }
            }

            if ($this->pickBestScoredCandidate($candidates)) {
                break;
            }
        }

        return $candidates;
    }

    private function buildMapeiProductPageUrls(string $productName): array
    {
        $slug = $this->buildProductSlug($productName);
        $baseUrl = $this->baseUrls['mapei'];

        return array_unique([
            "{$baseUrl}/co/es-co/productos/lista-de-productos/detalles-del-producto/{$slug}",
        ]);
    }

    private function fetchMapeiProductTdsUrl(string $pageUrl, ?int &$statusCode = null): ?string
    {
        $html = $this->fetchHtml($pageUrl, $statusCode);

        if (! $html) {
            return null;
        }

        return $this->importService->extractMapeiTdsUrlFromHtml($html);
    }

    private function deriveProductNameVariants(string $name): array
    {
        $clean = $this->cleanProductName($name);
        $variants = [$clean];
        $current = $clean;

        $colors = [
            'gris cemento', 'gris perla', 'gris', 'blanco', 'negro', 'beige', 'rojo', 'azul',
            'marfil', 'antracita', 'terracota', 'cemento', 'marron', 'verde', 'amarillo',
            'perla', 'natural', 'transparente', 'incoloro',
        ];

        usort($colors, fn ($a, $b) => strlen($b) <=> strlen($a));

        foreach ($colors as $color) {
            $stripped = preg_replace('/\s+'.preg_quote($color, '/').'$/iu', '', $current) ?? $current;
            $stripped = trim($stripped);

            if ($stripped !== '' && $stripped !== $current) {
                $variants[] = $stripped;
                $current = $stripped;
            }
        }

        foreach ([
            '/\\s+bolsa\\s+\\d+\\s*kg$/iu',
            '/\\s+saco\\s+\\d+\\s*kg$/iu',
            '/\\s+\\d+\\s*kg$/iu',
            '/\\s+\\d{2,4}\\s+[\\p{L}\\s]+$/u',
            '/\\s+\\d{2,4}$/u',
        ] as $pattern) {
            $stripped = preg_replace($pattern, '', $current) ?? $current;
            $stripped = trim($stripped);

            if ($stripped !== '' && $stripped !== $current) {
                $variants[] = $stripped;
                $current = $stripped;
            }
        }

        $words = preg_split('/\s+/', $current) ?: [];

        while (count($words) > 2) {
            array_pop($words);
            $shortName = trim(implode(' ', $words));

            if ($shortName !== '') {
                $variants[] = $shortName;
            }
        }

        return array_values(array_unique(array_filter($variants)));
    }

    private function getPrimaryBaseName(Product $product): string
    {
        $variants = $this->deriveProductNameVariants($product->name);

        return end($variants) ?: $this->cleanProductName($product->name);
    }

    private function getCachedMapeiLinePdf(Product $product): ?string
    {
        $key = $this->normalizeString($this->getPrimaryBaseName($product));

        return $this->mapeiLinePdfCache[$key] ?? null;
    }

    private function cacheMapeiLinePdf(Product $product, string $url): void
    {
        $key = $this->normalizeString($this->getPrimaryBaseName($product));
        $this->mapeiLinePdfCache[$key] = $url;
    }

    private function probeSikaDirectPdfUrls(Product $product): array
    {
        $slugs = array_unique(array_filter([
            $this->buildProductSlug($product->name),
            $this->buildProductSlug(preg_replace('/^sika[\s®™-]*/i', '', $this->cleanProductName($product->name)) ?? ''),
        ]));

        $folders = array_merge(
            range('0', '9'),
            range('a', 'z')
        );

        $candidates = [];

        foreach ($slugs as $slug) {
            if ($slug === '') {
                continue;
            }

            foreach ($folders as $folder) {
                $url = "https://col.sika.com/dam/dms/co01/{$folder}/{$slug}.pdf";

                if ($this->urlReturnsPdf($url)) {
                    $candidates[] = $url;
                    break 2;
                }
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
        preg_match_all('#https://cdnmedia\.mapei\.com[^"\s<>]+\.pdf[^"\s<>]*#i', $text, $mapeiMatches);
        preg_match_all('/(?:href|src)=["\']([^"\']+\.pdf[^"\']*)["\']/i', $text, $attributeMatches);
        preg_match_all('/uddg=([^&"\']+)/i', $text, $duckMatches);

        foreach (array_merge($absoluteMatches[0] ?? [], $mapeiMatches[0] ?? [], $attributeMatches[1] ?? []) as $match) {
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

    private function searchPdfViaWeb(Product $product, array $domains, ?string $brandName = null, ?array $nameVariants = null): array
    {
        $queries = [];
        $searchNames = $nameVariants ?: $this->deriveProductNameVariants($product->name);
        $brand = $brandName ?: ($product->brand->name ?? '');

        foreach ($searchNames as $searchName) {
            if (! empty($domains)) {
                foreach ($domains as $domain) {
                    $queries[] = "site:{$domain} filetype:pdf \"{$searchName}\"";
                    $queries[] = "site:{$domain} {$searchName} filetype:pdf";
                }
            }

            $queries[] = "\"{$brand}\" \"{$searchName}\" ficha tecnica filetype:pdf";
            $queries[] = "\"{$searchName}\" ficha tecnica filetype:pdf";
        }

        $found = [];

        foreach (array_unique($queries) as $query) {
            $found = array_merge($found, $this->searchBing($query));

            if (! empty($found)) {
                break;
            }

            usleep(250000);
        }

        return array_unique($found);
    }

    private function searchBing(string $query): array
    {
        $html = $this->fetchHtml('https://www.bing.com/search?q='.urlencode($query));

        if (! $html) {
            return [];
        }

        return $this->extractPdfUrlsFromText($html, 'https://www.bing.com');
    }

    private function scorePdfUrl(string $url, Product $product): float
    {
        $urlNorm = $this->normalizeString(urldecode(basename(parse_url($url, PHP_URL_PATH) ?? '')));
        $slugNorm = $this->normalizeString($product->slug);
        $score = 0.0;

        foreach ($this->deriveProductNameVariants($product->name) as $variantName) {
            $nameNorm = $this->normalizeString($variantName);

            if ($urlNorm === $nameNorm) {
                $score = max($score, 100.0);
                continue;
            }

            if ($nameNorm !== '' && (str_contains($urlNorm, $nameNorm) || str_contains($nameNorm, $urlNorm))) {
                $score = max($score, 90.0);
                continue;
            }

            similar_text($urlNorm, $nameNorm, $namePercent);
            $score = max($score, (float) $namePercent);
        }

        similar_text($urlNorm, $slugNorm, $slugPercent);
        $score = max($score, (float) $slugPercent);

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

    private function resolveSearchDomains(Product $product, ?string $brandType): array
    {
        if ($brandType && isset($this->searchDomains[$brandType])) {
            return $this->searchDomains[$brandType];
        }

        $brandSlug = Str::slug($product->brand->name ?? '');

        if ($brandSlug === '') {
            return [];
        }

        return array_unique([
            "{$brandSlug}.com.co",
            "{$brandSlug}.com",
            "{$brandSlug}.co",
        ]);
    }

    private function fetchHtml(string $url, ?int &$statusCode = null): ?string
    {
        try {
            $headers = $this->httpHeaders();

            if (str_contains($url, 'mapei.com')) {
                $headers['Referer'] = 'https://www.mapei.com/';
            }

            $response = Http::timeout(30)
                ->withHeaders($headers)
                ->get($url);

            $statusCode = $response->status();

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

    private function httpHeadersForPdfDownload(?string $brandType = null): array
    {
        $headers = $this->httpHeaders();
        $headers['Accept'] = 'application/pdf,application/octet-stream,*/*';

        if ($brandType === 'mapei' || str_contains(strtolower($brandType ?? ''), 'mapei')) {
            $headers['Referer'] = 'https://www.mapei.com/';
        }

        return $headers;
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
            $brandType = $this->resolveBrandType($product);
            $response = Http::timeout(45)
                ->withHeaders($this->httpHeadersForPdfDownload($brandType))
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
