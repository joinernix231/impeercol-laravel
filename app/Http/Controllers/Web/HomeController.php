<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Project\ProjectRepository;
use Illuminate\Http\Request;

/**
 * ============================================
 * CONTROLADOR: HomeController
 * ============================================
 *
 * Controla la página principal (home) del sitio web.
 * Usa Repository para obtener proyectos destacados.
 */
class HomeController extends Controller
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Muestra la página principal del sitio web
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtener proyectos destacados para mostrar en home (máximo 3)
        $featuredProjects = $this->projectRepository->getFeatured(10);

        return view('web.home', compact('featuredProjects'));
    }
}
