<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

/**
 * ============================================
 * MODELO: Project
 * ============================================
 * 
 * Representa un proyecto de impermeabilización en la base de datos.
 * 
 * CAMPOS:
 * - title: Título del proyecto
 * - slug: URL amigable única
 * - description: Descripción detallada
 * - image: Imagen principal
 * - gallery: Array JSON de imágenes adicionales
 * - client: Nombre del cliente
 * - location: Ubicación del proyecto
 * - system: Sistema utilizado
 * - project_date: Fecha del proyecto
 * - is_featured: Si es destacado (aparece en home)
 * - order: Orden de visualización
 * - is_active: Si está activo
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'gallery',
        'client',
        'location',
        'system',
        'project_date',
        'is_featured',
        'order',
        'is_active',
    ];

    protected $casts = [
        'gallery' => 'array',
        'project_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Reglas de validación base para proyectos
     */
    public static $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:projects,slug',
        'description' => 'required|string',
        'image' => 'nullable|string|max:500',
        'gallery' => 'nullable|array',
        'gallery.*' => 'string|max:500',
        'client' => 'nullable|string|max:255',
        'location' => 'nullable|string|max:255',
        'system' => 'nullable|string|max:255',
        'project_date' => 'nullable|date',
        'is_featured' => 'nullable|boolean',
        'is_active' => 'nullable|boolean',
        'order' => 'nullable|integer|min:0',
    ];

    /**
     * Scope para proyectos activos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para proyectos destacados
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope para ordenar por orden y fecha
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('project_date', 'desc');
    }

    /**
     * Accesor: Obtiene la URL completa de la imagen principal
     * 
     * Las imágenes de proyectos deben estar en storage/app/public/projects/images/
     * y se acceden mediante /storage/projects/images/...
     * 
     * @return string URL completa de la imagen
     */
    public function getImageUrlAttribute(): string
    {
        $path = $this->image;

        if (!$path) {
            // Imagen por defecto
            return asset('assets/img/project/440x380-1.jpg');
        }

        // Si ya es una URL completa (http:// o https://)
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Si empieza con 'assets/', es una ruta de assets del template
        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        // Limpiar la ruta: remover 'storage/' si está presente
        $cleanPath = str_starts_with($path, 'storage/') ? substr($path, 8) : $path;
        
        // Si empieza con 'projects/', es una ruta de storage
        if (str_starts_with($cleanPath, 'projects/')) {
            // Usar asset() para generar URL relativa en lugar de Storage::url() que puede generar URL completa
            return asset('storage/' . $cleanPath);
        }

        // Si no empieza con 'projects/', asumir que es una ruta relativa de storage
        // y agregar el prefijo 'projects/images/' si no lo tiene
        if (!str_contains($cleanPath, 'projects/')) {
            $cleanPath = 'projects/images/' . ltrim($cleanPath, '/');
        }
        
        return asset('storage/' . $cleanPath);
    }

    /**
     * Accesor: Obtiene las URLs completas de la galería
     * 
     * Todas las imágenes de la galería deben estar en storage/app/public/projects/images/
     * 
     * @return array Array de URLs completas
     */
    public function getGalleryUrlsAttribute(): array
    {
        if (!$this->gallery || !is_array($this->gallery)) {
            return [];
        }

        return array_map(function ($path) {
            if (!$path) {
                return null;
            }

            // Si ya es una URL completa (http:// o https://)
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path;
            }

            // Si empieza con 'assets/', es una ruta de assets del template
            if (str_starts_with($path, 'assets/')) {
                return asset($path);
            }

            // Limpiar la ruta: remover 'storage/' si está presente
            $cleanPath = str_starts_with($path, 'storage/') ? substr($path, 8) : $path;
            
            // Si empieza con 'projects/', es una ruta de storage
            if (str_starts_with($cleanPath, 'projects/')) {
                return asset('storage/' . $cleanPath);
            }

            // Si no empieza con 'projects/', asumir que es una ruta relativa de storage
            // y agregar el prefijo 'projects/images/' si no lo tiene
            if (!str_contains($cleanPath, 'projects/')) {
                $cleanPath = 'projects/images/' . ltrim($cleanPath, '/');
            }
            
            return asset('storage/' . $cleanPath);
        }, array_filter($this->gallery));
    }
}
