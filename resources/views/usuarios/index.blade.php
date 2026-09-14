<x-layouts.app title="Usuarios — VentasFix">
    <x-organisms.page-frame title="Listado de Usuarios" style="max-width: 960px;">
        <x-molecules.flash-message />

        <div class="top-bar">
            <a href="{{ route('usuarios.create') }}" class="link-bronze">+ Nuevo usuario</a>
            <a href="{{ route('dashboard') }}" class="link-bronze">&larr; Volver al dashboard</a>
        </div>

        <x-organisms.data-table :headers="['ID', 'RUT', 'Nombre', 'Apellido', 'Email']">
            @forelse ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->rut }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->apellido }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        <x-molecules.row-actions
                            :show-route="route('usuarios.show', $usuario)"
                            :edit-route="route('usuarios.edit', $usuario)"
                            :delete-route="route('usuarios.destroy', $usuario)"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center; color: var(--color-ink-muted);">
                        Aún no hay usuarios registrados.
                    </td>
                </tr>
            @endforelse
        </x-organisms.data-table>
    </x-organisms.page-frame>
</x-layouts.app>
