<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();

        City::create(array(
            'country_id'       => 1,
            'state_id'         => 1,
            'city_name'        => 'HOS',
            'city_description' => 'Houston',
        ));

         City::create(array(
            'country_id'       => 1,
            'state_id'         => 2,
            'city_name'        => 'NY',
            'city_description' => 'Nueva York',
        ));


        City::create(array(
            'country_id'       => 2,
            'state_id'         => 3,
            'city_name'        => 'MTY',
            'city_description' => 'Monterrey',
        ));

        City::create(array(
            'country_id'       => 2,
            'state_id'         => 3,
            'city_name'        => 'APO',
            'city_description' => 'Apodaca',
        ));

        City::create(array(
            'country_id'       => 2,
            'state_id'         => 4,
            'city_name'        => 'DF',
            'city_description' => 'Distrito Federal',
        ));

    }
}
