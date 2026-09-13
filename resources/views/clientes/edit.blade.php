<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente - VentasFix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Editar Cliente</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
        @csrf
        @method('PUT')

        <label>RUT Empresa:</label><br>
        <input type="text" name="rut_empresa" value="{{ old('rut_empresa', $cliente->rut_empresa) }}"><br><br>

        <label>Rubro:</label><br>
        <input type="text" name="rubro" value="{{ old('rubro', $cliente->rubro) }}"><br><br>

        <label>Razón Social:</label><br>
        <input type="text" name="razon_social" value="{{ old('razon_social', $cliente->razon_social) }}"><br><br>

        <label>Teléfono:</label><br>
        <input type="text" name="telefono" value="{{ old('telefono', $cliente->telefono) }}"><br><br>

        <label>Dirección:</label><br>
        <input type="text" name="direccion" value="{{ old('direccion', $cliente->direccion) }}"><br><br>

        <label>Nombre de contacto:</label><br>
        <input type="text" name="nombre_contacto" value="{{ old('nombre_contacto', $cliente->nombre_contacto) }}"><br><br>

        <label>Email de contacto:</label><br>
        <input type="email" name="email_contacto" value="{{ old('email_contacto', $cliente->email_contacto) }}"><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <a href="{{ route('clientes.index') }}">Volver al listado</a>
</body>
</html>