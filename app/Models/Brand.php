<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot del modelo - Generar slug automáticamente
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($brand) {
            if (empty($brand->slug)) {
                $brand->slug = Str::slug($brand->name);
            }
        });

        static::updating(function ($brand) {
            if ($brand->isDirty('name') && empty($brand->slug)) {
                $brand->slug = Str::slug($brand->name);
            }
        });
    }

    /**
     * Relación: Una marca tiene muchos productos
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Scope para marcas activas
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
     * Accesor: Obtiene la URL completa del logo
     */
    public function getLogoUrlAttribute(): string
    {
        $path = $this->logo;

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
        
        // Si empieza con 'brands/', es una ruta de storage
        if (str_starts_with($cleanPath, 'brands/')) {
            return asset('storage/' . $cleanPath);
        }

        // Por defecto, asumir que es una ruta de storage
        return asset('storage/' . $cleanPath);
    }
}

