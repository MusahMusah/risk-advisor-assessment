<?php

use App\Models\InsuranceQuote;
use App\Models\Submission;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Hash;

it('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

it('ensures consumers can submit their information for different insurance quotes', function () {
    InsuranceQuote::factory()->count(3)->create();
    $hashedPassword = Hash::make('password');
    $insuranceQuotes = InsuranceQuote::query()
        ->select('id')
        ->pluck('id')
        ->toArray();

    $response = $this->post('/register', [
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

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

it('ensures that validation errors are thrown when necessary', function () {
    $this->expectException(\Illuminate\Validation\ValidationException::class);

    InsuranceQuote::factory()->count(3)->create();
    $hashedPassword = Hash::make('password');

    $response = $this->post('/register', [
        ...(new UserSeeder())->getDemoUserData(),
        'password' => $hashedPassword,
        'password_confirmation' => $hashedPassword,
    ]);

    $response
        ->assertRedirect()
        ->assertJsonMissingValidationErrors(['selectedQuotes'])
        ->assertInvalid('selectedQuotes');

    $this->assertGuest();
});

it('ensures that submission contains insurance quotes', function () {
    InsuranceQuote::factory()->count(3)->create();
    $hashedPassword = Hash::make('password');
    $insuranceQuotes = InsuranceQuote::query()
        ->select('id')
        ->pluck('id')
        ->toArray();

    $this->post('/register', [
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

    $this->assertNotEmpty(auth()->user()->submissions->load('insuranceQuotes')->first()->insuranceQuotes);
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

        $response = $this->post('/register', [
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


        $this->assertAuthenticated();
        $this->assertCount(1, User::all());
        $this->assertCount(2, $user->submissions);
        $response->assertRedirect(RouteServiceProvider::HOME);
    });
