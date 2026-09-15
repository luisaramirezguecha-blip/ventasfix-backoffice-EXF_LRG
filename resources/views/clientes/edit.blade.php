<x-layouts.app title="Editar Cliente — VentasFix">
    <x-organisms.page-frame title="Editar Cliente">
        <form action="{{ route('clientes.update', $cliente) }}" method="POST">
            @csrf
            @method('PUT')
            <x-molecules.field label="RUT Empresa" name="rut_empresa" :value="$cliente->rut_empresa" />
            <x-molecules.field label="Rubro" name="rubro" :value="$cliente->rubro" />
            <x-molecules.field label="Razón Social" name="razon_social" :value="$cliente->razon_social" />
            <x-molecules.field label="Teléfono" name="telefono" :value="$cliente->telefono" />
            <x-molecules.field label="Dirección" name="direccion" type="textarea" :value="$cliente->direccion" />
            <x-molecules.field label="Nombre de contacto" name="nombre_contacto" :value="$cliente->nombre_contacto" />
            <x-molecules.field label="Email de contacto" name="email_contacto" type="email" :value="$cliente->email_contacto" />
            <x-atoms.button>Actualizar</x-atoms.button>
        </form>
        <p style="text-align:center; margin-top:1.5rem;">
            <a href="{{ route('clientes.index') }}" class="link-bronze">&larr; Volver al listado</a>
        </p>
    </x-organisms.page-frame>
</x-layouts.app>
