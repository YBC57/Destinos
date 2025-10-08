<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory; // importar la clase Factory
use Illuminate\Support\Facades\Hash; // Para hashear contraseñas
use Illuminate\Support\Str; // Para generar cadenas aleatorias

use App\Models\Categorias;
use App\Models\Comentarios;
use App\Models\Destinos;
use App\Models\Misviajes;
use App\Models\Paquetes;
use App\Models\Reservaciones;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory(29)->create();
        Categorias::factory(10)->create();
        Comentarios::factory(100)->create();
        Paquetes::factory(40)->create();
        Destinos::factory(40)->create();
        Misviajes::factory(40)->create();
        Reservaciones::factory(40)->create();


        // Relación muchos a muchos
       // $recetas = Receta::all();
        //$etiquetas = Etiqueta::all();

        // Asignar entre 2 y 4 etiquetas aleatorias a cada receta
        // attach() agrega registros a la tabla intermedia sin eliminar los existentes 
       // foreach ($recetas as $receta) {
           // $receta->etiquetas()->attach($etiquetas->random(rand(2, 4)));
       // }
    }
}
