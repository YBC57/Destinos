<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ComentarioCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
                return $this->collection->map(function ($comentario) {  // Mapear cada comentarios 
            return [
                'id' => $comentario->id,
                'tipo' => 'categoria',
                'atributos' => [
                    'nombre' => $comentario->nombre,
                ],
            ];
        })->toArray(); // Convertir la colección mapeada a un array
    
    }
}
