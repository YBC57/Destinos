<?php

namespace App\Policies;

use App\Models\User;  // Importar el modelo User
use App\Models\Destinos;  // Importar el modelo Destinos

class Destinospolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    
    // Determinar si el usuario puede actualizar la destinos
    public function update(User $user, Destinos $destino)
    {
        return $user->id === $destino->user_id;
    }

    // Determinar si el usuario puede eliminar la destinos
    public function delete(User $user, Destinos $destino)
    {
        return $user->id === $destino->user_id;
    }
}
