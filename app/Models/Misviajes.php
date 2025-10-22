<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Misviajes extends Model
{
    /** @use HasFactory<\Database\Factories\MisviajesFactory> */
    use HasFactory;
    protected $fillable= [ //Campos que se pueden asignar masivamente
        'precio',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];
    public function misviajes(){
        return $this->belongsToMany(misviajes::class);
    }
}
