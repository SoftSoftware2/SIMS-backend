<?php

namespace Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Admins\Models\Admin;

class AuthController extends Controller
{
    /**
     * Login admin and generate token
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email|max:70',
            'password' => 'required|string|min:8',
        ]);

        // Buscar usuario por email
        $admin = Admin::where('email', $request->email)->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Generar token
        $token = $admin->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'admin' => $admin
        ], 200);
    }

    /**
     * Logout admin (revoke current token)
     */
    public function logout(Request $request): JsonResponse
    {
        // Revocar el token actual del usuario autenticado
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }

}
