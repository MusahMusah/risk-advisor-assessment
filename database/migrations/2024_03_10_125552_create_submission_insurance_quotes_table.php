<?php

use App\Models\InsuranceQuote;
use App\Models\Submission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('submission_insurance_quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(InsuranceQuote::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Submission::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_insurance_quotes');
    }
};
