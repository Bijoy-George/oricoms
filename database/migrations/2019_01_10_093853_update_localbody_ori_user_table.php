<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLocalbodyOriUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_users', function (Blueprint $table) {
			
           $table->dropColumn('taluk_id');
		   $table->dropColumn('village_id');
		   
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
		   $table->foreign('department')->references('id')->on('ori_mast_query_type')->onDelete('cascade');
           $table->foreign('designation')->references('id')->on('ori_mast_designations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_users', function (Blueprint $table) {
			$table->integer('taluk_id')->nullable()->after('district_id');
            $table->integer('village_id')->nullable()->after('taluk_id');
			$table->dropForeign('ori_users_country_id_foreign');
			$table->dropForeign('ori_users_state_id_foreign');
			$table->dropForeign('ori_users_district_id_foreign');
			$table->dropForeign('ori_users_local_body_type_foreign');
			$table->dropForeign('ori_users_muncipality_id_foreign');
			$table->dropForeign('ori_users_corporation_id_foreign');
			$table->dropForeign('ori_users_district_panchayath_id_foreign');
			$table->dropForeign('ori_users_block_panchayath_id_foreign');
			$table->dropForeign('ori_users_grama_panchayath_id_foreign');
			$table->dropForeign('ori_users_panchayath_id_foreign');
			$table->dropForeign('ori_users_department_foreign');
			$table->dropForeign('ori_users_designation_foreign');
		});
    }
}
