<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Category\CategoryRepository;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Brand;
use Illuminate\Support\Str;

/**
 * ============================================
 * CONTROLADOR ADMIN: ProductController
 * ============================================
 *
 * Gestiona el CRUD de productos desde el panel administrativo.
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
     * Muestra la lista de productos
     */
    public function index()
    {

        $products = $this->productRepository->getAllForAdmin();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAllActive();
        $brands = Brand::active()->ordered()->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Guarda un nuevo producto
     */
    public function store(ProductStoreRequest $request)
    {
        $validated = $request->validated();

        // Generar slug automáticamente si no se proporciona
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Asegurar que gallery sea un array
        if (!isset($validated['gallery']) || !is_array($validated['gallery'])) {
            $validated['gallery'] = [];
        }

        // Extraer variantes del array validado
        $variantsData = $validated['variants'] ?? null;
        unset($validated['variants']);

        // Crear el producto con sus variantes usando el repositorio
        $this->productRepository->createWithVariants($validated, $variantsData);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto creado exitosamente');
    }

    /**
     * Muestra un producto específico
     */
    public function show($id)
    {
        $product = $this->productRepository->findWithRelations($id, ['category', 'brand', 'variants']);

        if (!$product) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Producto no encontrado');
        }

        return view('admin.products.show', compact('product'));
    }

    /**
     * Muestra el formulario para editar un producto
     */
    public function edit($id)
    {
        // Cargar el producto con sus variantes usando el repositorio
        $product = $this->productRepository->findWithRelations($id, ['category', 'brand', 'variants']);

        if (!$product) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Producto no encontrado');
        }

        $categories = $this->categoryRepository->getAllActive();
        $brands = Brand::active()->ordered()->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Actualiza un producto
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $validated = $request->validated();

        // Generar slug automáticamente si no se proporciona
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Asegurar que gallery sea un array
        if (!isset($validated['gallery']) || !is_array($validated['gallery'])) {
            $validated['gallery'] = [];
        }

        // Extraer variantes del array validado
        $variantsData = $validated['variants'] ?? null;
        unset($validated['variants']);

        // Actualizar el producto con sus variantes usando el repositorio
        $this->productRepository->updateWithVariants($validated, $id, $variantsData);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Elimina un producto
     */
    public function destroy($id)
    {
        $this->productRepository->delete($id);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto eliminado exitosamente');
    }
}
