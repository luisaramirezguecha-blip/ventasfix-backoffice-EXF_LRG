<!doctype html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title ?? 'VentasFix' }}</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<canvas id="ember-canvas"></canvas>
<x-molecules.theme-toggle />
{{ $slot }}
</body>
</html>
