<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'make' => fake()->word(),
            'model' => fake()->word(),
            'fuelType' => fake()->randomElement(['Petrol', 'Diesel', 'Electric']), 
            'registration' => fake()->unique()->regexify('[A-Z]{2}[0-9]{2}[A-Z]{3}[0-9]{3}'),
            'images' => json_encode([$this->faker->imageUrl(), $this->faker->imageUrl(), $this->faker->imageUrl()]),
            'user_id' => User::factory(), 
        ];
    }
}
