<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

use Illuminate\Database\Seeder as Seeder;


class UsersTableSeeder extends Seeder {

	public function run()
		{
			DB::table('users')->delete();

			User::create(array(
				//'person_id' => 0,
				'username'      => 'sysadmin',	
				'user_fullname' => 'System Administrator',
				'password'      => Hash::make('@admin2015@'),
				'email'         => 'ronnytorres@gmail.com',
				'role_id'       => 1,
				'logged_at'     => '25-09-2014'
			));

			User::create(array(
				//'person_id' => 1,
				'username'      => 'demo_user',
				'user_fullname' => 'Demostration User',
				'password'      => Hash::make('demo123'),
				'email'         => 'demo123@hotmail.com',
				'role_id'       => 1,
				'logged_at'     => '25-09-2014'
			));

	        User::create(array(
				//'person_id' => 1,
				'username'      => 'rtorresmtz',
				'user_fullname' => 'Rolando Torres',
				'password'      => Hash::make('rtorres'),
				'email'         => 'rtorresmtz@hotmail.com',
				'role_id'       => 1,
				'logged_at'     => '25-09-2014'
			));

			User::create(array(
				//'person_id' => 0,
				'username'      => 'cgarza2004',	
				'user_fullname' => 'Cesar Garza',
				'password'      => Hash::make('cgarza2004'),
				'email'         => 'rolatorres1@gmail.com',
				'role_id'       => 1,
				'logged_at'     => '25-09-2014'
			));

	        User::create(array(
				//'person_id' => 1,
				'username'      => 'mgonzalez',
				'user_fullname' => 'Monfornt Gonzalez',
				'password'      => Hash::make('mgonzalez'),
				'email'         => 'rtorresmtz2@hotmail.com',
				'role_id'       => 1,
				'logged_at'     => '25-09-2014'
			));
		}
}