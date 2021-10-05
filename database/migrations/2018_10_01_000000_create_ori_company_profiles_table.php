<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriCompanyProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_company_profiles', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('ori_cmp_org_name', 50)->nullable();
			$table->string('ori_cmp_org_email', 50)->nullable();
			$table->string('ori_cmp_org_phone', 30)->nullable();
			$table->string('ori_cmp_org_address', 250)->nullable();
			$table->integer('ori_cmp_org_plan')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('status')->nullable()->comment('1-Active 2-Inactive');
		});
		Schema::table('ori_company_profiles', function (Blueprint $table) {
			$table->foreign('ori_cmp_org_plan')->references('id')->on('ori_mast_plans')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_company_profiles');
	}

}
