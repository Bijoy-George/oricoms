<?php

use Illuminate\Database\Seeder;

class OriFaqsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_faqs')->delete();
        
        \DB::table('ori_faqs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'query_type_id' => 6,
                'faq_cat_id' => 2,
                'query_title_lang1' => NULL,
                'query_title_lang2' => 'how can i contact you?',
                'question_lang1' => NULL,
                'question_lang2' => '<p>how can i contact you?</p>',
                'answer_lang1' => NULL,
                'answer_lang2' => '<p>Please contact with www.oricoms.com</p>',
                'answer_lang1_short' => NULL,
                'answer_lang2_short' => 'Please contact with www.oricoms.com',
                'keywords' => 'how can i contact you?',
                'added_from' => NULL,
                'filename' => NULL,
                'sort_order' => 1,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-15 05:04:13',
                'updated_at' => '2018-11-15 05:04:13',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'query_type_id' => 5,
                'faq_cat_id' => 2,
                'query_title_lang1' => NULL,
                'query_title_lang2' => 'how to solve technical issue on registration form?',
                'question_lang1' => NULL,
                'question_lang2' => '<p>how to solve technical issue on registration form?</p>',
                'answer_lang1' => NULL,
                'answer_lang2' => '<p>Please clear your website cache</p>',
                'answer_lang1_short' => NULL,
                'answer_lang2_short' => 'Please clear your website cache',
                'keywords' => 'how to solve technical issue on registration form?',
                'added_from' => NULL,
                'filename' => NULL,
                'sort_order' => 1,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-15 05:07:28',
                'updated_at' => '2018-11-15 05:07:28',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}