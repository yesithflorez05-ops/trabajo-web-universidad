<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso de Empleados | Firma Legal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-6 bg-white rounded-xl shadow-2xl space-y-6 transform transition duration-500 hover:scale-[1.01]">
        
        <h2 class="text-3xl font-extrabold text-center text-gray-900 border-b pb-4 mb-4">
            Acceso de Empleados
        </h2>
        
        <p class="text-center text-sm text-gray-600 mb-6">
            Ingresa tus credenciales para acceder al panel de Servicio al Cliente.
        </p>

        <form method="POST" action="/login" class="space-y-6">
            @csrf 

            <div>
                <label for="correo" class="block text-sm font-medium text-gray-700 mb-1">
                    Correo Electrónico
                </label>
                <input id="correo" name="correo" type="email" autocomplete="email" required 
                        value="{{ old('correo') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    Contraseña
                </label>
                <input id="password" name="password" type="password" autocomplete="current-password" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
            </div>
            
            @error('correo')
                <div class="p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg mt-4" role="alert">
                    <p class="font-bold">Error de Credenciales</p>
                    <p class="text-sm">{{ $message }}</p>
                </div>
            @enderror

            <div>
                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-medium text-white 
                                bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 
                                transition duration-150 transform hover:scale-[1.02]">
                    Iniciar Sesión
                </button>
            </div>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-xs text-gray-500">
                Solo personal autorizado de la firma.
            </p>
        </div>
    </div>

</body>
</html>