<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [];
        
        $countries = collect(json_decode(trim(file_get_contents(__DIR__.'/../../countries.json')), true));

        foreach($countries as $country) {
            $newArray = [
                'code' => $country['countryCode'],
                'name' => $country['countryNameEn'],
                'currency_code' => $country['currencyCode'],
                'calling_code' => str_replace(' ', '', ($country['countryCallingCode'])),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $array[] = $newArray;
        }

        DB::table('countries')->insert($array);
    }
}
