<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriAutodialSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_autodial_schedules', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->string('name', 150);
			$table->date('datetime_init');
			$table->date('datetime_end');
			$table->time('daytime_init');
			$table->time('daytime_end');
			$table->integer('retries')->nullable();
			$table->integer('agent_group_id')->nullable();
			$table->integer('max_canales')->nullable();
			$table->integer('status');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_autodial_schedules', function (Blueprint $table) {
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
		Schema::drop('ori_autodial_schedules');
	}

}
