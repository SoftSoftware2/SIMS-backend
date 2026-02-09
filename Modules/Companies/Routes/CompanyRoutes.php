<?php

use Illuminate\Support\Facades\Route;
use Modules\Companies\Controllers\CompanyController;

Route::prefix('api')->middleware(['api', 'auth:sanctum'])->group(function () {
    Route::apiResource('companies', CompanyController::class);
});
