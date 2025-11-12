<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DestinoCollection;
use App\Models\Destinos;
use App\Http\Resources\DestinoResource;  // Importar el recurso DestinoResource
use App\Http\Requests\StoreDestinoRequest;  // Importar la request StoreDestinoRequest
use App\Http\Requests\UpdateDestinoRequest; // Importar la request UpdateDestinoRequest
use Symfony\Component\HttpFoundation\Response; // Importar la clase Response para los códigos de estado HTTP

class DestinoController extends Controller
{
    //// Muestra todas los destinos
    public function index(){
         //return Categoria::all(); // Devuelve todas las destinos
        return new DestinoCollection(Destinos::all());  // Devuelve todas las destinos como recurso API
    }

    // Muestra un destino a partir de su id
    public function show(Destinos $destinos){
        // return $categoria; // Devuelve la categoria
        $destinos = $destinos->load('categoria');  // Carga los destinos relacionadas con la categoria
        return new DestinoResource($destinos);  // Devuelve el destino como recurso API 
    }
     // Actualiza una receta existente
    public function update(UpdateDestinoRequest $request, Destinos $destino){  // Usar la request UpdateDestinoRequest para validar los datos
        $destino->update($request->all());  // Actualizar la receta con los datos validados

        if($etiquetas = json_decode($request->etiquetas)){  // Si se reciben etiquetas, decodificar el JSON
            $destino->etiquetas()->sync($etiquetas);  // Sincronizar las etiquetas (eliminar las que no están y agregar las nuevas)
        }

        // Devolver la receta actualizada como recurso API con código de estado 200 (OK)
        return response()->json(new DestinoResource($destino), Response::HTTP_OK);
    }

    // Elimina una receta existente
    public function destroy(Destinos $destino){  // Inyectar la receta a eliminar
        $destino->delete();  // Eliminar la receta

        // Devolver una respuesta vacía con código de estado 204 (No Content)
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
