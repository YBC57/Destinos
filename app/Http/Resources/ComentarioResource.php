<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComentarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
           return [
            'id' => $this->id,  // ID de la Comentario
            'tipo' => 'categoria', 
            'atributos' => [  // Estructuramos los atributos de la comenatrio
                'nombre' => $this->nombre
            ],
        ];
    }
}
