<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Project\ProjectRepository;

/**
 * ============================================
 * CONTROLADOR WEB: ProjectController
 * ============================================
 *
 * Controla las páginas públicas de proyectos.
 * Usa Repository para acceder a los datos.
 */
class ProjectController extends Controller
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Muestra la lista de proyectos
     */
    public function index()
    {
        $projects = $this->projectRepository->getAllActive();
        return view('web.projects', compact('projects'));
    }

    /**
     * Muestra el detalle de un proyecto por slug
     */
    public function show($slug)
    {
        $project = $this->projectRepository->findBySlug($slug);

        if (!$project) {
            abort(404, 'Proyecto no encontrado');
        }

        return view('web.project-details', compact('project'));
    }
}
