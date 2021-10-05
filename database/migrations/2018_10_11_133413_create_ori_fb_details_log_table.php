<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriFbDetailsLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_fb_details_log', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('fb_det_id')->nullable()->comment('referred from ori_fb_details');
			$table->integer('cmpny_id')->nullable();
			$table->bigInteger('customer_id')->nullable()->comment('Referred from ori_customer_profile');
			$table->string('reference_id', 250)->nullable()->comment('For Web reference id should be taken from followup table id, for chat reference id should be threadid');
			$table->string('call_id', 5)->nullable()->comment('only for ivr');
			$table->integer('fb_type')->nullable()->comment('Refered from ori_channels');
			$table->string('comments', 250)->nullable();
			$table->integer('rating')->default(0);
			$table->integer('status')->default(1)->comment('1-Active 2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_fb_details_log', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
		Schema::table('ori_fb_details_log', function (Blueprint $table) {
			$table->foreign('customer_id')->references('id')->on('ori_customer_profiles')->onDelete('cascade');
		});
		Schema::table('ori_fb_details_log', function (Blueprint $table) {
			$table->foreign('fb_type')->references('id')->on('ori_channels')->onDelete('cascade');
		});
		Schema::table('ori_fb_details_log', function (Blueprint $table) {
			$table->foreign('fb_det_id')->references('id')->on('ori_fb_details')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_fb_details_log');
	}

}
