<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLocalbodyOriLeadFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_lead_followups', function (Blueprint $table) {			
          $table->integer('country_id')->nullable()->after('docket_number');
          $table->integer('state_id')->nullable()->after('country_id');
          $table->integer('district_id')->nullable()->after('state_id');
          $table->integer('taluk_id')->nullable()->after('district_id');
          $table->integer('village_id')->nullable()->after('taluk_id');
          $table->integer('local_body_type')->nullable()->after('village_id');
          $table->integer('muncipality_id')->nullable()->after('local_body_type');
          $table->integer('corporation_id')->nullable()->after('muncipality_id');
          $table->integer('panchayath_type')->nullable()->after('corporation_id');
          $table->integer('district_panchayath_id')->nullable()->after('panchayath_type');
          $table->integer('block_panchayath_id')->nullable()->after('district_panchayath_id');
          $table->integer('grama_panchayath_id')->nullable()->after('block_panchayath_id');
          $table->integer('panchayath_id')->nullable()->after('grama_panchayath_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_lead_followups', function (Blueprint $table) {
      $table->dropColumn('country_id');
      $table->dropColumn('state_id');
      $table->dropColumn('district_id');
      $table->dropColumn('taluk_id');
      $table->dropColumn('village_id');
      $table->dropColumn('local_body_type');
      $table->dropColumn('muncipality_id');
      $table->dropColumn('corporation_id');
      $table->dropColumn('panchayath_type');
      $table->dropColumn('district_panchayath_id');
      $table->dropColumn('block_panchayath_id');
      $table->dropColumn('grama_panchayath_id');
      $table->dropColumn('panchayath_id');
        });
    }
}