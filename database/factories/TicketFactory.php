<?php

namespace Database\Factories;

use App\Models\Priority;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(['role' => User::REGULAR_USER])->id,
            'title' => fake()->sentence(),
            'description' => fake()->sentence(100),
            'priority_id' => Priority::all()->random()->id ?? Priority::factory()->create()->id,
            'closed_at' => fake()->optional()->dateTime(),
        ];
    }
}
