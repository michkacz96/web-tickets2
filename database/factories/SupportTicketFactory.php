<?php

namespace Database\Factories;

use App\Models\SupportTicket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SupportTicket>
 */
class SupportTicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if(fake()->randomDigitNotNull() % 2){
            $customrtType = 'P';
            $contact = fake()->phoneNumber();
        } else{
            $customrtType = 'E';
            $contact = fake()->safeEmail();
        }

        $priorities = array_keys(SupportTicket::getPriorityAray());
        
        return [
            'customer_id' => \App\Models\Customer::factory(),
            'category_id' => \App\Models\TicketCategory::factory(),
            'created_by' => \App\Models\User::factory(),
            'closed_by' => null,
            'priority' => $priorities[fake()->numberBetween(0, count($priorities) - 1)],
            'description' => fake()->text(),
            'customer_contact_type' => $customrtType,
            'customer_contact' => $contact,
        ];
    }
}
