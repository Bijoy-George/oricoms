<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOriCompanySubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_company_subscriptions', function (Blueprint $table) {
			$table->float('amount', 50)->nullable()->after('transaction_id');
            $table->float('discount_amount',50)->nullable()->after('amount');
            $table->datetime('extended_expiry_date')->nullable()->after('subscription_exp_date');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_company_subscriptions', function (Blueprint $table) {
            $table->dropColumn('amount');
            $table->dropColumn('discount_amount');
            $table->dropColumn('extended_expiry_date');
        });
    }
}
