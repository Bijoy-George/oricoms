<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriLocationSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_location_settings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('type', 100);
			$table->string('name', 100);
			$table->integer('parent');
			$table->integer('child');
			$table->integer('status')->nullable()->comment('1- Active,2- Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_location_settings');
	}

}
