<?php

use Illuminate\Database\Seeder;

class OriMastQueryTypeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_mast_query_type')->delete();
        
        \DB::table('ori_mast_query_type')->insert(array (
            0 => 
            array (
                'id' => 5,
                'cmpny_id' => 2,
                'query_type' => 'Complaints',
                'type' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-10-10 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 6,
                'cmpny_id' => 2,
                'query_type' => 'Service Request',
                'type' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-10-10 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 7,
                'cmpny_id' => 1,
                'query_type' => 'Complaints',
                'type' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-10-10 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 8,
                'cmpny_id' => 1,
                'query_type' => 'Service Request',
                'type' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-10-10 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 9,
                'cmpny_id' => 2,
                'query_type' => 'Lead Followup',
                'type' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-10-10 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}