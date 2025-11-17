<?php

namespace App\Repositories\Project;

use App\Models\Project;
use App\Repositories\BaseRepository;

/**
 * ============================================
 * REPOSITORIO: ProjectRepository
 * ============================================
 * 
 * Repositorio de proyectos usando BaseRepository.
 * Extiende BaseRepository que proporciona métodos CRUD automáticos.
 * 
 * MÉTODOS BASE DISPONIBLES (heredados de BaseRepository):
 * - create($attributes) - Crear proyecto
 * - update($attributes, $id) - Actualizar proyecto
 * - delete($id) - Eliminar proyecto
 * - find($id) - Buscar por ID
 * - all() - Todos los proyectos
 * - paginate($limit) - Con paginación
 * 
 * MÉTODOS PERSONALIZADOS:
 * - getFeatured($limit) - Proyectos destacados
 * - findBySlug($slug) - Buscar por slug
 * - getAllActive() - Todos los activos
 * - getAllForAdmin() - Para panel admin
 */
class ProjectRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'client',
        'location',
        'system',
        'created_at',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Project::class;
    }

    /**
     * Obtiene proyectos destacados para mostrar en home
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
     * Obtiene un proyecto por su slug
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
     * Obtiene todos los proyectos activos ordenados
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
     * Obtiene todos los proyectos (incluyendo inactivos) para admin
     *
     * @return mixed
     */
    public function getAllForAdmin()
    {
        return $this->model
            ->ordered()
            ->get();
    }
}
