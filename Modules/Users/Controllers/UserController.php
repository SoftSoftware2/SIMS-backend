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
        $data = $request->validate([
            'email'      => 'required|string|email|max:70|unique:users',
            'name'       => 'required|string|max:50',
            'password'   => 'required|string|min:8'
        ]);

        $user = User::create($data);

        return response()->json([
            'status'  => 'success',
            'data'    => $user
        ], 201);
   }

   public function show($id): JsonResponse{
    $user = User::find($id);

    if(!$user){
        return response()->json([
            'status' => 'error',
            'message' => 'User not found'
        ], 404);
    }

    return response()->json([
        'data' => $user
    ], 200);

   }
}
