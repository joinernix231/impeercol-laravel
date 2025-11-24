<?php

namespace App\Repositories\Blog;

use App\Models\Blog;
use App\Repositories\BaseRepository;

/**
 * ============================================
 * REPOSITORIO: BlogRepository
 * ============================================
 * 
 * Repositorio de artículos de blog usando BaseRepository.
 * Extiende BaseRepository que proporciona métodos CRUD automáticos.
 * 
 * MÉTODOS BASE DISPONIBLES (heredados de BaseRepository):
 * - create($attributes) - Crear artículo
 * - update($attributes, $id) - Actualizar artículo
 * - delete($id) - Eliminar artículo
 * - find($id) - Buscar por ID
 * - all() - Todos los artículos
 * - paginate($limit) - Con paginación
 * 
 * MÉTODOS PERSONALIZADOS:
 * - getFeatured($limit) - Artículos destacados
 * - findBySlug($slug) - Buscar por slug
 * - getAllActive() - Todos los activos
 * - getAllForAdmin() - Para panel admin
 * - getPublished($limit) - Artículos publicados
 */
class BlogRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'excerpt',
        'author',
        'content',
        'created_at',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Blog::class;
    }

    /**
     * Obtiene artículos destacados
     *
     * @param int $limit
     * @return mixed
     */
    public function getFeatured(int $limit = 3)
    {
        return $this->model
            ->active()
            ->featured()
            ->ordered()
            ->limit($limit)
            ->get();
    }

    /**
     * Obtiene un artículo por su slug
     *
     * @param string $slug
     * @return mixed
     */
    public function findBySlug(string $slug)
    {
        return $this->model
            ->where('slug', $slug)
            ->published()
            ->first();
    }

    /**
     * Obtiene todos los artículos activos
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
     * Obtiene artículos publicados con paginación
     *
     * @param int $limit
     * @return mixed
     */
    public function getPublished(int $limit = 12)
    {
        return $this->model
            ->published()
            ->ordered()
            ->paginate($limit);
    }

    /**
     * Obtiene todos los artículos para el panel admin (incluye inactivos)
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
     * Busca artículos por término
     *
     * @param string $search
     * @param int $limit
     * @return mixed
     */
    public function search(string $search, int $limit = 12)
    {
        return $this->model
            ->published()
            ->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
            })
            ->ordered()
            ->paginate($limit);
    }
}





