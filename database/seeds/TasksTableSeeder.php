<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->delete();


        Task::create(array(
            'task_name'                     => 'Create Cache Loading File',
            'task_description'              => 'Create a cache file for faster configuration loading',
            'task_command'                  => 'config:cache',
            'task_command_execution_result' => '',
            'task_status'                   => 'Not Running',
        ));

        Task::create(array(
            'task_name'                     => 'Remove Cache Loading File',
            'task_description'              => 'Remove the configuration cache file',
            'task_command'                  => 'config:clear',
            'task_command_execution_result' => '',
            'task_status'                   => 'Not Running',
        ));

		Task::create(array(
            'task_name'                     => 'Clean Up User Action Log',
            'task_description'              => 'Only Keep 3 years of User Action Log Data',
            'task_command'                  => 'clean:data',
            'task_command_execution_result' => '',
            'task_status'                   => 'Not Running',
		));

        Task::create(array(
            'task_name'                     => 'Clean Up ClockWork Log Files',
            'task_description'              => 'Delete all ClockWork Log Files',
            'task_command'                  => 'clockwork:clean',
            'task_command_execution_result' => '',
            'task_status'                   => 'Not Running',
        ));

       /* Task::create(array(
            'task_name'                     => 'Create Route Cache File',
            'task_description'              => 'Create a route cache file for faster route registration',
            'task_command'                  => 'route:cache',
            'task_command_execution_result' => '',
            'task_status'                   => 'Not Running',
        ));*/

        Task::create(array(
            'task_name'                     => 'Delete Route Cache File',
            'task_description'              => 'Remove the Route Cache File',
            'task_command'                  => 'route:clear',
            'task_command_execution_result' => '',
            'task_status'                   => 'Not Running',
        ));

         Task::create(array(
            'task_name'                     => 'ERROR TESTING',
            'task_description'              => 'This task is for development testing ',
            'task_command'                  => "'clean:data', ['days' => '700']",
            'task_command_execution_result' => '',
            'task_status'                   => 'Not Running',
        ));
    }
}
