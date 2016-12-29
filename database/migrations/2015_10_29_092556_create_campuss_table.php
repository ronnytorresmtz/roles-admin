<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampussTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campuss', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('institute_id');
            $table->string('campus_name',100);
            $table->string('campus_description',255);
            $table->softDeletes();
            $table->timestamps();

             $table->index('institute_id');
        });


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('campuss');
	}

}