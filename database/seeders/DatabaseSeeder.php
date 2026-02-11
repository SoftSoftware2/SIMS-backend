<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            \Modules\Users\Database\Seeders\UserSeeder::class,
            \Modules\Companies\Database\Seeders\CompanySeeder::class,
        ]);
    }
}
