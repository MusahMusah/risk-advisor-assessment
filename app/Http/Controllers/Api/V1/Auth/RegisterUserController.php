<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\DataTransferObjects\UserData;
use App\Http\Actions\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use Illuminate\Auth\Events\Registered;
use Symfony\Component\HttpFoundation\Response;

class RegisterUserController extends Controller
{
    public function __invoke(UserData $data, RegisterUserAction $action): ApiSuccessResponse
    {
        $user = $action->execute(data: $data);

        event(new Registered($user));

        return new ApiSuccessResponse(
            data: [
                'token' => $user->createToken('mobile')->plainTextToken,
            ],
            message: 'Token created successfully',
            status: Response::HTTP_CREATED
        );
    }
}
