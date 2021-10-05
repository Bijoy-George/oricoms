<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriCustomerProfilesTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_customer_profiles', function (Blueprint $table) {
          
           $table->integer('taluk_id')->nullable()->after('panchayath_id');
           $table->integer('village_id')->nullable()->after('taluk_id');
          

           
           $table->foreign('taluk_id')->references('id')->on('ori_localbody')->onDelete('cascade');
           $table->foreign('village_id')->references('id')->on('ori_localbody')->onDelete('cascade');
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
