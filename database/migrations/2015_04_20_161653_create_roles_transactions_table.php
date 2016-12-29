<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles_transactions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('role_id')->unsigned()->index();
			$table->integer('module_id')->unsigned()->index();
			$table->integer('transaction_id')->unsigned()->index();
			$table->tinyinteger('transaction_action_id')->unsigned()->index();
			$table->softDeletes();
			$table->timestamps();

			//$table->unique(array('role_id', 'transaction_id','transaction_action_id'));

			//$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
			//$table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
		});
		

		/*Schema::table('roles_transactions', function($table)
		{
		    $table->dropPrimary('PRIMARY');
		});

		Schema::table('roles_transactions', function($table)
		{
		    $table->primary(array('id', 'role_id', 'transaction_id','transaction_action_id'));
		});*/
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roles_transactions');
	}

}
