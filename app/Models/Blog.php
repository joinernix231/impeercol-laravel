<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * ============================================
 * MODELO: Blog
 * ============================================
 * 
 * Representa un artículo de blog en la base de datos.
 * 
 * CAMPOS:
 * - title: Título del artículo
 * - slug: URL amigable única
 * - excerpt: Resumen del artículo
 * - content: Contenido completo del artículo
 * - image: Imagen principal
 * - gallery: Array JSON de imágenes adicionales
 * - author: Autor del artículo
 * - published_at: Fecha de publicación
 * - is_featured: Si es destacado
 * - order: Orden de visualización
 * - is_active: Si está activo
 * - meta_title: Título para SEO
 * - meta_description: Descripción para SEO
 */
class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'thumbnail',
        'gallery',
        'tags',
        'video_url',
        'reading_time',
        'featured_quote',
        'tips',
        'difficulty',
        'estimated_time',
        'materials',
        'tools',
        'author',
        'published_at',
        'is_featured',
        'order',
        'is_active',
        'views_count',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'gallery' => 'array',
        'tags' => 'array',
        'published_at' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'reading_time' => 'integer',
        'views_count' => 'integer',
    ];

    /**
     * Scope para artículos activos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para artículos destacados
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope para ordenar por orden y fecha de publicación
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('published_at', 'desc');
    }

    /**
     * Scope para artículos publicados
     */
    public function scopePublished($query)
    {
        return $query->where('is_active', true)
            ->where(function($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            });
    }

    /**
     * Accesor: Obtiene la URL completa de la imagen principal
     */
    public function getImageUrlAttribute(): string
    {
        $path = $this->image;

        if (!$path) {
            return asset('assets/img/blog/1.jpg'); // Imagen por defecto
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
        
        // Si empieza con 'blogs/', es una ruta de storage
        if (str_starts_with($cleanPath, 'blogs/')) {
            return asset('storage/' . $cleanPath);
        }

        // Por defecto, asumir que es una ruta de storage
        return asset('storage/' . $cleanPath);
    }

    /**
     * Accesor: Obtiene las URLs completas de la galería
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
            
            // Si empieza con 'blogs/', es una ruta de storage
            if (str_starts_with($cleanPath, 'blogs/')) {
                return asset('storage/' . $cleanPath);
            }

            // Por defecto, asumir que es una ruta de storage
            return asset('storage/' . $cleanPath);
        }, array_filter($this->gallery));
    }

    /**
     * Accesor: Obtiene la URL completa del thumbnail
     */
    public function getThumbnailUrlAttribute(): string
    {
        $path = $this->thumbnail;

        if (!$path) {
            return $this->image_url; // Si no hay thumbnail, usar la imagen principal
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
        
        // Si empieza con 'blogs/', es una ruta de storage
        if (str_starts_with($cleanPath, 'blogs/')) {
            return asset('storage/' . $cleanPath);
        }

        // Por defecto, asumir que es una ruta de storage
        return asset('storage/' . $cleanPath);
    }

    /**
     * Calcula el tiempo de lectura estimado basado en el contenido
     */
    public function calculateReadingTime(): int
    {
        if ($this->reading_time) {
            return $this->reading_time;
        }

        // Calcular basado en palabras (promedio 200 palabras por minuto)
        $wordCount = str_word_count(strip_tags($this->content));
        return max(1, ceil($wordCount / 200));
    }

    /**
     * Incrementa el contador de vistas
     */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    /**
     * Relación: Productos relacionados (muchos a muchos)
     */
    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class, 'blog_product', 'blog_id', 'product_id')
            ->withTimestamps();
    }
}

