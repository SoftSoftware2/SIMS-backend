<?php

use Illuminate\Support\Facades\Route;
use Modules\Vehicles\Controllers\VehicleController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('vehicles', VehicleController::class);
