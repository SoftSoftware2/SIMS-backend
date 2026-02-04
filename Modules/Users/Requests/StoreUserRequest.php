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
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'email' => 'required|string|email|max:70|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'nullable|integer',
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
            'surname.required' => 'El cognom és obligatori.',
            'email.required' => 'El correu electrònic és obligatori.',
            'email.email' => 'El correu electrònic ha de ser vàlid.',
            'email.unique' => 'Aquest correu electrònic ja està registrat.',
            'password.required' => 'La contrasenya és obligatòria.',
            'password.min' => 'La contrasenya ha de tenir almenys 8 caràcters.',
            'password.confirmed' => 'La confirmació de contrasenya no coincideix.',
        ];
    }
}
