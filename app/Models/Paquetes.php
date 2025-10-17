<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquetes extends Model
{
    /** @use HasFactory<\Database\Factories\PaquetesFactory> */
    use HasFactory;
    // // Relación N:N
    public function paquete(){
        return $this->belongsToMany(Paquetes::class);
        }
}
