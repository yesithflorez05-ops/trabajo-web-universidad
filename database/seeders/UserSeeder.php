<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role; // Importamos el Modelo Role para buscar los IDs

class UserSeeder extends Seeder
{
    /**
     * Corre el seeder para llenar la tabla de usuarios con empleados iniciales.
     */
    public function run(): void
    {
        $rolServicioCliente = Role::where('slug', 'servicio-cliente')->first();
        $rolAbogado = Role::where('slug', 'abogado')->first();
        $rolAdmin = Role::where('slug', 'admin-contenido')->first();

        if (!$rolServicioCliente || !$rolAbogado || !$rolAdmin) {
            echo "ADVERTENCIA: No se encontraron los roles. Asegúrate de correr RoleSeeder primero.\n";
            return;
        }

        // 2. Insertamos a los empleados con su rol_id correspondiente.
        
        // EMPLEADO 1: Servicio al Cliente (el que va a usar el dashboard)
        DB::table('users')->insert([
            'role_id' => $rolServicioCliente->id,
            'nombre' => 'Ana Gestion',
            'correo' => 'ana.servicio@firma.com',
            // La contraseña será 'password' 
            'password' => Hash::make('password'), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // EMPLEADO 2: Abogado
        DB::table('users')->insert([
            'role_id' => $rolAbogado->id,
            'nombre' => 'Carlos Ley',
            'correo' => 'carlos.abogado@firma.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // EMPLEADO 3: Admin de Contenido 
        DB::table('users')->insert([
            'role_id' => $rolAdmin->id,
            'nombre' => 'Erica Contenido',
            'correo' => 'erica.admin@firma.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}