<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogoutUserController extends Controller
{
    public function __invoke(Request $request): ApiSuccessResponse
    {
        $request->user()->tokens()->delete();

        return new ApiSuccessResponse(
            data: null,
            message: 'Logged out successfully!',
            status: Response::HTTP_OK
        );
    }
}
