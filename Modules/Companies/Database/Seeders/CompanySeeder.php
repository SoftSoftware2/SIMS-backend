<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\Companies\Services\CompanyService;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
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

            $provision = $this->companyService->provisionCompany($dbName, $defaultDbUser, $defaultDbPwd);

            if (!empty($provision['success']) && $provision['success'] === true) {

                $this->seedTenantDatabase($dbName, $defaultDbUser, $defaultDbPwd);

                $company = \Modules\Companies\Models\Company::firstOrCreate(
                    ['cif' => $c['cif']],
                    [
                        'created_by_id' => 1,
                        'name' => $c['name'],
                        'description' => $c['description'],
                        'db_conexion' => $dbName,
                        'db_user' => $defaultDbUser,
                        'db_pwd' => $defaultDbPwd,
                    ]
                );

                \Modules\Users\Models\User::firstOrCreate(
                    ['email' => str_replace(['company_', '_'], ['', '.'], $dbName) . '@sims.com'],
                    [
                        'name' => $company->name . ' Manager',
                        'password' => Hash::make('password'),
                        'company_id' => $company->id,
                        'role' => 'manager',
                    ]
                );

                $this->command->info("✓ Company {$c['name']} created and provisioned.");
            } else {
                $this->command->error("✗ Failed to provision {$c['name']}: " . ($provision['message'] ?? 'unknown error'));
            }
        }
    }

    protected function seedTenantDatabase(string $dbName, string $dbUser, string $dbPassword): void
    {
        Config::set('database.connections.tenant', [
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

        DB::purge('tenant');
        DB::reconnect('tenant');

        $this->command->info("  → Creating tenant admin...");
        $tenantName = str_replace(['company_', '_'], ['', ' '], $dbName);
        $tenantEmail = str_replace('_', '.', str_replace('company_', '', $dbName)) . '@sims.com';

        // Check if user already exists
        $existingUser = DB::connection('tenant')->table('users')->where('email', $tenantEmail)->first();
        if (!$existingUser) {
            DB::connection('tenant')->table('users')->insert([
                'name' => ucfirst($tenantName) . ' Admin',
                'email' => $tenantEmail,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info("  → Seeding VehicleTypes...");
        Artisan::call('db:seed', [
            '--class' => \Modules\Vehicles\Database\Seeders\VehicleTypeSeeder::class,
            '--force' => true,
        ]);

        $this->command->info("  → Seeding Vehicles...");
        Artisan::call('db:seed', [
            '--class' => \Modules\Vehicles\Database\Seeders\VehicleSeeder::class,
            '--force' => true,
        ]);
    }
}
