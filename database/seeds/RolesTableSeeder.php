<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

use Illuminate\Database\Seeder as Seeder;


class RolesTableSeeder extends Seeder {

	public function run()
		{
			DB::table('roles')->delete();

			Role::create(array(
				'role_name'        => 'System Admin',
				'role_description' => 'Role for the System Administror'
			));

			Role::create(array(
				'role_name'        => 'Administrators',
				'role_description' => 'Role for User Administror'
			));

			Role::create(array(
				'role_name'        => 'Principal',
				'role_description' => 'Role for Principal'
			));

			Role::create(array(
				'role_name'        => 'Coordinators',
				'role_description' => 'Role for User Supervisors'
			));

			Role::create(array(
				'role_name'        => 'Teachers',	
				'role_description' => 'Role for Teachers'
			));

			Role::create(array(
				'role_name'        => 'Employees',
				'role_description' => 'Role for Employees'	
			));

			Role::create(array(
				'role_name'        => 'Students',
				'role_description' => 'Role for Students'
			));

			Role::create(array(
				'role_name'        => 'Parents',
				'role_description' => 'Role for Parents'	
			));

			Role::create(array(
				'role_name'        => 'Sport Coaches',
				'role_description' => 'Role for Sport Coaches'	
			));

			Role::create(array(
				'role_name'        => 'Secretaries',
				'role_description' => 'Role for Secretaries'	
			));


	        
		}
}