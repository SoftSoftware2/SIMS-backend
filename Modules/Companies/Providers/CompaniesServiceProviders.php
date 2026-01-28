<?php

namespace Modules\Companies\Providers;

use Illuminate\Support\ServiceProvider;

class CompaniesServiceProviders extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }
    /**
     * Bootstrap any application services.
    */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/routes.php');
    }

}
