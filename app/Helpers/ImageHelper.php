<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

/**
 * Helper para optimización de imágenes
 */
class ImageHelper
{
    /**
     * Genera URL de imagen optimizada (thumbnail si existe, sino original)
     * 
     * @param string $path Ruta de la imagen original
     * @param int $width Ancho deseado
     * @param int $height Alto deseado
     * @return string URL de la imagen optimizada
     */
    public static function optimizedImageUrl(string $path, int $width = 300, int $height = 300): string
    {
        // Si ya es URL completa, retornar
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Si empieza con 'assets/', es un asset estático
        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        // Limpiar la ruta
        $cleanPath = str_starts_with($path, 'storage/') ? substr($path, 8) : $path;
        
        // Generar ruta del thumbnail
        $thumbnailPath = 'thumbnails/' . $width . 'x' . $height . '/' . $cleanPath;
        
        // Si el thumbnail existe, retornarlo
        if (Storage::disk('public')->exists($thumbnailPath)) {
            return asset('storage/' . $thumbnailPath);
        }

        // Retornar la original (el thumbnail se generará en background)
        return asset('storage/' . $cleanPath);
    }

    /**
     * Genera srcset para imágenes responsivas
     * 
     * @param string $path Ruta base de la imagen
     * @param array $sizes Tamaños disponibles
     * @return string String srcset
     */
    public static function srcset(string $path, array $sizes = [300, 600, 900]): string
    {
        $srcset = [];
        foreach ($sizes as $size) {
            $url = self::optimizedImageUrl($path, $size, $size);
            $srcset[] = $url . ' ' . $size . 'w';
        }
        return implode(', ', $srcset);
    }

    /**
     * Genera atributos optimizados para imágenes
     *
     * @param string $src URL de la imagen
     * @param string $alt Texto alternativo
     * @param int|null $width Ancho de la imagen
     * @param int|null $height Alto de la imagen
     * @param bool $lazy Si debe usar lazy loading
     * @param string|null $fetchpriority Prioridad de carga (high, low, auto)
     * @return array Array con los atributos
     */
    public static function imageAttributes(
        string $src,
        string $alt,
        ?int $width = null,
        ?int $height = null,
        bool $lazy = true,
        ?string $fetchpriority = null
    ): array {
        $attributes = [
            'src' => $src,
            'alt' => $alt,
            'decoding' => 'async',
        ];

        if ($width && $height) {
            $attributes['width'] = $width;
            $attributes['height'] = $height;
            $attributes['style'] = 'width: 100%; height: auto; aspect-ratio: ' . $width . '/' . $height . '; object-fit: cover;';
        }

        if ($lazy) {
            $attributes['loading'] = 'lazy';
        } else {
            $attributes['loading'] = 'eager';
            if ($fetchpriority) {
                $attributes['fetchpriority'] = $fetchpriority;
            }
        }

        return $attributes;
    }

    /**
     * Genera un string de atributos HTML para imágenes
     *
     * @param array $attributes Array de atributos
     * @return string String de atributos HTML
     */
    public static function attributesToString(array $attributes): string
    {
        $html = [];
        foreach ($attributes as $key => $value) {
            if ($value !== null) {
                $html[] = $key . '="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '"';
            }
        }
        return implode(' ', $html);
    }
}

