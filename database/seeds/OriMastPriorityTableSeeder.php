<?php

use Illuminate\Database\Seeder;

class OriMastPriorityTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_mast_priority')->delete();
        
        \DB::table('ori_mast_priority')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'name' => 'low',
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
                'name' => 'medium',
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
                'name' => 'high',
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
                'cmpny_id' => 1,
                'name' => 'low',
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2018-10-31 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'cmpny_id' => 1,
                'name' => 'medium',
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2018-10-31 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'cmpny_id' => 1,
                'name' => 'high',
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2018-10-31 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}