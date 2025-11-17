<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\ValidationException;

/**
 * ============================================
 * CLASE BASE: BaseFormRequest
 * ============================================
 * 
 * Clase base para todos los Form Requests del proyecto.
 * Proporciona métodos comunes y manejo de errores.
 * 
 * INSTRUCCIONES PARA DESARROLLADORES:
 * 1. Todos los Form Requests deben extender esta clase
 * 2. Implementar authorize() y rules() en cada Form Request
 * 3. Usar existsRule() y uniqueRule() para validaciones de BD
 */
class BaseFormRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        // Para requests web, redirigir con errores
        if ($this->expectsJson()) {
            $errors = (new ValidationException($validator))->errors();
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => 'Ha ocurrido un error de validación',
                    'errors' => $errors
                ], 422)
            );
        }

        // Para requests web normales, usar el comportamiento por defecto
        parent::failedValidation($validator);
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @throws HttpResponseException
     */
    protected function failedAuthorization(): void
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => 'Este usuario no tiene permiso para realizar esta acción'
                ], 403)
            );
        }

        abort(403, 'Este usuario no tiene permiso para realizar esta acción');
    }

    /**
     * Throw an exception when a requested model does not exist.
     *
     * @throws HttpResponseException
     */
    public function failedExists(string $modelName): void
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => "Este {$modelName} no se ha encontrado."
                ], 404)
            );
        }

        abort(404, "Este {$modelName} no se ha encontrado.");
    }

    /**
     * Add parameters to the request.
     */
    public function addParametersToRequest(array $params): void
    {
        $this->merge($params);
    }

    /**
     * Get the validation messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'required' => 'El valor :attribute es requerido',
            'required_if' => 'El valor :attribute es requerido cuando :other es :value',

            'exists' => 'El valor :attribute no existe',
            'unique' => 'El valor :attribute ya existe',
            'in' => 'El valor :attribute debe ser uno de los siguientes valores: :values',

            'integer' => 'El valor :attribute debe ser un número entero',
            'numeric' => 'El valor :attribute debe ser numérico',
            'string' => 'El valor :attribute debe ser un texto',
            'boolean' => 'El valor :attribute debe ser verdadero o falso',
            'date' => 'El valor :attribute debe ser una fecha válida',
            'email' => 'El valor :attribute debe ser un correo electrónico válido',
            'confirmed' => 'El valor :attribute no coincide con la confirmación',

            'min' => [
                'numeric' => 'El valor :attribute debe ser al menos :min.',
                'file' => 'El archivo :attribute debe tener al menos :min kilobytes.',
                'string' => 'El valor :attribute debe tener al menos :min caracteres.',
                'array' => 'El valor :attribute debe tener al menos :min elementos.',
            ],

            'max' => [
                'numeric' => 'El valor :attribute no debe ser mayor que :max.',
                'file' => 'El archivo :attribute no debe pesar más de :max kilobytes.',
                'string' => 'El valor :attribute no debe tener más de :max caracteres.',
                'array' => 'El valor :attribute no debe contener más de :max elementos.',
            ],

            'between' => [
                'numeric' => 'El valor :attribute debe estar entre :min y :max.',
                'file' => 'El archivo :attribute debe tener entre :min y :max kilobytes.',
                'string' => 'El valor :attribute debe tener entre :min y :max caracteres.',
                'array' => 'El valor :attribute debe tener entre :min y :max elementos.',
            ],
        ];
    }

    /**
     * Helper para crear regla exists con soft deletes
     */
    public function existsRule(string $table, string $column = 'id'): Exists
    {
        return Rule::exists($table, $column);
    }

    /**
     * Helper para crear regla unique con soft deletes
     */
    public function uniqueRule(string $table, string $column = 'id', $ignoreId = null, $ignoreColumn = 'id'): Unique
    {
        $rule = Rule::unique($table, $column);

        if ($ignoreId) {
            $rule->ignore($ignoreId, $ignoreColumn);
        }

        return $rule;
    }
}

