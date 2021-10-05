<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOriCompanyProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_company_profiles', function (Blueprint $table) {
			$table->string('ori_cmp_org_country_code', 15)->nullable()->after('ori_cmp_org_address');
			$table->string('ori_cmp_org_mobile', 30)->nullable()->after('ori_cmp_org_country_code');
			$table->string('ori_cmp_org_city', 100)->nullable()->after('ori_cmp_org_mobile');
			$table->string('ori_cmp_org_state', 100)->nullable()->after('ori_cmp_org_city');
			$table->string('ori_cmp_org_pincode', 100)->nullable()->after('ori_cmp_org_state');
			$table->string('ori_cmp_org_country', 100)->nullable()->after('ori_cmp_org_pincode');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_company_profiles', function (Blueprint $table) {
            $table->dropColumn('ori_cmp_org_country_code');
            $table->dropColumn('ori_cmp_org_mobile');
			$table->dropColumn('ori_cmp_org_city');
			$table->dropColumn('ori_cmp_org_state');
			$table->dropColumn('ori_cmp_org_pincode');
			$table->dropColumn('ori_cmp_org_country');
        });
    }
}
