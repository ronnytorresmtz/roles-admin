<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();

        Country::create(array(
            'country_name'                     => 'USA',
            'country_description'              => 'United States',
        ));

        Country::create(array(
            'country_name'                     => 'Mex',
            'country_description'              => 'México',
        ));



    }
}
