<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// **CRUCIAL:** EL NOMBRE DEL ARCHIVO DEBE INDICAR QUE ES UNA ACTUALIZACIÓN.
// El contenido debe usar Schema::table, no Schema::create.
return new class extends Migration
{
    /**
     * Ejecuta las migraciones (añadir columna a la tabla users).
     */
    public function up(): void
    {
        // Usamos Schema::table para MODIFICAR la tabla 'users' que ya existe
        Schema::table('users', function (Blueprint $table) {
            
            // La columna 'nombre' ya existe, pero la columna 'role_id' no.
            // La definimos como NOT NULL porque todos los empleados DEBEN tener un rol
            $table->foreignId('role_id')
                  ->after('id') // Se añade después del ID
                  ->constrained('roles') // Asegura que el ID exista en la tabla 'roles'
                  ->onDelete('restrict'); 
        });
    }

    /**
     * Revierte las migraciones (borrar la columna).
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             // Es crucial borrar primero la clave foránea antes de la columna
             $table->dropForeign(['role_id']);
             $table->dropColumn('role_id');
        });
    }
};