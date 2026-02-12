<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Modules\Vehicles\Controllers\VehicleController;

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['api', 'setTenant'])->group(function () {
    Route::get('/vehicles', [VehicleController::class, 'index']);
    Route::get('/vehicles/stats', function() {
        return response()->json([
            'database' => DB::connection('tenant')->getDatabaseName(),
            'total_vehicles' => \Modules\Vehicles\Models\Vehicle::count(),
            'total_types' => \Modules\Vehicles\Models\VehicleType::count(),
            'sample_vehicles' => \Modules\Vehicles\Models\Vehicle::limit(3)->get(['id', 'license', 'status']),
        ]);
    });
});
