<?php

namespace Modules\Companies\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Companies\Models\Company;
use Modules\Users\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Companies\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companyName = fake()->company();
        
        return [
            'name' => $companyName,
            'description' => fake()->catchPhrase(),
            'cif' => fake()->unique()->regexify('[A-Z][0-9]{8}'),
            'db_conexion' => 'postgresql://localhost:5432/' . strtolower(str_replace(' ', '_', $companyName)) . '_db',
            'db_user' => 'user_' . strtolower(str_replace(' ', '_', $companyName)),
            'db_pwd' => fake()->password(16),
        ];
    }
}
