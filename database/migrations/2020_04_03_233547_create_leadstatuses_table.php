<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadstatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leadstatuses', function (Blueprint $table) {
            $table->increments('id', true);
            $table->integer('cmpny_id')->nullable();
            $table->string('customer', 150);
            $table->integer('sort_order')->default(0)->nullable();
            $table->integer('status')->default(1)->comment('1-Active 2-Inactive');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leadstatuses');
    }
}
