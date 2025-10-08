<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Misviajes>
 */
class MisviajesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
    'user_id' => \App\Models\User::factory(),         // si también necesitas user_id
    'destino_id' => \App\Models\Destinos::factory(),   // crea un destino y toma su id
    'estado' => ucfirst(fake()->word()),
];

    }
}
