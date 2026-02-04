<?php

namespace Modules\Vehicles\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Vehicles\Models\VehicleType;

class VehicleTypeController extends Controller
{
    public function index(): JsonResponse
    {
        $vehicleTypes = VehicleType::all();

        return response()->json([
            'status' => 'success',
            'data' => $vehicleTypes,
        ], 200);
    }


    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:vehicle_types,name',
            'description' => 'nullable|string',
        ]);

        $vehicleType = vehicleType::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle type created successfully',
            'data' => $vehicleType,
        ], 201);

    }

    public function show(VehicleType $vehicleType): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $vehicleType,
        ], 200);
    }

    public function update(Request $request, Vehicletype $vehicleType): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:50|unique:vehicle_types,name, ' . $vehicleType->id,
            'description' => 'nullable|string',
        ]);

        $vehicleType->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle type updated successfully',
            'data' => $vehicleType,
        ], 200);

    }

    public function destroy(VehicleType $vehicleType): JsonResponse
    {
        $vehicleType->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle type deleted successfully',
        ], 200);
    }
}
