<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\CustomerEmail;
use App\Models\CustomerPhone;
use App\Models\SupportTicket;
use App\Models\TicketCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        $categories = TicketCategory::factory(12)->create();
        

        for($i = 0; $i < 50; $i++){
            Customer::factory()
                ->has(CustomerEmail::factory()->count(fake()->numberBetween(0, 3)), 'emails')
                ->has(CustomerPhone::factory()->count(fake()->numberBetween(0, 3)), 'phones')
                ->has(SupportTicket::factory()
                    ->for($categories[fake()->numberBetween(0, count($categories) - 1)], 'category')
                    ->for($users[fake()->numberBetween(0, count($users) - 1)], 'createdBy')
                    ->for($users[fake()->numberBetween(0, count($users) - 1)], 'closedBy')
                    ->count(fake()->numberBetween(0, 100)), 'tickets')
                ->has(SupportTicket::factory()
                ->for($categories[fake()->numberBetween(0, count($categories) - 1)], 'category')
                ->for($users[fake()->numberBetween(0, count($users) - 1)], 'createdBy')
                ->count(fake()->numberBetween(0, 30)), 'tickets')
                ->create();
        }
    }
}
