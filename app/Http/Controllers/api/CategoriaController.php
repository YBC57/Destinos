<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Http\Resources\CategoriaResource;
use App\Http\Resources\CategoriaCollection;
use Symfony\Component\HttpFoundation\Response;

class CategoriaController extends Controller
{
   // Muestra todas las categorias
    public function index(){
         //return Categoria::all(); // Devuelve todas las categorias
        return new CategoriaCollection(Categoria::all());  // Devuelve todas las categorias como recurso API
    }

    // Muestra una categoria a partir de su id
    public function show(Categoria $categoria){
        // return $categoria; // Devuelve la categoria
        $categoria = $categoria->load('destino');  // Carga las recetas relacionadas con la categoria
        return new CategoriaResource($categoria);  // Devuelve la categoria como recurso API 
    }

}
