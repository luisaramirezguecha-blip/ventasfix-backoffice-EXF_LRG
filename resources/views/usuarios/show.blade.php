<x-layouts.app title="Detalle Usuario — VentasFix">
    <x-organisms.page-frame title="Detalle del Usuario">
        <div class="table-wrap">
            <table class="vf-table">
                <tbody>
                    <tr><th>RUT</th><td>{{ $usuario->rut }}</td></tr>
                    <tr><th>Nombre</th><td>{{ $usuario->nombre }}</td></tr>
                    <tr><th>Apellido</th><td>{{ $usuario->apellido }}</td></tr>
                    <tr><th>Email</th><td>{{ $usuario->email }}</td></tr>
                </tbody>
            </table>
        </div>
        <p style="text-align:center; margin-top:1.5rem;">
            <a href="{{ route('usuarios.index') }}" class="link-bronze">&larr; Volver al listado</a>
        </p>
    </x-organisms.page-frame>
</x-layouts.app>
