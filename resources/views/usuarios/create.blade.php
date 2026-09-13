<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Usuario - VentasFix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Nuevo Usuario</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf

        <label>RUT:</label><br>
        <input type="text" name="rut" value="{{ old('rut') }}"><br><br>

        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="{{ old('nombre') }}"><br><br>

        <label>Apellido:</label><br>
        <input type="text" name="apellido" value="{{ old('apellido') }}"><br><br>

        <label>Email (debe terminar en @ventasfix.cl):</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Guardar</button>
    </form>

    <a href="{{ route('usuarios.index') }}">Volver al listado</a>
</body>
</html>