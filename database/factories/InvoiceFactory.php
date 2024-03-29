<?php

namespace Database\Factories;

use App\Models\Repair;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'additionalCharges' =>fake()->text(), 
            'totalAmount' =>fake()->randomFloat(2, 10, 1000), 
            'repair_id' => Repair::factory(),
        ];
    }
}
