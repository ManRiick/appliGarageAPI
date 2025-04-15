<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Taches;
use App\Models\Vehicules;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Taches>
 */
class TachesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'description' => $this->faker->sentence(),
            'prix' => $this->faker->randomFloat(2, 100, 10000),
            'duree_jour' => $this->faker->numberBetween(1, 30), // Assuming this is the number of days
            'vehicule_id' => \App\Models\Vehicules::factory(), // Assuming you have a Vehicules factory
            'statut' => $this->faker->randomElement(['en cours', 'terminé', 'annulé']),

        ];
    }
}
