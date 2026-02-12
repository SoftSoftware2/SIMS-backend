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
                } elseif (!$user->isAdmin() && !$user->isManager()) {
                    return response()->json([
                        'error' => 'Unauthorized',
                    ], 403);
                }
            }

            $company = Company::find($companyId);

            if ($company) {
                Config::set('database.connections.tenant', [
                    'driver' => 'pgsql',
                    'host' => config('database.connections.pgsql.host'),
                    'port' => config('database.connections.pgsql.port'),
                    'database' => $company->db_conexion,
                    'username' => $company->db_user,
                    'password' => $company->db_pwd,
                    'charset' => 'utf8',
                    'prefix' => '',
                    'prefix_indexes' => true,
                    'search_path' => 'public',
                    'sslmode' => 'prefer',
                ]);

                DB::purge('tenant');
                DB::reconnect('tenant');
            }
        }

        return $next($request);
    }
}
