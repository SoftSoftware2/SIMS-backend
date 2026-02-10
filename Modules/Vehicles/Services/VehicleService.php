<?php

namespace Modules\Vehicles\Services;

use Modules\Vehicles\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

class VehicleService
{
    public function getAllVehicles(): Collection
    {
        return Vehicle::with('vehicleType')->get();
    }

    public function getVehicleById(int $id): Vehicle
    {
        return Vehicle::with('vehicleType')->findOrFail($id);
    }

    public function createVehicle(array $data): Vehicle
    {
        return Vehicle::create($data);
    }

    public function updateVehicle(Vehicle $vehicle, array $data): Vehicle
    {
        $vehicle->update($data);
        return $vehicle->fresh('vehicleType');
    }

    public function deleteVehicle(Vehicle $vehicle): bool
    {
        return $vehicle->delete();
    }

    public function getVehiclesByStatus(string $status): Collection
    {
        return Vehicle::where('status', $status)->with('vehicleType')->get();
    }
}
