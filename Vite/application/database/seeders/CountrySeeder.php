<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usaStates = [
            "AL" => 'Alabama',
            "AS" => 'Alaska',
            "AZ" => 'Arizona',
            "Tx" => 'Texas',
            "CA" => 'California',
        ];
        $countries = [
            ['code' => 'geo', 'name' => 'Georgia', 'states'=> null],
            ['code' => 'ind', 'name' => 'India', 'states'=> null],
            ['code' => 'ger', 'name' => 'Germany', 'states'=> null],
            ['code' => 'usa', 'name' => 'United States of America', 'states'=> json_encode($usaStates)],
        ];
        Country::insert($countries);

    }
}
