<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Crear cuenta</h4>
                </div>

                <div class="card-body">
                    <!-- Usamos el nombre de la ruta para mayor seguridad -->
                    <form action="{{ route('register.store') }}" method="POST"> 
                        @csrf 

                        <!-- Campo Nombre (name="nombre") -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <!-- ¡CORRECCIÓN CLAVE! El 'name' del input ahora es 'nombre' -->
                            <input type="text" id="nombre" name="nombre" 
                                   class="form-control @error('nombre') is-invalid @enderror" 
                                   value="{{ old('nombre') }}" 
                                   required autofocus>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Correo (name="correo") -->
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <!-- ¡CORRECCIÓN CLAVE! El 'name' del input ahora es 'correo' -->
                            <input type="email" id="correo" name="correo" 
                                   class="form-control @error('correo') is-invalid @enderror" 
                                   value="{{ old('correo') }}" 
                                   required>
                            @error('correo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" name="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Confirmar Contraseña -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                   class="form-control" 
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Registrarme</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>