<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOriCmpRegPaymentsLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   
	public function up()
    {
        Schema::table('ori_cmp_reg_payments_log', function (Blueprint $table) {
            $table->float('discount_off', 50)->comment('percent')->nullable()->after('amount');
			$table->string('coupon_code', 500)->nullable()->after('discount_off');
			$table->float('total_discount', 50)->nullable()->after('coupon_code');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_cmp_reg_payments_log', function (Blueprint $table) {
            $table->dropColumn('discount_off');
			$table->dropColumn('coupon_code');
			$table->dropColumn('total_discount');
        });
    }
}
