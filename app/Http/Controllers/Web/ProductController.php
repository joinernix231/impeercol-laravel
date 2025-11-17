<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepository;
use App\Models\Category;

/**
 * ============================================
 * CONTROLADOR WEB: ProductController
 * ============================================
 * 
 * Controla las páginas públicas de productos.
 */
class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Muestra la lista de productos con filtros y paginación
     */
    public function index()
    {
        $filters = [
            'category_id' => request('category_id'),
            'brand' => request('brand'),
        ];

        $products = $this->productRepository->getFiltered($filters, 12);
        $categories = Category::active()->ordered()->get();
        
        // Obtener todas las marcas únicas usando el repositorio
        $brands = $this->productRepository->getBrands();

        return view('web.products', compact('products', 'categories', 'brands'));
    }

    /**
     * Muestra el detalle de un producto por slug
     */
    public function show($slug)
    {
        $product = $this->productRepository->findBySlug($slug);

        if (!$product) {
            abort(404, 'Producto no encontrado');
        }

        // Obtener productos relacionados de la misma categoría
        $relatedProducts = [];
        if ($product->category_id) {
            $relatedProducts = $this->productRepository->getRelatedProducts(
                $product->id,
                $product->category_id,
                4
            );
        }

        return view('web.product-details', compact('product', 'relatedProducts'));
    }
}
