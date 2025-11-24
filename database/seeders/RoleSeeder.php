<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Corre el seeder para llenar la tabla de roles con datos iniciales.
     */
    public function run(): void
    {
        // 1. Rol de Servicio al Cliente 
        DB::table('roles')->insert([
            'nombre' => 'Servicio al Cliente',
            'slug' => 'servicio-cliente', // Usamos este SLUG para los permisos en el Controlador
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Otros Roles
        DB::table('roles')->insert([
            'nombre' => 'Abogado de la Firma',
            'slug' => 'abogado',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('roles')->insert([
            'nombre' => 'Admin de Contenido',
            'slug' => 'admin-contenido',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('roles')->insert([
        'nombre' => 'Evaluador postulaciones',
        'slug' => 'evaluador',
        'created_at' => now(),
        'updated_at' => now(),
        ]);
    }
}