<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->delete();

        State::create(array(
            'country_id'                     => '1',
            'state_name'                     => 'TX',
            'state_description'              => 'Texas',
        ));

        State::create(array(
            'country_id'                     => '1',
            'state_name'                     => 'NJ',
            'state_description'              => 'New Jersey',
        ));

        State::create(array(
            'country_id'                     => '2',
            'state_name'                     => 'NL',
            'state_description'              => 'Nuevo León',
        ));

        State::create(array(
            'country_id'                     => '2',
            'state_name'                     => 'DF',
            'state_description'              => 'Distrito Federal',
        ));


    }
}
