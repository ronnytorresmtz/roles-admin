<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersActionsLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('users_actions_log', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',50);
            $table->string('module_name',50);
            $table->string('transaction_name',50);
            $table->string('action_name', 50);
            $table->datetime('created_at',255);

            $table->index('created_at');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('users_actions_log');
    }


}
