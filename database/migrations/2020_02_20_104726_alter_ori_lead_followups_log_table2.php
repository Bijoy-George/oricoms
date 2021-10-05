<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOriLeadFollowupsLogTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_lead_followups_log', function (Blueprint $table) {
            $table->integer('customer_response_type')->nullable()->after('priority');
            $table->integer('customer_response')->nullable()->after('customer_response_type');
            $table->string('service_dealer')->nullable()->after('customer_response');
            $table->dateTime('service_date')->nullable()->after('service_dealer');
            $table->integer('service_km')->nullable()->after('service_date');
            $table->string('service_type')->nullable()->after('service_km');
            $table->dateTime('warranty_end_date')->nullable()->after('service_type');
            $table->integer('warranty_end_km')->nullable()->after('warranty_end_date');
            $table->boolean('has_extended_warranty')->nullable()->after('warranty_end_km');
            $table->dateTime('extended_warranty_end_date')->nullable()->after('has_extended_warranty');
            $table->integer('extended_warranty_end_km')->nullable()->after('extended_warranty_end_date');
            $table->boolean('has_amc')->nullable()->after('extended_warranty_end_km');
            $table->string('amc_type')->nullable()->after('has_amc');
            $table->dateTime('amc_end_date')->nullable()->after('amc_type');
            $table->integer('amc_end_km')->nullable()->after('amc_end_date');
            $table->string('insurance_provider')->nullable()->after('amc_end_km');
            $table->dateTime('insurance_expiry_date')->nullable()->after('insurance_provider');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_lead_followups_log', function (Blueprint $table) {
            //
        });
    }
}
