<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Controllers\UserController;

Route::prefix('api')->group(function () {
    Route::apiResource('users', UserController::class);
});
