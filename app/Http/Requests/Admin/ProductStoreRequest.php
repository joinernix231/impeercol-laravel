<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;
use App\Models\Product;

/**
 * ============================================
 * FORM REQUEST: ProductStoreRequest
 * ============================================
 * 
 * Valida los datos al crear un nuevo producto.
 * Solo usuarios con rol 'admin' pueden crear productos.
 */
class ProductStoreRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $allowedRoles = ['admin'];
        $user = auth()->user();

        return $user && in_array($user->role, $allowedRoles);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'description' => 'required|string',
            'image' => 'nullable|string|max:500',
            'gallery' => 'nullable',
            'brand_id' => 'nullable|exists:brands,id',
            'technical_sheet_file' => 'nullable|string|max:500',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'variants' => 'nullable|array|max:3',
            'variants.*.name' => 'required_with:variants|string|max:255',
            'variants.*.image' => 'nullable|string|max:500',
            'variants.*.order' => 'nullable|integer|min:0',
            'variants.*.is_active' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'La categoría es obligatoria.',
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.max' => 'El nombre no puede exceder 255 caracteres.',
            'slug.unique' => 'El slug ya está en uso. Por favor, elige otro.',
            'description.required' => 'La descripción es obligatoria.',
            'variants.max' => 'Solo se permiten máximo 3 variantes por producto.',
            'variants.*.name.required_with' => 'El nombre de la variante es obligatorio.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Normalizar gallery si viene como string JSON
        if ($this->has('gallery') && is_string($this->gallery)) {
            $gallery = json_decode($this->gallery, true);
            $this->merge([
                'gallery' => is_array($gallery) ? $gallery : [],
            ]);
        }

        // Normalizar booleanos
        $this->merge([
            'is_featured' => $this->has('is_featured') ? (bool) $this->is_featured : false,
            'is_active' => $this->has('is_active') ? (bool) $this->is_active : true,
            'order' => $this->has('order') ? (int) $this->order : 0,
        ]);

        // Normalizar variantes
        if ($this->has('variants') && is_string($this->variants)) {
            $variants = json_decode($this->variants, true);
            $this->merge([
                'variants' => is_array($variants) ? $variants : [],
            ]);
        }
    }
}
