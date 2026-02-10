<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Controllers\AdminController;

// Todas las rutas de usuarios están protegidas con autenticación Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('admins', [AdminController::class, 'index']);
    Route::post('admins', [AdminController::class, 'store']);
    Route::get('admins/{id}', [AdminController::class, 'show']);
    Route::put('admins/{id}', [AdminController::class, 'update']);
    Route::delete('admins/{id}', [AdminController::class, 'destroy']);
});
