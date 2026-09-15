<x-layouts.app title="Editar Usuario — VentasFix">
    <x-organisms.page-frame title="Editar Usuario">
        <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
            @csrf
            @method('PUT')
            <x-molecules.field label="RUT" name="rut" :value="$usuario->rut" />
            <x-molecules.field label="Nombre" name="nombre" :value="$usuario->nombre" />
            <x-molecules.field label="Apellido" name="apellido" :value="$usuario->apellido" />
            <x-molecules.field label="Email" name="email" type="email" :value="$usuario->email" />
            <x-molecules.field label="Nueva contraseña (opcional)" name="password" type="password" />
            <x-atoms.button>Actualizar</x-atoms.button>
        </form>
        <p style="text-align:center; margin-top:1.5rem;">
            <a href="{{ route('usuarios.index') }}" class="link-bronze">&larr; Volver al listado</a>
        </p>
    </x-organisms.page-frame>
</x-layouts.app>
