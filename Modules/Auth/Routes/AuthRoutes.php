<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Controllers\AuthController;

// Rutas públicas (sin autenticación)
Route::post('login', [AuthController::class, 'login']);

// Rutas protegidas (requieren autenticación con Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});
