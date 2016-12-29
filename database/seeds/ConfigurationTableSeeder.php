<?php

use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->delete();

        Configuration::create(array(
            'configuration_name'                     => 'Multi Institutes',
            'configuration_description'              => 'True',
        ));

        Configuration::create(array(
            'configuration_name'                     => 'Multi Campus',
            'configuration_description'              => 'True',
        ));

       
    }
}
