<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriServersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_servers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id');
			$table->string('server_name', 55);
			$table->string('server_ip', 55);
			$table->string('description')->nullable();
			$table->boolean('stage');
			$table->text('service', 65535)->nullable();
			$table->integer('status')->default(1);
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_servers', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_servers');
	}

}
