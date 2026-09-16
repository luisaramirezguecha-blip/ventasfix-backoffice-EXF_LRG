<x-layouts.app title="Nuevo Producto — VentasFix">
    <x-organisms.page-frame title="Nuevo Producto">
       
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <x-molecules.field label="SKU" name="sku" :value="old('sku')" />
            <x-molecules.field label="Nombre" name="nombre" :value="old('nombre')" />
            <x-molecules.field label="Descripción corta" name="descripcion_corta" :value="old('descripcion_corta')" />
            <x-molecules.field label="Descripción larga" name="descripcion_larga" type="textarea" :value="old('descripcion_larga')" />
            
            <!-- Opción B: Seleccionar archivo directamente del dispositivo -->
            <div class="field-group">
                <label class="field-label"> Seleccionar imagen desde el dispositivo</label>
                <input type="file" name="imagen_archivo" accept="image/*" class="field-input">
            </div>

            <x-molecules.field label="Precio neto" name="precio_neto" type="number" :value="old('precio_neto')" />
            <x-molecules.field label="Stock actual" name="stock_actual" type="number" :value="old('stock_actual')" />
            <x-molecules.field label="Stock mínimo" name="stock_minimo" type="number" :value="old('stock_minimo')" />
            <x-molecules.field label="Stock bajo" name="stock_bajo" type="number" :value="old('stock_bajo')" />
            <x-molecules.field label="Stock alto" name="stock_alto" type="number" :value="old('stock_alto')" />

            
            <div style="margin-top: 1.8rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    Guardar Producto
                </button>
            </div>
        </form>

        <p style="text-align:center; margin-top:1.5rem;">
            <a href="{{ route('productos.index') }}" class="link-bronze">&larr; Volver al listado</a>
        </p>
    </x-organisms.page-frame>
</x-layouts.app>