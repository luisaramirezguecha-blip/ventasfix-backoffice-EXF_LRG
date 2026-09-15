<x-layouts.app title="Editar Producto — VentasFix">
    <x-organisms.page-frame title="Editar Producto">
        <form action="{{ route('productos.update', $producto) }}" method="POST">
            @csrf
            @method('PUT')
            <x-molecules.field label="SKU" name="sku" :value="$producto->sku" />
            <x-molecules.field label="Nombre" name="nombre" :value="$producto->nombre" />
            <x-molecules.field label="Descripción corta" name="descripcion_corta" :value="$producto->descripcion_corta" />
            <x-molecules.field label="Descripción larga" name="descripcion_larga" type="textarea" :value="$producto->descripcion_larga" />
            <x-molecules.field label="Imagen" name="imagen" :value="$producto->imagen" />
            <x-molecules.field label="Precio neto" name="precio_neto" type="number" step="0.01" :value="$producto->precio_neto" />
            <x-molecules.field label="Stock actual" name="stock_actual" type="number" :value="$producto->stock_actual" />
            <x-molecules.field label="Stock mínimo" name="stock_minimo" type="number" :value="$producto->stock_minimo" />
            <x-molecules.field label="Stock bajo" name="stock_bajo" type="number" :value="$producto->stock_bajo" />
            <x-molecules.field label="Stock alto" name="stock_alto" type="number" :value="$producto->stock_alto" />
            <x-atoms.button>Actualizar</x-atoms.button>
        </form>
        <p style="text-align:center; margin-top:1.5rem;">
            <a href="{{ route('productos.index') }}" class="link-bronze">&larr; Volver al listado</a>
        </p>
    </x-organisms.page-frame>
</x-layouts.app>
