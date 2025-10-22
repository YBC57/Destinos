<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
        return [
                'id' => $categoria->id,
                'tipo' => 'categoria',
                'atributos' => [
                    'nombre' => $categoria->nombre,
                    'descripcion' => $categoria->descripcion,
                ],
            ];
    }
}
