<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Esta migración crea la tabla 'roles' con el nombre y el slug
return new class extends Migration
{
    /**
     * Ejecuta las migraciones (crear la tabla roles).
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            // Nombre descriptivo del rol (Admin, Abogado, Servicio al Cliente)
            $table->string('nombre', 50)->unique(); 
            // Slug para usar en el código (admin, abogado, servicio-cliente)
            $table->string('slug', 50)->unique(); 
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones (borrar la tabla roles).
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};