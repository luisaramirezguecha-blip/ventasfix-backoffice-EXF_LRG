<!doctype html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard — VentasFix</title>
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
  <div class="page-card manuscript-frame">
    <div class="ogival">
      <svg viewBox="0 0 64 80" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4 78V40C4 18 16 4 32 4C48 4 60 18 60 40V78" stroke="var(--color-bronze)" stroke-width="1.3"/>
        <path d="M12 78V42C12 24 20 12 32 12C44 12 52 24 52 42V78" stroke="var(--color-bronze-dim)" stroke-width="1"/>
        <circle cx="32" cy="30" r="2.4" fill="var(--color-bronze)"/>
      </svg>
    </div>

    <h1 class="page-title">Dashboard</h1>
    <p class="page-subtitle">Bienvenido, {{ auth()->user()->nombre }} {{ auth()->user()->apellido }}</p>

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
      <button type="submit" class="btn btn-secondary">Cerrar sesión</button>
    </form>
  </div>
</div>
</body>
</html>