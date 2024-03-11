<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\DataTransferObjects\UserData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;

class UsersMeController extends Controller
{
    public function __invoke(): ApiSuccessResponse|UserData
    {
        return new ApiSuccessResponse(
            data: UserData::from(auth()->user()),
            message: 'User data retrieved successfully.'
        );
    }
}
