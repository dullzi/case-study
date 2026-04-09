<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use ApiResponse;

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());
        
        $token = $this->authService->login($request->only('email', 'password'));

        return $this->successResponse(
            $this->authService->respondWithToken($token),
            'User registered successfully',
            201
        );
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->authService->login($request->validated());

        if (!$token) {
            return $this->errorResponse('Invalid credentials', 401);
        }

        return $this->successResponse(
            $this->authService->respondWithToken($token),
            'Login successful'
        );
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();

        return $this->successResponse(null, 'Successfully logged out');
    }

    public function refresh(): JsonResponse
    {
        $token = $this->authService->refresh();

        return $this->successResponse(
            $this->authService->respondWithToken($token),
            'Token refreshed'
        );
    }

    public function me(): JsonResponse
    {
        return $this->successResponse($this->authService->me(), 'User profile retrieved');
    }
}
