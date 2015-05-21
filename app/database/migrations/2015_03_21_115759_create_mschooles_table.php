<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMschoolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mschooles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('schoolname');
			$table->integer('sclassid');
			$table->integer('tcid');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mschooles');
	}

}
