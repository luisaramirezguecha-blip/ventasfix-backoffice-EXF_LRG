<?php

use App\Http\Controllers\Api\ProductoApiController;
use App\Http\Controllers\Api\ClienteApiController;
use App\Http\Controllers\Api\UsuarioApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Ruta pública: login de la API (devuelve el token)
Route::post('/login', [AuthController::class, 'apiLogin']);

// Rutas protegidas: requieren token válido (Sanctum)
Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::post('/logout', [AuthController::class, 'apiLogout']);
    Route::apiResource('productos', ProductoApiController::class);
    Route::apiResource('clientes', ClienteApiController::class);
    Route::apiResource('usuarios', UsuarioApiController::class);
});