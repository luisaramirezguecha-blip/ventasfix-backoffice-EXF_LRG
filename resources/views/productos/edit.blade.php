<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto - VentasFix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Editar Producto</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.update', $producto) }}" method="POST">
        @csrf
        @method('PUT')

        <label>SKU:</label><br>
        <input type="text" name="sku" value="{{ old('sku', $producto->sku) }}"><br><br>

        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}"><br><br>

        <label>Descripción corta:</label><br>
        <input type="text" name="descripcion_corta" value="{{ old('descripcion_corta', $producto->descripcion_corta) }}"><br><br>

        <label>Descripción larga:</label><br>
        <textarea name="descripcion_larga">{{ old('descripcion_larga', $producto->descripcion_larga) }}</textarea><br><br>

        <label>Imagen:</label><br>
        <input type="text" name="imagen" value="{{ old('imagen', $producto->imagen) }}"><br><br>

        <label>Precio neto:</label><br>
        <input type="number" step="0.01" name="precio_neto" value="{{ old('precio_neto', $producto->precio_neto) }}"><br><br>

        <label>Stock actual:</label><br>
        <input type="number" name="stock_actual" value="{{ old('stock_actual', $producto->stock_actual) }}"><br><br>

        <label>Stock mínimo:</label><br>
        <input type="number" name="stock_minimo" value="{{ old('stock_minimo', $producto->stock_minimo) }}"><br><br>

        <label>Stock bajo:</label><br>
        <input type="number" name="stock_bajo" value="{{ old('stock_bajo', $producto->stock_bajo) }}"><br><br>

        <label>Stock alto:</label><br>
        <input type="number" name="stock_alto" value="{{ old('stock_alto', $producto->stock_alto) }}"><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <a href="{{ route('productos.index') }}">Volver al listado</a>
</body>
</html