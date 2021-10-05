<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriCustomerProfileMetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_customer_profile_meta', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('cmpny_id');
			$table->bigInteger('user_id')->nullable()->comment('Referred from ori_customer_profile');
			$table->string('field_name', 25)->nullable();
			$table->string('value', 500)->nullable();
			$table->bigInteger('field_id')->nullable()->comment('Referred from profile_field');
			$table->integer('sort_order')->nullable();
			$table->integer('status')->nullable()->comment('1-Active,2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_customer_profile_meta', function (Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('ori_customer_profiles')->onDelete('cascade');
		});
		Schema::table('ori_customer_profile_meta', function (Blueprint $table) {
			$table->foreign('field_id')->references('id')->on('ori_customer_profile_fields')->onDelete('cascade');
		});
		Schema::table('ori_customer_profile_meta', function (Blueprint $table) {
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
		Schema::drop('ori_customer_profile_meta');
	}

}
