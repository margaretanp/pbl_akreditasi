<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeRoleRequest;
use App\Http\Requests\updateRoleRequest;
use App\Models\RolesModel;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = RolesModel::with("users")->get();
        
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
        $role = RolesModel::with("users")->find($id);

         return response()->json(
            [
                'status' => 'success',
                'message' => 'Role data retrieved successfully',
                'data' => $role
            ], 200
        );
    }

    public function store(storeRoleRequest $request)
    {
        $data = $request->validated();

        $role = RolesModel::create($data);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Role created successfully',
                'data' => $role
            ], 
            201
        );
    }
    public function update(updateRoleRequest $request, $id)
    {     
        $role = RolesModel::with("users")->find($id);

        if (!$role) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Role not found'
                ],
                404
            );
        }
        
        $data = $request->validated();

        $role->update($data);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Role updated successfully',
                'data' => $role
            ],
            200
        );
    }

    public function destroy($id) {
        $role = RolesModel::find($id);

        if (!$role) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Role not found'
                ],
                404
            );
        }

        $role->delete();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Role deleted successfully'
            ],
            200
        );
    }
}
