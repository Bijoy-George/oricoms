<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriCustomerProfilesTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_customer_profiles', function (Blueprint $table) {
           $table->string('aadhar')->nullable()->after('profile_status');
           $table->string('pancard')->nullable()->after('aadhar');
           $table->string('passport')->nullable()->after('pancard');
           $table->integer('country_id')->nullable()->after('passport');
           $table->integer('state_id')->nullable()->after('country_id');
           $table->integer('district_id')->nullable()->after('state_id');
           $table->integer('local_body_type')->nullable()->after('district_id');  
           $table->integer('muncipality_id')->nullable()->after('local_body_type');
           $table->integer('corporation_id')->nullable()->after('muncipality_id');
           $table->integer('panchayath_type')->nullable()->after('corporation_id');
           $table->integer('district_panchayath_id')->nullable()->after('panchayath_type');
           $table->integer('block_panchayath_id')->nullable()->after('district_panchayath_id');
           $table->integer('grama_panchayath_id')->nullable()->after('block_panchayath_id');
           $table->integer('panchayath_id')->nullable()->after('grama_panchayath_id');

           $table->foreign('country_id')->references('id')->on('ori_location_settings')->onDelete('cascade');
           $table->foreign('state_id')->references('id')->on('ori_location_settings')->onDelete('cascade');
           $table->foreign('district_id')->references('id')->on('ori_location_settings')->onDelete('cascade');
           $table->foreign('local_body_type')->references('id')->on('ori_localbodytype')->onDelete('cascade');
           $table->foreign('muncipality_id')->references('id')->on('ori_localbody')->onDelete('cascade');
           $table->foreign('corporation_id')->references('id')->on('ori_localbody')->onDelete('cascade');
           $table->foreign('district_panchayath_id')->references('id')->on('ori_localbody')->onDelete('cascade');
           $table->foreign('block_panchayath_id')->references('id')->on('ori_localbody')->onDelete('cascade');
           $table->foreign('grama_panchayath_id')->references('id')->on('ori_localbody')->onDelete('cascade');
           $table->foreign('panchayath_id')->references('id')->on('ori_localbody')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
