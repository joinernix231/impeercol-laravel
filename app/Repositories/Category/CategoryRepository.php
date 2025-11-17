<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;

/**
 * ============================================
 * REPOSITORIO: CategoryRepository
 * ============================================
 * 
 * Repositorio de categorías usando BaseRepository.
 * Centraliza toda la lógica de acceso a datos de categorías.
 * 
 * MÉTODOS BASE DISPONIBLES (heredados de BaseRepository):
 * - create($attributes) - Crear categoría
 * - update($attributes, $id) - Actualizar categoría
 * - delete($id) - Eliminar categoría
 * - find($id) - Buscar por ID
 * - all() - Todas las categorías
 * - paginate($limit) - Con paginación
 * 
 * MÉTODOS PERSONALIZADOS:
 * - getFeatured($limit) - Categorías destacadas
 * - findBySlug($slug) - Buscar por slug
 * - getAllActive() - Todas las activas
 * - getAllForAdmin() - Para panel admin
 * - getWithProducts() - Categorías con sus productos
 */
class CategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'slug',
        'description',
        'created_at',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Category::class;
    }

    /**
     * Obtiene categorías destacadas
     *
     * @param int $limit
     * @return mixed
     */
    public function getFeatured(int $limit = 6)
    {
        return $this->model
            ->active()
            ->ordered()
            ->limit($limit)
            ->get();
    }

    /**
     * Obtiene una categoría por su slug
     *
     * @param string $slug
     * @return mixed
     */
    public function findBySlug(string $slug)
    {
        return $this->model
            ->where('slug', $slug)
            ->active()
            ->first();
    }

    /**
     * Obtiene todas las categorías activas ordenadas
     *
     * @return mixed
     */
    public function getAllActive()
    {
        return $this->model
            ->active()
            ->ordered()
            ->get();
    }

    /**
     * Obtiene todas las categorías (incluyendo inactivas) para admin
     *
     * @return mixed
     */
    public function getAllForAdmin()
    {
        return $this->model
            ->ordered()
            ->get();
    }

    /**
     * Obtiene categorías con sus productos cargados
     *
     * @return mixed
     */
    public function getWithProducts()
    {
        return $this->model
            ->active()
            ->with(['products' => function ($query) {
                $query->active();
            }])
            ->ordered()
            ->get();
    }
}

