<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones (crear tablas).
     */
    public function up(): void
    {
        Schema::create('solicitudes_contacto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('correo'); // El correo del cliente que contacta
            // ELIMINADO: $table->string('asunto', 255); // Ya que el formulario no lo envía
            $table->text('mensaje'); // Este campo lleva el contenido de la solicitud
            
            // Campo para gestionar el estado de la solicitud
            $table->string('estado', 20)->default('Pendiente');
            
            // Campo opcional para registrar qué empleado está manejando la solicitud
            // Es nullable() porque al inicio nadie la ha tomado.
            $table->foreignId('atendido_por')
                  ->nullable()
                  ->constrained('users') // Apunta a la tabla de empleados (users)
                  ->onDelete('set null'); // Si el empleado es borrado, la solicitud queda sin asignar
                  
            // Campo para la respuesta interna/resumen del Servicio al Cliente
            $table->longText('respuesta_admin')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones (borrar tablas).
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_contacto');
    }
};