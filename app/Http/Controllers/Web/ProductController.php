<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Category\CategoryRepository;
use App\Utils\Criterias\BasicCriteria\FiltersCriteria;
use Illuminate\Http\Request;

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
    protected $categoryRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Muestra la lista de productos con filtros y paginación
     */
    public function index(Request $request)
    {
        // Limpiar criterios previos
        $this->productRepository->resetCriteria();

        // Construir el string de filtros
        $filtersString = $this->buildFiltersString($request);

        // Si hay filtros, aplicarlos
        if (!empty($filtersString)) {
            $this->productRepository->pushCriteria(new FiltersCriteria($filtersString));
        }

        // Obtener productos con filtros aplicados
        $products = $this->productRepository->getFiltered(request('search'), 12);
        $categories = $this->categoryRepository->getAllActive();

        // Obtener todas las marcas únicas usando el repositorio
        $brands = $this->productRepository->getBrands();

        return view('web.products', compact('products', 'categories', 'brands', 'filtersString'));
    }

    /**
     * Construye el string de filtros en formato FiltersCriteria
     * 
     * @param Request $request
     * @return string
     */
    private function buildFiltersString(Request $request): string
    {
        $filterStrings = [];
        
        if ($request->has('category_id') && $request->get('category_id')) {
            $filterStrings[] = 'category_id|=|' . $request->get('category_id');
        }
        
        if ($request->has('brand') && $request->get('brand')) {
            $brandId = $request->get('brand');
            
            // Intentar obtener la marca para verificar si es Sika
            $brands = $this->productRepository->getBrands();
            $brandModel = $brands->firstWhere('id', $brandId);
            
            if ($brandModel) {
                $brandName = strtolower(trim($brandModel->name));
                if (strpos($brandName, 'sika') !== false) {
                    $filterStrings[] = 'brand.name|like|sika';
                } else {
                    $filterStrings[] = 'brand_id|=|' . $brandId;
                }
            } else {
                // Si no se encuentra en la colección, usar directamente el ID
                // Esto puede pasar si la marca existe pero no tiene productos activos
                $filterStrings[] = 'brand_id|=|' . $brandId;
            }
        }
        
        // También verificar si viene el parámetro 'filters' directamente
        if ($request->has('filters') && !empty($request->get('filters'))) {
            $existingFilters = explode(';', $request->get('filters'));
            foreach ($existingFilters as $filter) {
                if (!empty($filter) && !in_array($filter, $filterStrings)) {
                    $filterStrings[] = $filter;
                }
            }
        }
        
        return implode(';', $filterStrings);
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

        // Obtener todos los productos destacados (sin límite o con límite alto)
        $featuredProducts = $this->productRepository->getFeatured(100);

        return view('web.product-details', compact('product', 'relatedProducts', 'featuredProducts'));
    }
}
