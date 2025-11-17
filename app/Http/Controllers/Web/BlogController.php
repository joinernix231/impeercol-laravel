<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * ============================================
 * CONTROLADOR: BlogController
 * ============================================
 * 
 * PROPÓSITO:
 * Controla la página del blog.
 * 
 * CÓMO FUNCIONA:
 * El método index() retorna la vista del blog.
 * 
 * INSTRUCCIONES PARA DESARROLLADORES:
 * 1. Cuando se implemente la base de datos, aquí se consultarán los artículos del blog
 * 2. Para agregar paginación, modifica el método index()
 */
class BlogController extends Controller
{
    /**
     * Muestra la página del blog
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO: Cuando se implemente la base de datos, aquí se consultarán los artículos
        // $posts = Post::latest()->paginate(10);
        // return view('web.blog', compact('posts'));
        
        return view('web.blog');
    }
}

