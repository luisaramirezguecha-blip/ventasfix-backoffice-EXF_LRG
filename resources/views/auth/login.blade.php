<!doctype html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Iniciar sesión — VentasFix</title>
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

<div class="auth-page">
  <div class="auth-card manuscript-frame">
    <div class="ogival">
      <svg viewBox="0 0 64 80" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4 78V40C4 18 16 4 32 4C48 4 60 18 60 40V78" stroke="var(--color-bronze)" stroke-width="1.3"/>
        <path d="M12 78V42C12 24 20 12 32 12C44 12 52 24 52 42V78" stroke="var(--color-bronze-dim)" stroke-width="1"/>
        <circle cx="32" cy="30" r="2.4" fill="var(--color-bronze)"/>
      </svg>
    </div>

    <h1 class="auth-title">VentasFix</h1>
    <p class="auth-subtitle">Ingresa a tu panel de gestión</p>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="field-group">
        <label for="email" class="field-label">Correo electrónico</label>
        <input
          type="email" id="email" name="email"
          value="{{ old('email') }}"
          placeholder="tucorreo@ventasfix.cl"
          required autofocus class="field-input">
        @error('email')
          <div class="field-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="field-group">
        <label for="password" class="field-label">Contraseña</label>
        <input
          type="password" id="password" name="password"
          placeholder="••••••••"
          required class="field-input">
        @error('password')
          <div class="field-error">{{ $message }}</div>
        @enderror
      </div>

      <label class="remember-row">
        <input type="checkbox" name="remember">
        Recordarme
      </label>

      <button type="submit" class="btn btn-primary">Entrar</button>
    </form>

    @if (Route::has('password.request'))
      <p class="auth-footer">
        ¿Olvidaste tu contraseña?
        <a href="{{ route('password.request') }}" class="link-bronze">Recupérala aquí</a>
      </p>
    @endif
  </div>
</div>
</body>
</html>