<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriDistInstitutionRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ori_dist_institution_relation', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->integer('dist_id')->nullable();
			$table->integer('institution_id')->nullable()->comment('Referred from ori_mast_institution');
			$table->integer('sort_order')->default(0)->nullable();
			$table->integer('status')->default(1)->comment('1-Active 2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		
		Schema::table('ori_dist_institution_relation', function (Blueprint $table) {
			$table->foreign('institution_id')->references('id')->on('ori_mast_institution')->onDelete('cascade');
		});
		Schema::table('ori_dist_institution_relation', function (Blueprint $table) {
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
        Schema::drop('ori_dist_institution_relation');
    }
}
