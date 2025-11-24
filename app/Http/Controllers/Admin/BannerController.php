<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Banner\BannerRepository;
use App\Http\Requests\Admin\BannerStoreRequest;
use App\Http\Requests\Admin\BannerUpdateRequest;

/**
 * ============================================
 * CONTROLADOR ADMIN: BannerController
 * ============================================
 *
 * Gestiona el CRUD de banners desde el panel administrativo.
 */
class BannerController extends Controller
{
    protected $bannerRepository;

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * Muestra la lista de banners
     */
    public function index()
    {
        $banners = $this->bannerRepository->getAllForAdmin();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Muestra el formulario para crear un nuevo banner
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Guarda un nuevo banner
     */
    public function store(BannerStoreRequest $request)
    {
        $validated = $request->validated();

        // Crear el banner usando el repositorio
        $this->bannerRepository->create($validated);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner creado exitosamente');
    }

    /**
     * Muestra un banner específico
     */
    public function show($id)
    {
        $banner = $this->bannerRepository->find($id);

        if (!$banner) {
            return redirect()->route('admin.banners.index')
                ->with('error', 'Banner no encontrado');
        }

        return view('admin.banners.show', compact('banner'));
    }

    /**
     * Muestra el formulario para editar un banner
     */
    public function edit($id)
    {
        $banner = $this->bannerRepository->find($id);

        if (!$banner) {
            return redirect()->route('admin.banners.index')
                ->with('error', 'Banner no encontrado');
        }

        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Actualiza un banner
     */
    public function update(BannerUpdateRequest $request, $id)
    {
        $validated = $request->validated();

        // Actualizar el banner usando el repositorio
        $this->bannerRepository->update($validated, $id);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner actualizado exitosamente');
    }

    /**
     * Elimina un banner
     */
    public function destroy($id)
    {
        $this->bannerRepository->delete($id);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner eliminado exitosamente');
    }
}

