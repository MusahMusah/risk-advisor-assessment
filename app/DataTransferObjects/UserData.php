<?php

namespace App\DataTransferObjects;

use App\Concerns\Enums\ContactPreferenceEnum;
use App\Models\InsuranceQuote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Illuminate\Validation\Rules;
use Spatie\LaravelData\Lazy;

final class UserData extends Data
{
    public function __construct(
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $email,
        public readonly string $phone,
        #[WithCast(EnumCast::class)]
        public readonly ?ContactPreferenceEnum $contact_preference,
        public readonly ?string $password,
        public readonly null|Lazy|SubmissionData $submission,
        public readonly ?array $selectedQuotes,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return self::from([
            ...$request->all(),
        ]);
    }

    public static function fromModel(User $user): self
    {
        return self::from([
            ...$user->toArray(),
        ])->except('password');
    }

    public static function rules(): array
    {
        return [
            'first_name' => ['string', 'min:3', 'required'],
            'last_name' => ['string', 'min:3', 'required'],
            'email' => [
                'string',
                'min:3',
                'max:255',
                'required',
                'email',
                'lowercase',
            ],
            'phone' => ['string', 'required'],
            'contact_preference' => ['string', 'min:3', 'required', new Enum(ContactPreferenceEnum::class)],
            'password' => ['sometimes', 'required', 'confirmed', Rules\Password::defaults()],
            'selectedQuotes' => ['array', 'required'],
            'selectedQuotes.*' => [Rule::exists(InsuranceQuote::class, 'id')],
            'submission' => ['array', 'required'],
            'submission.city' => ['string', 'required'],
            'submission.state' => ['string', 'required'],
            'submission.zip_code' => ['numeric', 'required'],
        ];
    }
}
