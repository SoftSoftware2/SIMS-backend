<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Controllers\UserController;

Route::prefix('api')->middleware(['api', 'auth:sanctum'])->group(function () {
    Route::apiResource('users', UserController::class);
});
