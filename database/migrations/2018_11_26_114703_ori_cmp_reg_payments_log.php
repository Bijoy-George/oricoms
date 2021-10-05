<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OriCmpRegPaymentsLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_cmp_reg_payments_log', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable()->comment('Reffered from ori_cmp_profiles');
			$table->integer('plan_id')->nullable()->comment('Reffered from ori_mast_plans');
			$table->float('amount', 50)->nullable();
			$table->string('order_id', 500)->nullable();
			$table->string('transaction_id', 500)->nullable();
			$table->string('transaction_details', 1000)->nullable();
			$table->string('status', 100)->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_cmp_reg_payments_log', function (Blueprint $table) {
			$table->foreign('plan_id')->references('id')->on('ori_mast_plans')->onDelete('cascade');
		});
		Schema::table('ori_cmp_reg_payments_log', function (Blueprint $table) {
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
        Schema::drop('ori_cmp_reg_payments_log');
    }
}
