<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use OpenApi\Attributes as OA;

class UsuarioApiController extends Controller
{
    #[OA\Get(
        path: "/api/usuarios",
        summary: "Listar todos los usuarios",
        tags: ["Usuarios"],
        security: [["bearerAuth" => []]],
        responses: [
            new OA\Response(response: 200, description: "Lista de usuarios obtenida correctamente")
        ]
    )]
    public function index()
    {
        $usuarios = User::all();
        return response()->json($usuarios);
    }

    #[OA\Get(
        path: "/api/usuarios/{id}",
        summary: "Obtener un usuario por su ID",
        tags: ["Usuarios"],
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Usuario encontrado"),
            new OA\Response(response: 404, description: "Usuario no encontrado")
        ]
    )]
    public function show(User $usuario)
    {
        return response()->json($usuario);
    }

    #[OA\Post(
        path: "/api/usuarios",
        summary: "Crear un nuevo usuario",
        tags: ["Usuarios"],
        security: [["bearerAuth" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["rut", "nombre", "apellido", "email", "password"],
                properties: [
                    new OA\Property(property: "rut", type: "string"),
                    new OA\Property(property: "nombre", type: "string"),
                    new OA\Property(property: "apellido", type: "string"),
                    new OA\Property(property: "email", type: "string", description: "Debe terminar en @ventasfix.cl"),
                    new OA\Property(property: "password", type: "string"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Usuario creado correctamente"),
            new OA\Response(response: 422, description: "Error de validación")
        ]
    )]
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rut' => 'required|string|unique:users,rut',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|regex:/^.+@ventasfix\.cl$/',
            'password' => ['required', 'string', Password::min(8)],
        ]);

        $usuario = User::create($validated);

        return response()->json($usuario, 201);
    }

    #[OA\Put(
        path: "/api/usuarios/{id}",
        summary: "Actualizar un usuario por su ID",
        tags: ["Usuarios"],
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "rut", type: "string"),
                    new OA\Property(property: "nombre", type: "string"),
                    new OA\Property(property: "apellido", type: "string"),
                    new OA\Property(property: "email", type: "string"),
                    new OA\Property(property: "password", type: "string", description: "Opcional: dejar vacío para no cambiarla"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Usuario actualizado correctamente"),
            new OA\Response(response: 404, description: "Usuario no encontrado"),
            new OA\Response(response: 422, description: "Error de validación")
        ]
    )]
    public function update(Request $request, User $usuario)
    {
        $validated = $request->validate([
            'rut' => 'required|string|unique:users,rut,' . $usuario->id,
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id . '|regex:/^.+@ventasfix\.cl$/',
            'password' => ['nullable', 'string', Password::min(8)],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $usuario->update($validated);

        return response()->json($usuario);
    }

    #[OA\Delete(
        path: "/api/usuarios/{id}",
        summary: "Eliminar un usuario por su ID",
        tags: ["Usuarios"],
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Usuario eliminado correctamente"),
            new OA\Response(response: 404, description: "Usuario no encontrado")
        ]
    )]
    public function destroy(User $usuario)
    {
        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente.']);
    }
}