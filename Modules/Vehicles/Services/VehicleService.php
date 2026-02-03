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

    pubilic function GetVehicleById(int $id)


    public function createVehicle(array $data): Vehicle
    {
        if (Vehicle::where('license', $data['license'])->exists()) {
            throw new \Exception('Vehicle with this license already exists');
        }

        return Vehicle::create($data);
    }


    public function updateVehicle(Vehicle $vehicle, array $data): Vehicle
    {
        $vehicle->update($data);
        return $vehicle;
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
