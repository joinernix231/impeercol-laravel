<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * ============================================
 * CONTROLADOR: DashboardController (Cliente)
 * ============================================
 * 
 * Maneja el dashboard para usuarios con rol 'cliente'.
 * Aquí podrán ver el estado de sus pedidos cuando se implemente.
 */
class DashboardController extends Controller
{
    /**
     * Muestra el dashboard del cliente
     */
    public function index()
    {
        $user = auth()->user();
        
        return view('cliente.dashboard', compact('user'));
    }
}
