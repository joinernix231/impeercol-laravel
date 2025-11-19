<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandStoreRequest;
use App\Http\Requests\Admin\BrandUpdateRequest;
use App\Repositories\Brand\BrandRepository;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function __construct(
        private readonly BrandRepository $brandRepository
    ) {
    }

    public function index()
    {
        $brands = $this->brandRepository->getAllForAdmin();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(BrandStoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        $this->brandRepository->create($data);

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Marca creada correctamente');
    }

    public function show(int $id)
    {
        $brand = $this->brandRepository->find($id);

        if (!$brand) {
            return redirect()
                ->route('admin.brands.index')
                ->with('error', 'Marca no encontrada');
        }

        return view('admin.brands.show', compact('brand'));
    }

    public function edit(int $id)
    {
        $brand = $this->brandRepository->find($id);

        if (!$brand) {
            return redirect()
                ->route('admin.brands.index')
                ->with('error', 'Marca no encontrada');
        }

        return view('admin.brands.edit', compact('brand'));
    }

    public function update(BrandUpdateRequest $request, int $id)
    {
        $brand = $this->brandRepository->find($id);

        if (!$brand) {
            return redirect()
                ->route('admin.brands.index')
                ->with('error', 'Marca no encontrada');
        }

        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        $this->brandRepository->update($data, $id);

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Marca actualizada correctamente');
    }

    public function destroy(int $id)
    {
        $brand = $this->brandRepository->find($id);

        if (!$brand) {
            return redirect()
                ->route('admin.brands.index')
                ->with('error', 'Marca no encontrada');
        }

        $this->brandRepository->delete($id);

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Marca eliminada correctamente');
    }
}

