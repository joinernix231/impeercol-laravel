<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SolutionUpdateRequest;
use App\Models\Product;
use App\Models\Solution;

class SolutionController extends Controller
{
    public function index()
    {
        $solutions = Solution::query()
            ->withCount('products')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.solutions.index', compact('solutions'));
    }

    public function edit(Solution $solution)
    {
        $solution->load([
            'products' => function ($q) {
                $q->with('brand')->orderByPivot('sort_order');
            },
        ]);

        $assignedIds = $solution->products->pluck('id')->all();

        $availableProducts = Product::query()
            ->with('brand')
            ->active()
            ->when(count($assignedIds) > 0, fn ($q) => $q->whereNotIn('id', $assignedIds))
            ->orderBy('name')
            ->get();

        return view('admin.solutions.edit', [
            'solution' => $solution,
            'availableProducts' => $availableProducts,
            'assignedProducts' => $solution->products,
        ]);
    }

    public function update(SolutionUpdateRequest $request, Solution $solution)
    {
        $ids = $request->validated('product_ids') ?? [];
        $sync = [];
        foreach ($ids as $index => $id) {
            $sync[(int) $id] = ['sort_order' => $index];
        }
        $solution->products()->sync($sync);

        return redirect()
            ->route('admin.solutions.index')
            ->with('success', 'Productos de la solución «'.$solution->name.'» actualizados correctamente.');
    }
}
