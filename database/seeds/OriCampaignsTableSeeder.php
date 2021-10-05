<?php

use Illuminate\Database\Seeder;

class OriCampaignsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_campaigns')->delete();
        
        \DB::table('ori_campaigns')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'name' => 'Orisys Campaign 1',
                'campaign_type' => 2,
                'goal_stage' => NULL,
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
                'name' => 'Orisys Campaign 2',
                'campaign_type' => 3,
                'goal_stage' => NULL,
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