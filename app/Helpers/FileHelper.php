<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

/**
 * ============================================
 * HELPER: FileHelper
 * ============================================
 * 
 * Funciones auxiliares para trabajar con archivos.
 * 
 * USO:
 * use App\Helpers\FileHelper;
 * 
 * $url = FileHelper::getPublicUrl($path);
 */
class FileHelper
{
    /**
     * Obtiene la URL pública de un archivo almacenado
     * 
     * @param string $path Ruta relativa del archivo (ej: projects/images/2025/11/image.jpg)
     * @return string URL completa del archivo
     */
    public static function getPublicUrl(string $path): string
    {
        return Storage::disk('public')->url($path);
    }

    /**
     * Verifica si un archivo existe
     * 
     * @param string $path Ruta relativa del archivo
     * @return bool
     */
    public static function fileExists(string $path): bool
    {
        return Storage::disk('public')->exists($path);
    }

    /**
     * Elimina un archivo
     * 
     * @param string $path Ruta relativa del archivo
     * @return bool
     */
    public static function deleteFile(string $path): bool
    {
        if (self::fileExists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }

    /**
     * Obtiene el tamaño de un archivo en formato legible
     * 
     * @param string $path Ruta relativa del archivo
     * @return string Tamaño formateado (ej: "2.5 MB")
     */
    public static function getFileSize(string $path): string
    {
        if (!self::fileExists($path)) {
            return '0 B';
        }

        $bytes = Storage::disk('public')->size($path);
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

}

