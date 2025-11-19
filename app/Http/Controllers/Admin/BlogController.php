<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Blog\BlogRepository;
use App\Http\Requests\Admin\BlogStoreRequest;
use App\Http\Requests\Admin\BlogUpdateRequest;
use Illuminate\Support\Str;

/**
 * ============================================
 * CONTROLADOR ADMIN: BlogController
 * ============================================
 *
 * Gestiona el CRUD de artículos de blog desde el panel administrativo.
 */
class BlogController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * Muestra la lista de artículos
     */
    public function index()
    {
        $blogs = $this->blogRepository->getAllForAdmin();
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Muestra el formulario para crear un nuevo artículo
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Guarda un nuevo artículo
     */
    public function store(BlogStoreRequest $request)
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

        // Crear el artículo usando el repositorio
        $this->blogRepository->create($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Artículo creado exitosamente');
    }

    /**
     * Muestra un artículo específico
     */
    public function show($id)
    {
        $blog = $this->blogRepository->find($id);

        if (!$blog) {
            return redirect()->route('admin.blogs.index')
                ->with('error', 'Artículo no encontrado');
        }

        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Muestra el formulario para editar un artículo
     */
    public function edit($id)
    {
        $blog = $this->blogRepository->find($id);

        if (!$blog) {
            return redirect()->route('admin.blogs.index')
                ->with('error', 'Artículo no encontrado');
        }

        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Actualiza un artículo
     */
    public function update(BlogUpdateRequest $request, $id)
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

        // Actualizar el artículo usando el repositorio
        $this->blogRepository->update($validated, $id);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Artículo actualizado exitosamente');
    }

    /**
     * Elimina un artículo
     */
    public function destroy($id)
    {
        $this->blogRepository->delete($id);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Artículo eliminado exitosamente');
    }
}



