<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Listar todos los productos
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario para crear un nuevo producto
    public function create()
    {
        return view('productos.create');
    }

    // Guardar un nuevo producto
    public function store(Request $request)
{
    $validated = $request->validate([
        'sku' => 'required|string|unique:productos,sku',
        'nombre' => 'required|string|max:255',
        'descripcion_corta' => 'required|string|max:255',
        'descripcion_larga' => 'required|string',
        'imagen' => 'required|string',
        'precio_neto' => 'required|numeric|min:0',
        'stock_actual' => 'required|integer|min:0',
        'stock_minimo' => 'required|integer|min:0',
        'stock_bajo' => 'required|integer|min:0',
        'stock_alto' => 'required|integer|min:0',
    ]);

    $validated['precio_venta'] = round($validated['precio_neto'] * 1.19, 2);

    Producto::create($validated);

return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
}
    // Mostrar un producto por su ID
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    // Mostrar formulario para editar un producto
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    // Actualizar un producto por su ID
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'sku' => 'required|string|unique:productos,sku,' . $producto->id,
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:255',
            'descripcion_larga' => 'required|string',
            'imagen' => 'required|string',
            'precio_neto' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'required|integer|min:0',
            'stock_alto' => 'required|integer|min:0',
        ]);

        $validated['precio_venta'] = round($validated['precio_neto'] * 1.19, 2);

        $producto->update($validated);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar un producto por su ID
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}