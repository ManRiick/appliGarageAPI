<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Vehicules;

class VehiculesFactory extends Factory
{
    protected $model = Vehicules::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'marque' => $this->faker->word(),
            'modele' => $this->faker->word(),
            'immatriculation' => strtoupper(Str::random(7)),
            'annee' => $this->faker->year(),
            'kilometrage' => $this->faker->numberBetween(10000, 200000),
            'user_id' => $this->faker->randomNumber(),
        ];
    }

}