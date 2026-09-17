<x-layouts.app title="Editar Producto — VentasFix">
    <x-organisms.page-frame title="Editar Producto">
        <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-molecules.field label="SKU" name="sku" :value="$producto->sku" />
            <x-molecules.field label="Nombre" name="nombre" :value="$producto->nombre" />
            <x-molecules.field label="Descripción corta" name="descripcion_corta" :value="$producto->descripcion_corta" />
            <x-molecules.field label="Descripción larga" name="descripcion_larga" type="textarea" :value="$producto->descripcion_larga" />

            @if ($producto->imagen)
                <div class="field-group">
                    <label class="field-label">Imagen actual</label>
                    <img
                        src="{{ Str::startsWith($producto->imagen, ['http://', 'https://'])
                                ? $producto->imagen
                                : asset('storage/' . $producto->imagen) }}"
                        alt="{{ $producto->nombre }}"
                        style="max-width:150px; display:block; margin-bottom:.5rem; border-radius:8px;">
                </div>
            @endif

            <!-- Reemplazar imagen: archivo o URL. Si no se completa ninguno, se conserva la actual. -->
            <div class="field-group">
                <label class="field-label">Reemplazar imagen desde el dispositivo (opcional)</label>
                <input type="file" name="imagen_archivo" accept="image/*" class="field-input">
                @error('imagen_archivo')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>
            <x-molecules.field label="O reemplazar por URL de imagen (opcional)" name="imagen_url" :value="old('imagen_url')" />

            <x-molecules.field label="Precio neto (CLP)" name="precio_neto" type="number" step="1" :value="$producto->precio_neto" />
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