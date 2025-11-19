<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\ProjectController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Cliente\DashboardController;

/*
|--------------------------------------------------------------------------
| RUTAS DEL FRONTEND WEB
|--------------------------------------------------------------------------
|
| Estas rutas manejan todas las páginas públicas del sitio web IMPEERCOL.
| Cada ruta está asociada a un controlador que retorna la vista Blade correspondiente.
|
| ESTRUCTURA:
| - / : Página principal (home)
| - /nosotros : Página "Sobre Nosotros"
| - /servicios : Página de servicios
| - /productos : Lista de productos
| - /producto/{slug} : Detalle de un producto específico
| - /blog : Página del blog
| - /proyectos : Página de proyectos
| - /contacto : Página de contacto
|
| INSTRUCCIONES PARA DESARROLLADORES:
| 1. Todas las rutas usan nombres (->name()) para facilitar su uso en las vistas
| 2. Para usar una ruta en una vista: route('web.home')
| 3. Para agregar una nueva ruta, sigue el mismo patrón
*/

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('web.home');

// Páginas estáticas
Route::get('/nosotros', [PageController::class, 'about'])->name('web.about');
Route::get('/servicios', [PageController::class, 'services'])->name('web.services');
Route::get('/contacto', [PageController::class, 'contact'])->name('web.contact');

// Productos
Route::get('/productos', [ProductController::class, 'index'])->name('web.products');
Route::get('/producto/{slug}', [ProductController::class, 'show'])->name('web.product.show');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('web.blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('web.blog.show');

// Proyectos
Route::get('/proyectos', [ProjectController::class, 'index'])->name('web.projects');
Route::get('/proyecto/{slug}', [ProjectController::class, 'show'])->name('web.project.show');

// Autenticación (públicas)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas protegidas para clientes
Route::middleware(['auth', 'role:cliente'])->prefix('cliente')->name('cliente.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
