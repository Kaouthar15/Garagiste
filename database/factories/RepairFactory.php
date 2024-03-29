<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Repair>
 */
class RepairFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->text(),
            'status' => fake()->randomElement(['Pending', 'In Progress', 'Completed']),
            'startDate' => fake()->date(),
            'endDate' => fake()->date(), 
            'mechanicNotes' => fake()->text(),
            'clientNotes' => fake()->text(),
            'user_id' => User::factory(),
            'vehicle_id' => Vehicle::factory(),
        ];
    }
}
