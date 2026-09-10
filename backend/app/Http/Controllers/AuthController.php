<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user = Users::create([
                'name' => $validated['name'],
                'email' => strtolower($validated['email']),
                'password' => $validated['password'],
                'role' => 'student',
            ]);

            Auth::login($user);
            $request->session()->regenerate();

            return response()->json([
                'message' => 'Registration successful.',
                'user' => $this->userPayload($user),
            ], 201);
        } catch (Throwable $exception) {
            Log::error('Registration failed.', ['exception' => $exception]);

            return response()->json(['message' => 'Registration is temporarily unavailable.'], 503);
        }
    }

    public function login(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
            ]);

        $credentials = [
            'email' => strtolower($validated['email']),
            'password' => $validated['password'],
        ];

            if (! Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid email or password.',
                ], 401);
            }

            $request->session()->regenerate();

            return response()->json([
                'message' => 'Login successful.',
                'user' => $this->userPayload($request->user()),
            ]);
        } catch (Throwable $exception) {
            Log::error('Login failed.', ['exception' => $exception]);

            return response()->json(['message' => 'Login is temporarily unavailable.'], 503);
        }
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json(['user' => $this->userPayload($request->user())]);
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logout successful.']);
    }

    private function userPayload(Users $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ];
    }
}