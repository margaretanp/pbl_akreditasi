<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\RolesModel;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = RolesModel::get();
        
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Roles data retrieved successfully',
                'data' => $roles
            ], 200
        );
    }

    public function show($id) 
    {
        $role = RolesModel::find($id);

         return response()->json(
            [
                'status' => 'success',
                'message' => 'Role data retrieved successfully',
                'data' => $role
            ], 200
        );
    }
}
