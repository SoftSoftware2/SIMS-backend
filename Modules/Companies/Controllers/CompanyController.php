<?php

namespace Modules\Companies\Controllers;

use App\Http\Controllers\Controller;
use Modules\Companies\Models\Company;
use Illuminate\Http\JsonResponse;
use Modules\Companies\Requests\StoreCompanyRequest;
use Modules\Companies\Requests\UpdateCompanyRequest;
use Modules\Companies\Resources\CompanyResource;
use Modules\Companies\Services\CompanyService;

class CompanyController extends Controller
{
    /**
     * Display a listing of companies.
     */
    public function index(): JsonResponse
    {
        $companies = Company::all();

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
        $validated = $request->validated();
        $companyService = new CompanyService();
        $provision = $companyService->provisionCompany(
            $validated['db_conexion'],
            $validated['db_user'],
            $validated['db_pwd']
        );

        if (!$provision['success']) {
            return response()->json([
                'success' => false,
                'message' => $provision['message']
            ], 500);
        }

        $company = Company::create($validated);

        return response()->json([
            'success' => true,
            'data' => new CompanyResource($company),
            'message' => 'Company created successfully'
        ], 201);
    }

    /**
     * Display the specified company.
     */
    public function show(string $id): JsonResponse
    {
        $company = Company::find($id);

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
    public function update(UpdateCompanyRequest $request, string $id): JsonResponse
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company not found'
            ], 404);
        }

        $validated = $request->validated();

        $company->update($validated);

        return response()->json([
            'success' => true,
            'data' => new CompanyResource($company),
            'message' => 'Company updated successfully'
        ], 200);
    }

    /**
     * Remove the specified company.
     */
    public function destroy(string $id): JsonResponse
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company not found'
            ], 404);
        }

        $company->delete();

        return response()->json([
            'success' => true,
            'message' => 'Company deleted successfully'
        ], 200);
    }
}
