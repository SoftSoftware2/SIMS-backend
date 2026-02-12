<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Modules\Companies\Models\Company;

class SetTenantConnection
{
    protected $tenantService;

    public function __construct(\Modules\Companies\Services\TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $companyId = $request->header('X-Company-ID');

        if ($companyId) {
            $user = $request->user();

            if ($user) {
                if ($user->isAdmin()) {
                }
                elseif ($user->isManager() && $user->company_id != $companyId) {
                    return response()->json([
                        'error' => 'Unauthorized - You can only access your own company',
                    ], 403);
                }
                elseif (!$user->isAdmin() && !$user->isManager()) {
                    return response()->json([
                        'error' => 'Unauthorized',
                    ], 403);
                }
            }

            $company = Company::find($companyId);

            if ($company) {
                $this->tenantService->switchToTenant($company);
            }
        }

        return $next($request);
    }
}
