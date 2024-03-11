<?php

namespace Database\Seeders;

use App\Models\InsuranceQuote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class InsuranceQuoteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table((new InsuranceQuote())->getTable())
            ->insert(
                $this->getDefaultInsuranceQuotes()
                ->map(fn ($quote) => [...$quote, 'created_at' => now(), 'updated_at' => now()])
                ->toArray()
            );
    }

    public function getDefaultInsuranceQuotes(): Collection
    {
        return collect([
           [
               'name' => 'Home',
               'sub_title' => 'Your current or soon-to-be home',
               'icon' => 'fa-house'
           ],
            [
               'name' => 'Auto',
               'sub_title' => 'Your personal vehicle(s)',
               'icon' => 'fa-gear'
           ],
            [
               'name' => 'Recreational Vehicle',
               'sub_title' => 'Your boat RV, motorcycle, etc',
               'icon' => 'fa-car'
           ],
        ]);
    }
}
