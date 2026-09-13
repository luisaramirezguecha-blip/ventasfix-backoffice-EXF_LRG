<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Usuario - VentasFix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Detalle del Usuario</h1>

    <p><strong>RUT:</strong> {{ $usuario->rut }}</p>
    <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
    <p><strong>Apellido:</strong> {{ $usuario->apellido }}</p>
    <p><strong>Email:</strong> {{ $usuario->email }}</p>

    <a href="{{ route('usuarios.index') }}">Volver al listado</a>
</body>
</html>