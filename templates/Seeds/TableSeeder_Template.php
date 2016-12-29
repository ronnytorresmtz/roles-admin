<?php

use Illuminate\Database\Seeder;

class ucfirstModelTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modelTemplates')->delete();

        ucfirstModelTemplate::create(array(
            'modelTemplate_name'                     => 'Texto Uno',
            'modelTemplate_description'              => 'Texto Texto Texto Texto Texto Texto',
        ));


         ucfirstModelTemplate::create(array(
            'modelTemplate_name'                     => 'Texto Dos',
            'modelTemplate_description'              => 'Texto Texto Texto Texto Texto Texto',
        ));

    }
}
