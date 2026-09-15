<x-layouts.app title="Nuevo Producto — VentasFix">
    <x-organisms.page-frame title="Nuevo Producto">
        <form action="{{ route('productos.store') }}" method="POST">
            @csrf
            <x-molecules.field label="SKU" name="sku" />
            <x-molecules.field label="Nombre" name="nombre" />
            <x-molecules.field label="Descripción corta" name="descripcion_corta" />
            <x-molecules.field label="Descripción larga" name="descripcion_larga" type="textarea" />
            <x-molecules.field label="Imagen (URL o nombre de archivo)" name="imagen" />
            <x-molecules.field label="Precio neto" name="precio_neto" type="number" step="0.01" />
            <x-molecules.field label="Stock actual" name="stock_actual" type="number" />
            <x-molecules.field label="Stock mínimo" name="stock_minimo" type="number" />
            <x-molecules.field label="Stock bajo" name="stock_bajo" type="number" />
            <x-molecules.field label="Stock alto" name="stock_alto" type="number" />
            <x-atoms.button>Guardar</x-atoms.button>
        </form>
        <p style="text-align:center; margin-top:1.5rem;">
            <a href="{{ route('productos.index') }}" class="link-bronze">&larr; Volver al listado</a>
        </p>
    </x-organisms.page-frame>
</x-layouts.app>
