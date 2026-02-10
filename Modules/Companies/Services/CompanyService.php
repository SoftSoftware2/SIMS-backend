<?php

namespace Modules\Companies\Services;

use Modules\Companies\Models\Company;

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
        // Check if created_by_id is provided, if not, use authenticated user
        if (!isset($data['created_by_id'])) {
            $data['created_by_id'] = auth()->id();
        }

        return Company::create($data);
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

        $company->update($data);

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
