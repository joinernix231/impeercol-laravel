<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Project\ProjectRepository;
use App\Http\Requests\Admin\ProjectStoreRequest;
use App\Http\Requests\Admin\ProjectUpdateRequest;
use Illuminate\Support\Str;

/**
 * ============================================
 * CONTROLADOR ADMIN: ProjectController
 * ============================================
 * 
 * Gestiona el CRUD de proyectos desde el panel administrativo.
 * Usa Repository para acceder a los datos.
 * 
 * MÉTODOS BASE DISPONIBLES (heredados de BaseRepository):
 * - create($data) - Crear proyecto
 * - update($data, $id) - Actualizar proyecto
 * - delete($id) - Eliminar proyecto
 * - find($id) - Buscar por ID
 * - all() - Todos los proyectos
 * - paginate($limit) - Con paginación
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
        $projects = $this->projectRepository->getAllForAdmin();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Muestra el formulario para crear un nuevo proyecto
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Guarda un nuevo proyecto
     */
    public function store(ProjectStoreRequest $request)
    {
        $validated = $request->validated();

        // Generar slug automáticamente si no se proporciona
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Asegurar que gallery sea un array
        if (!isset($validated['gallery']) || !is_array($validated['gallery'])) {
            $validated['gallery'] = [];
        }

        $this->projectRepository->create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyecto creado exitosamente');
    }

    /**
     * Muestra un proyecto específico
     */
    public function show($id)
    {
        $project = $this->projectRepository->find($id);
        
        if (!$project) {
            return redirect()->route('admin.projects.index')
                ->with('error', 'Proyecto no encontrado');
        }

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Muestra el formulario para editar un proyecto
     */
    public function edit($id)
    {
        $project = $this->projectRepository->find($id);
        
        if (!$project) {
            return redirect()->route('admin.projects.index')
                ->with('error', 'Proyecto no encontrado');
        }

        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Actualiza un proyecto
     */
    public function update(ProjectUpdateRequest $request, $id)
    {
        $validated = $request->validated();

        // Generar slug automáticamente si no se proporciona
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Asegurar que gallery sea un array
        if (!isset($validated['gallery']) || !is_array($validated['gallery'])) {
            $validated['gallery'] = [];
        }

        $this->projectRepository->update($validated, $id);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyecto actualizado exitosamente');
    }

    /**
     * Elimina un proyecto
     */
    public function destroy($id)
    {
        $this->projectRepository->delete($id);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyecto eliminado exitosamente');
    }
}
