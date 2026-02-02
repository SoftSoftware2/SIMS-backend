<?php

namespace Modules\Vehicles\Controllers;

use App\Http\Controllers\Controller;
use Modules\Vehicles\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller

{
    public function index(): JsonResponse
    {
        $vehicles = Vehicle::with('vehicleType')->get();

        return response()->json([
            'status' => 'success',
            'data' => $vehicles
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'license' => 'required|unique:vehicles,license|max:15',
            'status' => 'required|in:available,using,stopped',
            'vehicle_type_id' => 'required|exists:vehicle_types,id'
        ]);

        $vehicle = Vehicle::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle created successfully',
            'data' => $vehicle
        ], 201);
    }

    public function show(Vehicle $vehicle): JsonResponse
    {
        $vehicle->load('vehicleType');
        
        return response()->json([
            'status' => 'success',
            'data' => $vehicle
        ], 200);
    }

    public function update(Request $request, Vehicle $vehicle): JsonResponse
    {
        $validated = $request->validate([
            'license' => 'sometimes|max:15|unique:vehicles,license,' . $vehicle->id,
            'status' => 'sometimes|in:available,using,stopped',
            'vehicle_type_id' => 'sometimes|exists:vehicle_types,id'
        ]);

        $vehicle->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle updated',
            'data' => $vehicle
        ], 200);
    }

    public function destroy(Vehicle $vehicle): JsonResponse
    {
        $vehicle->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle deleted'
        ], 200);
    }

}
