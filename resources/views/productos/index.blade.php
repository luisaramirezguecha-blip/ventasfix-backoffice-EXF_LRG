<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos - VentasFix</title>
</head>
<body>
    <h1>Listado de Productos</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('productos.create') }}">+ Nuevo Producto</a>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>SKU</th>
                <th>Nombre</th>
                <th>Precio Neto</th>
                <th>Precio Venta</th>
                <th>Stock Actual</th>
                <th>Stock Bajo</th>
                <th>Stock Alto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->sku }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->precio_neto }}</td>
                    <td>{{ $producto->precio_venta }}</td>
                    <td>{{ $producto->stock_actual }}</td>
                    <td>
                        <a href="{{ route('productos.show', $producto) }}">Ver</a>
                        <a href="{{ route('productos.edit', $producto) }}">Editar</a>
                        <form action="{{ route('productos.destroy', $producto) }}"
                        @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>