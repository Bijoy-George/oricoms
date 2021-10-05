<?php

use Illuminate\Database\Seeder;

class OriMastQueryCategoryRelationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_mast_query_category_relation')->delete();
        
        \DB::table('ori_mast_query_category_relation')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'query_type_id' => 5,
                'category_id' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'query_type_id' => 5,
                'category_id' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'query_type_id' => 6,
                'category_id' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'cmpny_id' => 1,
                'query_type_id' => 8,
                'category_id' => 4,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'cmpny_id' => 2,
                'query_type_id' => 9,
                'category_id' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'cmpny_id' => 2,
                'query_type_id' => 9,
                'category_id' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}