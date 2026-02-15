<?php

namespace Modules\Vehicles\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Vehicles\Models\VehicleType;
use Modules\Vehicles\Requests\StoreVehicleTypeRequest;
use Modules\Vehicles\Requests\UpdateVehicleTypeRequest;
use Modules\Vehicles\Resources\VehicleTypeResource;
use Modules\Vehicles\Services\VehicleTypeService;

class VehicleTypeController extends Controller
{
    protected VehicleTypeService $vehicleTypeService;

    public function __construct(VehicleTypeService $vehicleTypeService)
    {
        $this->vehicleTypeService = $vehicleTypeService;
    }

    public function index(): JsonResponse
    {
        $vehicleTypes = $this->vehicleTypeService->getAllVehicleTypes();

        return response()->json([
            'success' => true,
            'data' => VehicleTypeResource::collection($vehicleTypes),
            'message' => 'Vehicle types retrieved successfully'
        ], 200);
    }

    public function store(StoreVehicleTypeRequest $request): JsonResponse
    {
        $vehicleType = $this->vehicleTypeService->createVehicleType($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Vehicle type created successfully',
            'data' => new VehicleTypeResource($vehicleType)
        ], 201);
    }

    public function show(VehicleType $vehicleType): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new VehicleTypeResource($vehicleType),
            'message' => 'Vehicle type retrieved successfully'
        ], 200);
    }

    public function update(UpdateVehicleTypeRequest $request, VehicleType $vehicleType): JsonResponse
    {
        $vehicleType = $this->vehicleTypeService->updateVehicleType($vehicleType, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Vehicle type updated successfully',
            'data' => new VehicleTypeResource($vehicleType)
        ], 200);
    }

    public function destroy(VehicleType $vehicleType): JsonResponse
    {
        $this->vehicleTypeService->deleteVehicleType($vehicleType);

        return response()->json([
            'success' => true,
            'message' => 'Vehicle type deleted successfully'
        ], 200);
    }
}
