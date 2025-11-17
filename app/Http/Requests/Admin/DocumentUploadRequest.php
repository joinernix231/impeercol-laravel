<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

/**
 * ============================================
 * FORM REQUEST: DocumentUploadRequest
 * ============================================
 * 
 * Valida la subida de documentos.
 * Solo usuarios con rol 'admin' pueden subir documentos.
 */
class DocumentUploadRequest extends BaseFormRequest
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
            'document' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:20480', // Máximo 20MB
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'document.required' => 'Debes seleccionar un documento.',
            'document.file' => 'El archivo debe ser válido.',
            'document.mimes' => 'El documento debe ser de tipo: pdf, doc, docx, xls, xlsx, ppt, pptx o txt.',
            'document.max' => 'El documento no puede pesar más de 20MB.',
        ]);
    }
}
