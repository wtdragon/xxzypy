<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKtestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ktest', function(Blueprint $table)
		{
			$table->increments('id');
	        $table->integer('user_id');
	        $table->integer('kuser_id');
			$table->integer('sc_id');
			$table->integer('co_id');
	        $table->timestamps();
			$table->text('body')->nullable();
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
