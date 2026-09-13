<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ProductoApiController extends Controller
{
    #[OA\Get(
        path: "/api/productos",
        summary: "Listar todos los productos",
        tags: ["Productos"],
        security: [["bearerAuth" => []]],
        responses: [
            new OA\Response(response: 200, description: "Lista de productos obtenida correctamente")
        ]
    )]
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    #[OA\Get(
        path: "/api/productos/{id}",
        summary: "Obtener un producto por su ID",
        tags: ["Productos"],
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Producto encontrado"),
            new OA\Response(response: 404, description: "Producto no encontrado")
        ]
    )]
    public function show(Producto $producto)
    {
        return response()->json($producto);
    }

    #[OA\Post(
        path: "/api/productos",
        summary: "Crear un nuevo producto",
        tags: ["Productos"],
        security: [["bearerAuth" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["sku", "nombre", "descripcion_corta", "descripcion_larga", "imagen", "precio_neto", "stock_actual", "stock_minimo", "stock_bajo", "stock_alto"],
                properties: [
                    new OA\Property(property: "sku", type: "string"),
                    new OA\Property(property: "nombre", type: "string"),
                    new OA\Property(property: "descripcion_corta", type: "string"),
                    new OA\Property(property: "descripcion_larga", type: "string"),
                    new OA\Property(property: "imagen", type: "string"),
                    new OA\Property(property: "precio_neto", type: "number"),
                    new OA\Property(property: "stock_actual", type: "integer"),
                    new OA\Property(property: "stock_minimo", type: "integer"),
                    new OA\Property(property: "stock_bajo", type: "integer"),
                    new OA\Property(property: "stock_alto", type: "integer"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Producto creado correctamente"),
            new OA\Response(response: 422, description: "Error de validación")
        ]
    )]
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

        $producto = Producto::create($validated);

        return response()->json($producto, 201);
    }

    #[OA\Put(
        path: "/api/productos/{id}",
        summary: "Actualizar un producto por su ID",
        tags: ["Productos"],
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "sku", type: "string"),
                    new OA\Property(property: "nombre", type: "string"),
                    new OA\Property(property: "descripcion_corta", type: "string"),
                    new OA\Property(property: "descripcion_larga", type: "string"),
                    new OA\Property(property: "imagen", type: "string"),
                    new OA\Property(property: "precio_neto", type: "number"),
                    new OA\Property(property: "stock_actual", type: "integer"),
                    new OA\Property(property: "stock_minimo", type: "integer"),
                    new OA\Property(property: "stock_bajo", type: "integer"),
                    new OA\Property(property: "stock_alto", type: "integer"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Producto actualizado correctamente"),
            new OA\Response(response: 404, description: "Producto no encontrado"),
            new OA\Response(response: 422, description: "Error de validación")
        ]
    )]
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

        return response()->json($producto);
    }

    #[OA\Delete(
        path: "/api/productos/{id}",
        summary: "Eliminar un producto por su ID",
        tags: ["Productos"],
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Producto eliminado correctamente"),
            new OA\Response(response: 404, description: "Producto no encontrado")
        ]
    )]
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return response()->json(['message' => 'Producto eliminado correctamente.']);
    }
}