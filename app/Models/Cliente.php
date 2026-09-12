<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'rut_empresa',
    'rubro',
    'razon_social',
    'telefono',
    'direccion',
    'nombre_contacto',
    'email_contacto',
])]
class Cliente extends Model
{
    use HasFactory;
}