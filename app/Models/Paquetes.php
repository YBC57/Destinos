<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquetes extends Model
{
    /** @use HasFactory<\Database\Factories\PaquetesFactory> */
    use HasFactory;
    protected $fillable= [ //Campos que se pueden asignar masivamente
        'nombre',
        'descripcion',
        'precio',
        'fecha_inicio',
        'fecha_fin',
    ];

    // // Relación N:N
    public function paquete(){
        return $this->belongsToMany(Paquetes::class);
        }
}
