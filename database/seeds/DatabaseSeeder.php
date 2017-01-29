<?php

use Illuminate\Database\Seeder as Seeder;


class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();


		// configuration for startup
		$this->call('RolesTableSeeder');
		$this->call('RolesTransactionsTableSeeder');
		$this->call('TransactionActionsTableSeeder');
		$this->call('UsersTableSeeder'); 				
		$this->call('UsersActionsLogTableSeeder');	
		$this->call('LanguagesTableSeeder');		
		$this->call('ModulesTableSeeder');		
		$this->call('TransactionsTableSeeder');		
		//TableSeeder_Template Don´t Delete this Line

		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		



		
	}

}
