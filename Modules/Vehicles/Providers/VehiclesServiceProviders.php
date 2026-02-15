<?php
namespace Modules\Vehicles\Providers;

use Illuminate\Support\ServiceProvider;

class VehiclesServiceProviders extends ServiceProvider
{
    public function register(): void
    {
        // You can bind services here
        // $this->app->bind(NewService::class, fn() => new NewService());
    }

    public function boot(): void
    {
        // Load module routes
        $this->loadRoutesFrom(__DIR__ . '/../Routes/VehicleRoutes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
