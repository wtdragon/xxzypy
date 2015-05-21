<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSclassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sclasses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('classname');
			$table->integer('tid');
			$table->integer('stucount');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

}
