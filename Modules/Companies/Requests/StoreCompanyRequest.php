<?php

namespace Modules\Companies\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'created_by_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'cif' => 'required|string|max:25|unique:companies',
            'db_conexion' => 'required|string|max:255',
            'db_user' => 'required|string|max:255',
            'db_pwd' => 'required|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'created_by_id.required' => 'L\'usuari creador és obligatori.',
            'created_by_id.exists' => 'L\'usuari especificat no existeix.',
            'name.required' => 'El nom de l\'empresa és obligatori.',
            'name.max' => 'El nom no pot superar els 50 caràcters.',
            'cif.required' => 'El CIF és obligatori.',
            'cif.unique' => 'Aquest CIF ja està registrat.',
            'db_conexion.required' => 'La connexió de base de dades és obligatòria.',
            'db_user.required' => 'L\'usuari de base de dades és obligatori.',
            'db_pwd.required' => 'La contrasenya de base de dades és obligatòria.',
        ];
    }
}
