<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OriMastSupplyOffices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_mast_supply_offices', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('cmpny_id')->nullable();
            $table->string('supply_office',255)->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('email',255)->nullable();
            $table->string('type',255)->nullable();
            $table->integer('sort_order')->default(0)->nullable();
            $table->integer('status')->default(1)->comment('1-Active 2-Inactive');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('ori_mast_supply_offices', function (Blueprint $table) {
            $table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ori_mast_supply_offices');
    }
}
