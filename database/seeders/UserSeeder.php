<?php

namespace Database\Seeders;

use App\Concerns\Enums\ContactPreferenceEnum;
use App\DataTransferObjects\UserData;
use App\Http\Actions\RegisterUserAction;
use App\Models\InsuranceQuote;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(RegisterUserAction $action): void
    {
        // Create a Demo User
        $user = User::query()->create($this->getDemoUserData());

        // Create a Consumer
        $submission = $user->submissions()->create($this->getSubmissionData());

        // Select consumer Insurance Quote
        $submission->insuranceQuotes()->sync(InsuranceQuote::all());
    }

    public function getDemoUserData(): array
    {
        return [
            'first_name' => 'Demo',
            'last_name' => 'User',
            'email' => 'demouser@riskadvisor.com',
            'phone' => '+234811127333',
            'contact_preference' => ContactPreferenceEnum::EMAIL->value,
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ];
    }

    private function getSubmissionData(): array
    {
        return [
            'address' => '56 F5 Street Citec Estate',
            'apartment_no' => '56 F5',
            'city' => 'Jabi',
            'state' => 'Abuja',
            'zip_code' => '90010'
        ];
    }
}
