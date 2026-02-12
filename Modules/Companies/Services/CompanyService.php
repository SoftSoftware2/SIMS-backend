<?php

namespace Modules\Companies\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Modules\Companies\Models\Company;

class CompanyService
{

    public function getAllCompanies()
    {
        return Company::all();
    }

    public function createCompany(array $data, $user = null)
    {
        if (!isset($data['created_by_id']) && $user) {
            $data['created_by_id'] = $user->id;
        }

        return Company::create($data);
    }

    public function getCompanyById(int $id)
    {
        return Company::find($id);
    }

    public function updateCompany(int $id, array $data)
    {
        $company = Company::find($id);

        if (!$company) {
            return null;
        }

        $company->update($data);

        return $company;
    }

    public function deleteCompany(int $id)
    {
        $company = Company::find($id);

        if (!$company) {
            return false;
        }

        $company->delete();

        return true;
    }


    public function setTenant(string $dbName): void
    {
        Config::set('database.connections.tenant.database', $dbName);
        DB::purge('tenant');
        DB::reconnect('tenant');
    }

    public function createCompanyDatabase(string $dbName, string $dbUser, string $dbPassword): bool
    {
        try {
            $defaultConnection = Config::get('database.default');

            // Eliminar si existeix (per re-seeding)
            DB::connection($defaultConnection)->statement("DROP DATABASE IF EXISTS \"{$dbName}\"");

            DB::connection($defaultConnection)->statement("CREATE DATABASE \"{$dbName}\"");
            DB::connection($defaultConnection)->statement("GRANT ALL PRIVILEGES ON DATABASE \"{$dbName}\" TO \"{$dbUser}\"");

            return true;
        } catch (\Exception $e) {
            Log::error("Error creating database: " . $e->getMessage());
            return false;
        }
    }

    public function runCompanyMigrations(string $dbName, string $dbUser, string $dbPassword): bool
    {
        try {
            // Configurar connexió temporal
            Config::set('database.connections.company_temp', [
                'driver' => 'pgsql',
                'host' => config('database.connections.pgsql.host'),
                'port' => config('database.connections.pgsql.port'),
                'database' => $dbName,
                'username' => $dbUser,
                'password' => $dbPassword,
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => true,
                'search_path' => 'public',
                'sslmode' => 'prefer',
            ]);

            DB::purge('company_temp');
            DB::reconnect('company_temp');

            $testDb = DB::connection('company_temp')->getDatabaseName();
            Log::info("Running migrations on database: {$testDb}");

            // Run Users migrations first (tenant users table)
            $exitCode = Artisan::call('migrate', [
                '--database' => 'company_temp',
                '--path' => 'Modules/Users/Database/Migrations',
                '--force' => true,
            ]);

            if ($exitCode !== 0) {
                $output = Artisan::output();
                Log::error("Users migration failed: {$output}");
                return false;
            }

            // Run Vehicles migrations
            $exitCode = Artisan::call('migrate', [
                '--database' => 'company_temp',
                '--path' => 'Modules/Vehicles/Database/Migrations',
                '--force' => true,
            ]);

            if ($exitCode !== 0) {
                $output = Artisan::output();
                Log::error("Vehicles migration failed: {$output}");
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error("Error running migrations for {$dbName}: " . $e->getMessage());
            return false;
        }
    }

    public function provisionCompany(string $dbName, string $dbUser, string $dbPassword): array
    {
        if (!$this->createCompanyDatabase($dbName, $dbUser, $dbPassword)) {
            return [
                'success' => false,
                'message' => 'Failed to create database'
            ];
        }

        if (!$this->runCompanyMigrations($dbName, $dbUser, $dbPassword)) {
            return [
                'success' => false,
                'message' => 'Database created but migrations failed'
            ];
        }

        return [
            'success' => true,
            'message' => 'Company provisioned successfully'
        ];
    }
}
