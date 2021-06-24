<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = Config::get('seedsdata.languages');
        
        foreach($languages as $code => $title) {

            Language::create([
                'lang'  => trim($code, " \t\n\r\0\x0B"),
                'title' => trim($title, " \t\n\r\0\x0B"),
                'img'   => trim($code, " \t\n\r\0\x0B"). '.png'
            ]);
        }
    }
}
