<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Contáctanos - Te Apoyamos SAS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Te Apoyamos SAS</a> <!-- href con futuro link a Home -->
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#">Servicios</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Quienes somos</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Alianzas</a></li>
          <li class="nav-item"><a class="nav-link active" href="#">Contacto</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Trabaja con nosotros</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <div class="container mt-5">
    <div class="row g-5">
      <!-- Izquierda: info de contacto -->
      <div class="col-md-5">
        <h1>Información de contacto</h1>
        <div class="card p-3">
          <p>Teléfono: 0000000001</p>
          <p>Correo: TeApoyamosSaS@gmail.com</p>
          <p>Ubicación: Bogotá, calle 1, centro</p>
          <p>Horario atención presencial:</p>
          <p>Lunes - Viernes: 8:00 am - 6:00 pm</p>
          <p>Fin de semana y festivos: 10:00 am - 2:00 pm</p>
          <p>Horario atención telefónica:</p>
          <p>Lunes - Viernes: 8:00 am - 6:00 pm</p>
          <p>Fin de semana: 10:00 am - 2:00 pm</p>
        </div>
      </div>

      <!-- Derecha: formulario -->
      <div class="col-md-6">
        <h1>Contáctanos</h1>

        <!-- Mensaje de éxito -->
        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif

        <!-- Mensajes de error -->
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <!-- Formulario -->
        <form action="{{ route('contacto.send') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" name="correo" class="form-control" id="correo"
              value="{{ old('correo') }}" required>
          </div>

          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre"
              value="{{ old('nombre') }}" required>
          </div>


          <div class="mb-3">
            <label for="mensaje" class="form-label">Solicitud</label>
            <textarea name="mensaje" class="form-control" id="mensaje" rows="5" required>{{ old('mensaje') }}</textarea>
          </div>

          <div class="form-check mb-3">
            <input type="checkbox" name="politicas" class="form-check-input" id="acepto"
              {{ old('politicas') ? 'checked' : '' }} required>
            <label class="form-check-label" for="acepto">Acepto las políticas</label>
          </div>

          <button type="submit" class="btn btn-primary d-block mx-auto">Enviar</button>
        </form>

      </div>
    </div>
  </div>

  <footer class="bg-dark text-white text-center py-3 mt-5 fixed-bottom">
    <p class="mb-0">&copy; 2025 Te Apoyamos SAS. Todos los derechos reservados.</p>
  </footer>

</body>

</html>