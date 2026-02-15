<?php

namespace Modules\Vehicles\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
        $vehicleId = $this->route('vehicle')->id;

        return [
            'license' => 'sometimes|string|max:15|unique:tenant.vehicles,license,' . $vehicleId,
            'status' => 'sometimes|string|in:available,using,stopped',
            'vehicle_type_id' => 'sometimes|integer|exists:tenant.vehicle_types,id',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'license.string' => 'The license must be a string.',
            'license.max' => 'The license must not exceed 15 characters.',
            'license.unique' => 'This license already exists.',
            'status.string' => 'The status must be a string.',
            'status.in' => 'The status must be: available, using or stopped.',
            'vehicle_type_id.integer' => 'The vehicle type must be a number.',
            'vehicle_type_id.exists' => 'The selected vehicle type does not exist.',
        ];
    }
}
