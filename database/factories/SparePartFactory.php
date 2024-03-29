<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SparePart>
 */
class SparePartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'partName' => fake()->word(),
            'partReference' => fake()->unique()->regexify('[A-Z0-9]{10}'),
            'supplier' => fake()->company(),
            'price' => fake()->randomFloat(2, 10, 1000), 
        ];
    }
}
