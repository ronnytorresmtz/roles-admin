<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

use Illuminate\Database\Seeder as Seeder;


class TransactionActionsTableSeeder extends Seeder {

	public function run()
		{
			DB::table('transaction_actions')->delete();

			DB::table('transaction_actions')->insert(array(
				array(
					'transaction_action_name'        => 'No Access Allowed',	
					'transaction_action_description' => 'User can not access the transaction'	
				),

				array(
					'transaction_action_name'        => 'Read Only Access',	
					'transaction_action_description' => 'User can access the transaction in a read mode'
				),

				array(
					'transaction_action_name'        => 'Read And Write Access',	
					'transaction_action_description' => 'User can access the transaction in a read and write mode'
				)

			));
	        
		}
}