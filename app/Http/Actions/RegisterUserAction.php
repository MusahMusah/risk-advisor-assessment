<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\DataTransferObjects\UserData;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterUserAction
{
    public function execute(UserData $data): Model|Builder
    {
        return DB::transaction(function () use ($data) {
            $user = User::whereEmail($data->email)->first();

            if (!$user) {
                $user = User::query()->create([
                    'first_name' => $data->first_name,
                    'last_name' => $data->last_name,
                    'email' => $data->email,
                    'phone' => $data->phone,
                    'contact_preference' => $data->contact_preference,
                    'password' => Hash::make($data->password)
                ]);
            }

            $submission = $user->submissions()->create($data->submission->toArray());

            $submission->insuranceQuotes()->attach($data->selectedQuotes);

            return $user;
        });
    }
}
