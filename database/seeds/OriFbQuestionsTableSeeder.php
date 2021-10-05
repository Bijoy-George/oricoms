<?php

use Illuminate\Database\Seeder;

class OriFbQuestionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_fb_questions')->delete();
        
        \DB::table('ori_fb_questions')->insert(array (
            0 => 
            array (
                'id' => 6,
                'feedback_id' => 3,
                'eng_qstn_id' => 1,
                'mal_qstn_id' => 3,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-21 10:47:09',
                'updated_at' => '2018-11-21 10:47:09',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 7,
                'feedback_id' => 3,
                'eng_qstn_id' => 2,
                'mal_qstn_id' => 4,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-21 10:49:01',
                'updated_at' => '2018-11-21 10:49:01',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 8,
                'feedback_id' => 1,
                'eng_qstn_id' => 1,
                'mal_qstn_id' => 4,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-21 13:07:34',
                'updated_at' => '2018-11-21 13:07:34',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}