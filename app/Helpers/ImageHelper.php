<?php

namespace App\Helpers;

/**
 * Helper para optimización de imágenes
 */
class ImageHelper
{
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
            $attributes['style'] = 'aspect-ratio: ' . $width . '/' . $height . '; object-fit: cover; max-width: 100%; height: auto;';
        }

        if ($lazy) {
            $attributes['loading'] = 'lazy';
        } else {
            $attributes['loading'] = 'eager';
            $attributes['fetchpriority'] = $fetchpriority ?? 'high';
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

