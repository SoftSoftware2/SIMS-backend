<?php

namespace Modules\Companies;

use Illuminate\Support\ServiceProvider;

class CompaniesServiceProvider extends ServiceProvider{

    public function register(): void{
        //
    }

    public function boot(): void{
        $this->loadRoutesFrom(__DIR__ .'/routes.php');
    }

}