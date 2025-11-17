<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;

/**
 * ============================================
 * FORM REQUEST: LoginRequest
 * ============================================
 * 
 * Valida los datos del formulario de login.
 * Cualquier usuario puede intentar iniciar sesión.
 */
class LoginRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Cualquiera puede intentar iniciar sesión
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return array_merge(parent::messages(), [
            'email.required' => 'El correo electrónico es requerido.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'password.required' => 'La contraseña es requerida.',
        ]);
    }
}
