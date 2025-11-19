<?php

namespace App\Http\Controllers\api;
use App\Models\Destinos;

use App\Http\Controllers\Controller;
use App\Http\Resources\DestinoCollection;

use App\Http\Resources\DestinoResource;  // Importar el recurso DestinoResource
use App\Http\Requests\StoreDestinoRequest;  // Importar la request StoreDestinoRequest
use App\Http\Requests\UpdateDestinoRequest; // Importar la request UpdateDestinoRequest
use Symfony\Component\HttpFoundation\Response; // Importar la clase Response para los códigos de estado HTTP

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Importar el trait AuthorizesRequests para la autorización de políticas

class DestinoController extends Controller
{
    use AuthorizesRequests; // Usar el trait AuthorizesRequests para la autorización de políticas

    // Muestra todas las recetas
    public function index(){
        $this->authorize('Ver destinos');  
        $destinos = Destinos::with('categoria', 'user')->get();
        return DestinoResource::collection($destinos); // Devuelve todas las recetas como recurso API
    }

    // Muestra una receta a partir de su id
    public function show(Destinos $destino){
        $this->authorize('Ver destinos');  
        $destino = $destino->load('categoria', 'user');
        return new DestinoResource($destino); // Devuelve la receta como recurso API 
    }

    // Almacena una nueva receta 
    public function store(StoreDestinoRequest $request){  // Usar la request StoreRecetasRequest para validar los datos
        $this->authorize('Crear destinos');  
       
        $destino = $request->user()->destinos()->create($request->all());  // Crear una nueva receta asociada al usuario autenticado
        $destino->etiquetas()->attach(json_decode($request->etiquetas));  // Asociar las etiquetas a la receta (decodificar el JSON recibido)

        $destino->imagen = $request->file('imagen')->store('destinos','public'); // Almacenar la imagen en el disco 'public' dentro de la carpeta 'recetas'
        $destino->save(); // Guardar la receta con la ruta de la imagen
 
        // Devolver la receta creada como recurso API con código de estado 201 (creado) 
        return response()->json(new DestinoResource($destino), Response::HTTP_CREATED); 
    }

    // Actualiza una receta existente
    public function update(UpdateDestinoRequest $request, Destinos $destino){  // Usar la request UpdateRecetasRequest para validar los datos
        $this->authorize('Editar destinos');

        $this->authorize('update', $destino);  // Autorizar la acción usando la política RecetaPolicy
        
        $destino->update($request->all());  // Actualizar la receta con los datos validados

        if($etiquetas = json_decode($request->etiquetas)){  // Si se reciben etiquetas, decodificar el JSON
            $destino->etiquetas()->sync($etiquetas);  // Sincronizar las etiquetas (eliminar las que no están y agregar las nuevas)
        }

        if($request->file('imagen')){  // Si se recibe una imagen
            $destino->imagen = $request->file('imagen')->store('destinos','public');  // Almacenar la imagen en el disco 'public' dentro de la carpeta 'recetas'
            $destino->save(); // Guardar la receta con la ruta de la imagen
        }
        

        // Devolver la receta actualizada como recurso API con código de estado 200 (OK)
        return response()->json(new DestinoResource($destino), Response::HTTP_OK);
    }

    // Elimina una receta existente
    public function destroy(Destinos $destino){  // Inyectar la receta a eliminar
        $this->authorize('Eliminar destinos');
        
        $this->authorize('delete', $destino);  // Autorizar la acción usando la política RecetaPolicy
        
        $destino->delete();  // Eliminar la receta

        // Devolver una respuesta vacía con código de estado 204 (No Content)
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}