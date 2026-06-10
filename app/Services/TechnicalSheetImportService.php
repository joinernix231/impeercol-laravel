<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TechnicalSheetImportService
{
    public function pendingProductsQuery(?string $brand = null, bool $force = false): Builder
    {
        $query = Product::query()->with('brand')->orderBy('id');

        if (! $force) {
            $query->where(function ($q) {
                $q->whereNull('technical_sheet_file')
                    ->orWhere('technical_sheet_file', '');
            });
        }

        if ($brand) {
            $brand = strtolower($brand);
            $query->whereHas('brand', function ($q) use ($brand) {
                $q->where('name', 'LIKE', "%{$brand}%");
            });
        }

        return $query;
    }

    public function getPendingProducts(?string $brand = null, ?int $limit = null, bool $force = false): Collection
    {
        $query = $this->pendingProductsQuery($brand, $force);

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    public function assignPdfContent(Product $product, string $content, string $sourceTag, bool $force = false): array
    {
        if (! $force && ! empty($product->technical_sheet_file)) {
            return [
                'success' => false,
                'error' => 'already_assigned',
                'path' => $product->technical_sheet_file,
            ];
        }

        if (! $this->isPdfContent($content)) {
            return [
                'success' => false,
                'error' => 'invalid_pdf',
            ];
        }

        $path = $this->storePdfContent($content, $product, $sourceTag);

        if (! $path) {
            return [
                'success' => false,
                'error' => 'storage_failed',
            ];
        }

        $product->technical_sheet_file = $path;
        $product->save();

        return [
            'success' => true,
            'path' => $path,
        ];
    }

    public function assignFromUrl(Product $product, string $pdfUrl, string $sourceTag = 'agent', bool $force = false): array
    {
        $content = $this->downloadPdf($pdfUrl, $this->resolveBrandType($product));

        if ($content === null) {
            return [
                'success' => false,
                'error' => 'download_failed',
                'url' => $pdfUrl,
            ];
        }

        return $this->assignPdfContent($product, $content, $sourceTag, $force);
    }

    public function assignFromBase64(Product $product, string $base64, string $sourceTag = 'agent', bool $force = false): array
    {
        $content = base64_decode($base64, true);

        if ($content === false) {
            return [
                'success' => false,
                'error' => 'invalid_base64',
            ];
        }

        return $this->assignPdfContent($product, $content, $sourceTag, $force);
    }

    public function downloadPdf(string $pdfUrl, ?string $brandType = null): ?string
    {
        try {
            $response = Http::timeout(45)
                ->withHeaders($this->httpHeadersForPdfDownload($brandType))
                ->get($pdfUrl);

            if (! $response->successful()) {
                return null;
            }

            $content = $response->body();

            return $this->isPdfContent($content) ? $content : null;
        } catch (\Throwable) {
            return null;
        }
    }

    public function resolveMapeiTdsUrl(string $productName): ?string
    {
        $baseUrl = 'https://www.mapei.com';

        foreach ($this->deriveProductNameVariants($productName) as $variantName) {
            $slug = Str::slug($this->cleanProductName($variantName));
            $pageUrl = "{$baseUrl}/co/es-co/productos/lista-de-productos/detalles-del-producto/{$slug}";
            $html = $this->fetchHtml($pageUrl);

            if (! $html) {
                continue;
            }

            $tdsUrl = $this->extractMapeiTdsUrlFromHtml($html);

            if ($tdsUrl) {
                return $tdsUrl;
            }
        }

        return null;
    }

    public function suggestMapeiSlug(string $productName): string
    {
        $variants = $this->deriveProductNameVariants($productName);

        return Str::slug($this->cleanProductName(end($variants) ?: $productName));
    }

    public function extractMapeiTdsUrlFromHtml(string $html): ?string
    {
        if (! preg_match(
            '/<select[^>]*tds-language-selector[^>]*>(.*?)<\/select>/is',
            $html,
            $selectMatch
        )) {
            return null;
        }

        $bestUrl = null;
        $bestScore = -1;

        preg_match_all(
            '/<option([^>]*)value="([^"]+)"[^>]*>(.*?)<\/option>/is',
            $selectMatch[1],
            $optionMatches,
            PREG_SET_ORDER
        );

        foreach ($optionMatches as $optionMatch) {
            $url = html_entity_decode($optionMatch[2], ENT_QUOTES, 'UTF-8');
            $label = html_entity_decode(strip_tags($optionMatch[3]), ENT_QUOTES, 'UTF-8');
            $attributes = $optionMatch[1];

            if ($url === '' || ! str_contains(strtolower($url), '.pdf')) {
                continue;
            }

            $urlLower = strtolower($url);
            $labelLower = strtolower($label);
            $score = 0;

            if (str_contains($urlLower, 'tds-')) {
                $score += 50;
            }

            if (str_contains($attributes, 'selected')) {
                $score += 40;
            }

            if (str_contains($labelLower, 'espa') && str_contains($labelLower, 'colombia')) {
                $score += 30;
            } elseif (str_contains($labelLower, 'espa')) {
                $score += 20;
            }

            if (preg_match('/_(es|es-es|es-co)(_|\.)/', $urlLower)) {
                $score += 15;
            }

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestUrl = $url;
            }
        }

        if ($bestUrl && $bestScore >= 20) {
            return $bestUrl;
        }

        return null;
    }

    public function deriveProductNameVariants(string $name): array
    {
        $clean = $this->cleanProductName($name);
        $variants = [$clean];
        $current = $clean;

        $colors = [
            'gris cemento', 'gris perla', 'gris manhattan', 'gris', 'blanco', 'negro', 'beige', 'rojo', 'azul',
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
            '/\s+bolsa\s+\d+\s*kg$/iu',
            '/\s+saco\s+\d+\s*kg$/iu',
            '/\s+\d+\s*kg$/iu',
            '/\s+\d{2,4}\s+[\p{L}\s]+$/u',
            '/\s+\d{2,4}$/u',
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

    private function fetchHtml(string $url): ?string
    {
        try {
            $headers = $this->httpHeaders();

            if (str_contains($url, 'mapei.com')) {
                $headers['Referer'] = 'https://www.mapei.com/';
            }

            $response = Http::timeout(30)->withHeaders($headers)->get($url);

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

    private function storePdfContent(string $content, Product $product, string $sourceTag): ?string
    {
        $year = date('Y');
        $month = date('m');
        $fileName = Str::slug($this->cleanProductName($product->name))."_{$sourceTag}_".time().'_'.Str::random(6).'.pdf';
        $path = "products/documents/{$year}/{$month}/{$fileName}";

        if (! \Illuminate\Support\Facades\Storage::disk('public')->put($path, $content)) {
            return null;
        }

        return $path;
    }

    private function cleanProductName(string $name): string
    {
        $name = str_replace(['®', '™', '©'], '', $name);
        $name = preg_replace('/\s+/', ' ', trim($name)) ?? $name;

        return $name;
    }

    private function isPdfContent(string $content): bool
    {
        return str_starts_with($content, '%PDF');
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

        if ($brandType === 'mapei') {
            $headers['Referer'] = 'https://www.mapei.com/';
        }

        return $headers;
    }
}
