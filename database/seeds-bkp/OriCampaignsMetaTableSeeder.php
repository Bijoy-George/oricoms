<?php

use Illuminate\Database\Seeder;

class OriCampaignsMetaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_campaigns_meta')->delete();
        
        \DB::table('ori_campaigns_meta')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'campaign_id' => 1,
                'source_type' => 8,
                'source_id' => 1,
                'budget' => NULL,
                'field1' => NULL,
                'field2' => NULL,
                'field3' => NULL,
                'field1_description' => NULL,
                'field2_description' => NULL,
                'field3_description' => NULL,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-21 04:47:57',
                'updated_at' => '2018-11-21 04:47:57',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'campaign_id' => 2,
                'source_type' => 8,
                'source_id' => 4,
                'budget' => NULL,
                'field1' => NULL,
                'field2' => NULL,
                'field3' => NULL,
                'field1_description' => NULL,
                'field2_description' => NULL,
                'field3_description' => NULL,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-21 04:49:04',
                'updated_at' => '2018-11-21 04:49:04',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}