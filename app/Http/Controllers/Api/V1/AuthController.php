<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\JsonResponse;
use App\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {
        $result = $this->authService->register($request->validated());
        return response()->json($result['message'],$result['code']);
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        $result = $this->authService->login($request->validated());
        return response()->json($result['message'],$result['code']);
    }

    public function logout(): JsonResponse
    {
        $result = $this->authService->logout();
        return response()->json($result['message'],$result['code']);
    }
}
