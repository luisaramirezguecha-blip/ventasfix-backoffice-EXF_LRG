<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ClienteApiController extends Controller
{
    #[OA\Get(
        path: "/api/clientes",
        summary: "Listar todos los clientes",
        tags: ["Clientes"],
        security: [["bearerAuth" => []]],
        responses: [
            new OA\Response(response: 200, description: "Lista de clientes obtenida correctamente")
        ]
    )]
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    #[OA\Get(
        path: "/api/clientes/{id}",
        summary: "Obtener un cliente por su ID",
        tags: ["Clientes"],
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Cliente encontrado"),
            new OA\Response(response: 404, description: "Cliente no encontrado")
        ]
    )]
    public function show(Cliente $cliente)
    {
        return response()->json($cliente);
    }

    #[OA\Post(
        path: "/api/clientes",
        summary: "Crear un nuevo cliente",
        tags: ["Clientes"],
        security: [["bearerAuth" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["rut_empresa", "rubro", "razon_social", "telefono", "direccion", "nombre_contacto", "email_contacto"],
                properties: [
                    new OA\Property(property: "rut_empresa", type: "string"),
                    new OA\Property(property: "rubro", type: "string"),
                    new OA\Property(property: "razon_social", type: "string"),
                    new OA\Property(property: "telefono", type: "string"),
                    new OA\Property(property: "direccion", type: "string"),
                    new OA\Property(property: "nombre_contacto", type: "string"),
                    new OA\Property(property: "email_contacto", type: "string"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Cliente creado correctamente"),
            new OA\Response(response: 422, description: "Error de validación")
        ]
    )]
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rut_empresa' => 'required|string|unique:clientes,rut_empresa',
            'rubro' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'nombre_contacto' => 'required|string|max:255',
            'email_contacto' => 'required|email|max:255',
        ]);

        $cliente = Cliente::create($validated);

        return response()->json($cliente, 201);
    }

    #[OA\Put(
        path: "/api/clientes/{id}",
        summary: "Actualizar un cliente por su ID",
        tags: ["Clientes"],
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "rut_empresa", type: "string"),
                    new OA\Property(property: "rubro", type: "string"),
                    new OA\Property(property: "razon_social", type: "string"),
                    new OA\Property(property: "telefono", type: "string"),
                    new OA\Property(property: "direccion", type: "string"),
                    new OA\Property(property: "nombre_contacto", type: "string"),
                    new OA\Property(property: "email_contacto", type: "string"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Cliente actualizado correctamente"),
            new OA\Response(response: 404, description: "Cliente no encontrado"),
            new OA\Response(response: 422, description: "Error de validación")
        ]
    )]
    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'rut_empresa' => 'required|string|unique:clientes,rut_empresa,' . $cliente->id,
            'rubro' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'nombre_contacto' => 'required|string|max:255',
            'email_contacto' => 'required|email|max:255',
        ]);

        $cliente->update($validated);

        return response()->json($cliente);
    }

    #[OA\Delete(
        path: "/api/clientes/{id}",
        summary: "Eliminar un cliente por su ID",
        tags: ["Clientes"],
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Cliente eliminado correctamente"),
            new OA\Response(response: 404, description: "Cliente no encontrado")
        ]
    )]
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return response()->json(['message' => 'Cliente eliminado correctamente.']);
    }
}