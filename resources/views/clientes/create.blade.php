<x-layouts.app title="Nuevo Cliente — VentasFix">
    <x-organisms.page-frame title="Nuevo Cliente">
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf
            <x-molecules.field label="RUT Empresa" name="rut_empresa" />
            <x-molecules.field label="Rubro" name="rubro" />
            <x-molecules.field label="Razón Social" name="razon_social" />
            <x-molecules.field label="Teléfono" name="telefono" />
            <x-molecules.field label="Dirección" name="direccion" type="textarea" />
            <x-molecules.field label="Nombre de contacto" name="nombre_contacto" />
            <x-molecules.field label="Email de contacto" name="email_contacto" type="email" />
            <x-atoms.button>Guardar</x-atoms.button>
        </form>
        <p style="text-align:center; margin-top:1.5rem;">
            <a href="{{ route('clientes.index') }}" class="link-bronze">&larr; Volver al listado</a>
        </p>
    </x-organisms.page-frame>
</x-layouts.app>
