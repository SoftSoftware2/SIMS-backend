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

        // Create 10 fake companies
        Company::factory(10)->create([
            'created_by_id' => $user->id,
        ]);

        $this->command->info('10 companies created successfully!');
    }
}
