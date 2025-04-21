<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Taches;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factures>
 */
class FacturesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'date_facture' => $this->faker->date(),
        'description' => $this->faker->sentence(),
        'tache_id' => Taches::factory(),
        'vehicule_id' => $this->faker->randomNumber(),
        'user_id' => $this->faker->randomNumber(),
        'montant_total' => $this->faker->randomFloat(2, 100, 10000),
        'statut_payement' => $this->faker->randomElement(['paid', 'unpaid', 'pending']),
        ];
    }
}
