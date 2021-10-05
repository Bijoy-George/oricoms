<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriFbDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_fb_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->bigInteger('customer_id')->nullable()->comment('Referred from ori_customer_profile');
			$table->integer('reference_id')->nullable()->comment('For Web reference id should be taken from followup table id, for chat reference id should be threadid');
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
		Schema::table('ori_fb_details', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
		Schema::table('ori_fb_details', function (Blueprint $table) {
			$table->foreign('customer_id')->references('id')->on('ori_customer_profiles')->onDelete('cascade');
		});
		Schema::table('ori_fb_details', function (Blueprint $table) {
			$table->foreign('fb_type')->references('id')->on('ori_channels')->onDelete('cascade');
		});
		
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_fb_details');
	}

}
