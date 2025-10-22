<?php

use App\Http\Controllers\api\CategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas de categorias
Route::apiResource("categorias", CategoriaController::class);
// Rutas de comentarios 
Route::apiResource("comentarios", CategoriaController::class);
// Rutas de destinos 
Route::apiResource("destinos", CategoriaController::class);
// Rutas de misviajes 
Route::apiResource("misviajes", CategoriaController::class);
// Rutas de paquetes 
Route::apiResource("paquetes", CategoriaController::class);
// Rutas de reservaciones 
Route::apiResource("reservaciones", CategoriaController::class);
