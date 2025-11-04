<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\CategoriaController;
use App\Http\Controllers\Api\ComentarioController;
use App\Http\Controllers\Api\DestinoController;
use App\Http\Controllers\Api\MisviajesController;
use App\Http\Controllers\Api\PaqueteController;
use App\Http\Controllers\Api\ReservacionController;
use App\Http\Controllers\Api\LoginController;
//use App\Models\Misviajes;
//use App\Models\Paquetes;
//use App\Models\Reservaciones;

Route::post('login', [LoginController::class, 'store']);  // Ruta para el login
Route::middleware('auth:sanctum')->group(function () {  
    Route::apiResource('categorias', CategoriaController::class);  // Rutas de categorias
    Route::apiResource('comentarios', ComentarioController::class);  // Rutas de comentarios
    Route::apiResource('destinos', DestinoController::class);     // Rutas de destinos
    Route::apiResource('misviajes', MisviajesController::class);      // Rutas de misviajes
    Route::apiResource('paquetes', PaqueteController::class);        // Rutas de paquetes
    Route::apiResource('reservaciones', ReservacionController::class);   // Rutas de reservaciones
    Route::post('logout', [LoginController::class, 'destroy']);  // Ruta para el logout
});
// Route::get('/user', function (Request $request) {
    //     return $request->user();
    // })->middleware('auth:sanctum');




// Rutas de categorias
//Route::apiResource("categorias", CategoriaController::class);
// Rutas de comentarios 
 //Route::apiResource("comentarios", CategoriaController::class);
// Rutas de destinos 
//Route::apiResource("destinos", CategoriaController::class);
// Rutas de misviajes 
//Route::apiResource("misviajes", CategoriaController::class);
// Rutas de paquetes 
//Route::apiResource("paquetes", CategoriaController::class);
// Rutas de reservaciones 
//Route::apiResource("reservaciones", CategoriaController::class);

