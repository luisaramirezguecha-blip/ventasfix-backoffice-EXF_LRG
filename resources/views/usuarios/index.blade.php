
Usuarios index.blade · PHP
<!doctype html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Usuarios — VentasFix</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<canvas id="ember-canvas"></canvas>
 
<div class="theme-toggle-wrap">
  <button class="theme-toggle" onclick="toggleTheme()" aria-label="Cambiar tema">
    <span class="knob">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
        <circle cx="12" cy="12" r="4"/>
        <path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>
      </svg>
    </span>
  </button>
</div>
 
<div class="page-shell">
  <div class="page-card manuscript-frame" style="max-width: 960px;">
    <div class="ogival">
      <svg viewBox="0 0 64 80" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4 78V40C4 18 16 4 32 4C48 4 60 18 60 40V78" stroke="var(--color-bronze)" stroke-width="1.3"/>
        <path d="M12 78V42C12 24 20 12 32 12C44 12 52 24 52 42V78" stroke="var(--color-bronze-dim)" stroke-width="1"/>
        <circle cx="32" cy="30" r="2.4" fill="var(--color-bronze)"/>
      </svg>
    </div>
 
    <h1 class="page-title">Listado de Usuarios</h1>
 
    @if (session('success'))
      <div class="flash-success">{{ session('success') }}</div>
    @endif
 
    <div class="top-bar">
      <a href="{{ route('usuarios.create') }}" class="link-bronze">+ Nuevo usuario</a>
      <a href="{{ route('dashboard') }}" class="link-bronze">&larr; Volver al dashboard</a>
    </div>
 
    <div class="table-wrap">
      <table class="vf-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>RUT</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($usuarios as $usuario)
            <tr>
              <td>{{ $usuario->id }}</td>
              <td>{{ $usuario->rut }}</td>
              <td>{{ $usuario->nombre }}</td>
              <td>{{ $usuario->apellido }}</td>
              <td>{{ $usuario->email }}</td>
              <td>
                <a href="{{ route('usuarios.show', $usuario) }}" class="link-bronze action-link">Ver</a>
                <a href="{{ route('usuarios.edit', $usuario) }}" class="link-bronze action-link">Editar</a>
                <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="action-btn" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align:center; color: var(--color-ink-muted);">
                Aún no hay usuarios registrados.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
 
