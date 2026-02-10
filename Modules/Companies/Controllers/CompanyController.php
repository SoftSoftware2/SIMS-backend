<?php

namespace Modules\Companies\Controllers;

use App\Http\Controllers\Controller;
use Modules\Companies\Services\CompanyService;
use Modules\Companies\Requests\StoreCompanyRequest;
use Modules\Companies\Requests\UpdateCompanyRequest;
use Modules\Companies\Resources\CompanyResource;
use Illuminate\Http\JsonResponse;

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
            'data' => CompanyResource::collection($companies),
            'message' => 'Companies retrieved successfully'
        ], 200);
    }

    /**
     * Store a newly created company.
     */
    public function store(StoreCompanyRequest $request): JsonResponse
    {
        $company = $this->companyService->createCompany($request->validated());

        return response()->json([
            'success' => true,
            'data' => new CompanyResource($company),
            'message' => 'Company created successfully'
        ], 201);
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
            'data' => new CompanyResource($company),
            'message' => 'Company retrieved successfully'
        ], 200);
    }

    /**
     * Update the specified company.
     */
    public function update(UpdateCompanyRequest $request, int $id): JsonResponse
    {
        $company = $this->companyService->updateCompany($id, $request->validated());

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new CompanyResource($company),
            'message' => 'Company updated successfully'
        ], 200);
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
