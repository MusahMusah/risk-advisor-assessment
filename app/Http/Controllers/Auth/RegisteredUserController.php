<?php

namespace App\Http\Controllers\Auth;

use App\DataTransferObjects\UserData;
use App\Http\Actions\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Models\InsuranceQuote;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    public function create(): Response
    {
        $insuranceQuotes = InsuranceQuote::all(['id', 'name', 'icon', 'sub_title']);

        return Inertia::render('Auth/Register', ['insuranceQuotes' => $insuranceQuotes]);
    }

    public function store(UserData $data, RegisterUserAction $action): RedirectResponse
    {
        $user = $action->execute(data: $data);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
