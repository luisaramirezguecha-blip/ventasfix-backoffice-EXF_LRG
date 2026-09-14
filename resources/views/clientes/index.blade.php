<x-layouts.app title="Clientes — VentasFix">
    <x-organisms.page-frame title="Listado de Clientes" style="max-width: 960px;">
        <x-molecules.flash-message />

        <div class="top-bar">
            <a href="{{ route('clientes.create') }}" class="link-bronze">+ Nuevo cliente</a>
            <a href="{{ route('dashboard') }}" class="link-bronze">&larr; Volver al dashboard</a>
        </div>

        <x-organisms.data-table :headers="['ID', 'RUT empresa', 'Razón social', 'Rubro', 'Teléfono', 'Contacto']">
            @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->rut_empresa }}</td>
                    <td>{{ $cliente->razon_social }}</td>
                    <td>{{ $cliente->rubro }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->nombre_contacto }}</td>
                    <td>
                        <x-molecules.row-actions
                            :show-route="route('clientes.show', $cliente)"
                            :edit-route="route('clientes.edit', $cliente)"
                            :delete-route="route('clientes.destroy', $cliente)"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; color: var(--color-ink-muted);">
                        Aún no hay clientes registrados.
                    </td>
                </tr>
            @endforelse
        </x-organisms.data-table>
    </x-organisms.page-frame>
</x-layouts.app>
