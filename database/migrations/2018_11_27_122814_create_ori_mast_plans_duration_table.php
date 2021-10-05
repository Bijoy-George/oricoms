<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriMastPlansDurationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_mast_plans_duration', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('plan_id')->nullable()->index('plan_id');
			$table->integer('amount')->nullable();
			$table->string('duration', 20)->nullable();
			$table->integer('status')->nullable();
			$table->integer('sort_order')->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		
		Schema::table('ori_mast_plans_duration', function(Blueprint $table)
		{
			$table->foreign('plan_id')->references('id')->on('ori_mast_plans')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
		Schema::table('ori_mast_plans_duration', function(Blueprint $table)
		{
			$table->dropForeign('ori_mast_plans_duration_plan_id_foreign');
		});
		Schema::drop('ori_mast_plans_duration');
	}
	

}
