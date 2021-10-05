<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OriCompanySubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_company_subscriptions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable()->comment('Reffered from ori_cmp_profiles');
			$table->integer('plan_id')->nullable()->comment('Reffered from ori_mast_plans');
			$table->string('transaction_id', 500)->nullable();
			$table->datetime('subscription_start_date')->nullable();
			$table->datetime('subscription_exp_date')->nullable();
			$table->string('status', 100)->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_company_subscriptions', function (Blueprint $table) {
			$table->foreign('plan_id')->references('id')->on('ori_mast_plans')->onDelete('cascade');
		});
		Schema::table('ori_company_subscriptions', function (Blueprint $table) {
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
        Schema::drop('ori_company_subscriptions');
    }
}
