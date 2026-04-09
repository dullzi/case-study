<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthService
{
    /**
     * Register a new user.
     *
     * @param array $data
     * @return User
     */
    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Login user and return token.
     *
     * @param array $credentials
     * @return string|bool
     */
    public function login(array $credentials)
    {
        if (!$token = auth('api')->attempt($credentials)) {
            return false;
        }

        return $token;
    }

    /**
     * Logout user (invalidate token).
     *
     * @return void
     */
    public function logout(): void
    {
        auth('api')->logout();
    }

    /**
     * Refresh current token.
     *
     * @return string
     */
    public function refresh(): string
    {
        /** @var \PHPOpenSourceSaver\JWTAuth\JWTGuard $guard */
        $guard = auth('api');
        return $guard->refresh();
    }

    /**
     * Get authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function me()
    {
        return auth('api')->user();
    }

    /**
     * Get token details.
     *
     * @param string $token
     * @return array
     */
    public function respondWithToken(string $token): array
    {
        /** @var \PHPOpenSourceSaver\JWTAuth\JWTGuard $guard */
        $guard = auth('api');
        
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $guard->factory()->getTTL() * 60
        ];
    }
}
