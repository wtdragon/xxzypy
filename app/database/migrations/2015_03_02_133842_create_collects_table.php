<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('collect', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('sc_id');
			$table->integer('co_id');
			$table->integer('course_id');
			$table->integer('video_id');
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
		//
	}

}
