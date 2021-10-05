<?php

use Illuminate\Database\Seeder;

class OriMastQueryStatusRelationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_mast_query_status_relation')->delete();
        
        \DB::table('ori_mast_query_status_relation')->insert(array (
            0 => 
            array (
                'id' => 7,
                'cmpny_id' => 2,
                'query_type_id' => 9,
                'query_status_id' => 4,
                'status' => 2,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-07 13:06:08',
                'updated_at' => '2019-02-07 13:06:08',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 8,
                'cmpny_id' => 2,
                'query_type_id' => 6,
                'query_status_id' => 4,
                'status' => 2,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-07 13:06:08',
                'updated_at' => '2019-02-07 13:06:08',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 9,
                'cmpny_id' => 2,
                'query_type_id' => 5,
                'query_status_id' => 4,
                'status' => 2,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-07 13:06:08',
                'updated_at' => '2019-02-07 13:06:08',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 10,
                'cmpny_id' => 2,
                'query_type_id' => 9,
                'query_status_id' => 1,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-07 13:06:15',
                'updated_at' => '2019-02-07 13:06:15',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 11,
                'cmpny_id' => 2,
                'query_type_id' => 6,
                'query_status_id' => 1,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-07 13:06:15',
                'updated_at' => '2019-02-07 13:06:15',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 12,
                'cmpny_id' => 2,
                'query_type_id' => 5,
                'query_status_id' => 1,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-07 13:06:15',
                'updated_at' => '2019-02-07 13:06:15',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 13,
                'cmpny_id' => 2,
                'query_type_id' => 9,
                'query_status_id' => 2,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-07 13:06:18',
                'updated_at' => '2019-02-07 13:06:18',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 14,
                'cmpny_id' => 2,
                'query_type_id' => 6,
                'query_status_id' => 2,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-07 13:06:18',
                'updated_at' => '2019-02-07 13:06:18',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 15,
                'cmpny_id' => 2,
                'query_type_id' => 5,
                'query_status_id' => 2,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-07 13:06:18',
                'updated_at' => '2019-02-07 13:06:18',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}