<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json(['access_token' => $token], 200);
    }

    return response()->json(['error' => 'Invalid credentials'], 401);
}


public function logout(Request $request)
{
    // Check if the user is authenticated
    if (Auth::check()) {
        // Get the authenticated user
        $user = Auth::user();

        // Revoke all tokens associated with the user
        $user->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out'], 200);
    } else {
        // Return an error if the user is not authenticated
        return response()->json(['error' => 'User is not authenticated'], 401);
}
}}
