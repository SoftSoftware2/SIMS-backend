<?php

use Illuminate\Support\Facades\Route;
use Modules\Vehicles\Controllers\VehicleController;
use Modules\Vehicles\Controllers\VehicleTypeController;

Route::middleware(['api'])->prefix('api')->group(function () {
    Route::apiResource('vehicles', VehicleController::class);
    Route::apiResource('vehicle-types', VehicleTypeController::class);
});

