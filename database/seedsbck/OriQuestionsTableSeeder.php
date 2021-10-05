<?php

use Illuminate\Database\Seeder;

class OriQuestionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_questions')->delete();
        
        \DB::table('ori_questions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'questions' => 'Are you interested ?',
                'language_type' => 1,
                'option1' => 'yes',
                'option2' => 'no',
                'option3' => NULL,
                'option4' => NULL,
                'option5' => NULL,
                'option6' => NULL,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-10-11 09:01:04',
                'updated_at' => '2018-10-11 09:01:04',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'questions' => 'Question 1?',
                'language_type' => 1,
                'option1' => 'op1',
                'option2' => 'op2',
                'option3' => NULL,
                'option4' => NULL,
                'option5' => NULL,
                'option6' => NULL,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-10-11 09:01:21',
                'updated_at' => '2018-10-11 09:01:21',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
