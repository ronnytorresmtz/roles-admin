<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->delete();

        Language::create(array(
            'language_name'                     => 'en',
            'language_description'              => 'English',
        ));


         Language::create(array(
            'language_name'                     => 'sp',
            'language_description'              => 'Spanish',
        ));

    }
}
