<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\SoftDeletingTrait;


class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			//$table->mediuminteger('person_id')->unsigned();
			$table->smallinteger('role_id')->unsigned();
			$table->string('username',15);   
			$table->string('password',100);  //Size=100 because this field is encrypted / Hash::make ('whatever_password')
			$table->string('user_fullname',100);
			$table->string('email',100);
			$table->string('remember_security_number',8);
			$table->string('remember_token',100);
			$table->datetime('logged_at');
			$table->softDeletes();
			$table->timestamps();

			$table->unique('username');
			$table->unique('email');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
