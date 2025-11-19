<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;
use App\Models\Blog;
use Illuminate\Validation\Rule;

/**
 * ============================================
 * FORM REQUEST: BlogUpdateRequest
 * ============================================
 * 
 * Valida los datos al actualizar un artículo de blog.
 * Solo usuarios con rol 'admin' pueden actualizar artículos.
 */
class BlogUpdateRequest extends BaseFormRequest
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
        $blogId = $this->route('blog'); // Obtener el ID del blog desde la ruta

        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('blogs', 'slug')->ignore($blogId),
            ],
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|string|max:500',
            'thumbnail' => 'nullable|string|max:500',
            'gallery' => 'nullable',
            'tags' => 'nullable',
            'video_url' => 'nullable|url|max:500',
            'reading_time' => 'nullable|integer|min:1|max:120',
            'featured_quote' => 'nullable|string|max:500',
            'tips' => 'nullable|string',
            'difficulty' => 'nullable|in:básico,intermedio,avanzado',
            'estimated_time' => 'nullable|string|max:100',
            'materials' => 'nullable|string',
            'tools' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede exceder 255 caracteres.',
            'slug.unique' => 'El slug ya está en uso. Por favor, elige otro.',
            'content.required' => 'El contenido es obligatorio.',
            'excerpt.max' => 'El resumen no puede exceder 500 caracteres.',
            'author.max' => 'El nombre del autor no puede exceder 255 caracteres.',
            'published_at.date' => 'La fecha de publicación debe ser una fecha válida.',
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

        // Normalizar tags si viene como string JSON o string separado por comas
        if ($this->has('tags')) {
            if (is_string($this->tags)) {
                // Si es JSON, decodificar
                $decoded = json_decode($this->tags, true);
                if (is_array($decoded)) {
                    $this->merge(['tags' => $decoded]);
                } else {
                    // Si es string separado por comas, convertir a array
                    $tags = array_filter(array_map('trim', explode(',', $this->tags)));
                    $this->merge(['tags' => $tags]);
                }
            }
        }

        // Normalizar booleanos y enteros
        $this->merge([
            'is_featured' => $this->has('is_featured') ? (bool) $this->is_featured : false,
            'is_active' => $this->has('is_active') ? (bool) $this->is_active : true,
            'order' => $this->has('order') ? (int) $this->order : 0,
            'reading_time' => $this->has('reading_time') && $this->reading_time ? (int) $this->reading_time : null,
        ]);
    }
}

