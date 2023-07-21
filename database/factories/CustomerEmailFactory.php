<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerEmail>
 */
class CustomerEmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'customer_id' => \App\Models\Customer::factory(),
            'email' => fake()->email(),
            'tags' => \Database\Factories\Helpers\CustomerContactHelper::generateTags(fake()->numberBetween(0, 5)),
        ];
    }
}
