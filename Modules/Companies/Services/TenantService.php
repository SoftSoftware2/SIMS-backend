<?php

namespace Modules\Companies\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\Companies\Models\Company;

class TenantService
{
    /**
     * Switch the database connection to the specified tenant company.
     *
     * @param Company $company
     * @return void
     */
    public function switchToTenant(Company $company): void
    {
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

    /**
     * Purge the tenant connection.
     *
     * @return void
     */
    public function disconnect(): void
    {
        DB::purge('tenant');
    }
}
