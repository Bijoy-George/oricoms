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
            2 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'questions' => 'നിങ്ങൾ ഞങ്ങളുടെ സേവനങ്ങളിൽ തൃപ്തരാണോ?',
                'language_type' => 2,
                'option1' => 'അതെ',
                'option2' => 'അല്ല',
                'option3' => NULL,
                'option4' => NULL,
                'option5' => NULL,
                'option6' => NULL,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 3,
                'created_at' => '2018-11-19 12:59:21',
                'updated_at' => '2018-11-22 06:03:45',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 8,
                'cmpny_id' => 2,
                'questions' => 'ചോദ്യം ഒന്ന്',
                'language_type' => 2,
                'option1' => 'ഉത്തരം1',
                'option2' => 'ഉത്തരം2',
                'option3' => NULL,
                'option4' => NULL,
                'option5' => NULL,
                'option6' => NULL,
                'status' => 1,
                'created_by' => 3,
                'updated_by' => 3,
                'created_at' => '2018-11-22 06:04:25',
                'updated_at' => '2018-11-22 06:04:25',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}