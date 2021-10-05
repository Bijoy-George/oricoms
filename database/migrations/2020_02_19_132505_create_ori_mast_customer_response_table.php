<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriMastCustomerResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_mast_customer_response', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cmpny_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('customer_response', 150);
            $table->integer('sort_order')->default(0)->nullable();
            $table->integer('is_other')->nullable();
            $table->integer('status')->default(1)->comment('1-Active 2-Inactive');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('ori_mast_customer_response', function (Blueprint $table) {
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
        Schema::dropIfExists('ori_mast_customer_response');
    }
}
