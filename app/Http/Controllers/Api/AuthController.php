<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends APIController
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('api')->plainTextToken;

        return $this->respondWithSuccess([
            'user' => $user,
            'token' => $token,
        ], 'Registration successful', 201);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->respondWithError('Unauthorized', 401);
        }

        $user = Auth::user();
        $token = $user->createToken('api')->plainTextToken;

        return $this->respondWithSuccess([
            'user' => $user,
            'token' => $token,
        ], 'Login successful');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        $validated  = $request->validated();

        $user->update($validated);

        return $this->respondWithSuccess($user, 'Profile updated successfully');
    }
}
