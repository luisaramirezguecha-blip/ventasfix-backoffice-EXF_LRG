<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - VentasFix</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Bienvenido, {{ auth()->user()->nombre }} {{ auth()->user()->apellido }}</p>

    <table border="1" cellpadding="8">
        <tr>
            <td><strong>Usuarios registrados</strong></td>
            <td>{{ $totalUsuarios }}</td>
        </tr>
        <tr>
            <td><strong>Productos registrados</strong></td>
            <td>{{ $totalProductos }}</td>
        </tr>
        <tr>
            <td><strong>Clientes registrados</strong></td>
            <td>{{ $totalClientes }}</td>
        </tr>
    </table>

    <br>

    <ul>
        <li><a href="{{ route('productos.index') }}">Productos</a></li>
        <li><a href="{{ route('clientes.index') }}">Clientes</a></li>
        <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
    </ul>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
</body>
</html>