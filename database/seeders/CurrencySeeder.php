<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = Config::get('seedsdata.currencies');
        
        foreach($currencies as $value) {

            $currencyArray = explode(",", $value);
            
            Currency::create([
                'code'      => trim($currencyArray[2], " \t\n\r\0\x0B"),
                'title'     => trim($currencyArray[1], " \t\n\r\0\x0B"),
                'country'   => trim($currencyArray[0], " \t\n\r\0\x0B"),
                'img'       => trim($currencyArray[2], " \t\n\r\0\x0B").".png",
                'html_code' => trim($currencyArray[3], " \t\n\r\0\x0B"),
            ]);
        }
    }
}
