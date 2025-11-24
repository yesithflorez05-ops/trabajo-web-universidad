<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cliente; // Asegúrate de que este es el nombre de tu modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

/**
 * Controlador para manejar el registro de nuevos clientes.
 */
class RegisterClienteController extends Controller
{
    /**
     * Muestra el formulario de registro de clientes.
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        // Esto carga la vista resources/views/auth/register.blade.php
        return view('auth.register');
    }

    /**
     * Maneja la solicitud de registro de un nuevo cliente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // 1. Validar los datos de entrada
        $request->validate([
            // Usamos 'name' y 'email' como en el formulario Blade
            'name' => ['required', 'string', 'max:255'],
            // La validación 'unique:clientes,email' verifica que el correo no exista en la tabla 'clientes'
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clientes,email'],
            'password' => ['required', 'confirmed', Password::defaults()], // 'confirmed' verifica 'password_confirmation'
        ], [
            // Mensajes de error personalizados (opcional)
            'name.required' => 'El nombre es obligatorio.',
            'email.unique' => 'Este correo ya está registrado.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        // 2. Crear el nuevo cliente
        $cliente = Cliente::create([
            // Usamos 'name' y 'email' en el modelo
            'name' => $request->name, 
            'email' => $request->email,
            'password' => $request->password, // El mutator en el modelo lo hashea
        ]);

        // 3. Autenticar al cliente
        // Utilizamos el guard 'web' o el guard específico para clientes si lo tienes
        Auth::login($cliente); 

        // 4. Redirigir al cliente a la página deseada después del registro
        return redirect()->intended('/home');
    }
}