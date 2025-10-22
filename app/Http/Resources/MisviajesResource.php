<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MisviajesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,  // ID de la categoria
            'tipo' => 'categoria', 
            'atributos' => [  // Estructuramos los atributos de la categoria
                'nombre' => $this->nombre
            ],
        ];
    }
}
