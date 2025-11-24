<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SolicitudContacto;
use Illuminate\Support\Facades\Auth;

class AdminSolicitudesController extends Controller
{
    //muestra solicitudes
    public function index()
    {
        // Se ordena por fecha de creación (las más nuevas primero) y se pagina
        $solicitudes = SolicitudContacto::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.solicitudes.index', compact('solicitudes'));
    }

    //muestra detalles
    public function show(SolicitudContacto $solicitud)
    {
        // El 'SolicitudContacto $solicitud' hace la inyección de modelo automáticamente.
        return view('admin.solicitudes.show', compact('solicitud'));
    }

    //respuesta
    public function responder(Request $request, SolicitudContacto $solicitud)
    {
        //validaciones
        $request->validate([
            'respuesta_texto' => 'required|string|min:10',
        ], [
            'respuesta_texto.required' => 'El campo de respuesta no puede estar vacío.',
            'respuesta_texto.min' => 'La respuesta debe tener al menos 10 caracteres.',
        ]);

        //actualizar en base de datos
        try {
            // Utilizamos los nombres de columna de la base de datos
            $solicitud->respuesta_admin = $request->input('respuesta_texto'); // Guardar el texto de la respuesta
            $solicitud->estado = 'Completada'; // Cambiar estado

            //ID usuario
            $solicitud->atendido_por = Auth::id();

            $solicitud->fecha_respuesta = now();
            $solicitud->save();



            return redirect()->route('admin.solicitudes.index')
                ->with('success', 'La solicitud de ' . $solicitud->nombre . ' ha sido respondida y marcada como Completada.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar guardar la respuesta: ' . $e->getMessage());
        }
    }
}
