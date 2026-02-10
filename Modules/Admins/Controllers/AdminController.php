<?php

namespace Modules\Admins\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Admins\Models\Admin;



class AdminController extends Controller
{
   public function index(): JsonResponse {
    $admins = Admin::all();
    return response()->json(AdminResource::collection($admins));
   }

   public function store(Request $request): JsonResponse{

        if(Admin::where('email', $request->email)->exists()){
            return response()->json([
                'message' => 'A admin with this email already exists'
            ], 409);
        }

        $data = $request->validate([
            'email'      => 'required|string|email|max:70',
            'name'       => 'required|string|max:50',
            'password'   => 'required|string|min:8'
        ]);

        $admin = Admin::create($data);

        return response()->json([
            'data'    => new AdminResource(($admin))
        ], 201);
   }

   public function show($id): JsonResponse{
    $admin = Admin::find($id);

    if(!$admin){
        return response()->json([
            'message' => 'admin not found'
        ], 404);
    }

    return response()->json([
        'data' => new AdminResource($admin)
    ], 200);

   }

   public function update(Request $request, $id): JsonResponse{
    $admin = Admin::find($id);
    
    if(!$admin){
        return response()->json([
            'message' => 'admin not found'
        ], 404);
    }

    $data = $request->validate([
        'email' => 'sometimes|required|string|email|max:70|unique:admins,email,' . $id,
        'name' => 'sometimes|required|string|max:50',
        'password' => 'sometimes|required|string|min:8'
    ]);

    $admin->update($data);

    return response()->json([
        'message' => 'admin updated successfully',
        'data' => new AdminResource($admin)
    ], 200);
   }

   public function destroy($id): JsonResponse{
    $admin = Admin::find($id);
    
    if(!$admin){
        return response()->json([
            'message' => 'admin not found'
        ], 404);
    }
    
    $admin->delete();
    
    return response()->json([
        'message' => 'admin has been deleted'
    ], 200);
   }
}
