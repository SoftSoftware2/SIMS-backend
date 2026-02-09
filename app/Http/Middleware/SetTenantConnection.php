<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\Companies\Models\Company;

class SetTenantConnection
{
    public function handle(Request $request, Closure $next)
    {
        $companyDb = $request->header('X-Company-ID');

        if (!$companyDb) {
            return response()->json(['error' => 'Missing X-Company-ID header'], 400);
        }

        $company = Company::where('db_conexion', $companyDb)->first();

        if (!$company) {
            return response()->json(['error' => 'Invalid company'], 403);
        }

        Config::set('database.connections.tenant.database', $company->db_conexion);
        Config::set('database.connections.tenant.username', $company->db_user);
        Config::set('database.connections.tenant.password', $company->db_pwd);

        DB::purge('tenant');
        DB::reconnect('tenant');

        return $next($request);
    }
}
