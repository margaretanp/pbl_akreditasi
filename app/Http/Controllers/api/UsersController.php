<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeUserRequest;
use App\Http\Requests\updateUserRequest;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            ],
            200
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
            ],
            200
        );
    }

    public function store(storeUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = UsersModel::create($data);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'User created successfully',
                'data' => $user
            ],
            201
        );
    }

    public function update(updateUserRequest $request, $id)
    {
        $user = UsersModel::find($id);

        if (!$user) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'User not found'
                ],
                404
            );
        }

        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'User updated successfully',
                'data' => $user
            ],
            200
        );
    }

    public function destroy($id)
    {
        $user = UsersModel::find($id);

        if (!$user) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'User not found'
                ],
                404
            );
        }

        $user->delete();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'User deleted successfully'
            ],
            200
        );
    }
}
