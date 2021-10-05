<?php

use Illuminate\Database\Seeder;

class OriMastFaqCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_mast_faq_categories')->delete();
        
        \DB::table('ori_mast_faq_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'category_name' => 'KYC',
                'parent_category_id' => NULL,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-10-11 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'category_name' => 'Registration',
                'parent_category_id' => NULL,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-10-11 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'category_name' => 'Profile Page',
                'parent_category_id' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-10-11 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'cmpny_id' => 1,
                'category_name' => 'c1 - KYC',
                'parent_category_id' => NULL,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}