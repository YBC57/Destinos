<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReservacionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
   {
        return parent::toArray($request);
                return $this->collection->map(function ($reservacion) {  // Mapear cada categoria en la colección y estructurarla
            return [
                'id' => $reservacion->id,
                'tipo' => 'categoria',
                'atributos' => [
                    'nombre' => $reservacion->nombre,
                ],
            ];
        })->toArray(); // Convertir la colección mapeada a un array
    
    }
}
