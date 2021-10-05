<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OriMastCouponCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_mast_coupon_codes', function(Blueprint $table)
		{
			$table->Integer('id', true);
			$table->integer('plan_id')->nullable();
			$table->string('coupon_name', 50)->nullable();
			$table->string('coupon_code', 50)->nullable();
			$table->string('discount', 50)->nullable();
			$table->integer('disc_flag')->comment('1- Percent,2- Rupees')->nullable();
			$table->string('duration')->comment('Monthly')->nullable();
			$table->datetime('valid_from')->nullable();
			$table->datetime('valid_to')->nullable();
			$table->integer('status')->nullable()->comment('1-Active,2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_mast_coupon_codes', function (Blueprint $table) {
            $table->foreign('plan_id')->references('id')->on('ori_mast_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('ori_mast_coupon_codes');
    }
}
