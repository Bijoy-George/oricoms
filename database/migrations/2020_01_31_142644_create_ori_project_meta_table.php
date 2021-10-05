<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriProjectMetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_project_meta', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->index('ori_project_meta_ibfk_2');
			$table->integer('project_id')->index('project_id');
			$table->text('contact_details', 65535)->nullable();
			$table->text('server_credentials', 65535)->nullable();
			$table->integer('created_by')->default(0);
			$table->integer('updated_by')->default(0);
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
		Schema::drop('ori_project_meta');
	}

}
