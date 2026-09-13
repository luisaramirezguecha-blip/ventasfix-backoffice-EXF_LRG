<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario - VentasFix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Editar Usuario</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
        @csrf
        @method('PUT')

        <label>RUT:</label><br>
        <input type="text" name="rut" value="{{ old('rut', $usuario->rut) }}"><br><br>

        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}"><br><br>

        <label>Apellido:</label><br>
        <input type="text" name="apellido" value="{{ old('apellido', $usuario->apellido) }}"><br><br>

        <label>Email (debe terminar en @ventasfix.cl):</label><br>
        <input type="email" name="email" value="{{ old('email', $usuario->email) }}"><br><br>

        <label>Nueva contraseña (dejar vacío para no cambiarla):</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <a href="{{ route('usuarios.index') }}">Volver al listado</a>
</body>
</html>