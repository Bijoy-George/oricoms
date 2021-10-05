<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToRegPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_cmp_reg_payments', function (Blueprint $table) {
            $table->dropColumn('transaction_id');
			$table->string('tracking_id', 500)->nullable()->after('order_id');
			$table->string('payment_mode', 500)->nullable()->after('tracking_id');
			$table->integer('subscription_period')->nullable()->comment('monthly')->after('tracking_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_cmp_reg_payments', function (Blueprint $table) {
            $table->string('transaction_id', 500)->nullable();
			$table->dropColumn('tracking_id');
			$table->dropColumn('payment_mode');
			$table->dropColumn('subscription_period');
        });
    }
}
