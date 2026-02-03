<?php

use Illuminate\Support\Facades\Route;
use Modules\Vehicles\Controllers\VehicleController;

Route::middleware(['api'])->prefix('api')->group(function () {
    Route::apiResource('vehicles', VehicleController::class);
});

