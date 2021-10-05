<?php

use Illuminate\Database\Seeder;

class OriCompanyChannelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_company_channels')->delete();
        
        \DB::table('ori_company_channels')->insert(array (
            0 => 
            array (
                'id' => 5,
                'cmpny_id' => 2,
                'channel_id' => 1,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 6,
                'cmpny_id' => 2,
                'channel_id' => 2,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 7,
                'cmpny_id' => 2,
                'channel_id' => 3,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
			3 => 
            array (
                'id' => 8,
                'cmpny_id' => 2,
                'channel_id' => 4,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
			4 => 
            array (
                'id' => 9,
                'cmpny_id' => 2,
                'channel_id' => 5,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
			5 => 
            array (
                'id' => 10,
                'cmpny_id' => 2,
                'channel_id' => 6,
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