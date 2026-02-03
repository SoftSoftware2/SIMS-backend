<?php

return [
    App\Providers\AppServiceProvider::class,

    //Modules

    Modules\Companies\Providers\CompaniesServiceProviders::class,
    Modules\Vehicles\Providers\VehiclesServiceProviders::class,
];
