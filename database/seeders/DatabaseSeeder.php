<?php

namespace Database\Seeders;

use Modules\Users\Models\User;
use Modules\Companies\Database\Seeders\CompanySeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            \Modules\Admins\Database\Seeders\AdminSeeders::class,
            \Modules\Vehicles\Database\Seeders\VehicleSeeder::class,
            \Modules\Vehicles\Database\Seeders\VehicleTypeSeeder::class,
        ]);

        $this->call([
            CompanySeeder::class,
        ]);
    }
}
