<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\ProjectController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Cliente\DashboardController;
use App\Http\Controllers\SitemapController;

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
| - /soluciones/{techos|terrazas|muros} : Páginas por tipo de uso (producto + problema)
| - /blog : Página del blog
| - /proyectos : Página de proyectos
| - /contacto : Página de contacto
|
| INSTRUCCIONES PARA DESARROLLADORES:
| 1. Todas las rutas usan nombres (->name()) para facilitar su uso en las vistas
| 2. Para usar una ruta en una vista: route('web.home')
| 3. Para agregar una nueva ruta, sigue el mismo patrón
*/

// Sitemap para SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('web.home');

// Páginas estáticas
Route::get('/nosotros', [PageController::class, 'about'])->name('web.about');
Route::get('/servicios', [PageController::class, 'services'])->name('web.services');

// Soluciones por tipo de uso (venta orientada al problema)
Route::get('/soluciones/{tipo}', [PageController::class, 'solution'])
    ->whereIn('tipo', ['techos', 'terrazas', 'muros'])
    ->name('web.solutions.show');

// Páginas de servicio SEO específicas
Route::get('/impermeabilizacion-techos-bogota', [PageController::class, 'serviceRoofsBogota'])
    ->name('web.services.roofs.bogota');
Route::get('/impermeabilizacion-terrazas-bogota', [PageController::class, 'serviceTerracesBogota'])
    ->name('web.services.terraces.bogota');
Route::get('/impermeabilizacion-industrial-bogota', [PageController::class, 'serviceIndustrialBogota'])
    ->name('web.services.industrial.bogota');

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
