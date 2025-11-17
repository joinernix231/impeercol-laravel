<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * ============================================
 * MIDDLEWARE: RoleMiddleware
 * ============================================
 * 
 * Verifica que el usuario autenticado tenga el rol requerido.
 * 
 * USO:
 * Route::middleware(['auth', 'role:admin'])->group(...)
 * Route::middleware(['auth', 'role:cliente'])->group(...)
 */
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  Roles permitidos (puede recibir múltiples)
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Verificar que el usuario esté autenticado
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        $user = auth()->user();

        // Verificar si el usuario tiene alguno de los roles permitidos
        $hasRole = false;
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                $hasRole = true;
                break;
            }
        }

        if (!$hasRole) {
            // Si no tiene el rol, redirigir según su rol actual
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'No tienes permiso para acceder a esta sección.');
            } else {
                return redirect()->route('cliente.dashboard')
                    ->with('error', 'No tienes permiso para acceder a esta sección.');
            }
        }

        return $next($request);
    }
}
