<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEhealthFieldsToOriLeadFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_lead_followups', function (Blueprint $table) {
           $table->string('type_of_call')->nullable()->after('demo');
           $table->string('source_of_call')->nullable()->after('type_of_call');
           $table->string('institution')->nullable()->after('source_of_call');
           $table->string('issue')->nullable()->after('institution');
           $table->string('nature_of_call')->nullable()->after('issue');
           $table->string('fwc_bs')->nullable()->after('nature_of_call');
           $table->string('pen_no')->nullable()->after('fwc_bs');
           $table->string('utid')->nullable()->after('pen_no');
           $table->string('complaint_resolve')->nullable()->after('utid');
           $table->string('measure_taken')->nullable()->after('complaint_resolve');
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
            //
        });
    }
}
