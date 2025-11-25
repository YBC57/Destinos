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
/**
 * @OA\Get(
 *     path="/api/destinos",
 *     summary="Obtener todos los destinos",
 *     tags={"Destinos"},
 *     security={{"bearer_token":{}}},
 *    @OA\Response(
 *       response=200,
 *       description="Operación exitosa",
 *    ),
 *    @OA\Response(
 *       response=403,
 *       description="No autorizado"
 *    ),
 *    @OA\Response(
 *       response=404,
 *       description="No se encontraron destinos"
 *    ),
 *    @OA\Response(
 *       response=405,
 *       description="Método no permitido"
 *    )
 * )
 */
    // Muestra todos los destinos
    public function index(){
        $this->authorize('Ver destinos');  
        $destinos = Destinos::with('categoria', 'user')->get();
        return DestinoResource::collection($destinos); // Devuelve todas las recetas como recurso API
    }
/**
 * @OA\Get(
 * path="/api/destinos/{id}",
 * summary="Obtener una destino por ID",
 * tags={"Destinos"},
 * security={{"bearer_token": {}}},
 * @OA\Parameter(
 * name="id",
 * in="path",
 * required=true,
 * description="ID del destino a recuperar.",
 * @OA\Schema(type="integer")
 * ),
 * @OA\Response(response=200, description="Destino encontrado."),
 * @OA\Response(response=404, description="Destino no encontrado.")
 * )
 */
    // Muestra un destino a partir de su id
    public function show(Destinos $destino){
        $this->authorize('Ver destinos');  
        $destino = $destino->load('categoria', 'user');
        return new DestinoResource($destino); // Devuelve la receta como recurso API 
    }
/**
 * @OA\Post(
 * path="/api/destinos",
 * summary="Crear un nuevo destino",
 * tags={"Destinos"},
 * security={{"bearer_token": {}}},
 * @OA\RequestBody(
 * required=true,
 * description="Datos de la nueva receta.",
 * @OA\MediaType(
 * mediaType="multipart/form-data",
 * @OA\Schema(
 * required={"categoria_id", "nombre", "descripcion", "precio", "fecha_inicio"},
 * @OA\Property(property="categoria_id", type="integer", example=1, description="ID de la categoría."),
 * @OA\Property(property="nombre", type="string", example="Destino de Tacos al Pastor"),
 * @OA\Property(property="descripcion", type="string", example="Descripción del destino."),
 * @OA\Property(property="precio", type="string", example="Lista de precio."),
 * @OA\Property(property="fecha_inicio", type="string", example="Pasos de preparación."),
 * @OA\Property(property="imagen", type="string", format="binary"),
 * )
 * )
 * ),
 * @OA\Response(response=201, description="Destino creado exitosamente."),
 * @OA\Response(response=400, description="Solicitud inválida."),
 * @OA\Response(response=403, description="No autorizado.")
 * )
 */
    // Almacena una nueva receta 
    public function store(StoreDestinoRequest $request){  // Usar la request StoreRecetasRequest para validar los datos
        $this->authorize('Crear destinos');  
       
        $destino = $request->user()->destinos()->create($request->all());  // Crear una nueva receta asociada al usuario autenticado
        //$destino->etiquetas()->attach(json_decode($request->etiquetas));  // Asociar las etiquetas a la receta (decodificar el JSON recibido)

        $destino->imagen = $request->file('imagen')->store('destinos','public'); // Almacenar la imagen en el disco 'public' dentro de la carpeta 'recetas'
        $destino->save(); // Guardar la receta con la ruta de la imagen
 
        // Devolver la receta creada como recurso API con código de estado 201 (creado) 
        return response()->json(new DestinoResource($destino), Response::HTTP_CREATED); 
    }
    /**
 * @OA\Put(
 *     path="/api/destinos/{destino}",
 *     summary="Actualizar destino",
 *     tags={"Destinos"},
 *     security={{"bearer_token":{}}},
 *
 *     @OA\Parameter(
 *        name="destino",
 *        in="path",
 *        required=true,
 *        @OA\Schema(type="integer")
 *     ),
 *
 *     @OA\RequestBody(
 *        required=true,
 *        @OA\MediaType(
 *           mediaType="multipart/form-data",
 *           @OA\Schema(
 *              @OA\Property(property="categoria_id", type="integer"),
 *              @OA\Property(property="nombre", type="string"),
 *              @OA\Property(property="descripcion", type="string"),
 *              @OA\Property(property="precio", type="string"),
 *              @OA\Property(property="fecha_inicio", type="string"),
 *              @OA\Property(property="imagen", type="string", format="binary"),        
 *           )
 *        )
 *     ),
 *
 *     @OA\Response(response=200, description="Destino actualizada"),
 *     @OA\Response(response=403, description="No autorizado"),
 *     @OA\Response(response=404, description="Destino no encontrada")
 * )
 */

    // Actualiza una destino existente
    public function update(UpdateDestinoRequest $request, Destinos $destino){  // Usar la request UpdateRecetasRequest para validar los datos
        $this->authorize('Editar destinos');

        $this->authorize('update', $destino);  // Autorizar la acción usando la política RecetaPolicy
        
        $destino->update($request->all());  // Actualizar la receta con los datos validados

        //if($etiquetas = json_decode($request->etiquetas)){  // Si se reciben etiquetas, decodificar el JSON
            //$destino->etiquetas()->sync($etiquetas);  // Sincronizar las etiquetas (eliminar las que no están y agregar las nuevas)
        //}

        if($request->file('imagen')){  // Si se recibe una imagen
            $destino->imagen = $request->file('imagen')->store('destinos','public');  // Almacenar la imagen en el disco 'public' dentro de la carpeta 'recetas'
            $destino->save(); // Guardar la receta con la ruta de la imagen
        }
        

        // Devolver la receta actualizada como recurso API con código de estado 200 (OK)
        return response()->json(new DestinoResource($destino), Response::HTTP_OK);
    }

/**
 * @OA\Delete(
 *     path="/api/destinos/{destino}",
 *     summary="Eliminar destino",
 *     tags={"Destinos"},
 *     security={{"bearer_token":{}}},
 *
 *     @OA\Parameter(
 *        name="destino",
 *        in="path",
 *        required=true,
 *        @OA\Schema(type="integer")
 *     ),
 *
 *     @OA\Response(response=204, description="Destino eliminado"),
 *     @OA\Response(response=403, description="No autorizado"),
 *     @OA\Response(response=404, description="Destino no encontrado")
 * )
 */

    // Elimina una receta existente
    public function destroy(Destinos $destino){  // Inyectar la receta a eliminar
        $this->authorize('Eliminar destinos');
        
        $this->authorize('delete', $destino);  // Autorizar la acción usando la política RecetaPolicy
        
        $destino->delete();  // Eliminar la receta

        // Devolver una respuesta vacía con código de estado 204 (No Content)
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}