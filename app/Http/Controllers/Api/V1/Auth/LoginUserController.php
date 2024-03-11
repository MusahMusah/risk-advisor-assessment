<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginUserController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function __invoke(LoginRequest $request): ApiSuccessResponse
    {
        $user = User::whereEmail($request->email)->first();

        if (! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => [
                    'The provided credentials are incorrect.',
                ],
            ]);
        }

        return new ApiSuccessResponse(
            data: [
                'token' => $user->createToken('mobile')->plainTextToken,
            ],
            message: 'Token created successfully',
            status: Response::HTTP_CREATED
        );
    }
}
