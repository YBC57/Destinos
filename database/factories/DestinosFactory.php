<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destinos>
 */
class DestinosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->text(), // sentence genera una frase aleatoria
            'descripcion' => fake()->text(), // text genera un texto aleatorio
            'ubicacion' => fake()->text(), 
            'precio' => fake()->randomDigit(), 
            'fecha_inicio' => fake()->date(),
            'fecha_fin' => fake()->date(),
            'imagen' => fake()->imageUrl(640, 480), // imageUrl genera una URL de imagen aleatoria//
        
        ];
    }
}
