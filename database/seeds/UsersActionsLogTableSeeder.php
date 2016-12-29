<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

use Illuminate\Database\Seeder as Seeder;


class UsersActionsLogTableSeeder extends Seeder {

	public function run()
		{

			$usernames = array('sysadmin', 'demo_user', 'rtorresmtz', 'cgarza2004','mgonzalez');

			$transactions =array(
				//Login
				'login.login.login', 'login.login.tokenMail', 'login.login.resetPassword',
				//Users
				'security.users.index', 'security.users.view', 'security.users.store', 'security.users.update', 
				'security.users.delete','security.users.import', 'security.users.export',
				'security.users.search', 'security.users.resetPassword'
			);
			

			UserActionLog::truncate();

			$faker = Faker\Factory::create();

			//foreach(range(1,1000000) as $index) 
			for ($i = 0; $i < 10000; $i++) {

				$transAction= explode('.', Lang::get($transactions[array_rand($transactions, 1)]));

				UserActionLog::create(array(
					'username'         => $usernames[array_rand($usernames, 1)],
					'module_name'	  	 => $transAction[0],
					'transaction_name' => $transAction[1],
					'action_name'      => $transAction[2],
					'created_at'       => $faker-> dateTimeBetween($startDate = '-4 years', $endDate = 'now')   //dateTimeThisYear($max = 'now') //date('Y-m-d H:i:s')
				));
			}


			/*UserActionLog::create(array(
					'username'    => 'sysadmin',
					'user_action' => Lang::get('transactions.login.login'),
					'created_at'  => date('Y-m-d H:i:s')
				));*/

	        
		}
}