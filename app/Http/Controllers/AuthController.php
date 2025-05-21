<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function user()
    {
        return response()->successJson(auth()->user());
    }

    public function logout()
    {
        User::UserApiGuard()->currentAccessToken()->delete();
        return response()->successJson(['message' => 'Successfully logged out']);
    }
}
