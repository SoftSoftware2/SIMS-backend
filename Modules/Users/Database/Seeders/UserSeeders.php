<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Users\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Example

        $users = [
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

        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'], // Se hasheará automáticamente por el cast
            ]);
        }
    }
}