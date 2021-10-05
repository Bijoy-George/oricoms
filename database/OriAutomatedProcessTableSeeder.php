<?php

use Illuminate\Database\Seeder;

class OriAutomatedProcessTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_automated_process')->delete();
        
        \DB::table('ori_automated_process')->insert(array (
            0 => 
            array (
                'id' => 1,
				'cmpny_id' => 2,
                'process_name' => 'New Lead Mail',
                'description' => NULL,
                'process' => NULL,
                'process_type' => 1,
                'stage' => 1,
                'parent_id' => NULL,
                'process_stage_type' => NULL,
                'category' => NULL,
                'faq_category' => NULL,
                'action' => '2',
                'response_pos' => '6',
                'response_neg' => '2',
                'action_time' => '1',
                'expiry_time' => '3000',
                'expiry_param' => 0,
                'content' => '1',
                'created_at' => '2018-02-16 00:00:00',
                'updated_at' => '2018-02-16 00:00:00',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
				'cmpny_id' => 2,
                'process_name' => 'New Lead SMS',
                'description' => NULL,
                'process' => NULL,
                'process_type' => 1,
                'stage' => 1,
                'parent_id' => NULL,
                'process_stage_type' => NULL,
                'category' => NULL,
                'faq_category' => NULL,
                'action' => '1',
                'response_pos' => '6',
                'response_neg' => '3',
                'action_time' => '1',
                'expiry_time' => '3000',
                'expiry_param' => 0,
                'content' => '1',
                'created_at' => '2018-02-16 00:00:00',
                'updated_at' => '2018-02-16 00:00:00',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
				'cmpny_id' => 2,
                'process_name' => 'Lead Manual Call',
                'description' => NULL,
                'process' => NULL,
                'process_type' => 1,
                'stage' => 1,
                'parent_id' => NULL,
                'process_stage_type' => NULL,
                'category' => NULL,
                'faq_category' => NULL,
                'action' => '3',
                'response_pos' => '6',
                'response_neg' => '4',
                'action_time' => '1',
                'expiry_time' => '3000',
                'expiry_param' => 0,
                'content' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
				'cmpny_id' => 2,
                'process_name' => 'Lead Auto Dial',
                'description' => NULL,
                'process' => NULL,
                'process_type' => 1,
                'stage' => 1,
                'parent_id' => NULL,
                'process_stage_type' => NULL,
                'category' => NULL,
                'faq_category' => NULL,
                'action' => '4',
                'response_pos' => '6',
                'response_neg' => '5',
                'action_time' => '1',
                'expiry_time' => '3000',
                'expiry_param' => 0,
                'content' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
				'cmpny_id' => 2,
                'process_name' => 'Leads - Not Interested',
                'description' => NULL,
                'process' => NULL,
                'process_type' => NULL,
                'stage' => 1,
                'parent_id' => NULL,
                'process_stage_type' => NULL,
                'category' => NULL,
                'faq_category' => NULL,
                'action' => NULL,
                'response_pos' => '6',
                'response_neg' => '5',
                'action_time' => '1',
                'expiry_time' => '30000',
                'expiry_param' => 0,
                'content' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
				'cmpny_id' => 2,
                'process_name' => 'Registered Customer',
                'description' => NULL,
                'process' => NULL,
                'process_type' => 3,
                'stage' => 1,
                'parent_id' => NULL,
                'process_stage_type' => NULL,
                'category' => NULL,
                'faq_category' => NULL,
                'action' => '2',
                'response_pos' => NULL,
                'response_neg' => '7',
                'action_time' => '1',
                'expiry_time' => '3000',
                'expiry_param' => 0,
                'content' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
				'cmpny_id' => 2,
                'process_name' => 'Idle After Registration',
                'description' => NULL,
                'process' => NULL,
                'process_type' => NULL,
                'stage' => 2,
                'parent_id' => NULL,
                'process_stage_type' => NULL,
                'category' => NULL,
                'faq_category' => NULL,
                'action' => NULL,
                'response_pos' => NULL,
                'response_neg' => NULL,
                'action_time' => NULL,
                'expiry_time' => '01',
                'expiry_param' => 0,
                'content' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}