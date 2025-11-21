<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

use App\Models\Destinos;
use App\Models\User;
use App\Models\categorias;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);
uses(WithFaker::class);

test('index', function () {
    // Ejecuta el seeder de roles
    $this->artisan('db:seed', ['--class' => 'RolSeeder']);

    Sanctum::actingAs(User::factory()->create()->assignRole('Usuario'));  // Simula un usuario autenticado con el rol de Usuario

    Categorias::factory()->create();  // Crear una categoría para las recetas
    Destinos::factory(3)->create();  // Crear 3 recetas

    $response = $this->getJson('/api/destinos');  // Realiza una solicitud GET a la ruta /api/recetas
    //dd($response->json());  // Mostrar la respuesta JSON para depuración

    $response->assertStatus(Response::HTTP_OK)  // Verificar que el estado de la respuesta sea 200 OK
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'tipo',
                    'atributos' => [
                        'nombre',
                        'descripcion',
                    ]
                ]
            ]
        ]);
});


test('show', function () {  // Muestra una receta específica
    // Ejecuta el seeder de roles
    $this->artisan('db:seed', ['--class' => 'RolSeeder']);

    Sanctum::actingAs(User::factory()->create()->assignRole('Usuario'));  // Simula un usuario autenticado con el rol de Usuario

    $categoria = categorias::factory()->create();  // Crear una categoría para la receta
    $destino = Destinos::factory()->create();  // Crear una receta

    $response = $this->getJson("/api/destinos/{$destino->id}");  // Realiza una solicitud GET a la ruta /api/recetas/{id}
    //dd($response->json());

    $response->assertStatus(Response::HTTP_OK)  // Verificar que el estado de la respuesta sea 200 OK
        ->assertJsonStructure([
            'data' => [
                'id',
                'tipo',
                'atributos' => [
                    'nombre',
                    'descripcion',
                ]
            ]
        ]);
});

test('store', function () {  // Crea una nueva receta
    // Ejecuta el seeder de roles
    $this->artisan('db:seed', ['--class' => 'RolSeeder']);

    $usuario = Sanctum::actingAs(User::factory()->create()->assignRole('Administrador'));  // Simula un usuario autenticado con el rol de Administrador

    $categoria = categorias::factory()->create();  // Crear una categoría para la receta
    //$etiqueta = Etiqueta::factory()->creatnombree();  // Crear una etiqueta para la receta

    $data = [  // Datos de la nueva receta
        'categoria_id' => $categoria->id,
        'nombre' => $this->faker->sentence,
        'descripcion' => $this->faker->sentence,
        'precio' => $this->faker->word,
        'fecha_inicio' => $this->faker->date('Y-m-d'),
        'imagen' => UploadedFile::fake()->image('destino.png'),
        //'etiquetas' => $etiqueta->id,
    ];

    $response = $this->postJson('/api/destinos/', $data);  // Realiza una solicitud POST a la ruta /api/destinos
  // dd($response->json());

    $response->assertStatus(Response::HTTP_CREATED);  // Verificar que el estado de la respuesta sea 201 Created

    // Verificar que se haya creado el registro
    $this->assertDatabaseHas('destinos', 
                            ['nombre' => $response['atributos']['nombre']]);
});

test('update', function () {
    // Ejecuta el seeder de roles
    $this->artisan('db:seed', ['--class' => 'RolSeeder']);

$usuario = User::factory()->create()->assignRole('Editor');// Simula un usuario autenticado con el rol de Editor
    Sanctum::actingAs($usuario);
    $categoria = categorias::factory()->create();  // Crear una categoría para la receta
    $destino = Destinos::factory()->create(['user_id' => $usuario->id]);
      // Crear una destino

    $data = [   // Datos actualizados de la destino
        'categoria_id' => $categoria->id,
        'nombre' => 'nombre actualizado',      
        'descripcion' => 'descripcion actualizada',
        'precio' => $this->faker->sentence,
        'fecha_inicio' => $this->faker->sentence,
    ];

    $response = $this->putJson("/api/destinos/{$destino->id}", $data);  // Realiza una solicitud PUT a la ruta /api/recetas/{id}
    //dd($response->json());

    $response->assertStatus(Response::HTTP_OK);  // Verificar que el estado de la respuesta sea 200 OK

    // Verificar que se haya actualizado el registro
    $this->assertDatabaseHas('destinos', [
        'nombre' => 'nombre actualizado',
        'descripcion' => 'descripcion actualizada',
    ]);
});


test('destroy', function () {  // Elimina una receta
    $this->artisan('db:seed', ['--class' => 'RolSeeder']);

    $usuario = User::factory()->create()->assignRole('Administrador');
     
    Sanctum::actingAs($usuario);  // Simula un usuario autenticado con el rol de Administrador

    categorias::factory()->create();  // Crear una categoría para la receta

    $destino = Destinos::factory()->create(['user_id' => $usuario->id]);  // Crear una receta

    $response = $this->deleteJson("/api/destinos/{$destino->id}");  // Realiza una solicitud DELETE a la ruta /api/recetas/{id}

    $response->assertStatus(Response::HTTP_NO_CONTENT);  // Verificar que el estado de la respuesta sea 204 No Content

    // Verificar que se haya eliminado el registro
    $this->assertDatabaseMissing('destinos', ['id' => $destino->id]);
});

test('destroy_editor', function () {  // Intenta eliminar una receta con un usuario con rol Editor
    $this->artisan('db:seed', ['--class' => 'RolSeeder']);  // Ejecuta el seeder de roles

    Sanctum::actingAs(User::factory()->create()->assignRole('Editor'));  // Simula un usuario autenticado con el rol de Editor

    Categorias::factory()->create();  // Crear una categoría para la receta

    $destino = Destinos::factory()->create();  // Crear una receta

    $response = $this->deleteJson("/api/destinos/{$destino->id}");  // Realiza una solicitud DELETE a la ruta /api/recetas/{id}

    $response->assertStatus(Response::HTTP_FORBIDDEN);  // Verificar que el estado de la respuesta sea 403 Forbidden
});