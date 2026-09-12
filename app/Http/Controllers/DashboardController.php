<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Producto;
use App\Models\Cliente;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsuarios = User::count();
        $totalProductos = Producto::count();
        $totalClientes = Cliente::count();

        return view('dashboard', compact('totalUsuarios', 'totalProductos', 'totalClientes'));
    }
}