<?php

namespace Modules\Admins\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admins\Models\Admin;

class AdminSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Example

        $admins = [
            [
                'name' => 'Jordi',
                'email' => 'jordi@sims.com',
                'password' => env('PASSWORD_ADMIN_USERS'),
            ],
            [
                'name' => 'Iker',
                'email' => 'iker@sims.com',
                'password' => env('PASSWORD_ADMIN_USERS'),
            ],
            [
                'name' => 'Francesc',
                'email' => 'francesc@sims.com',
                'password' => env('PASSWORD_ADMIN_USERS'),
            ],
        ];

        foreach ($admins as $adminData) {
            Admin::create([
                'name' => $adminData['name'],
                'email' => $adminData['email'],
                'password' => $adminData['password'],
            ]);
        }
    }
}