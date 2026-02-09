<?php

namespace Modules\Users\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
class UsersServiceProvider extends ServiceProvider
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
            ->group(base_path('Modules/Users/Routes/UserRoutes.php'));

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
