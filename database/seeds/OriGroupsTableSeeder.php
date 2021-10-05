<?php

use Illuminate\Database\Seeder;

class OriGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_groups')->delete();
        
        \DB::table('ori_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'name' => 'Orisys Group 1',
                'total_count' => 2,
                'stage_id' => NULL,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-21 04:43:32',
                'updated_at' => '2018-11-21 10:14:33',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'name' => 'Orisys Group 2',
                'total_count' => 0,
                'stage_id' => NULL,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-21 04:45:45',
                'updated_at' => '2018-11-21 04:45:45',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'name' => 'Orisys Test Excel Group',
                'total_count' => 0,
                'stage_id' => NULL,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-12-05 04:19:03',
                'updated_at' => '2018-12-05 04:19:03',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}