<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;


test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->postJson(route('api.auth.login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertCreated();
});

test('can get loggedIn user data', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->getJson(route('api.users.me'))
        ->assertOk();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post(route('api.auth.login'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('api.auth.logout'));

    expect($user->fresh()->tokens)->toBeEmpty();
});
