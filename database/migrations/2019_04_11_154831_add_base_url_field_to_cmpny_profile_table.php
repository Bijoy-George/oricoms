<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBaseUrlFieldToCmpnyProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_company_profiles', function (Blueprint $table) {
			 $table->string('ori_cmp_org_base_url', 255)->nullable()->after('ori_cmp_org_plan');
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
            $table->dropColumn('ori_cmp_org_base_url');
        });
    }
}
