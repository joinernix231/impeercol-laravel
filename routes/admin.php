<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\Cliente\DashboardController;

/*
|--------------------------------------------------------------------------
| RUTAS DEL PANEL ADMINISTRATIVO
|--------------------------------------------------------------------------
|
| Estas rutas manejan el panel administrativo del sitio web IMPEERCOL.
| Requieren autenticación y rol de administrador.
|
| PREFIJO: /admin
|
| INSTRUCCIONES PARA DESARROLLADORES:
| 1. Todas las rutas aquí requieren autenticación y rol 'admin'
| 2. El prefijo /admin se aplica automáticamente
| 3. Para agregar nuevas secciones admin, sigue el mismo patrón
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard (se implementará más adelante)
    Route::get('/', function () {
        return redirect()->route('admin.projects.index');
    })->name('dashboard');

    // Proyectos - CRUD completo
    Route::resource('projects', ProjectController::class);

    // Productos - CRUD completo
    Route::resource('products', ProductController::class);

    // Subida de archivos
    Route::prefix('upload')->name('upload.')->group(function () {
        Route::post('/images', [FileUploadController::class, 'uploadImages'])->name('images');
        Route::post('/document', [FileUploadController::class, 'uploadDocument'])->name('document');
        Route::delete('/file', [FileUploadController::class, 'deleteFile'])->name('delete');
        Route::get('/file-info', [FileUploadController::class, 'getFileInfo'])->name('info');
    });
});

