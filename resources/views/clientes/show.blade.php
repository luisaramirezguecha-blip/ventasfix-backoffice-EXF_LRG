<x-layouts.app title="Detalle Cliente — VentasFix">
    <x-organisms.page-frame title="Detalle del Cliente">
        <div class="table-wrap">
            <table class="vf-table">
                <tbody>
                    <tr><th>RUT Empresa</th><td>{{ $cliente->rut_empresa }}</td></tr>
                    <tr><th>Rubro</th><td>{{ $cliente->rubro }}</td></tr>
                    <tr><th>Razón Social</th><td>{{ $cliente->razon_social }}</td></tr>
                    <tr><th>Teléfono</th><td>{{ $cliente->telefono }}</td></tr>
                    <tr><th>Dirección</th><td>{{ $cliente->direccion }}</td></tr>
                    <tr><th>Nombre de contacto</th><td>{{ $cliente->nombre_contacto }}</td></tr>
                    <tr><th>Email de contacto</th><td>{{ $cliente->email_contacto }}</td></tr>
                </tbody>
            </table>
        </div>
        <p style="text-align:center; margin-top:1.5rem;">
            <a href="{{ route('clientes.index') }}" class="link-bronze">&larr; Volver al listado</a>
        </p>
    </x-organisms.page-frame>
</x-layouts.app>
