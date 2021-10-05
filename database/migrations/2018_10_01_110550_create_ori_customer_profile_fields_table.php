<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriCustomerProfileFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_customer_profile_fields', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('cmpny_id');
			$table->string('field_name', 25)->nullable();
			$table->integer('type')->nullable()->comment('1- Default profile fields, 2- Custom  fields');
			$table->integer('required')->nullable()->comment('1- Reuired,  2 - Not required');
			$table->string('label', 50)->nullable();
			$table->integer('report_field')->nullable()->comment('1- yes, 2- No');
$table->integer('is_unique')->nullable()->comment('1- Unique field, 2- Not unique');
$table->string('field_type', 20)->nullable(); 
$table->integer('field_id')->nullable()->comment('Referred from ori_default_profile_fields');
$table->integer('sort_order')->nullable();
			$table->integer('status')->nullable()->comment('1-Active,2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_customer_profile_fields', function (Blueprint $table) {
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
		Schema::drop('ori_customer_profile_fields');
	}

}
