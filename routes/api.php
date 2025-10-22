<?php

use App\Http\Controllers\api\CategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource("categorias", CategoriaController::class);
