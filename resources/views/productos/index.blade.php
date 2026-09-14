<x-layouts.app title="Productos — VentasFix">
    <x-organisms.page-frame title="Listado de Productos" style="max-width: 960px;">
        <x-molecules.flash-message />

        <div class="top-bar">
            <a href="{{ route('productos.create') }}" class="link-bronze">+ Nuevo producto</a>
            <a href="{{ route('dashboard') }}" class="link-bronze">&larr; Volver al dashboard</a>
        </div>

        <x-organisms.data-table :headers="['ID', 'SKU', 'Nombre', 'Precio neto', 'Precio venta', 'Stock actual']">
            @forelse ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->sku }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->precio_neto }}</td>
                    <td>{{ $producto->precio_venta }}</td>
                    <td>{{ $producto->stock_actual }}</td>
                    <td>
                        <x-molecules.row-actions
                            :show-route="route('productos.show', $producto)"
                            :edit-route="route('productos.edit', $producto)"
                            :delete-route="route('productos.destroy', $producto)"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; color: var(--color-ink-muted);">
                        Aún no hay productos registrados.
                    </td>
                </tr>
            @endforelse
        </x-organisms.data-table>
    </x-organisms.page-frame>
</x-layouts.app>
