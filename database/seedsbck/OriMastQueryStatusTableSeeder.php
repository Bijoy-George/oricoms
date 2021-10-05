<?php

use Illuminate\Database\Seeder;

class OriMastQueryStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_mast_query_status')->delete();
        
        \DB::table('ori_mast_query_status')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'name' => 'Open',
                'color' => '#f00',
                'is_close' => NULL,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => NULL,
                'created_at' => '2018-10-31 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'name' => 'Processing',
                'color' => '#00f',
                'is_close' => NULL,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => NULL,
                'created_at' => '2018-10-31 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'name' => 'Closed',
                'color' => '#00f',
                'is_close' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => NULL,
                'created_at' => '2018-10-31 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}