<?php

return [
    App\Providers\AppServiceProvider::class,

    //Modules

    Modules\Companies\Providers\CompaniesServiceProviders::class,
    Modules\users\providers\UsersServiceProvider::class,
    Modules\auth\providers\AuthServiceProvider::class,
];
