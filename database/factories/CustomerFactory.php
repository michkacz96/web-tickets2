<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();

        return [
            'name' => $name,
            'full_name' => $name,
            'tax_id' => fake()->numberBetween(1000000000, 9999999999),
            'licence_number' => fake()->unique()->numberBetween(1000, 9000),
        ];
    }
}
