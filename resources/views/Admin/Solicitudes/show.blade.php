<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud #{{ $solicitud->id }} | Responder</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f9fb;
        }
    </style>
</head>
<body>

    <header class="bg-white shadow-md sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-indigo-700">
                Panel de Servicio al Cliente
            </h1>
            <a href="{{ route('admin.solicitudes.index') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition duration-150">
                ← Volver a Pendientes
            </a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <h2 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">
            Detalle de Solicitud #{{ $solicitud->id }}
        </h2>

        <div class="space-y-8">
            
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">
                    Datos del Cliente
                </h3>
                <dl class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                    <div class="col-span-2 sm:col-span-1">
                        <dt class="font-medium text-gray-500">Nombre:</dt>
                        <dd class="mt-1 text-gray-900">{{ $solicitud->nombre }}</dd>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <dt class="font-medium text-gray-500">Correo:</dt>
                        <dd class="mt-1 text-indigo-600 font-mono">{{ $solicitud->correo }}</dd>
                    </div>
                    <div class="col-span-2">
                        <dt class="font-medium text-gray-500">Recibido:</dt>
                        <dd class="mt-1 text-gray-900">{{ $solicitud->created_at->format('d/M/Y H:i:s') }}</dd>
                    </div>
                    <div class="col-span-2">
                        <dt class="font-medium text-gray-500">Estado:</dt>
                        <dd class="mt-1 font-bold @if($solicitud->estado === 'Pendiente') text-red-600 @else text-green-600 @endif">
                            {{ $solicitud->estado }}
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="bg-indigo-50 p-6 rounded-xl shadow-inner border border-indigo-200">
                <h3 class="text-xl font-semibold text-indigo-700 mb-4 pb-2 border-b border-indigo-200">
                    Mensaje del Cliente
                </h3>
                <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">
                    {{ $solicitud->mensaje }}
                </p>
            </div>

            @if ($solicitud->estado === 'Pendiente')
                <div class="bg-white p-6 rounded-xl shadow-lg border border-yellow-300">
                    <h3 class="text-xl font-semibold text-yellow-800 mb-4 pb-2 border-b">
                        Responder y Completar Solicitud
                    </h3>
                    
                    <form method="POST" action="{{ route('admin.solicitudes.responder', $solicitud->id) }}" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label for="respuesta_admin" class="block text-sm font-medium text-gray-700 mb-1">
                                Respuesta Interna / Resumen de Gestión (Obligatorio)
                            </label>
                            <textarea id="respuesta_admin" name="respuesta_admin" rows="6" required 
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                                      placeholder="Detalles sobre cómo se gestionó o respondió la solicitud. Esta información se guarda en la base de datos.">{{ old('respuesta_admin') }}</textarea>
                            
                            @error('respuesta_admin')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <button type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-medium text-white 
                                       bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 
                                       transition duration-150 transform hover:scale-[1.01]">
                            Marcar como Completada y Registrar Respuesta
                        </button>
                    </form>
                </div>
            @else
            
                <div class="bg-green-50 p-6 rounded-xl shadow-lg border border-green-300">
                    <h3 class="text-xl font-semibold text-green-700 mb-4 pb-2 border-b">
                        Solicitud Completada
                    </h3>
                    <p class="text-sm text-gray-600 mb-3">
                        Atendido por: 
                        <span class="font-bold">{{ $solicitud->atendidoPor->nombre ?? 'N/A' }}</span> el 
                        <span class="font-bold">{{ $solicitud->updated_at->format('d/M/Y H:i:s') }}</span>
                    </p>
                    <div class="bg-white p-4 rounded-lg border border-gray-200">
                        <p class="font-medium text-gray-500 mb-1">Respuesta/Gestión Registrada:</p>
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $solicitud->respuesta_admin }}</p>
                    </div>
                </div>
            @endif

        </div>
        
    </main>

</body>
</html>