<?php

use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->delete();

       DB::table('transactions')->delete();

            //Dashboard
            Transaction::create(['module_id' => 1, 'transaction_name' => 'Collection','transaction_description' => 'Graph Collection', 'transaction_order' => 1 ]);
            Transaction::create(['module_id' => 1, 'transaction_name' => 'Payments', 'transaction_description' => 'Graph Payments', 'transaction_order' => 2 ]);
            Transaction::create(['module_id' => 1, 'transaction_name' => 'Inventory', 'transaction_description' => 'Graph Inventory', 'transaction_order' => 3 ]);
            Transaction::create(['module_id' => 1, 'transaction_name' => 'Assets','transaction_description' => 'Graph Assets', 'transaction_order' => 4 ]);
            Transaction::create(['module_id' => 1, 'transaction_name' => 'Requests', 'transaction_description' => 'Graph Requests', 'transaction_order' => 5 ]);
            Transaction::create(['module_id' => 1, 'transaction_name' => 'Authorizations', 'transaction_description' => 'Graph Authorizations', 'transaction_order' => 6 ]);
            Transaction::create(['module_id' => 1, 'transaction_name' => 'Achievement', 'transaction_description' => 'Graph Achievement', 'transaction_order' => 7 ]);
            Transaction::create(['module_id' => 1, 'transaction_name' => 'Absenteeism', 'transaction_description' => 'Graph Absenteeism', 'transaction_order' => 8 ]);
            Transaction::create(['module_id' => 1, 'transaction_name' => 'Discipline', 'transaction_description' => 'Graph Discipline', 'transaction_order' => 9 ]);

            //Facilities
            Transaction::create(['module_id' => 2, 'transaction_name' => 'Institutes','transaction_description' => 'Information of the Institute', 'transaction_order' => 1 ]);
            Transaction::create(['module_id' => 2, 'transaction_name' => 'Campus', 'transaction_description' => 'Information of the Campus', 'transaction_order' => 2 ]);
            Transaction::create(['module_id' => 2, 'transaction_name' => 'Buildings', 'transaction_description' => 'Information of the Buildings', 'transaction_order' => 3 ]);
            Transaction::create(['module_id' => 2, 'transaction_name' => 'Departments','transaction_description' => 'Information of the Departments', 'transaction_order' => 4 ]);
            Transaction::create(['module_id' => 2, 'transaction_name' => 'Offices', 'transaction_description' => 'Information of the Offices', 'transaction_order' => 5 ]);
            Transaction::create(['module_id' => 2, 'transaction_name' => 'Classrooms', 'transaction_description' => 'Information of the Classrooms', 'transaction_order' => 6 ]);
            Transaction::create(['module_id' => 2, 'transaction_name' => 'Courts','transaction_description' => 'Information of the Courts', 'transaction_order' => 7 ]);
            Transaction::create(['module_id' => 5, 'transaction_name' => 'Warehouses','transaction_description' => 'Information of the Warehouses', 'transaction_order' => 8 ]);

            //Academic
            Transaction::create(['module_id' => 3, 'transaction_name' => 'Cycles','transaction_description' => 'Information of the Cycles', 'transaction_order' => 1 ]);
            Transaction::create(['module_id' => 3, 'transaction_name' => 'Levels', 'transaction_description' => 'Information of the Levels', 'transaction_order' => 2 ]);
            Transaction::create(['module_id' => 3, 'transaction_name' => 'Plans', 'transaction_description' => 'Information of the Plans', 'transaction_order' => 3 ]);
            Transaction::create(['module_id' => 3, 'transaction_name' => 'Programs','transaction_description' => 'Information of the Programs', 'transaction_order' => 4 ]);
            Transaction::create(['module_id' => 3, 'transaction_name' => 'Courses', 'transaction_description' => 'Information of the Courses', 'transaction_order' => 5 ]);
            Transaction::create(['module_id' => 3, 'transaction_name' => 'Subjects', 'transaction_description' => 'Information of the Subjects', 'transaction_order' => 6 ]);
            Transaction::create(['module_id' => 3, 'transaction_name' => 'Schedule','transaction_description' => 'Information of the Schedule', 'transaction_order' => 7 ]);
            Transaction::create(['module_id' => 3, 'transaction_name' => 'Evaluations','transaction_description' => 'Information of the Evaluations', 'transaction_order' => 10]);
            Transaction::create(['module_id' => 3, 'transaction_name' => 'Assignments', 'transaction_description' => 'Information of the Assigments', 'transaction_order' => 11]);
            Transaction::create(['module_id' => 3, 'transaction_name' => 'Grades', 'transaction_description' => 'Information of the Grades', 'transaction_order' => 12]);
            
            //Resources
            Transaction::create(['module_id' => 4, 'transaction_name' => 'Employees','transaction_description' => 'Information of the Employees', 'transaction_order' => 1 ]);
            Transaction::create(['module_id' => 4, 'transaction_name' => 'Teachers', 'transaction_description' => 'Information of the Teachers', 'transaction_order' => 2 ]);
            Transaction::create(['module_id' => 4, 'transaction_name' => 'Students', 'transaction_description' => 'Information of the Students', 'transaction_order' => 3 ]);
            Transaction::create(['module_id' => 4, 'transaction_name' => 'Suppliers', 'transaction_description' => 'Information of the Suppliers', 'transaction_order' => 4 ]);

            //Inventory
            Transaction::create(['module_id' => 5, 'transaction_name' => 'Products','transaction_description' => 'Information of the Products', 'transaction_order' => 1 ]);
            Transaction::create(['module_id' => 5, 'transaction_name' => 'Receives', 'transaction_description' => 'Information of the Receives', 'transaction_order' => 2 ]);
            Transaction::create(['module_id' => 5, 'transaction_name' => 'Inventory', 'transaction_description' => 'Information of the Inventory', 'transaction_order' => 3 ]);
            Transaction::create(['module_id' => 5, 'transaction_name' => 'Deliveries','transaction_description' => 'Information of the Deliveries', 'transaction_order' => 4 ]);
            Transaction::create(['module_id' => 5, 'transaction_name' => 'Transfers', 'transaction_description' => 'Information of the Transfers', 'transaction_order' => 5 ]);
            Transaction::create(['module_id' => 5, 'transaction_name' => 'Returns', 'transaction_description' => 'Information of the Returns', 'transaction_order' => 6 ]);
            Transaction::create(['module_id' => 5, 'transaction_name' => 'Adjustments','transaction_description' => 'Information of the Adjustments', 'transaction_order' => 7 ]);

            //Assets
            Transaction::create(['module_id' => 6, 'transaction_name' => 'Assets','transaction_description' => 'Information of the Assets', 'transaction_order' => 1 ]);
            Transaction::create(['module_id' => 6, 'transaction_name' => 'Locations', 'transaction_description' => 'Information of the Locations', 'transaction_order' => 2 ]);
            Transaction::create(['module_id' => 6, 'transaction_name' => 'Maintenance', 'transaction_description' => 'Information of the Maintenance', 'transaction_order' => 3 ]);
            Transaction::create(['module_id' => 6, 'transaction_name' => 'Check-Out','transaction_description' => 'Information of the Check-Out', 'transaction_order' => 4 ]);
            Transaction::create(['module_id' => 6, 'transaction_name' => 'Check-In', 'transaction_description' => 'Information of the Check-In', 'transaction_order' => 5 ]);
            Transaction::create(['module_id' => 6, 'transaction_name' => 'Costs', 'transaction_description' => 'Information of the Costs', 'transaction_order' => 6 ]);


            //Services
            Transaction::create(['module_id' => 7, 'transaction_name' => 'Requests','transaction_description' => 'Information of the Requests', 'transaction_order' => 1 ]);
            Transaction::create(['module_id' => 7, 'transaction_name' => 'Authorizations', 'transaction_description' => 'Information of the Authorizations', 'transaction_order' => 2 ]);
            Transaction::create(['module_id' => 7, 'transaction_name' => 'Assigments', 'transaction_description' => 'Information of the Assigments', 'transaction_order' => 3 ]);
            Transaction::create(['module_id' => 7, 'transaction_name' => 'Scheduling','transaction_description' => 'Information of the Scheduling', 'transaction_order' => 4 ]);
            Transaction::create(['module_id' => 7, 'transaction_name' => 'Status', 'transaction_description' => 'Information of the Status', 'transaction_order' => 5 ]);

            //Tresury
            Transaction::create(['module_id' => 8, 'transaction_name' => 'Fees','transaction_description' => 'Information of the Fees', 'transaction_order' => 1 ]);
            Transaction::create(['module_id' => 8, 'transaction_name' => 'Collection', 'transaction_description' => 'Information of the Collection', 'transaction_order' => 2 ]);
            Transaction::create(['module_id' => 8, 'transaction_name' => 'Invoicing', 'transaction_description' => 'Information of the Invoicing', 'transaction_order' => 3 ]);
            Transaction::create(['module_id' => 8, 'transaction_name' => 'Purchasing','transaction_description' => 'Information of the Purchasing', 'transaction_order' => 4 ]);
            Transaction::create(['module_id' => 8, 'transaction_name' => 'Autorizations', 'transaction_description' => 'Information of the Autorizations', 'transaction_order' => 5 ]);
            Transaction::create(['module_id' => 8, 'transaction_name' => 'Payments', 'transaction_description' => 'Information of the Payments', 'transaction_order' => 6 ]);
            Transaction::create(['module_id' => 8, 'transaction_name' => 'Salaries', 'transaction_description' => 'Information of the Salaries', 'transaction_order' => 7 ]);

            //Security
            Transaction::create(['module_id' => 9, 'transaction_name' => 'Dashboard','transaction_description' => 'Statistical Information of the Users', 'transaction_order' => 1 ]);
            Transaction::create(['module_id' => 9, 'transaction_name' => 'Users','transaction_description' => 'Information of the Users', 'transaction_order' => 2 ]);
            Transaction::create(['module_id' => 9, 'transaction_name' => 'Roles', 'transaction_description' => 'Information of the Roles', 'transaction_order' => 3 ]);
            Transaction::create(['module_id' => 9, 'transaction_name' => 'Access Rights', 'transaction_description' => 'Information of the Access Rights', 'transaction_order' => 4 ]);
            Transaction::create(['module_id' => 9, 'transaction_name' => 'Modules','transaction_description' => 'Information of the Modules', 'transaction_order' => 5 ]);
            Transaction::create(['module_id' => 9, 'transaction_name' => 'Transactions', 'transaction_description' => 'Information of the Transactions', 'transaction_order' => 6 ]);

            //Settings
            Transaction::create(['module_id' => 10, 'transaction_name' => 'Configurations','transaction_description' => 'Information of the Configuration', 'transaction_order' => 1 ]);
            Transaction::create(['module_id' => 10, 'transaction_name' => 'Notifications', 'transaction_description' => 'Information of the Notifications', 'transaction_order' => 2 ]);
            Transaction::create(['module_id' => 10, 'transaction_name' => 'Maintenance Tasks', 'transaction_description' => 'Information of the Maintenance Tasks', 'transaction_order' => 3 ]);
            Transaction::create(['module_id' => 10, 'transaction_name' => 'Task Scheduler', 'transaction_description' => 'Information of the Task Scheduler', 'transaction_order' => 4 ]);
            Transaction::create(['module_id' => 10, 'transaction_name' => 'Application Log', 'transaction_description' => 'Information of the Application Log', 'transaction_order' => 5 ]);

            //Data
            Transaction::create(['module_id' => 11, 'transaction_name' => 'Countries','transaction_description' => 'List of the Countries', 'transaction_order' => 1 ]);
            Transaction::create(['module_id' => 11, 'transaction_name' => 'States', 'transaction_description' => 'List of the States', 'transaction_order' => 2 ]);
            Transaction::create(['module_id' => 11, 'transaction_name' => 'Cities', 'transaction_description' => 'List of the Cities', 'transaction_order' => 3 ]);
            Transaction::create(['module_id' => 11, 'transaction_name' => 'Languages', 'transaction_description' => 'List of the Langueges', 'transaction_order' => 4 ]);

    }
}
