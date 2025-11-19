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
            'images.*.required' => 'Cada imagen es requerida. Verifica que el archivo se haya seleccionado correctamente.',
            'images.*.image' => 'El archivo debe ser una imagen válida.',
            'images.*.mimes' => 'La imagen debe ser de tipo: jpeg, jpg, png, webp o gif.',
            'images.*.max' => 'Cada imagen no puede pesar más de 10MB. Si tu archivo es más grande, comprímelo o reduce su tamaño.',
        ]);
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Verificar errores de subida de PHP antes de la validación
            if ($this->hasFile('images')) {
                foreach ($this->file('images') as $index => $file) {
                    if ($file && !$file->isValid()) {
                        $errorCode = $file->getError();
                        $errorMessages = [
                            UPLOAD_ERR_INI_SIZE => 'El archivo excede el tamaño máximo permitido por PHP (upload_max_filesize).',
                            UPLOAD_ERR_FORM_SIZE => 'El archivo excede el tamaño máximo permitido por el formulario.',
                            UPLOAD_ERR_PARTIAL => 'El archivo se subió parcialmente.',
                            UPLOAD_ERR_NO_FILE => 'No se subió ningún archivo.',
                            UPLOAD_ERR_NO_TMP_DIR => 'Falta la carpeta temporal.',
                            UPLOAD_ERR_CANT_WRITE => 'Error al escribir el archivo en el disco.',
                            UPLOAD_ERR_EXTENSION => 'Una extensión de PHP detuvo la subida del archivo.',
                        ];
                        
                        $errorMessage = $errorMessages[$errorCode] ?? "Error desconocido al subir el archivo (código: {$errorCode})";
                        $validator->errors()->add("images.{$index}", $errorMessage);
                    }
                }
            }
        });
    }

}
