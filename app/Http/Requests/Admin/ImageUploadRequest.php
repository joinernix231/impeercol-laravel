<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

/**
 * ============================================
 * FORM REQUEST: ImageUploadRequest
 * ============================================
 * 
 * Valida la subida de imágenes.
 * Solo usuarios con rol 'admin' pueden subir imágenes.
 */
class ImageUploadRequest extends BaseFormRequest
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
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,jpg,png,webp,gif|max:10240', // Máximo 10MB por imagen
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'images.required' => 'Debes seleccionar al menos una imagen.',
            'images.array' => 'Las imágenes deben ser enviadas como una lista.',
            'images.min' => 'Debes seleccionar al menos una imagen.',
            'images.*.required' => 'Cada imagen es requerida.',
            'images.*.image' => 'El archivo debe ser una imagen válida.',
            'images.*.mimes' => 'La imagen debe ser de tipo: jpeg, jpg, png, webp o gif.',
            'images.*.max' => 'Cada imagen no puede pesar más de 10MB.',
        ]);
    }
}
