<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;
use App\Models\Project;

/**
 * ============================================
 * FORM REQUEST: ProjectUpdateRequest
 * ============================================
 * 
 * Valida los datos al actualizar un proyecto existente.
 * Solo usuarios con rol 'admin' pueden actualizar proyectos.
 */
class ProjectUpdateRequest extends BaseFormRequest
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
        $rules = Project::$rules;
        $projectId = $this->route('project'); // Obtener el ID del proyecto desde la ruta

        // El slug debe ser único, pero ignorando el proyecto actual
        $rules['slug'] = [
            'nullable',
            'string',
            'max:255',
            $this->uniqueRule('projects', 'slug', $projectId)
        ];

        // La galería puede venir como string JSON o como array
        $rules['gallery'] = 'nullable';

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'title.required' => 'El título del proyecto es requerido.',
            'title.max' => 'El título no puede exceder 255 caracteres.',
            'slug.unique' => 'Este slug ya está en uso. Por favor, usa otro.',
            'description.required' => 'La descripción del proyecto es requerida.',
            'gallery.json' => 'La galería debe ser un formato JSON válido.',
            'project_date.date' => 'La fecha del proyecto debe ser una fecha válida.',
            'order.integer' => 'El orden debe ser un número entero.',
            'order.min' => 'El orden no puede ser negativo.',
        ]);
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Convertir gallery de string JSON a array si viene como string
        if ($this->has('gallery')) {
            if (is_string($this->gallery)) {
                $decoded = json_decode($this->gallery, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $this->merge(['gallery' => $decoded]);
                } elseif (empty($this->gallery) || $this->gallery === '[]') {
                    $this->merge(['gallery' => []]);
                }
            } elseif (!is_array($this->gallery)) {
                $this->merge(['gallery' => []]);
            }
        } else {
            $this->merge(['gallery' => []]);
        }

        // Normalizar valores booleanos (checkboxes solo envían valor si están marcados)
        $this->merge([
            'is_featured' => $this->has('is_featured') ? (bool) $this->is_featured : false,
            'is_active' => $this->has('is_active') ? (bool) $this->is_active : true,
        ]);

        // Normalizar order: si viene vacío o null, usar 0
        if ($this->has('order')) {
            $orderValue = $this->order;
            if ($orderValue === null || $orderValue === '' || $orderValue === '0') {
                $this->merge(['order' => 0]);
            } else {
                $this->merge(['order' => (int) $orderValue]);
            }
        } else {
            $this->merge(['order' => 0]);
        }
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Validar que si gallery es array, cada elemento sea string
            if ($this->has('gallery') && is_array($this->gallery)) {
                foreach ($this->gallery as $index => $item) {
                    if (!is_string($item) || strlen($item) > 500) {
                        $validator->errors()->add("gallery.{$index}", 'Cada elemento de la galería debe ser una cadena de texto de máximo 500 caracteres.');
                    }
                }
            }
        });
    }
}
