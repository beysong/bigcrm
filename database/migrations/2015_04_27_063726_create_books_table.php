<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('shop');
			$table->string('come_date');
			$table->string('come_time');
			$table->string('name');
			$table->string('tel');
			$table->string('userid');
			$table->string('come_product');
			$table->string('come_for');
			$table->string('is_xiaofei');
			$table->string('status');
			$table->string('status_opt');
			$table->string('status_time');
			$table->string('status_note');
			$table->string('status_score');
			$table->string('lixing_opt');
			$table->string('lixing_time');
			$table->string('lixing_note');
			$table->string('lixing_score');
			$table->string('not_opt');
			$table->string('not_time');
			$table->string('not_note');
			$table->string('not_score');
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
		Schema::drop('books');
	}

}
