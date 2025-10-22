<?php

namespace App\Http\Resources;

use App\Models\Misviajes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MisviajesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
                return $this->collection->map(function ($Misviajes) {  // Mapear cada categoria en la colección y estructurarla
            return [
                'id' => $Misviajes->id,
                'tipo' => 'categoria',
                'atributos' => [
                    'nombre' => $Misviajes->nombre,
                ],
            ];
        })->toArray(); // Convertir la colección mapeada a un array
    
    }
}

