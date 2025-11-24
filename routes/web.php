<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactanosController; // Controlador Público de Contacto
use App\Http\Controllers\Auth\LoginController; // Controlador de Autenticación
use App\Http\Controllers\Admin\AdminSolicitudesController; // Controlador del Panel Admin

Route::get('/', function () {
    return redirect()->route('login');
})->name('inic'); 

// Ruta para mostrar el formulario de contacto
Route::get('/contacto', [ContactanosController::class, 'index'])->name('contacto.form'); 

// Ruta para procesar el envío del formulario de contacto (POST)
Route::post('/contacto', [ContactanosController::class, 'store'])->name('contacto.send');


// Muestra el formulario de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Procesa el inicio de sesión
Route::post('/login', [LoginController::class, 'login']);
// Procesa el cierre de sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');





Route::middleware(['auth'])->group(function () {

    // Redirige al dashboard después de iniciar sesión al listado de solicitudes
    // Este nombre de ruta 'dashboard' es el que se usa en LoginController.php
    Route::get('/dashboard', function () {
        return redirect()->route('admin.solicitudes.index');
    })->name('dashboard');

    // rutas al servicio al cliente
    // Se usa el middleware 'role:servicio-cliente' para restringir el acceso.
    Route::middleware(['role:servicio-cliente'])->prefix('admin/solicitudes')->name('admin.solicitudes.')->group(function ()
    { 
        Route::get('/', [AdminSolicitudesController::class, 'index'])->name('index'); 

        Route::get('/{solicitud}', [AdminSolicitudesController::class, 'show'])->name('show');

        Route::post('/{solicitud}/responder', [AdminSolicitudesController::class, 'responder'])->name('responder');
    });

});