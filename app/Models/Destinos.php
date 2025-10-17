<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinos extends Model
{
    /** @use HasFactory<\Database\Factories\DestinosFactory> */
    use HasFactory;
    // Una receta puede tener muchas etiquetas y una etiqueta puede tener muchas recetas
    public function destinos(){
        return $this->belongsToMany(Destinos::class);
    }
}
