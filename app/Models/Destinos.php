<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinos extends Model
{
    /** @use HasFactory<\Database\Factories\DestinosFactory> */
    use HasFactory;

protected $fillable= [ //Campos que se pueden asignar masivamente
    'categoria_id',
        // 'user_id',  // Se asigna automáticamente en el controlador con el usuario logueado 
        'nombre',
        'descripcion',
        'ubicacion',
        'precio',
        'fecha_inicio',
        'fecha_fin',
    ];

    // Una receta puede tener muchas etiquetas y una etiqueta puede tener muchas recetas
    public function destinos(){
        return $this->belongsToMany(Destinos::class);
    }
}
