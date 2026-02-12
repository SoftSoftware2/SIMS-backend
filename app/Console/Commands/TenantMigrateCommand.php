<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Companies\Models\Company;

class TenantMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate {tenant_id? : The ID of the tenant to migrate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations for all tenants or a specific tenant';

    /**
     * Execute the console command.
     */
    protected $tenantService;

    public function __construct(\Modules\Companies\Services\TenantService $tenantService)
    {
        parent::__construct();
        $this->tenantService = $tenantService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tenantId = $this->argument('tenant_id');

        $query = Company::query();

        if ($tenantId) {
            $query->where('id', $tenantId);
        }

        $companies = $query->get();

        if ($companies->isEmpty()) {
            $this->info('No companies found to migrate.');
            return;
        }

        foreach ($companies as $company) {
            $this->info("Migrating tenant: {$company->name} (ID: {$company->id})");

            $this->migrateTenant($company);
        }

        $this->info('All tenant migrations completed.');
    }

    /**
     * Run migrations for a specific tenant.
     *
     * @param  \Modules\Companies\Models\Company  $company
     * @return void
     */
    protected function migrateTenant(Company $company)
    {
        // Set the tenant database connection using the service
        $this->tenantService->switchToTenant($company);

        if (!DB::connection('tenant')->getPdo()) {
            $this->error("Could not connect to database for tenant {$company->name}");
            return;
        }

        $this->info("Connected to database: {$company->db_conexion}");

        // Paths to module migrations
        // Assuming typical module structure, we might want to scan Modules/*/Database/Migrations
        // But for now, let's assume we want to run all migrations that are meant for tenants.
        // If we just run 'migrate', it might run migrations from standard 'database/migrations' too which might not be desired if they are shared/central.
        // However, usually tenant migrations are specific.

        // Let's assume we want to run migrations from all Modules.
        // We can find all paths.

        $migrationPaths = glob(base_path('Modules/*/Database/Migrations'));

        // Also include the default migration path if there are tenant-specific migrations there, 
        // but typically 'database/migrations' is for the central DB (landlord).
        // Let's stick to Modules for now as that seems to be where business logic is.

        if (empty($migrationPaths)) {
            $this->warn("No module migration paths found.");
        }

        foreach ($migrationPaths as $path) {
            $this->line("Running migrations from: " . str_replace(base_path(), '', $path));

            $this->call('migrate', [
                '--database' => 'tenant',
                '--path' => str_replace(base_path() . '/', '', $path),
                '--force' => true, // Force is needed for production environment
            ]);
        }
    }
}
