<?php

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->delete();

        Module::create(array(
            'module_name'        => 'Dashboard', 
            'module_description' => 'Performance Indicadors Management',
            'module_order'       => 1
        ));
        
        Module::create(array(
            'module_name'        => 'Facilities', 
            'module_description' => 'Campus, Buildings and Classrooms Management',
            'module_order'       => 2   
        ));
        
        Module::create(array(
            'module_name'        => 'Academic', 
            'module_description' => 'Academic Cycles, Plans and Courses Management',
            'module_order'       => 3   
        ));
        
        Module::create(array(
            'module_name'        => 'Resources', 
            'module_description' => 'Employees and Supplier Management',
            'module_order'       => 4
        ));
        
        Module::create(array(
            'module_name'        => 'Inventory',  
            'module_description' => 'Warehouses Management',
            'module_order'       => 5   
        ));
        
        Module::create(array(
            'module_name'        => 'Assets',  
            'module_description' => 'Assets Registration and Asssigment',
            'module_order'       => 6   
        ));
        
        Module::create(array(
            'module_name'        => 'Services', 
            'module_description' => 'Service Requests Management',
            'module_order'       => 7   
        ));

        Module::create(array(
            'module_name'        => 'Treasury',  
            'module_description' => 'Treasury Management',
            'module_order'       => 8   
        ));
        
        
        Module::create(array(
            'module_name'        => 'Security',  
            'module_description' => 'Users and Roles Management',
            'module_order'       => 9   
        ));
        
        Module::create(array(
            'module_name'        => 'Settings', 
            'module_description' => 'Applicationn Settings Management',
            'module_order'       => 10
        ));

        Module::create(array(
            'module_name'        => 'Data',     
            'module_description' => 'Master Data Management',
            'module_order'       => 11
        ));

    }
}
