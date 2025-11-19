<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory; // importar la clase Factory
use Illuminate\Support\Facades\Hash; // Para hashear contraseñas
use Illuminate\Support\Str; // Para generar cadenas aleatorias

use App\Models\User;// importar el modelo User
use App\Models\Categorias;// importar el modelo Categorias
use App\Models\Comentarios;// importar el modelo UseComentariosr
use App\Models\Destinos;// importar el modelo Destinos
use App\Models\Misviajes;// importar el modelo Misviajes
use App\Models\Paquetes;// importar el modelo Paquetes
use App\Models\Reservaciones;// importar el modelo Reservaciones

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call(RolSeeder::class);  // Llamar al seeder de roles

        User::factory()->create([
            'name' => 'Yuleisi Barrera Castro',
            'email' => 'Yuleisi@laravel.com',
        ])-> assignRole('Administrador');  // Asignar rol de Administrador al usuario creado

        User::factory()->create([
            'name' => 'Itzel Gudiño Garcia',
            'email' => 'itzel@gmail.com',
        ])-> assignRole('Editor');  // Asignar rol de Editor al usuario Itzel


        User::factory(29)->create()->each(function ($user) {
            $user->assignRole('Usuario');
        });  // Crear 29 usuarios y les asigna el rol de Usuario

       // User::factory(10)->create();
        Categorias::factory(10)->create();
        Comentarios::factory(10)->create();
        Paquetes::factory(3)->create();
        Destinos::factory(30)->create();
        Misviajes::factory(30)->create();
        Reservaciones::factory(30)->create();


        // Relación muchos a muchos
       $destinos = Destinos::all();
      // $reservacion = Reservaciones::all();
       $categorias = Categorias::all();

        // Asignar entre 2 y 4 etiquetas aleatorias a cada receta
        // attach() agrega registros a la tabla intermedia sin eliminar los existentes 
       //foreach ($destinos as $destinos) {
           // $destinos->reservaciones()->attach($reservacion->random(rand(2, 4)));
        //}

        foreach ($destinos as $destino) {
            $destino->categoria()->attach($categorias->random(rand(2, 4)));
        }
    }
}
