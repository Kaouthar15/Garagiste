<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Invoice;
use App\Models\Repair;
use App\Models\SparePart;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Vehicle::factory()->count(10)->create();
        Invoice::factory()->count(10)->create();
        Repair::factory()->count(10)->create();
        SparePart::factory()->count(10)->create();
        User::factory()->count(10)->create();
    }
}
