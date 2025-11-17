<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * ============================================
 * INTERFACE: ProjectRepositoryInterface
 * ============================================
 * 
 * Interface del repositorio de proyectos usando Prettus Repository.
 * Define los métodos personalizados además de los métodos base de RepositoryInterface.
 * 
 * MÉTODOS BASE DE PRETTUS (heredados de RepositoryInterface):
 * - find($id)
 * - findWhere(array $where)
 * - create(array $attributes)
 * - update(array $attributes, $id)
 * - delete($id)
 * - all()
 * - paginate($limit = null)
 * - etc.
 * 
 * MÉTODOS PERSONALIZADOS:
 * - getFeatured($limit) - Proyectos destacados
 * - findBySlug($slug) - Buscar por slug
 * - getAllActive() - Todos los activos
 */
interface ProjectRepositoryInterface extends RepositoryInterface
{
    /**
     * Obtiene proyectos destacados para mostrar en home
     *
     * @param int $limit
     * @return mixed
     */
    public function getFeatured(int $limit = 3);

    /**
     * Obtiene un proyecto por su slug
     *
     * @param string $slug
     * @return mixed
     */
    public function findBySlug(string $slug);

    /**
     * Obtiene todos los proyectos activos ordenados
     *
     * @return mixed
     */
    public function getAllActive();

    /**
     * Obtiene todos los proyectos (incluyendo inactivos) para admin
     *
     * @return mixed
     */
    public function getAllForAdmin();
}

