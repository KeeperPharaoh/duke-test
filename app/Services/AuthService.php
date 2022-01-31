<?php

namespace App\Services;

use App\Domain\Contracts\UserContract;
use App\Domain\Repositories\UserRepository;
use App\Responses\ApiResponse;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data): array
    {
        $data['password'] = bcrypt($data['password']);

        try {
            DB::beginTransaction();
            $user = $this->userRepository->create($data);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return ApiResponse::failure(
                REGISTER_FAIL,
                Response::HTTP_CONFLICT
            );
        }

        $success['token'] = $user->createToken('Duke-Test')->plainTextToken;
        $success['user']  = [
            'name'  => $user->name,
            'phone' => $user->email,
        ];

        return ApiResponse::success(
            $success,
            Response::HTTP_OK
        );
    }

    public function login(array $data): array
    {
        $email    = $data['email'];
        $password = $data['password'];

        if (Auth::attempt([
                              UserContract::EMAIL    => $email,
                              UserContract::PASSWORD => $password,
                          ])) {
            $user    = Auth::user();
            $success = ['token' => $user->createToken('Duke-Test')->plainTextToken];

            return ApiResponse::success(
                $success, Response::HTTP_OK
            );
        }

        return ApiResponse::failure(
            REGISTER_FAIL,
            Response::HTTP_FORBIDDEN
        );
    }

    /** @noinspection PhpUndefinedFieldInspection */
    public function logout(): array
    {
        Auth::user()->tokens->each(function ($token) {
            $token->delete();
        });

        return ApiResponse::success(
            SUCCESSFULLY_EXIT, Response::HTTP_OK
        );
    }
}
