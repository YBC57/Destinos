<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriasFactory> */
    use HasFactory;
protected $fillable= [ //Campos que se pueden asignar masivamente
        'nombre',
    ];

    // Una Categoria puede tener muchos Destinos y un Destinos puede tener muchas Categorias
    public function destino(){
        return $this->belongsToMany(Categorias::class);
    }
}
