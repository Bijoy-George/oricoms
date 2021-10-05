<?php

use Illuminate\Database\Seeder;

class OriBatchProcessTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_batch_process')->delete();
        
        \DB::table('ori_batch_process')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'process_type' => 1,
                'searched_criteria' => '{"search_keywords":null,"startdate":null,"enddate":null}',
                'exclude_list' => '',
                'target_count' => 0,
                'processed_count' => 0,
                'last_processed_id' => 2,
                'group_id' => 1,
                'file_name' => '',
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-21 04:43:53',
                'updated_at' => '2018-11-21 10:14:33',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}