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
        'category_id',
        'brand_id',
        'description',
        'is_active',
        'is_featured',
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
     * @param int|null $limit Si es null, obtiene todos sin límite
     * @return mixed
     */
    public function getFeatured(?int $limit = 3)
    {
        $query = $this->model
            ->with(['category', 'brand', 'activeVariants'])
            ->active()
            ->featured()
            ->ordered();
        
        if ($limit !== null) {
            $query->limit($limit);
        }
        
        return $query->get();
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
     * Los filtros de categoría y marca se aplican desde el controlador usando FiltersCriteria
     * Este método solo maneja la búsqueda por texto
     *
     * @param string|null $search
     * @param int $perPage
     * @return mixed
     */
    public function getFiltered(?string $search = null, int $perPage = 12, ?int $brandId = null)
    {
        // Construir la query base con relaciones y scope active
        $query = $this->model
            ->with(['category', 'brand', 'activeVariants'])
            ->active();

        // Aplicar filtro de marca directamente si se proporciona
        if ($brandId && $brandId > 0) {
            $query->where('brand_id', $brandId);
        }

        // Para la búsqueda, necesitamos un OR entre name, description y brand.name
        if (!empty($search)) {
            $search = trim($search);
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhereHas('brand', function($brandQuery) use ($search) {
                      $brandQuery->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }

        // Aplicar los criterios que se pusieron desde el controlador
        $criteria = $this->getCriteria();
        foreach ($criteria as $criterion) {
            $query = $criterion->apply($query, $this);
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
     * Agrupa las marcas de Sika en una sola opción
     *
     * @return \Illuminate\Support\Collection
     */
    public function getBrands()
    {
        $brands = $this->model
            ->active()
            ->whereNotNull('brand_id')
            ->with('brand')
            ->get()
            ->pluck('brand')
            ->filter()
            ->unique('id')
            ->sortBy(function($brand) {
                return $brand->name ?? '';
            })
            ->values();
        
        // Agrupar marcas de Sika: usar la primera marca de Sika encontrada como representante
        $sikaBrands = $brands->filter(function($brand) {
            return strpos(strtolower($brand->name), 'sika') !== false;
        });
        
        if ($sikaBrands->count() > 1) {
            // Obtener la primera marca de Sika (normalmente "SIKA" sin "constructor")
            $mainSika = $sikaBrands->first();
            
            // Remover todas las marcas de Sika de la colección
            $brands = $brands->reject(function($brand) {
                return strpos(strtolower($brand->name), 'sika') !== false;
            });
            
            // Agregar solo la marca principal de Sika
            $brands = $brands->push($mainSika);
            
            // Reordenar
            $brands = $brands->sortBy(function($brand) {
                $name = strtolower($brand->name ?? '');
                // Si es Sika, ponerlo en una posición especial
                if (strpos($name, 'sika') !== false) {
                    return '0_sika'; // Para que aparezca primero entre las que empiezan con S
                }
                return $brand->name ?? '';
            })->values();
        }
        
        return $brands;
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

