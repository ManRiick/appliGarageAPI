<?php

namespace Database\Seeders;

use App\Models\Vehicules;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehiculesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 vehicules using the factory
        \App\Models\Vehicules::factory()->count(10)->create();
    }
}