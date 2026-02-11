<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Companies\Services\CompanyService;

class CompaniesSeeder extends Seeder
{
    protected CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function run(): void
    {
        $companies = [
            [
                'name' => 'Acme Corporation',
                'description' => 'Tenant for Acme',
                'cif' => 'ACME-001',
            ],
            [
                'name' => 'Globex Ltd',
                'description' => 'Tenant for Globex',
                'cif' => 'GLOBEX-002',
            ],
            [
                'name' => 'Initech',
                'description' => 'Tenant for Initech',
                'cif' => 'INITECH-003',
            ],
        ];

        $defaultDbUser = env('DB_USERNAME');
        $defaultDbPwd = env('DB_PASSWORD');

        foreach ($companies as $c) {
            $dbName = 'company_' . Str::slug($c['name'], '_');

            $this->command->info("Provisioning tenant DB: {$dbName}");

            // Provisionar la base de dades (crear BD + migracions)
            $provision = $this->companyService->provisionCompany($dbName, $defaultDbUser, $defaultDbPwd);

            if (!empty($provision['success']) && $provision['success'] === true) {
                // Crear el registre a la taula companies
                $this->companyService->createCompany([
                    'created_by_id' => 1, // Ajusta segons el teu usuari admin
                    'name' => $c['name'],
                    'description' => $c['description'],
                    'cif' => $c['cif'],
                    'db_conexion' => $dbName,
                    'db_user' => $defaultDbUser,
                    'db_pwd' => $defaultDbPwd,
                ]);

                $this->command->info("✓ Company {$c['name']} created and provisioned.");
            } else {
                $this->command->error("✗ Failed to provision {$c['name']}: " . ($provision['message'] ?? 'unknown error'));
            }
        }
    }
}
