<?php

namespace Modules\Vehicles\Services;

use Modules\Vehicles\Models\VehicleType;
use Illuminate\Database\Eloquent\Collection;

class VehicleTypeService
{
    public function getAllVehicleTypes(): Collection
    {
        return VehicleType::all();
    }

    public function getVehicleTypeById(int $id): VehicleType
    {
        return VehicleType::findOrFail($id);
    }

    public function createVehicleType(array $data): VehicleType
    {
        return VehicleType::create($data);
    }

    public function updateVehicleType(VehicleType $vehicleType, array $data): VehicleType
    {
        $vehicleType->update($data);
        return $vehicleType->fresh();
    }

    public function deleteVehicleType(VehicleType $vehicleType): bool
    {
        return $vehicleType->delete();
    }
}
