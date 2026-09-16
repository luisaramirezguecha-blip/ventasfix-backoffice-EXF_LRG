<x-layouts.app title="Nuevo Usuario — VentasFix">
    <x-organisms.page-frame title="Nuevo Usuario">
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            <x-molecules.field label="RUT" name="rut" :value="old('rut')" />
            <x-molecules.field label="Nombre" name="nombre" :value="old('nombre')" />
            <x-molecules.field label="Apellido" name="apellido" :value="old('apellido')" />
            <x-molecules.field label="Email (debe terminar en @ventasfix.cl)" name="email" type="email" :value="old('email')" />
            <x-molecules.field label="Contraseña" name="password" type="password" />
            
            <x-atoms.button>Guardar</x-atoms.button>
        </form>
        <p style="text-align:center; margin-top:1.5rem;">
            <a href="{{ route('usuarios.index') }}" class="link-bronze">&larr; Volver al listado</a>
        </p>
    </x-organisms.page-frame>
</x-layouts.app>