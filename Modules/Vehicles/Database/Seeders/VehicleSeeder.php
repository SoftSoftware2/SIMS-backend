<?php

namespace Modules\Vehicles\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Vehicles\Models\Vehicle;
use Modules\Vehicles\Models\VehicleType;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicleTypes = \Modules\Vehicles\Models\VehicleType::all();

        if ($vehicleTypes->isEmpty()) {
            $this->command->error('No vehicle types found. Run VehicleTypeSeeder first.');
            return;
        }

        $statuses = ['available', 'using', 'stopped'];

        $dbName = DB::connection('tenant')->getDatabaseName();
        $prefix = strtoupper(substr($dbName, 8, 4));

        for ($i = 1; $i <= 10; $i++) {
            $license = "{$prefix}-" . str_pad($i, 4, '0', STR_PAD_LEFT);
            \Modules\Vehicles\Models\Vehicle::firstOrCreate(
                ['license' => $license],
                [
                    'status' => $statuses[array_rand($statuses)],
                    'vehicle_type_id' => $vehicleTypes->random()->id,
                ]
            );
        }

        $this->command->info("✓ Created 10 vehicles for {$dbName}");
    }
}
