<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Project;
use App\Repositories\ProjectRepositoryInterface;

/**
 * ============================================
 * REPOSITORIO: ProjectRepositoryEloquent
 * ============================================
 * 
 * Implementación del repositorio de proyectos usando Prettus Repository.
 * Extiende BaseRepository que proporciona métodos CRUD automáticos.
 * 
 * VENTAJAS DE PRETTUS REPOSITORY:
 * 1. Métodos CRUD automáticos (create, update, delete, find, etc.)
 * 2. Criterios de búsqueda avanzados
 * 3. Validación integrada
 * 4. Cache automático (opcional)
 * 5. Presenters para transformar datos
 * 
 * INSTRUCCIONES PARA DESARROLLADORES:
 * 1. Usa $this->model para acceder al modelo
 * 2. Usa $this->pushCriteria() para agregar criterios de búsqueda
 * 3. Los métodos personalizados se definen aquí
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepositoryInterface
{
    /**
     * Especifica el modelo que usa este repositorio
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    /**
     * Boot del repositorio - se ejecuta al inicializar
     * Aquí puedes agregar criterios globales
     */
    public function boot()
    {
        // Habilita búsqueda automática por parámetros de request
        $this->pushCriteria(app(RequestCriteria::class));
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

