<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

use Illuminate\Database\Seeder as Seeder;


class ProgramsTableSeeder extends Seeder {

	public function run()
		{
			DB::table('programs')->delete();

			Program::create(array(
				'program_id'          => 'Nuevo 1',
				'program_name'        => 'Nuevo 1',	
				'program_description' => 'Nuevo 1'
			));

	        
		}
}