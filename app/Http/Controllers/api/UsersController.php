<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = UsersModel::with('role')->get();
        
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Users data retrieved successfully',
                'data' => $users
            ], 200
        );
    }

      public function show($id) 
    {
        $user = UsersModel::find($id);

         return response()->json(
            [
                'status' => 'success',
                'message' => 'User data retrieved successfully',
                'data' => $user
            ], 200
        );
    }
}
