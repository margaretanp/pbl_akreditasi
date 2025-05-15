<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

        // Create token
        $token = $user->createToken('api_token')->plainTextToken;
        
        // Calculate token expiration time (e.g., 24 hours from now)
        $expiresAt = now()->addHours(24)->toIso8601String();
        
        // Return response matching frontend expectations
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'access_token' => $token,
            'jwt_key' => $token, // Using the same token for JWT as well
            'expires_at' => $expiresAt,
            'user' => $user,
        ], 200);
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully.'
        ]);
    }
    
    public function getUser(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'user' => $request->user()
        ]);
    }
}