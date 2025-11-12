<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;  // Importar el modelo Role
use Spatie\Permission\Models\Permission;  // Importar el modelo Permission

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         /*
        Administrador -> CRUD
        Editor -> CRU
        Usuario -> R
        */


        $administrador = Role::create(['name' => 'Administrador']);
        $editor = Role::create(['name' => 'Editor']);
        $usuario = Role::create(['name' => 'Usuario']);


        Permission::create(['name' => 'Crear destinos'])->syncRoles([$administrador, $editor]);
        Permission::create(['name' => 'Editar destinos'])->syncRoles([$administrador, $editor]);
        Permission::create(['name' => 'Eliminar destinos'])->syncRoles([$administrador]);
        Permission::create(['name' => 'Ver destinos'])->syncRoles([$administrador, $editor, $usuario]);
    }
}