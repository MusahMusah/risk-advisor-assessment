<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'apartment_no',
        'city',
        'state',
        'zip_code',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function insuranceQuotes(): BelongsToMany
    {
        return $this->belongsToMany(
            related: InsuranceQuote::class,
            table: SubmissionInsuranceQuote::class,
            foreignPivotKey: 'submission_id',
            relatedPivotKey: 'insurance_quote_id'
        );
    }
}
