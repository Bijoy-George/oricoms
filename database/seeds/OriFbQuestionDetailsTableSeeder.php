<?php

use Illuminate\Database\Seeder;

class OriFbQuestionDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_fb_question_details')->delete();
        
        \DB::table('ori_fb_question_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'fb_det_id' => 4,
                'question_id' => 1,
                'answer' => 'yes',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-22 10:37:25',
                'updated_at' => '2018-11-22 10:37:25',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'fb_det_id' => 4,
                'question_id' => 2,
                'answer' => 'op1',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-22 10:37:25',
                'updated_at' => '2018-11-22 10:37:25',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}