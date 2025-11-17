<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;

/**
 * ============================================
 * REPOSITORIO: ProductRepository
 * ============================================
 * 
 * Repositorio de productos usando BaseRepository.
 * Centraliza toda la lógica de acceso a datos de productos.
 * 
 * MÉTODOS BASE DISPONIBLES (heredados de BaseRepository):
 * - create($attributes) - Crear producto
 * - update($attributes, $id) - Actualizar producto
 * - delete($id) - Eliminar producto
 * - find($id) - Buscar por ID
 * - all() - Todos los productos
 * - paginate($limit) - Con paginación
 * 
 * MÉTODOS PERSONALIZADOS:
 * - getFeatured($limit) - Productos destacados
 * - findBySlug($slug) - Buscar por slug
 * - getAllActive() - Todos los activos
 * - getAllForAdmin() - Para panel admin (con variantes)
 * - getFiltered($filters, $perPage) - Con filtros y paginación
 * - getRelatedProducts($productId, $categoryId, $limit) - Productos relacionados
 * - getBrands() - Obtener todas las marcas únicas
 * - createWithVariants($productData, $variantsData) - Crear producto con variantes
 * - updateWithVariants($productData, $id, $variantsData) - Actualizar producto con variantes
 * - findWithRelations($id, $relations) - Buscar con relaciones cargadas
 */
class ProductRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'brand',
        'description',
        'created_at',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Product::class;
    }

    /**
     * Obtiene productos destacados para mostrar en home
     *
     * @param int $limit
     * @return mixed
     */
    public function getFeatured(int $limit = 3)
    {
        return $this->model
            ->with(['category', 'brand', 'activeVariants'])
            ->active()
            ->featured()
            ->ordered()
            ->limit($limit)
            ->get();
    }

    /**
     * Obtiene un producto por su slug
     *
     * @param string $slug
     * @return mixed
     */
    public function findBySlug(string $slug)
    {
        return $this->model
            ->with(['category', 'brand', 'activeVariants'])
            ->where('slug', $slug)
            ->active()
            ->first();
    }

    /**
     * Obtiene todos los productos activos ordenados
     *
     * @return mixed
     */
    public function getAllActive()
    {
        return $this->model
            ->with(['category', 'brand', 'activeVariants'])
            ->active()
            ->ordered()
            ->get();
    }

    /**
     * Obtiene todos los productos (incluyendo inactivos) para admin
     *
     * @return mixed
     */
    public function getAllForAdmin()
    {
        return $this->model
            ->with(['category', 'brand', 'variants'])
            ->ordered()
            ->get();
    }

    /**
     * Obtiene productos con filtros y paginación
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     */
    public function getFiltered(array $filters = [], int $perPage = 12)
    {
        $query = $this->model
            ->with(['category', 'brand', 'activeVariants'])
            ->active();

        // Filtrar por categoría
        if (isset($filters['category_id']) && $filters['category_id']) {
            $query->byCategory($filters['category_id']);
        }

        // Filtrar por marca
        if (isset($filters['brand']) && $filters['brand']) {
            $query->byBrand($filters['brand']);
        }

        // Ordenar
        $query->ordered();

        return $query->paginate($perPage);
    }

    /**
     * Obtiene productos relacionados de la misma categoría
     *
     * @param int $productId
     * @param int $categoryId
     * @param int $limit
     * @return mixed
     */
    public function getRelatedProducts(int $productId, int $categoryId, int $limit = 4)
    {
        return $this->model
            ->with(['category', 'brand', 'activeVariants'])
            ->where('category_id', $categoryId)
            ->where('id', '!=', $productId)
            ->active()
            ->ordered()
            ->limit($limit)
            ->get();
    }

    /**
     * Obtiene todas las marcas únicas de productos activos
     *
     * @return \Illuminate\Support\Collection
     */
    public function getBrands()
    {
        return $this->model
            ->active()
            ->whereNotNull('brand_id')
            ->with('brand')
            ->get()
            ->pluck('brand')
            ->filter()
            ->unique('id')
            ->sortBy('name')
            ->values();
    }

    /**
     * Crea un producto con sus variantes
     *
     * @param array $productData
     * @param array|null $variantsData
     * @return Product
     */
    public function createWithVariants(array $productData, ?array $variantsData = null)
    {
        // Crear el producto
        $product = $this->create($productData);

        // Crear variantes si existen
        if ($variantsData && is_array($variantsData)) {
            foreach ($variantsData as $variantData) {
                $product->variants()->create($variantData);
            }
        }

        return $product;
    }

    /**
     * Actualiza un producto con sus variantes
     *
     * @param array $productData
     * @param int $id
     * @param array|null $variantsData
     * @return Product
     */
    public function updateWithVariants(array $productData, int $id, ?array $variantsData = null)
    {
        // Actualizar el producto
        $product = $this->update($productData, $id);

        // Actualizar variantes si se proporcionan
        if ($variantsData !== null) {
            // Obtener IDs de variantes que vienen en el request (solo los que tienen ID)
            $variantIds = array_filter(array_column($variantsData, 'id'));
            
            // Eliminar variantes que no están en el request
            if (!empty($variantIds)) {
                $product->variants()->whereNotIn('id', $variantIds)->delete();
            } else {
                // Si no hay IDs, eliminar todas las variantes existentes
                $product->variants()->delete();
            }
            
            // Actualizar o crear variantes
            foreach ($variantsData as $variantData) {
                if (isset($variantData['id']) && !empty($variantData['id'])) {
                    // Actualizar variante existente
                    $variant = \App\Models\ProductVariant::where('product_id', $product->id)
                        ->where('id', $variantData['id'])
                        ->first();
                    
                    if ($variant) {
                        unset($variantData['id']); // Remover el ID del array para evitar conflictos
                        $variant->update($variantData);
                    }
                } else {
                    // Crear nueva variante
                    unset($variantData['id']); // Asegurar que no haya ID
                    $product->variants()->create($variantData);
                }
            }
        }

        return $product;
    }

    /**
     * Busca un producto por ID con sus relaciones
     *
     * @param int $id
     * @param array $relations
     * @return Product|null
     */
    public function findWithRelations(int $id, array $relations = ['variants'])
    {
        return $this->model
            ->with($relations)
            ->find($id);
    }
}

