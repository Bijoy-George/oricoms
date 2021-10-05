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
                'color' => 'FF0000',
                'is_close' => 0,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-10-31 00:00:00',
                'updated_at' => '2019-02-07 13:06:15',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'name' => 'Processing',
                'color' => '0000FF',
                'is_close' => 0,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-10-31 00:00:00',
                'updated_at' => '2019-02-07 13:06:18',
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
            3 => 
            array (
                'id' => 4,
                'cmpny_id' => 2,
                'name' => 'Re-open',
                'color' => 'FFFFFF',
                'is_close' => 0,
                'sort_order' => 0,
                'status' => 2,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-07 13:06:08',
                'updated_at' => '2019-02-07 13:06:08',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}