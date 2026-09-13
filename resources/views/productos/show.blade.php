<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Producto - VentasFix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Detalle del Producto</h1>

    <p><strong>SKU:</strong> {{ $producto->sku }}</p>
    <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
    <p><strong>Descripción corta:</strong> {{ $producto->descripcion_corta }}</p>
    <p><strong>Descripción larga:</strong> {{ $producto->descripcion_larga }}</p>
    <p><strong>Imagen:</strong> {{ $producto->imagen }}</p>
    <p><strong>Precio neto:</strong> {{ $producto->precio_neto }}</p>
    <p><strong>Precio venta (con IVA):</strong> {{ $producto->precio_venta }}</p>
    <p><strong>Stock actual:</strong> {{ $producto->stock_actual }}</p>
    <p><strong>Stock mínimo:</strong> {{ $producto->stock_minimo }}</p>
    <p><strong>Stock bajo:</strong> {{ $producto->stock_bajo }}</p>
    <p><strong>Stock alto:</strong> {{ $producto->stock_alto }}</p>

    <a href="{{ route('productos.index') }}">Volver al listado</a>
</body>
</html>