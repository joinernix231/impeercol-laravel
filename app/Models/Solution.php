<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Solution extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'sort_order',
    ];

    /**
     * Productos asociados a esta solución (orden admin en pivot sort_order).
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('sort_order')
            ->withTimestamps()
            ->orderByPivot('sort_order');
    }

    /**
     * Productos activos asociados, con relaciones para el catálogo web.
     *
     * @return \Illuminate\Database\Eloquent\Builder<\App\Models\Product>
     */
    public function activeProductsQuery()
    {
        return $this->products()
            ->where('products.is_active', true)
            ->with(['category', 'brand', 'activeVariants'])
            ->orderByPivot('sort_order');
    }
}
