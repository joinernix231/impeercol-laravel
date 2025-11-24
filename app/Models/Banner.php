<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * ============================================
 * MODELO: Banner
 * ============================================
 * 
 * Representa un banner del slider principal en la página de inicio.
 * 
 * CAMPOS:
 * - title: Título del banner
 * - subtitle: Subtítulo del banner
 * - image: Ruta de la imagen de fondo
 * - order: Orden de visualización
 * - is_active: Si está activo
 */
class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Scope para banners activos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para ordenar por orden
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Accesor: Obtiene la URL completa de la imagen
     */
    public function getImageUrlAttribute(): string
    {
        $path = $this->image;

        if (!$path) {
            return asset('assets/img/gallery/BO-convertido-de-jpg.webp'); // Imagen por defecto
        }

        // Si ya es una URL completa
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Si empieza con 'assets/', es una ruta de assets del template
        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        // Limpiar la ruta: remover 'storage/' si está presente
        $cleanPath = str_starts_with($path, 'storage/') ? substr($path, 8) : $path;
        
        // Si empieza con 'banners/', es una ruta de storage
        if (str_starts_with($cleanPath, 'banners/')) {
            return asset('storage/' . $cleanPath);
        }

        // Por defecto, asumir que es una ruta de storage
        return asset('storage/' . $cleanPath);
    }
}

