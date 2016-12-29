<?php

use Illuminate\Database\Seeder;

class CampussTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campuss')->delete();

        Campus::create(array(
            'institute_id'                     => '1',
            'campus_name'                     => 'Campus Mederos',
            'campus_description'              => 'Campus Mederos - Primaria y Secundaria',
        ));


         Campus::create(array(
            'institute_id'                     => '1',
            'campus_name'                     => 'Campus Cortijo',
            'campus_description'              => 'Campus Cortijo - Kinder',
        ));

    }
}
