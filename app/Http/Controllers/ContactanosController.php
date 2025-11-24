<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudContacto; // Importamos el Modelo

class ContactanosController extends Controller
{
    
    // Muestra el formulario de contacto.
    
    public function index()
    {
        
        return view('contacto');
    }

    public function store(Request $request)
    {
        // Validaciones
        $datosValidados = $request->validate([
            'correo' => 'required|email|max:255',
            'nombre' => 'required|string|max:100',
            'mensaje' => 'required|string',
            'politicas' => 'accepted', 
        ], [
            // Mensajes de error personalizados
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Por favor, ingrese un formato de correo electrónico válido.',
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'mensaje.required' => 'Por favor, escriba el contenido de su solicitud.',
            'politicas.accepted' => 'Debe aceptar las políticas de privacidad para continuar.',
        ]);

        // Lógica de negocio 
        try {
            SolicitudContacto::create($datosValidados);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Hubo un error al registrar su solicitud. Intente de nuevo más tarde.');
        }

        // Redirección
        return redirect()
            ->route('contacto.form')
            ->with('success', '¡Gracias por contactarnos, ' . $request->nombre . '! Su solicitud ha sido enviada con éxito.');
    }
}
