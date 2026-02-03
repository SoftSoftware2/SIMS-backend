<?php
namespace Modules\Vehicles\Providers;

use Illuminate\Support\ServiceProvider;

class VehiclesServiceProvider extends ServiceProvider
{
    public function register()
    {
        // You can bind services here
        // $this->app->bind(NewService::class, fn() => new NewService());
    }

    public function boot()
    {
        // Load module routes
        $this->loadRoutesFrom(__DIR__ . '/../Routes/vehicleRoutes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
