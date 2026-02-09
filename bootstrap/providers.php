<?php

return [
    App\Providers\AppServiceProvider::class,

    //Modules

    Modules\Auth\Providers\AuthServiceProvider::class,
    Modules\Companies\Providers\CompaniesServiceProviders::class,
    Modules\Users\Providers\UsersServiceProvider::class,
];
