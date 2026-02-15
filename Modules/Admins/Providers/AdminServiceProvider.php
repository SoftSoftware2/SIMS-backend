<?php

namespace Modules\Admins\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('Modules/Admins/Routes/AdminRoutes.php'));

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
