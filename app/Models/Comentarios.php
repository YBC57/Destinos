<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    /** @use HasFactory<\Database\Factories\ComentariosFactory> */
    use HasFactory;
    protected $fillable= [ //Campos que se pueden asignar masivamente
        'comentario',
        'puntuacion',
    ];
    // Relación 1:N (Una etiqueta tiene muchas recetas)
    public function comentarios(){
        return $this->belongsToMany(Comentarios::class);
    }
}
