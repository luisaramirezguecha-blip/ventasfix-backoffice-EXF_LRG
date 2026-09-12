<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'sku',
    'nombre',
    'descripcion_corta',
    'descripcion_larga',
    'imagen',
    'precio_neto',
    'precio_venta',
    'stock_actual',
    'stock_minimo',
    'stock_bajo',
    'stock_alto',
])]
class Producto extends Model
{
    use HasFactory;
}