<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->delete();

        Plan::create(array(
            'plan_id'                       => 'Texto Uno',
            'plan_name'                     => 'Texto Uno',
            'plan_description'              => 'Texto Texto Texto Texto Texto Texto',
        ));


         Plan::create(array(
            'plan_id'                       => 'Texto Dos',
            'plan_name'                     => 'Texto Dos',
            'plan_description'              => 'Texto Texto Texto Texto Texto Texto',
        ));

    }
}
