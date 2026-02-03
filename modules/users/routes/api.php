<?php

use Illuminate\Support\Facades\Route;
use Modules\users\controllers\UserController;

Route::prefix('api')->group(function () {
    Route::apiResource('users', UserController::class);
});
