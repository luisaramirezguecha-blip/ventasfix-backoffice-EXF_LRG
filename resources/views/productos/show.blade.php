<x-layouts.app title="Detalle Producto — VentasFix">
    <x-organisms.page-frame title="Detalle del Producto">
        <div class="table-wrap">
            <table class="vf-table">
                <tbody>
                    <tr><th>SKU</th><td>{{ $producto->sku }}</td></tr>
                    <tr><th>Nombre</th><td>{{ $producto->nombre }}</td></tr>
                    <tr><th>Descripción corta</th><td>{{ $producto->descripcion_corta }}</td></tr>
                    <tr><th>Descripción larga</th><td>{{ $producto->descripcion_larga }}</td></tr>
                    <tr><th>Imagen</th><td>{{ $producto->imagen }}</td></tr>
                    <tr><th>Precio neto</th><td>{{ $producto->precio_neto }}</td></tr>
                    <tr><th>Precio venta (con IVA)</th><td>{{ $producto->precio_venta }}</td></tr>
                    <tr><th>Stock actual</th><td>{{ $producto->stock_actual }}</td></tr>
                    <tr><th>Stock mínimo</th><td>{{ $producto->stock_minimo }}</td></tr>
                    <tr><th>Stock bajo</th><td>{{ $producto->stock_bajo }}</td></tr>
                    <tr><th>Stock alto</th><td>{{ $producto->stock_alto }}</td></tr>
                </tbody>
            </table>
        </div>
        <p style="text-align:center; margin-top:1.5rem;">
            <a href="{{ route('productos.index') }}" class="link-bronze">&larr; Volver al listado</a>
        </p>
    </x-organisms.page-frame>
</x-layouts.app>
