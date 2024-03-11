<?php

namespace App\DataTransferObjects;

use App\Models\Submission;
use Spatie\LaravelData\Data;

class SubmissionData extends Data
{
    public function __construct(
        public readonly ?string $address,
        public readonly ?string $apartment_no,
        public readonly string $city,
        public readonly string $state,
        public readonly string $zip_code,
    ) {
    }

    public static function fromModel(Submission $submission): self
    {
        return self::from([
            ...$submission->toArray(),
        ]);
    }

    public static function rules(): array
    {
        return [
            'address' => ['string', 'nullable', 'min:3', 'max:255'],
            'apartment_no' => ['string', 'nullable', 'min:3', 'max:255'],
            'city' => ['string', 'required', 'max:255'],
            'state' => ['string', 'required', 'max:255'],
            'zip_code' => ['numeric', 'required', 'min:5'],
        ];
    }
}
