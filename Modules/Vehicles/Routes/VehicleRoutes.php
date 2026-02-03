<?php

use Illuminate\Support\Facades\Route;
use Modules\Vehicles\Controllers\VehicleController;

Route::middleweare(['api'])->prefix('api')->group(function () {
    Route::apiResource('vehicles', VehicleController::class);
});

