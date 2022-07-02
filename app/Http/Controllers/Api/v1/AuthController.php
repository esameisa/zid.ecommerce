<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserDefaultDataResource;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => (object) []
            ], 401);
        }

        $token = $request->user()->createToken(auth()->user()->type);

        return response()->json([
            'status' => true,
            'message' => 'loged in successfully',
            'data' => [
                'token' => $token->plainTextToken
            ]
        ], 200);
    }

    // register user function
    public function register(Request $request, string $type)
    {
        $request->merge(['type' => $type]);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required|string|max:12|in:merchant,consumer'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type' => $request->type
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'data' => (object) []
        ]);
    }

    public function me()
    {
        return response()->json([
            'status' => true,
            'message' => 'User data',
            'data' => new UserDefaultDataResource(auth()->user())
        ]);
    }
}
