<?php

namespace Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Users\Models\User;



class UserController extends Controller
{
   public function index(): JsonResponse {
    return response()->json(User::all());
   }

   public function store(Request $request): JsonResponse{
        // Verificar si el usuario ya existe
        if(User::where('email', $request->email)->exists()){
            return response()->json([
                'message' => 'A user with this email already exists'
            ], 409);
        }

        $data = $request->validate([
            'email'      => 'required|string|email|max:70',
            'name'       => 'required|string|max:50',
            'password'   => 'required|string|min:8'
        ]);

        $user = User::create($data);

        return response()->json([
            'data'    => $user
        ], 201);
   }

   public function show($id): JsonResponse{
    $user = User::find($id);

    if(!$user){
        return response()->json([
            'message' => 'User not found'
        ], 404);
    }

    return response()->json([
        'data' => $user
    ], 200);

   }

   public function update(Request $request, $id): JsonResponse{
    $user = User::find($id);
    
    if(!$user){
        return response()->json([
            'message' => 'User not found'
        ], 404);
    }

    $data = $request->validate([
        'email' => 'sometimes|required|string|email|max:70|unique:users,email,' . $id,
        'name' => 'sometimes|required|string|max:50',
        'password' => 'sometimes|required|string|min:8'
    ]);

    $user->update($data);

    return response()->json([
        'message' => 'User updated successfully',
        'data' => $user
    ], 200);
   }

   public function destroy($id): JsonResponse{
    $user = User::find($id);
    
    if(!$user){
        return response()->json([
            'message' => 'User not found'
        ], 404);
    }
    
    $user->delete();
    
    return response()->json([
        'message' => 'User has been deleted'
    ], 200);
   }
}
