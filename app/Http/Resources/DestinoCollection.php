<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DestinoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
        parent::toArray($request);
                return $this->collection->map(function ($categoria) {  // Mapear cada categoria en la colección y estructurarla
            return [
                'id' => $categoria->id,
                'tipo' => 'categoria',
                'atributos' => [
                    'nombre' => $categoria->nombre,
                    'descripcion' => $categoria->descripcion,
                ],
            ];
        })->toArray(); // Convertir la colección mapeada a un array
    }
}
