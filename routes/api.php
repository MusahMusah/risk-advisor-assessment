<?php

use App\Http\Controllers\Api\V1\Auth\LoginUserController;
use App\Http\Controllers\Api\V1\Auth\LogoutUserController;
use App\Http\Controllers\Api\V1\Auth\RegisterUserController;
use App\Http\Controllers\Api\V1\Users\UsersMeController;
use Illuminate\Support\Facades\Route;


Route::post('register', RegisterUserController::class)->name('auth.register');
Route::post('login', LoginUserController::class)->name('auth.login');

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('/users/me', UsersMeController::class)->name('users.me');
        Route::post('logout', LogoutUserController::class)->name('auth.logout');
    });
