<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * ============================================
 * CONTROLADOR: PageController
 * ============================================
 * 
 * PROPÓSITO:
 * Controla las páginas estáticas del sitio web:
 * - Sobre Nosotros (about)
 * - Servicios (services)
 * - Contacto (contact)
 * 
 * CÓMO FUNCIONA:
 * Cada método retorna su vista Blade correspondiente.
 * 
 * INSTRUCCIONES PARA DESARROLLADORES:
 * 1. Para agregar lógica a una página, modifica su método correspondiente
 * 2. Para pasar datos dinámicos, agrega parámetros al return view()
 */
class PageController extends Controller
{
    /**
     * Muestra la página "Sobre Nosotros"
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('web.about');
    }

    /**
     * Muestra la página de servicios
     *
     * @return \Illuminate\View\View
     */
    public function services()
    {
        return view('web.services');
    }

    /**
     * Muestra la página de contacto
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return view('web.contact');
    }
}

