<?php

return [
    App\Providers\AppServiceProvider::class,

    //Modules

    Modules\Auth\Providers\AuthServiceProvider::class,
    Modules\Admins\Providers\AdminServiceProvider::class,
    Modules\Companies\Providers\CompaniesServiceProviders::class,
    Modules\Vehicles\Providers\VehiclesServiceProviders::class,
];
