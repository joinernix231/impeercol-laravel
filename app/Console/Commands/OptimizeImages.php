<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize {--force : Forzar regeneración de thumbnails}';
    protected $description = 'Optimiza imágenes existentes generando thumbnails';

    public function handle()
    {
        $this->info('Iniciando optimización de imágenes...');
        
        // Procesar productos
        $this->processDirectory('products/images', 300, 300);
        $this->processDirectory('products/images', 600, 600);
        
        // Procesar proyectos
        $this->processDirectory('projects/images', 300, 300);
        $this->processDirectory('projects/images', 600, 600);
        
        // Procesar banners
        $this->processDirectory('banners/images', 1920, 1080);
        
        $this->info('Optimización completada. Nota: Los thumbnails se generarán automáticamente cuando se accedan.');
        $this->warn('Para generar thumbnails automáticamente, considera usar un servicio como Cloudinary o ImageKit.');
    }
    
    private function processDirectory($directory, $width, $height)
    {
        $files = Storage::disk('public')->allFiles($directory);
        $count = 0;
        
        foreach ($files as $file) {
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            
            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                continue;
            }
            
            $thumbnailPath = 'thumbnails/' . $width . 'x' . $height . '/' . $file;
            
            if (!$this->option('force') && Storage::disk('public')->exists($thumbnailPath)) {
                continue;
            }
            
            $count++;
        }
        
        if ($count > 0) {
            $this->info("Encontradas {$count} imágenes en {$directory} para optimizar a {$width}x{$height}");
        }
    }
}




