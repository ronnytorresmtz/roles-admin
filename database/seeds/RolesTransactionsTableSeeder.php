<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

use Illuminate\Database\Seeder as Seeder;


class RolesTransactionsTableSeeder extends Seeder {

	public function run()
		{
			DB::table('roles_transactions')->delete();

			//Admin System
			RoleTransaction::create(['role_id' => 1, 'module_id' => 1, 'transaction_id' => 1, 'transaction_action_id' => 3]);   //Dashboard -Collection
				RoleTransaction::create(['role_id' => 1, 'module_id' => 1, 'transaction_id' => 2, 'transaction_action_id' => 3]);   //Dashboard -Payments
				RoleTransaction::create(['role_id' => 1, 'module_id' => 1, 'transaction_id' => 3, 'transaction_action_id' => 3]);   //Dashboard -Inventory
				RoleTransaction::create(['role_id' => 1, 'module_id' => 1, 'transaction_id' => 4, 'transaction_action_id' => 3]);   //Dashboard -Assets
				RoleTransaction::create(['role_id' => 1, 'module_id' => 1, 'transaction_id' => 5, 'transaction_action_id' => 3]);   //Dashboard -Requests
				RoleTransaction::create(['role_id' => 1, 'module_id' => 1, 'transaction_id' => 6, 'transaction_action_id' => 3]);   //Dashboard -Authorizations
				RoleTransaction::create(['role_id' => 1, 'module_id' => 1, 'transaction_id' => 7, 'transaction_action_id' => 3]);   //Dashboard -Achievement
				RoleTransaction::create(['role_id' => 1, 'module_id' => 1, 'transaction_id' => 8, 'transaction_action_id' => 3]);   //Dashboard -Absenteeism
				RoleTransaction::create(['role_id' => 1, 'module_id' => 1, 'transaction_id' => 9, 'transaction_action_id' => 3]);   //Dashboard -Discipline

				RoleTransaction::create(['role_id' => 1, 'module_id' => 2, 'transaction_id' => 10, 'transaction_action_id' => 3]);   //Facilities -Institute
				RoleTransaction::create(['role_id' => 1, 'module_id' => 2, 'transaction_id' => 11, 'transaction_action_id' => 3]);   //Facilities -Campus
				RoleTransaction::create(['role_id' => 1, 'module_id' => 2, 'transaction_id' => 12, 'transaction_action_id' => 3]);   //Facilities -Buildings
				RoleTransaction::create(['role_id' => 1, 'module_id' => 2, 'transaction_id' => 13, 'transaction_action_id' => 3]);   //Facilities -Departments
				RoleTransaction::create(['role_id' => 1, 'module_id' => 2, 'transaction_id' => 14, 'transaction_action_id' => 3]);   //Facilities -Offices
				RoleTransaction::create(['role_id' => 1, 'module_id' => 2, 'transaction_id' => 15, 'transaction_action_id' => 3]);   //Facilities -Classrooms
				RoleTransaction::create(['role_id' => 1, 'module_id' => 2, 'transaction_id' => 16, 'transaction_action_id' => 3]);   //Facilities -Court
				RoleTransaction::create(['role_id' => 1, 'module_id' => 2, 'transaction_id' => 17, 'transaction_action_id' => 3]);   //Facilities -Warehouses

				RoleTransaction::create(['role_id' => 1, 'module_id' => 3, 'transaction_id' => 18, 'transaction_action_id' => 3]);   //Academic -Cycles
				RoleTransaction::create(['role_id' => 1, 'module_id' => 3, 'transaction_id' => 19, 'transaction_action_id' => 3]);   //Academic -Levels
				RoleTransaction::create(['role_id' => 1, 'module_id' => 3, 'transaction_id' => 20, 'transaction_action_id' => 3]);   //Academic -Plans
				RoleTransaction::create(['role_id' => 1, 'module_id' => 3, 'transaction_id' => 21, 'transaction_action_id' => 3]);   //Academic -Programs
				RoleTransaction::create(['role_id' => 1, 'module_id' => 3, 'transaction_id' => 22, 'transaction_action_id' => 3]);   //Academic -Courses
				RoleTransaction::create(['role_id' => 1, 'module_id' => 3, 'transaction_id' => 23, 'transaction_action_id' => 3]);   //Academic -Subjects
				RoleTransaction::create(['role_id' => 1, 'module_id' => 3, 'transaction_id' => 24, 'transaction_action_id' => 3]);   //Academic -Schedule
				RoleTransaction::create(['role_id' => 1, 'module_id' => 3, 'transaction_id' => 25, 'transaction_action_id' => 3]);   //Academic -Evaluations
				RoleTransaction::create(['role_id' => 1, 'module_id' => 3, 'transaction_id' => 26, 'transaction_action_id' => 3]);   //Academic -Assigments
				RoleTransaction::create(['role_id' => 1, 'module_id' => 3, 'transaction_id' => 27, 'transaction_action_id' => 3]);   //Academic -Grades

				RoleTransaction::create(['role_id' => 1, 'module_id' => 4, 'transaction_id' => 28, 'transaction_action_id' => 3]);  //Resources -Employees
				RoleTransaction::create(['role_id' => 1, 'module_id' => 4, 'transaction_id' => 29, 'transaction_action_id' => 3]);   //Academic -Teachers
				RoleTransaction::create(['role_id' => 1, 'module_id' => 4, 'transaction_id' => 30, 'transaction_action_id' => 3]);   //Academic -Students
				RoleTransaction::create(['role_id' => 1, 'module_id' => 4, 'transaction_id' => 31, 'transaction_action_id' => 3]);   //Resources -Suppliers
				

				RoleTransaction::create(['role_id' => 1, 'module_id' => 5, 'transaction_id' => 32, 'transaction_action_id' => 3]);   //Inventory -Products
				RoleTransaction::create(['role_id' => 1, 'module_id' => 5, 'transaction_id' => 33, 'transaction_action_id' => 3]);   //Inventory -Receives
				RoleTransaction::create(['role_id' => 1, 'module_id' => 5, 'transaction_id' => 34, 'transaction_action_id' => 3]);   //Inventory -Inventory
				RoleTransaction::create(['role_id' => 1, 'module_id' => 5, 'transaction_id' => 35, 'transaction_action_id' => 3]);   //Inventory -Deliveries
				RoleTransaction::create(['role_id' => 1, 'module_id' => 5, 'transaction_id' => 36, 'transaction_action_id' => 3]);   //Inventory -Transfers
				RoleTransaction::create(['role_id' => 1, 'module_id' => 5, 'transaction_id' => 37, 'transaction_action_id' => 3]);   //Inventory -Returns
				RoleTransaction::create(['role_id' => 1, 'module_id' => 5, 'transaction_id' => 38, 'transaction_action_id' => 3]);   //Inventory -Adjustments

				RoleTransaction::create(['role_id' => 1, 'module_id' => 6, 'transaction_id' => 39, 'transaction_action_id' => 3]);   //Assets -Assets
				RoleTransaction::create(['role_id' => 1, 'module_id' => 6, 'transaction_id' => 40, 'transaction_action_id' => 3]);   //Assets -Locations
				RoleTransaction::create(['role_id' => 1, 'module_id' => 6, 'transaction_id' => 41, 'transaction_action_id' => 3]);   //Assets -Maintenance
				RoleTransaction::create(['role_id' => 1, 'module_id' => 6, 'transaction_id' => 42, 'transaction_action_id' => 3]);   //Assets -Check-Out
				RoleTransaction::create(['role_id' => 1, 'module_id' => 6, 'transaction_id' => 43, 'transaction_action_id' => 3]);   //Assets -Check-In
				RoleTransaction::create(['role_id' => 1, 'module_id' => 6, 'transaction_id' => 44, 'transaction_action_id' => 3]);   //Assets -Costs
				
				RoleTransaction::create(['role_id' => 1, 'module_id' => 7, 'transaction_id' => 45, 'transaction_action_id' => 3]);   //Services -Request
				RoleTransaction::create(['role_id' => 1, 'module_id' => 7, 'transaction_id' => 46, 'transaction_action_id' => 3]);   //Services -Authorizations
				RoleTransaction::create(['role_id' => 1, 'module_id' => 7, 'transaction_id' => 47, 'transaction_action_id' => 3]);   //Services -Assigments
				RoleTransaction::create(['role_id' => 1, 'module_id' => 7, 'transaction_id' => 48, 'transaction_action_id' => 3]);   //Services -Scheduling
				RoleTransaction::create(['role_id' => 1, 'module_id' => 7, 'transaction_id' => 49, 'transaction_action_id' => 3]);   //Services -Status

				RoleTransaction::create(['role_id' => 1, 'module_id' => 8, 'transaction_id' => 50, 'transaction_action_id' => 3]);   //Treasury -Fees
				RoleTransaction::create(['role_id' => 1, 'module_id' => 8, 'transaction_id' => 51, 'transaction_action_id' => 3]);   //Treasury -Collection
				RoleTransaction::create(['role_id' => 1, 'module_id' => 8, 'transaction_id' => 52, 'transaction_action_id' => 3]);   //Treasury -Invoicing
				RoleTransaction::create(['role_id' => 1, 'module_id' => 8, 'transaction_id' => 53, 'transaction_action_id' => 3]);   //Treasury -Purchasing
				RoleTransaction::create(['role_id' => 1, 'module_id' => 8, 'transaction_id' => 54, 'transaction_action_id' => 3]);   //Treasury -Autorizations
				RoleTransaction::create(['role_id' => 1, 'module_id' => 8, 'transaction_id' => 55, 'transaction_action_id' => 3]);   //Treasury -Payments
				RoleTransaction::create(['role_id' => 1, 'module_id' => 8, 'transaction_id' => 56, 'transaction_action_id' => 3]);   //Treasury -Salaries

				RoleTransaction::create(['role_id' => 1, 'module_id' => 9, 'transaction_id' => 57, 'transaction_action_id' => 3]);   //Security -Dashboard
				RoleTransaction::create(['role_id' => 1, 'module_id' => 9, 'transaction_id' => 58, 'transaction_action_id' => 3]);   //Security -Users
				RoleTransaction::create(['role_id' => 1, 'module_id' => 9, 'transaction_id' => 59, 'transaction_action_id' => 3]);   //Security -Roles
				RoleTransaction::create(['role_id' => 1, 'module_id' => 9, 'transaction_id' => 60, 'transaction_action_id' => 3]);   //Security -Access Rights
				RoleTransaction::create(['role_id' => 1, 'module_id' => 9, 'transaction_id' => 61, 'transaction_action_id' => 3]);   //Security -Modules
				RoleTransaction::create(['role_id' => 1, 'module_id' => 9, 'transaction_id' => 62, 'transaction_action_id' => 3]);   //Security -Transactions

				RoleTransaction::create(['role_id' => 1, 'module_id' => 10, 'transaction_id' => 63, 'transaction_action_id' => 3]);   //Settings -Configuration
				RoleTransaction::create(['role_id' => 1, 'module_id' => 10, 'transaction_id' => 64, 'transaction_action_id' => 3]);   //Settings -Notifications
				RoleTransaction::create(['role_id' => 1, 'module_id' => 10, 'transaction_id' => 65, 'transaction_action_id' => 3]);   //Settings -Maintainance Tasks
				RoleTransaction::create(['role_id' => 1, 'module_id' => 10, 'transaction_id' => 66, 'transaction_action_id' => 3]);   //Services -Task Schedule
				RoleTransaction::create(['role_id' => 1, 'module_id' => 10, 'transaction_id' => 67, 'transaction_action_id' => 3]);   //Services -Application Log

				RoleTransaction::create(['role_id' => 1, 'module_id' => 11, 'transaction_id' => 68, 'transaction_action_id' => 3]);   //Settings -Countries
				RoleTransaction::create(['role_id' => 1, 'module_id' => 11, 'transaction_id' => 69, 'transaction_action_id' => 3]);   //Settings -States
				RoleTransaction::create(['role_id' => 1, 'module_id' => 11, 'transaction_id' => 70, 'transaction_action_id' => 3]);   //Settings -Cities
				RoleTransaction::create(['role_id' => 1, 'module_id' => 11, 'transaction_id' => 71, 'transaction_action_id' => 3]);   //Services -Languagues

			// Administrator
						// Principal
						// Coordinators
			//Teachers
								
			// Students
				
	}
}


