<?php

use Illuminate\Database\Seeder;

class OriCampaignGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_campaign_groups')->delete();
        
        \DB::table('ori_campaign_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'campaign_id' => 1,
                'group_id' => 1,
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
                'group_id' => 2,
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