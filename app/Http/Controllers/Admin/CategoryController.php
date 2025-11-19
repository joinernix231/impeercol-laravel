<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository
    ) {
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAllForAdmin();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        $this->categoryRepository->create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categoría creada correctamente');
    }

    public function show(int $id)
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Categoría no encontrada');
        }

        return view('admin.categories.show', compact('category'));
    }

    public function edit(int $id)
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Categoría no encontrada');
        }

        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, int $id)
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Categoría no encontrada');
        }

        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        $this->categoryRepository->update($data, $id);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categoría actualizada correctamente');
    }

    public function destroy(int $id)
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Categoría no encontrada');
        }

        $this->categoryRepository->delete($id);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categoría eliminada correctamente');
    }
}

