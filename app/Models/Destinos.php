<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinos extends Model
{
    /** @use HasFactory<\Database\Factories\DestinosFactory> */
    use HasFactory;

protected $fillable= [ //Campos que se pueden asignar masivamente
    'user_id',// Se asigna automáticamente en el controlador con el usuario logueado 
    'categoria_id',
        'nombre',
        'descripcion',
        'precio',
        'fecha_inicio',
        'imagen',
    ];

    // Una destino puede tener muchas reservaciones y una reservacion puede tener muchas destinos
    //public function destinos(){
        //return $this->belongsToMany(Destinos::class);
   // }

    // Una destino puede tener muchas reservaciones y una reservacion puede tener muchas destinos
    public function categoria(){
        return $this->belongsTo(Categorias::class);
 
    }

    // Una destino pertenece a un usuario
    public function user() {
        return $this->belongsTo(User::class);
    }
}
