<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Cliente - VentasFix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Detalle del Cliente</h1>

    <p><strong>RUT Empresa:</strong> {{ $cliente->rut_empresa }}</p>
    <p><strong>Rubro:</strong> {{ $cliente->rubro }}</p>
    <p><strong>Razón Social:</strong> {{ $cliente->razon_social }}</p>
    <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
    <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
    <p><strong>Nombre de contacto:</strong> {{ $cliente->nombre_contacto }}</p>
    <p><strong>Email de contacto:</strong> {{ $cliente->email_contacto }}</p>

    <a href="{{ route('clientes.index') }}">Volver al listado</a>
</body>
</html>