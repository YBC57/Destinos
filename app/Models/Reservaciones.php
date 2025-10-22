<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservaciones extends Model
{
    /** @use HasFactory<\Database\Factories\ReservacionesFactory> */
    use HasFactory;

    protected $fillable= [ //Campos que se pueden asignar masivamente
        'cantidad',
        'fecha_reserva',
        'estado',
        'total',
    ];

    // Relación N:N
    public function rervacion(){
        return $this->belongsToMany(Reservaciones::class);
    }
}
