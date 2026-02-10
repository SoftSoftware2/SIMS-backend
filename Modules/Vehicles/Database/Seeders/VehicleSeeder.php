<?php

namespace Modules\Vehicles\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Vehicles\Models\Vehicle;
use Modules\Vehicles\Models\VehicleType;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicleTypes = VehicleType::all();

        if ($vehicleTypes->isEmpty()) {
            $this->command->warn('No vehicle types found. Please run VehicleTypeSeeder first.');
            return;
        }

        $vehicles = [
            ['license' => 'ABC1234', 'status' => 'available'],
            ['license' => 'XYZ5678', 'status' => 'available'],
            ['license' => 'DEF9012', 'status' => 'using'],
            ['license' => 'GHI3456', 'status' => 'available'],
            ['license' => 'JKL7890', 'status' => 'stopped'],
            ['license' => 'MNO2345', 'status' => 'available'],
            ['license' => 'PQR6789', 'status' => 'using'],
            ['license' => 'STU0123', 'status' => 'available'],
            ['license' => 'VWX4567', 'status' => 'available'],
            ['license' => 'YZA8901', 'status' => 'stopped'],
        ];

        foreach ($vehicles as $vehicleData) {
            Vehicle::create([
                'license' => $vehicleData['license'],
                'status' => $vehicleData['status'],
                'vehicle_type_id' => $vehicleTypes->random()->id,
            ]);
        }
    }
}
