<?php

use Illuminate\Database\Seeder;

class OriFbSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_fb_settings')->delete();
        
        \DB::table('ori_fb_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'question_ids' => 'a:0:{}',
                'fb_type' => 1,
                'query_type' => 5,
                'fb_status' => 'a:1:{i:0;s:1:"2";}',
                'action_time' => '12',
                'action_type' => 2,
                'is_comment' => 1,
                'is_rating' => 1,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-10-15 06:24:23',
                'updated_at' => '2018-11-20 04:35:12',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'question_ids' => 'a:0:{}',
                'fb_type' => 5,
                'query_type' => NULL,
                'fb_status' => NULL,
                'action_time' => NULL,
                'action_type' => NULL,
                'is_comment' => 1,
                'is_rating' => 1,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-05 12:07:59',
                'updated_at' => '2018-11-13 12:16:54',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}