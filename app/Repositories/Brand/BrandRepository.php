<?php

namespace App\Repositories\Brand;

use App\Models\Brand;
use App\Repositories\BaseRepository;

/**
 * ============================================
 * REPOSITORIO: BrandRepository
 * ============================================
 *
 * Centraliza la lógica de acceso a datos de marcas.
 */
class BrandRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'slug',
        'description',
        'is_active',
        'created_at',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Brand::class;
    }

    /**
     * Obtiene todas las marcas activas ordenadas.
     */
    public function getAllActive()
    {
        return $this->model
            ->active()
            ->ordered()
            ->get();
    }

    /**
     * Obtiene todas las marcas (activas e inactivas) para el panel admin.
     */
    public function getAllForAdmin()
    {
        return $this->model
            ->ordered()
            ->get();
    }
}

