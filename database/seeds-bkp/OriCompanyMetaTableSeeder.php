<?php

use Illuminate\Database\Seeder;

class OriCompanyMetaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_company_meta')->delete();
        
        \DB::table('ori_company_meta')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'meta_name' => 're_open_status',
                'meta_value' => '4',
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-13 12:06:52',
                'updated_at' => '2018-11-13 13:41:54',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'meta_name' => 'after_re_open',
                'meta_value' => '2',
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-13 12:06:52',
                'updated_at' => '2018-11-13 13:41:59',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 5,
                'cmpny_id' => 2,
                'meta_name' => 'chat_agent',
                'meta_value' => '4',
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-13 13:39:51',
                'updated_at' => '2018-11-13 13:39:51',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}