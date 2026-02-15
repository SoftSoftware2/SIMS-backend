<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Cargar rutas del módulo Auth
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('Modules/Auth/Routes/AuthRoutes.php'));
    }
}
