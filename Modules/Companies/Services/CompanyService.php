<?php

namespace Modules\Companies\Services;

use Modules\Companies\Models\Company;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CompanyService
{
    /**
     * Get all companies.
     */
    public function getAllCompanies()
    {
        return Company::all();
    }

    /**
     * Create a new company.
     */
    public function createCompany(array $data)
    {
        $validator = Validator::make($data, [
            'created_by_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'cif' => 'required|string|max:25|unique:companies',
            'db_conexion' => 'required|string|max:255',
            'db_user' => 'required|string|max:255',
            'db_pwd' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return Company::create($validator->validated());
    }

    /**
     * Get a company by ID.
     */
    public function getCompanyById(int $id)
    {
        return Company::find($id);
    }

    /**
     * Update a company.
     */
    public function updateCompany(int $id, array $data)
    {
        $company = Company::find($id);

        if (!$company) {
            return null;
        }

        $validator = Validator::make($data, [
            'created_by_id' => 'sometimes|required|integer|exists:users,id',
            'name' => 'sometimes|required|string|max:50',
            'description' => 'sometimes|nullable|string|max:255',
            'cif' => 'sometimes|required|string|max:25|unique:companies,cif,' . $id,
            'db_conexion' => 'sometimes|required|string|max:255',
            'db_user' => 'sometimes|required|string|max:255',
            'db_pwd' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $company->update($validator->validated());

        return $company;
    }

    /**
     * Delete a company.
     */
    public function deleteCompany(int $id)
    {
        $company = Company::find($id);

        if (!$company) {
            return false;
        }

        $company->delete();

        return true;
    }
}
