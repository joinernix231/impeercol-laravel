<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\TechnicalSheetImportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AgentTechnicalSheetController extends Controller
{
    public function __construct(
        private readonly TechnicalSheetImportService $importService
    ) {}

    public function pending(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'brand' => 'nullable|string|max:100',
            'limit' => 'nullable|integer|min:1|max:500',
            'force' => 'nullable|boolean',
        ]);

        $products = $this->importService->getPendingProducts(
            $validated['brand'] ?? null,
            $validated['limit'] ?? null,
            (bool) ($validated['force'] ?? false)
        );

        $items = $products->map(function (Product $product) {
            $brandName = strtolower($product->brand->name ?? '');
            $isMapei = str_contains($brandName, 'mapei');

            return [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'brand' => $product->brand->name ?? null,
                'mapei_slug' => $isMapei ? $this->importService->suggestMapeiSlug($product->name) : null,
            ];
        })->values();

        return response()->json([
            'success' => true,
            'count' => $items->count(),
            'items' => $items,
        ]);
    }

    public function resolveMapei(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'nullable|integer|exists:products,id',
            'name' => 'nullable|string|max:255',
        ]);

        $productName = $validated['name'] ?? null;

        if (! $productName && ! empty($validated['product_id'])) {
            $product = Product::query()->find($validated['product_id']);
            $productName = $product?->name;
        }

        if (! $productName) {
            return response()->json([
                'success' => false,
                'message' => 'Provide product_id or name.',
            ], 422);
        }

        $pdfUrl = $this->importService->resolveMapeiTdsUrl($productName);

        return response()->json([
            'success' => $pdfUrl !== null,
            'name' => $productName,
            'mapei_slug' => $this->importService->suggestMapeiSlug($productName),
            'pdf_url' => $pdfUrl,
        ]);
    }

    public function assign(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1|max:100',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.pdf_url' => 'nullable|url|max:2000',
            'items.*.pdf_base64' => 'nullable|string',
            'force' => 'nullable|boolean',
        ]);

        $force = (bool) ($validated['force'] ?? false);
        $results = [];

        foreach ($validated['items'] as $item) {
            $product = Product::query()->with('brand')->find($item['product_id']);

            if (! $product) {
                $results[] = [
                    'product_id' => $item['product_id'],
                    'success' => false,
                    'error' => 'not_found',
                ];
                continue;
            }

            if (! empty($item['pdf_base64'])) {
                $result = $this->importService->assignFromBase64(
                    $product,
                    $item['pdf_base64'],
                    'agent',
                    $force
                );
            } elseif (! empty($item['pdf_url'])) {
                $result = $this->importService->assignFromUrl(
                    $product,
                    $item['pdf_url'],
                    'agent',
                    $force
                );
            } else {
                $result = [
                    'success' => false,
                    'error' => 'missing_pdf_source',
                ];
            }

            $results[] = array_merge([
                'product_id' => $product->id,
                'name' => $product->name,
            ], $result);
        }

        $successCount = collect($results)->where('success', true)->count();

        return response()->json([
            'success' => $successCount > 0,
            'assigned' => $successCount,
            'failed' => count($results) - $successCount,
            'results' => $results,
        ]);
    }
}
