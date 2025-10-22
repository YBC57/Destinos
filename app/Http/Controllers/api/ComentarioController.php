<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComentarioResource;
use App\Models\Comentarios;
use App\Http\Resources\ComentarioCollection;

class ComentarioController extends Controller
{
    //// Muestra todos los comentarios
    public function index(){
         //return Categoria::all(); // Devuelve todos los comentarios
        return new ComentarioCollection(Comentarios::all());  // Devuelve todos los comentarios como recurso API
    }

    // Muestra una comentario a partir de su id
    public function show(Comentarios $comentario){
        // return $comentario; // Devuelve la comentario
        $comentario = $comentario->load('destino');  // Carga los destinos relacionados con el comentario
        return new ComentarioResource($comentario);  // Devuelve la comentario como recurso API 
    }
}
