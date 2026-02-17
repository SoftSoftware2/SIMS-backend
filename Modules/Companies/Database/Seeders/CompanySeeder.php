<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Companies\Models\Company;
use Modules\Admins\Models\Admin;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first existing admin
        $admin = Admin::first();

        if (!$admin) {
            $this->command->error('No admins found. Please create an admin first.');
            return;
        }

        $companies = [
            [
                'created_by_id' => $admin->id,
                'name' => 'Autocars La Rapitenca',
                'description' => 'Bus and passenger transportation services',
                'cif' => 'A12345678',
                'db_conexion' => 'postgresql://localhost:5432/autocars_rapitenca_db',
                'db_user' => 'user_autocars_rapitenca',
                'db_pwd' => 'password123',
            ],
            [
                'created_by_id' => $admin->id,
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
