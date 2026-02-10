<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Models\Company;
use Modules\Users\Models\User;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first existing user
        $user = User::first();

        if (!$user) {
            $this->command->error('No users found. Please create a user first via register endpoint.');
            return;
        }

        $companies = [
            [
                'created_by_id' => $user->id,
                'name' => 'Autocars La Rapitenca',
                'description' => 'Bus and passenger transportation services',
                'cif' => 'A12345678',
                'db_conexion' => 'postgresql://localhost:5432/autocars_rapitenca_db',
                'db_user' => 'user_autocars_rapitenca',
                'db_pwd' => 'password123',
            ],
            [
                'created_by_id' => $user->id,
                'name' => 'Taxis Delta',
                'description' => 'Taxi and mobility services in La Rapita',
                'cif' => 'B23456789',
                'db_conexion' => 'postgresql://localhost:5432/taxis_delta_db',
                'db_user' => 'user_taxis_delta',
                'db_pwd' => 'password123',
            ],
        ];

        foreach ($companies as $companyData) {
            Company::create($companyData);
        }

        $this->command->info(count($companies) . ' companies created successfully!');
    }
}
