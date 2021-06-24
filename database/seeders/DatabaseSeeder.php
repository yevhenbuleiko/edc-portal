<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Currency;
use App\Models\Language;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        if(Currency::all()->count() == 0) {
            $this->call(CurrencySeeder::class);
        }
        if(Language::all()->count() == 0) {
            $this->call(LanguageSeeder::class);
        }
    }
}
