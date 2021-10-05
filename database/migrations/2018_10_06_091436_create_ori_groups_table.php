<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_groups', function (Blueprint $table) {
            $table->increments('id', true);
            $table->integer('cmpny_id');
            $table->string('name', 500)->nullable();
            $table->integer('total_count')->default(0);
            $table->integer('stage_id')->nullable()->comment('cmp_automated_process:parent_id');
            $table->integer('status')->nullable()->comment('1-Active,2-Processing');
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
        Schema::dropIfExists('ori_groups');
    }
}
