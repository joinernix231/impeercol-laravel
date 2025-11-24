<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImageUploadRequest;
use App\Http\Requests\Admin\DocumentUploadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * ============================================
 * CONTROLADOR: FileUploadController
 * ============================================
 * 
 * Gestiona la subida de archivos (fotos e imágenes, documentos) para proyectos.
 * 
 * ESTRUCTURA DE ALMACENAMIENTO:
 * - Fotos/Imágenes: storage/app/public/projects/images/{año}/{mes}/{archivo}
 * - Documentos: storage/app/public/projects/documents/{año}/{mes}/{archivo}
 * 
 * ACCESO PÚBLICO:
 * Los archivos se acceden mediante: /storage/projects/images/...
 * Requiere ejecutar: php artisan storage:link
 * 
 * VENTAJAS DE ESTA ESTRUCTURA:
 * 1. Organización por tipo y fecha
 * 2. Fácil mantenimiento y limpieza
 * 3. Seguridad (fuera de public directo)
 * 4. Escalable para migrar a S3/cloud storage
 */
class FileUploadController extends Controller
{
    /**
     * Sube una o múltiples imágenes/fotos
     * 
     * @param ImageUploadRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImages(ImageUploadRequest $request)
    {
        try {
            // Determinar el tipo de almacenamiento según el parámetro opcional
            $type = $request->input('type', 'projects'); // 'projects', 'products', 'product-variants', 'banners', 'blogs'
            
            $uploadedFiles = [];
            $year = date('Y');
            $month = date('m');
            
            // Definir la ruta base según el tipo
            $basePathMap = [
                'projects' => "projects/images/{$year}/{$month}",
                'products' => "products/images/{$year}/{$month}",
                'product-variants' => "product-variants/images/{$year}/{$month}",
                'banners' => "banners/images/{$year}/{$month}",
                'blogs' => "blogs/images/{$year}/{$month}",
            ];
            
            $basePath = $basePathMap[$type] ?? $basePathMap['projects'];

            if (!$request->hasFile('images')) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se recibieron archivos para subir.',
                ], 400);
            }

            foreach ($request->file('images') as $file) {
                if (!$file || !$file->isValid()) {
                    continue;
                }

                // Generar nombre único para el archivo
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileName = Str::slug($originalName) . '_' . time() . '_' . Str::random(8) . '.' . $extension;
                
                // Guardar el archivo
                $path = $file->storeAs($basePath, $fileName, 'public');
                
                if (!$path) {
                    throw new \Exception('Error al guardar el archivo en el servidor.');
                }
                
                $uploadedFiles[] = [
                    'original_name' => $file->getClientOriginalName(),
                    'file_name' => $fileName,
                    'path' => $path,
                    'url' => Storage::disk('public')->url($path),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                ];
            }

            if (empty($uploadedFiles)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudo subir ninguna imagen. Verifica que los archivos sean válidos.',
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => count($uploadedFiles) . ' imagen(es) subida(s) exitosamente',
                'files' => $uploadedFiles,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación: ' . implode(', ', $e->errors()),
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al subir la imagen: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Sube un documento (PDF, Word, Excel, etc.)
     * 
     * @param DocumentUploadRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadDocument(DocumentUploadRequest $request)
    {

        $file = $request->file('document');
        $year = date('Y');
        $month = date('m');
        $basePath = "projects/documents/{$year}/{$month}";

        // Generar nombre único para el archivo
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::slug($originalName) . '_' . time() . '_' . Str::random(8) . '.' . $extension;
        
        // Guardar el archivo
        $path = $file->storeAs($basePath, $fileName, 'public');

        $uploadedFile = [
            'original_name' => $file->getClientOriginalName(),
            'file_name' => $fileName,
            'path' => $path,
            'url' => Storage::disk('public')->url($path),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
        ];

        return response()->json([
            'success' => true,
            'message' => 'Documento subido exitosamente',
            'file' => $uploadedFile,
        ]);
    }

    /**
     * Elimina un archivo
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFile(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        $path = $request->input('path');

        // Verificar que el archivo existe
        if (!Storage::disk('public')->exists($path)) {
            return response()->json([
                'success' => false,
                'message' => 'El archivo no existe',
            ], 404);
        }

        // Eliminar el archivo
        Storage::disk('public')->delete($path);

        return response()->json([
            'success' => true,
            'message' => 'Archivo eliminado exitosamente',
        ]);
    }

    /**
     * Obtiene información de un archivo
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFileInfo(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        $path = $request->input('path');

        if (!Storage::disk('public')->exists($path)) {
            return response()->json([
                'success' => false,
                'message' => 'El archivo no existe',
            ], 404);
        }

        $fileInfo = [
            'path' => $path,
            'url' => Storage::disk('public')->url($path),
            'size' => Storage::disk('public')->size($path),
            'mime_type' => Storage::disk('public')->mimeType($path),
            'last_modified' => Storage::disk('public')->lastModified($path),
        ];

        return response()->json([
            'success' => true,
            'file' => $fileInfo,
        ]);
    }
}
