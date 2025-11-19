<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class BrandUpdateRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        $user = auth()->user();
        return $user && $user->role === 'admin';
    }

    public function rules(): array
    {
        $brandId = (int) $this->route('brand');

        return [
            'name' => 'required|string|max:255|unique:brands,name,' . $brandId,
            'slug' => 'nullable|string|max:255|unique:brands,slug,' . $brandId,
            'description' => 'nullable|string',
            'logo' => 'nullable|string|max:500',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active') ? (bool) $this->is_active : false,
            'order' => $this->has('order') && $this->order !== null ? (int) $this->order : 0,
        ]);
    }
}

