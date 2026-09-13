<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes - VentasFix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Nuevo Cliente</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('clientes.create') }}">+ Nuevo Cliente</a>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>RUT Empresa</th>
                <th>Razón Social</th>
                <th>Rubro</th>
                <th>Teléfono</th>
                <th>Contacto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->rut_empresa }}</td>
                    <td>{{ $cliente->razon_social }}</td>
                    <td>{{ $cliente->rubro }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->nombre_contacto }}</td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente) }}">Ver</a>
                        <a href="{{ route('clientes.edit', $cliente) }}">Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>