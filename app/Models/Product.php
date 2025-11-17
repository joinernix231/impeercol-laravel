<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'gallery',
        'brand',
        'technical_sheet_file',
        'order',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Relación: Un producto pertenece a una categoría
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relación: Un producto tiene muchas variantes
     */
    public function variants()
    {
        return $this->hasMany(ProductVariant::class)->orderBy('order', 'asc');
    }

    /**
     * Relación: Un producto tiene variantes activas
     */
    public function activeVariants()
    {
        return $this->hasMany(ProductVariant::class)->where('is_active', true)->orderBy('order', 'asc');
    }

    /**
     * Scope para productos activos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para productos destacados
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope para ordenar por orden
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Scope para filtrar por categoría
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope para filtrar por marca
     */
    public function scopeByBrand($query, $brand)
    {
        return $query->where('brand', $brand);
    }

    /**
     * Accesor: Obtiene la URL completa de la imagen
     */
    public function getImageUrlAttribute(): string
    {
        $path = $this->image;

        if (!$path) {
            return asset('assets/img/product/1.png'); // Imagen por defecto
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
        
        // Si empieza con 'products/', es una ruta de storage
        if (str_starts_with($cleanPath, 'products/')) {
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
            
            // Si empieza con 'products/', es una ruta de storage
            if (str_starts_with($cleanPath, 'products/')) {
                return asset('storage/' . $cleanPath);
            }

            // Por defecto, asumir que es una ruta de storage
            return asset('storage/' . $cleanPath);
        }, array_filter($this->gallery));
    }

    /**
     * Genera la URL de WhatsApp para cotizar
     */
    public function getWhatsAppUrlAttribute(): string
    {
        $phone = '573025069825'; // Número de WhatsApp (formato internacional sin +)
        $message = urlencode("Hola, estoy interesado en cotizar: {$this->name}");
        return "https://wa.me/{$phone}?text={$message}";
    }
}
