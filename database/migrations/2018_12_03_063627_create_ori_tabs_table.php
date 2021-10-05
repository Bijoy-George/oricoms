<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriTabsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_tabs', function(Blueprint $table)
		{
			$table->Integer('id', true);
			$table->integer('cmpny_id')->index('ori_customer_profiles_cmpny_id_foreign');
			$table->string('name', 50)->nullable();
			$table->integer('type')->nullable()->comment('1- tab containing normal fileds,2- tab containing repeatable fields');
			$table->integer('sort_order')->nullable();
			$table->integer('status')->nullable()->comment('1-Active,2-Inactive');
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
		Schema::drop('ori_tabs');
	}

}
