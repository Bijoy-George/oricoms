<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriFbSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_fb_settings', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->text('question_ids')->nullable();
			$table->integer('fb_type')->nullable()->comment('1- SMS,2- Email');
			$table->integer('query_type')->nullable();
			$table->text('fb_status', 65535)->nullable();
			$table->string('action_time', 50)->nullable()->comment('action time should be in minute');
			$table->integer('action_type')->nullable()->comment('1- Hour, 2 - Minute');
			$table->integer('is_comment')->default(2)->comment('1- Need Comment Box , 2 - no need comment  box');
			$table->integer('is_rating')->default(2)->comment('1- Need  rating feature, 2 - no need rating');
			$table->integer('status')->nullable()->comment('1-Active,2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_fb_settings', function (Blueprint $table) {
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
		Schema::drop('ori_fb_settings');
	}

}
