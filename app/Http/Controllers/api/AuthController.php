<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = UsersModel::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }

        $expiresAt = now()->addHours(24);
        $token = $user->createToken('auth_token', ["*"], $expiresAt)->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => [
                'auth_token' => $token,
                'expires_at' => $expiresAt->toIso8601String(),
                'user' => $user->load('role')
            ],
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully.'
        ]);
    }

    public function currentUser()
    {
        return response()->json([
            "status" => "success",
            "message" => "Authenticated user retrieved successfuly",
            'data' => auth()->user()->load('role')
        ], 200);
    }
}
