<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comentarios>
 */
class ComentariosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

    return [
    'user_id' => \App\Models\User::factory(),        // genera un usuario y asigna su id
    //'destino_id' => \App\Models\Destinos::factory(),  // genera un destino y asigna su id
    'comentario' => ucfirst(fake()->word()),         // tu comentario aleatorio
];

    }
}
