<?php

namespace Modules\Vehicles\Controllers;

use App\Http\Controllers\Controller;
use Modules\Vehicles\Models\Vehicle;
use Modules\Vehicles\Requests\StoreVehicleRequest;
use Modules\Vehicles\Requests\UpdateVehicleRequest;
use Modules\Vehicles\Resources\VehicleResource;
use Modules\Vehicles\Services\VehicleService;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
    protected VehicleService $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function index(): JsonResponse
    {
        $vehicles = $this->vehicleService->getAllVehicles();

        return response()->json([
            'success' => true,
            'data' => VehicleResource::collection($vehicles),
            'message' => 'Vehicles retrieved successfully'
        ], 200);
    }

    public function store(StoreVehicleRequest $request): JsonResponse
    {
        $vehicle = $this->vehicleService->createVehicle($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Vehicle created successfully',
            'data' => new VehicleResource($vehicle)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $vehicle = $this->vehicleService->getVehicleById($id);

        return response()->json([
            'success' => true,
            'data' => new VehicleResource($vehicle),
            'message' => 'Vehicle retrieved successfully'
        ], 200);
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle): JsonResponse
    {
        $vehicle = $this->vehicleService->updateVehicle($vehicle, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Vehicle updated successfully',
            'data' => new VehicleResource($vehicle)
        ], 200);
    }

    public function destroy(Vehicle $vehicle): JsonResponse
    {
        $this->vehicleService->deleteVehicle($vehicle);

        return response()->json([
            'success' => true,
            'message' => 'Vehicle deleted successfully'
        ], 200);
    }
}
