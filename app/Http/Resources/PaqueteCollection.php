<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PaqueteCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
                return $this->collection->map(function ($paquete) {  // Mapear cada categoria en la colección y estructurarla
            return [
                'id' => $paquete->id,
                'tipo' => 'categoria',
                'atributos' => [
                    'nombre' => $paquete->nombre,
                ],
            ];
        })->toArray(); // Convertir la colección mapeada a un array
    
    }
}
