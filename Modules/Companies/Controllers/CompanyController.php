<?php

namespace Modules\Companies\Controllers;

use App\Http\Controllers\Controller;
use Modules\Companies\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of companies.
     */
    public function index(): JsonResponse
    {
        $companies = $this->companyService->getAllCompanies();
        
        return response()->json([
            'success' => true,
            'data' => $companies,
            'message' => 'Companies retrieved successfully'
        ], 200);
    }

    /**
     * Store a newly created company.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $company = $this->companyService->createCompany($request->all());

            return response()->json([
                'success' => true,
                'data' => $company,
                'message' => 'Company created successfully'
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Display the specified company.
     */
    public function show(int $id): JsonResponse
    {
        $company = $this->companyService->getCompanyById($id);

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $company,
            'message' => 'Company retrieved successfully'
        ], 200);
    }

    /**
     * Update the specified company.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $company = $this->companyService->updateCompany($id, $request->all());

            if (!$company) {
                return response()->json([
                    'success' => false,
                    'message' => 'Company not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $company,
                'message' => 'Company updated successfully'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified company.
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->companyService->deleteCompany($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Company not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Company deleted successfully'
        ], 200);
    }
}
