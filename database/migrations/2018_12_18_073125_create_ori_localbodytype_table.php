<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriLocalbodytypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_localbodytype', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('type', 50);
			$table->integer('parent_id')->nullable();
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
		Schema::drop('ori_localbodytype');
	}

}
