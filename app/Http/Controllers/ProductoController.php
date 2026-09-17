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
            'imagen_url' => 'nullable|url',
            'imagen_archivo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'precio_neto' => 'required|integer|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'required|integer|min:0',
            'stock_alto' => 'required|integer|min:0',
        ]);

        // Nos quedamos solo con los datos validados, sin los campos auxiliares de imagen
        $datosProducto = collect($validated)->except(['imagen_archivo', 'imagen_url'])->toArray();

        if ($request->hasFile('imagen_archivo')) {
            $datosProducto['imagen'] = $request->file('imagen_archivo')->store('productos', 'public');
        } elseif ($request->filled('imagen_url')) {
            $datosProducto['imagen'] = $request->input('imagen_url');
        }

        // IVA 19% — requisito del enunciado. CLP no usa decimales.
        $datosProducto['precio_venta'] = (int) round($datosProducto['precio_neto'] * 1.19);

        Producto::create($datosProducto);

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
            'imagen_url' => 'nullable|url',
            'imagen_archivo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'precio_neto' => 'required|integer|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'required|integer|min:0',
            'stock_alto' => 'required|integer|min:0',
        ]);

        // Nos quedamos solo con los datos validados, sin los campos auxiliares de imagen
        $datosProducto = collect($validated)->except(['imagen_archivo', 'imagen_url'])->toArray();

        // Solo tocamos la imagen si el usuario subió un archivo nuevo o puso una URL nueva.
        // Si no hizo nada, se conserva la imagen que ya tenía el producto (esto es lo que
        // arregla el bug: antes 'imagen' era un campo de texto editable a mano).
        if ($request->hasFile('imagen_archivo')) {
            $datosProducto['imagen'] = $request->file('imagen_archivo')->store('productos', 'public');
        } elseif ($request->filled('imagen_url')) {
            $datosProducto['imagen'] = $request->input('imagen_url');
        }

        // IVA 19% — requisito del enunciado. CLP no usa decimales.
        $datosProducto['precio_venta'] = (int) round($datosProducto['precio_neto'] * 1.19);

        $producto->update($datosProducto);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar un producto por su ID
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}