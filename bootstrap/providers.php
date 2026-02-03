<?php

return [
    App\Providers\AppServiceProvider::class,

    //Modules

    Modules\Companies\Providers\CompaniesServiceProviders::class,
    Modules\Users\Providers\UsersServiceProvider::class,
    Modules\Auth\Providers\AuthServiceProvider::class,
];
