<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
    // Mostrar el formulario de login (sistema web)
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar el intento de login (sistema web)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    // Cerrar sesión (sistema web)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    #[OA\Post(
        path: "/api/login",
        summary: "Iniciar sesión y obtener un token de acceso",
        tags: ["Autenticación"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["email", "password"],
                properties: [
                    new OA\Property(property: "email", type: "string", example: "usuario@ventasfix.cl"),
                    new OA\Property(property: "password", type: "string", example: "contraseña123"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Login exitoso, devuelve el token"),
            new OA\Response(response: 401, description: "Credenciales incorrectas"),
            new OA\Response(response: 422, description: "Error de validación")
        ]
    )]
    // Login para la API: devuelve un token en vez de redirigir
    public function apiLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Las credenciales no coinciden con nuestros registros.',
            ], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    // Logout de la API: revoca el token actual
    public function apiLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión de API cerrada correctamente.',
        ]);
    }
}