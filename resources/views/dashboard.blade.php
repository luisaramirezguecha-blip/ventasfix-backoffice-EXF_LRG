<x-layouts.app title="Dashboard — VentasFix">
    <x-organisms.page-frame
        title="Dashboard"
        :subtitle="'Bienvenido, ' . auth()->user()->nombre . ' ' . auth()->user()->apellido"
    >
        <div class="stat-grid">
            <div class="stat-card">
                <span class="stat-label">Usuarios registrados</span>
                <span class="stat-value">{{ $totalUsuarios }}</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Productos registrados</span>
                <span class="stat-value">{{ $totalProductos }}</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Clientes registrados</span>
                <span class="stat-value">{{ $totalClientes }}</span>
            </div>
        </div>

        <nav class="nav-links">
            <a href="{{ route('productos.index') }}" class="link-bronze">Productos</a>
            <a href="{{ route('clientes.index') }}" class="link-bronze">Clientes</a>
            <a href="{{ route('usuarios.index') }}" class="link-bronze">Usuarios</a>
        </nav>

        <form action="{{ route('logout') }}" method="POST" class="mt-form">
            @csrf
            <x-atoms.button variant="secondary">Cerrar sesión</x-atoms.button>
        </form>
    </x-organisms.page-frame>
</x-layouts.app>
