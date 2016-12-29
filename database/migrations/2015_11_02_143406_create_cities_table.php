<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cities', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->string('city_name',100);
            $table->string('city_description',255);
            $table->softDeletes();
            $table->timestamps();

            $table->index('country_id','state_id');
        });


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cities');
	}

}