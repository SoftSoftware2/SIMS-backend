<?php

namespace Modules\Vehicles\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Vehicles\Models\VehicleType;

class VehicleTypeSeeder extends Seeder
{
    public function run(): void
    {
        $vehicleTypes = [
            [
                'name' => 'SIMS-1',
                'description' => 'Intelligent sustainable mobility system',
            ],
            [
                'name' => 'SIMS-2',
                'description' => 'Intelligent sustainable mobility system',
            ],
            [
                'name' => 'SIMS-3',
                'description' => 'Intelligent sustainable mobility system',
            ],
            [
                'name' => 'SIMS-4',
                'description' => 'Intelligent sustainable mobility system',
            ],
            [
                'name' => 'SIMS-5',
                'description' => 'Intelligent sustainable mobility system',
            ],
        ];

        foreach ($vehicleTypes as $type) {
            VehicleType::create($type);
        }
    }
}
