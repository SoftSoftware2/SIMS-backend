<?php

namespace Modules\Companies\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
        $companyId = $this->route('company');
        
        return [
            'created_by_id' => 'sometimes|required|integer|exists:users,id',
            'name' => 'sometimes|required|string|max:50',
            'description' => 'sometimes|nullable|string|max:255',
            'cif' => 'sometimes|required|string|max:25|unique:companies,cif,' . $companyId,
            'db_conexion' => 'sometimes|required|string|max:255',
            'db_user' => 'sometimes|required|string|max:255',
            'db_pwd' => 'sometimes|required|string',
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
            'created_by_id.required' => 'The creator user is required.',
            'created_by_id.exists' => 'The specified user does not exist.',
            'name.required' => 'The company name is required.',
            'name.max' => 'The name cannot exceed 50 characters.',
            'cif.required' => 'The CIF is required.',
            'cif.unique' => 'This CIF is already registered.',
            'db_conexion.required' => 'The database connection is required.',
            'db_user.required' => 'The database user is required.',
            'db_pwd.required' => 'The database password is required.',
        ];
    }
}
