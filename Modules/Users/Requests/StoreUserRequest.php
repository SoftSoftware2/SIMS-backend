<?php

namespace Modules\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'company_id' => 'nullable|exists:companies,id',
            'role' => 'required|in:admin,manager',
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
            'name.required' => 'El nom és obligatori.',
            'email.required' => 'El correu electrònic és obligatori.',
            'email.email' => 'El correu electrònic ha de ser vàlid.',
            'email.unique' => 'Aquest correu electrònic ja està registrat.',
            'password.required' => 'La contrasenya és obligatòria.',
            'password.min' => 'La contrasenya ha de tenir almenys 8 caràcters.',
            'password.confirmed' => 'La confirmació de contrasenya no coincideix.',
            'company_id.exists' => 'La companyia seleccionada no existeix.',
            'role.required' => 'El rol és obligatori.',
            'role.in' => 'El rol ha de ser admin o manager.',
        ];
    }
}
