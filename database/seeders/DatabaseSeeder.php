<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Llamar al Seeder de Roles primero, porque los Usuarios dependen de ellos.
        $this->call(RoleSeeder::class);
        
        // 2. Llamar al Seeder de Usuarios para precargar los empleados.
        $this->call(UserSeeder::class);
        
        
    }
}
