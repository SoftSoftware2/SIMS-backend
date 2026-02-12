<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Users\Models\User;
use Modules\Companies\Models\Company;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@sims.com'],
            [
                'name' => 'Admin SaaS',
                'password' => Hash::make('password'),
                'company_id' => null,
                'role' => 'admin',
            ]
        );
    }
}
