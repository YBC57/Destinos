<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservaciones>
 */
class ReservacionesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
    'user_id' => \App\Models\User::factory(),       // si necesitas
    'destino_id' => \App\Models\Destinos::factory(), // crea un destino y toma su id
    'cantidad' => fake()->numberBetween(1, 10),
    'fecha_reserva' => fake()->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
    'total' => fake()->numberBetween(100, 1000),
];

    }
}
