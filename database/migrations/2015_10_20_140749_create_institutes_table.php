<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institutes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('institute_short_name', 100);
			$table->string('institute_long_name', 255);
			$table->string('institute_address1', 255);
			$table->string('institute_address2', 255);
			$table->integer('institute_city');
			$table->integer('institute_state');
			$table->integer('institute_contry');
			$table->string('institute_zipcode',10);
			$table->string('institute_phone_number', 50);
            $table->string('institute_email', 100);
			$table->string('institute_reg_number', 100);
			$table->string('institute_fiscal_folio', 100);
			$table->string('institute_serie_number', 100);
			$table->string('institute_digital_seal1', 255);
			$table->string('institute_digital_seal2', 255);
			$table->softDeletes();
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('institutes');
	}

}

