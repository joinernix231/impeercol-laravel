<?php

namespace App\Repositories\Banner;

use App\Models\Banner;
use App\Repositories\BaseRepository;

/**
 * ============================================
 * REPOSITORIO: BannerRepository
 * ============================================
 * 
 * Repositorio de banners usando BaseRepository.
 * Extiende BaseRepository que proporciona métodos CRUD automáticos.
 * 
 * MÉTODOS BASE DISPONIBLES (heredados de BaseRepository):
 * - create($attributes) - Crear banner
 * - update($attributes, $id) - Actualizar banner
 * - delete($id) - Eliminar banner
 * - find($id) - Buscar por ID
 * - all() - Todos los banners
 * - paginate($limit) - Con paginación
 * 
 * MÉTODOS PERSONALIZADOS:
 * - getAllActive() - Todos los activos
 * - getAllForAdmin() - Para panel admin
 */
class BannerRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'subtitle',
        'created_at',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Banner::class;
    }

    /**
     * Obtiene todos los banners activos
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
     * Obtiene todos los banners para el panel admin (incluye inactivos)
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

