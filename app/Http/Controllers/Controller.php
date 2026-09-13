<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: "VentasFix API",
    version: "1.0.0",
    description: "API REST para gestión de Usuarios, Productos y Clientes de VentasFix"
)]
#[OA\SecurityScheme(
    securityScheme: "bearerAuth",
    type: "http",
    scheme: "bearer",
    bearerFormat: "Sanctum Token"
)]
abstract class Controller
{
    //
}