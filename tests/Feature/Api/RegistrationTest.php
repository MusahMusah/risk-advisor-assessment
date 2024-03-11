<?php

use App\Models\InsuranceQuote;
use App\Models\Submission;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Hash;

it('ensures consumers api can submit their information for different insurance quotes', function () {
    InsuranceQuote::factory()->count(3)->create();
    $hashedPassword = Hash::make('password');
    $insuranceQuotes = InsuranceQuote::query()
        ->select('id')
        ->pluck('id')
        ->toArray();

    $response = $this->postJson(route('api.auth.register'), [
        ...(new UserSeeder())->getDemoUserData(),
        'password' => $hashedPassword,
        'password_confirmation' => $hashedPassword,
        'selectedQuotes' => $insuranceQuotes,
        'submission' => [
            'address' => '56 F5 Street Citec Estate',
            'apartment_number' => '56 F5',
            'city' => 'Jabi',
            'state' => 'FCT Abuja',
            'zip_code' => 900109
        ]
    ]);

    $response->assertJson($response->getOriginalContent());
});

it('ensures that validation errors are thrown when necessary', function () {
    $this->expectException(\Illuminate\Validation\ValidationException::class);

    InsuranceQuote::factory()->count(3)->create();
    $hashedPassword = Hash::make('password');

    $response = $this->post(route('api.auth.register'), [
        ...(new UserSeeder())->getDemoUserData(),
        'password' => $hashedPassword,
        'password_confirmation' => $hashedPassword,
    ]);

    $response
        ->assertJsonMissingValidationErrors(['selectedQuotes'])
        ->assertInvalid('selectedQuotes');

    $this->assertGuest();
});

it('ensures that new user is not created if already exist but rather create a new submission for the user',
    function () {
        InsuranceQuote::factory()->count(3)->create();
        $hashedPassword = Hash::make('password');
        $insuranceQuotes = InsuranceQuote::query()
            ->select('id')
            ->pluck('id')
            ->toArray();
        $user = User::factory()->create([
            ...(new UserSeeder())->getDemoUserData(),
        ]);

        Submission::factory()
            ->count(1)
            ->has(InsuranceQuote::factory()->count(3))
            ->create([
                'user_id' => $user->id
            ]);

        $this->post(route('api.auth.register'), [
            ...(new UserSeeder())->getDemoUserData(),
            'password' => $hashedPassword,
            'password_confirmation' => $hashedPassword,
            'selectedQuotes' => $insuranceQuotes,
            'submission' => [
                'address' => '56 F5 Street Citec Estate',
                'apartment_number' => '56 F5',
                'city' => 'Jabi',
                'state' => 'FCT Abuja',
                'zip_code' => 900109
            ]
        ]);


        $this->assertCount(1, User::all());
    });
