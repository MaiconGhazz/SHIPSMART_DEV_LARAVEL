<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login() : JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        
        $token = auth()->user()->createToken('access_token');

        return response()->json(['token' => $token->plainTextToken]);
    }

    public function register() : JsonResponse
    {
        request()->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);

        return response()->json(['user' => $user]);
    }

    public function logout() : JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }

    public function update() : JsonResponse
    {
        request()->validate([
            'name' => ['sometimes', 'string', 'min:5', 'max:255'],
            'email' => ['sometimes', 'string', 'email', Rule::unique('users', 'email')->ignore(auth()->user()->id)],
            'password' => ['sometimes', 'string', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        $user = auth()->user();

        $user->update([
            'name' => request('name', $user->name),
            'email' => request('email', $user->email),
            'password' => request('passworrd') ? Hash::make(request('password')) : $user->password,
        ]);

        return response()->json(['user' => $user]);
    }
}
