<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Controllers\AuthController;

Route::prefix('api/auth')->middleware('api')->group(function () {
    
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});
