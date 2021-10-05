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
                'process_name' => 'KYC related intimation on registration',
                'action' => NULL,
                'department' => 1,
                'is_first' => 1,
                'intimation_to' => '1-1,2-1,3-,4-1',
                'intimation_cc_to' => '1-1,2-,3-,4-1',
                'additional_cc_flag' => NULL,
                'intimation_to_param' => 1,
                'response_pos' => NULL,
                'response_neg' => '2',
                'action_time' => '5',
                'expiry_time' => '20',
                'action_time_param' => 1,
                'expiry_time_param' => 3,
                'expiry_flag' => 1,
                'content' => NULL,
                'closed' => 0,
                'parent_id' => NULL,
                'created_by' => NULL,
                'updated_by' => 2,
                'created_at' => NULL,
                'updated_at' => '2019-03-05 04:58:40',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'process_name' => 'KYC related intimation on expiry',
                'action' => '2',
                'department' => 1,
                'is_first' => NULL,
                'intimation_to' => '1-1,2-1,3-,4-1',
                'intimation_cc_to' => '1-0,2-,3-,4-0',
                'additional_cc_flag' => 1,
                'intimation_to_param' => 0,
                'response_pos' => NULL,
                'response_neg' => NULL,
                'action_time' => '5',
                'expiry_time' => '2',
                'action_time_param' => 1,
                'expiry_time_param' => 3,
                'expiry_flag' => 1,
                'content' => '1',
                'closed' => 0,
                'parent_id' => NULL,
                'created_by' => NULL,
                'updated_by' => 2,
                'created_at' => NULL,
                'updated_at' => '2019-03-05 05:04:24',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'process_name' => 'Registration related intimation on complaint registration',
                'action' => NULL,
                'department' => 1,
                'is_first' => 1,
                'intimation_to' => '1-1,2-1,3-,4-1',
                'intimation_cc_to' => '1-1,2-1,3-,4-1',
                'additional_cc_flag' => NULL,
                'intimation_to_param' => 1,
                'response_pos' => NULL,
                'response_neg' => '4',
                'action_time' => '5',
                'expiry_time' => '2',
                'action_time_param' => 1,
                'expiry_time_param' => 3,
                'expiry_flag' => 1,
                'content' => NULL,
                'closed' => 0,
                'parent_id' => NULL,
                'created_by' => NULL,
                'updated_by' => 2,
                'created_at' => NULL,
                'updated_at' => '2019-03-05 05:06:53',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'cmpny_id' => 2,
                'process_name' => 'Registration on due intimation',
                'action' => '2',
                'department' => 1,
                'is_first' => NULL,
                'intimation_to' => '1-1,2-1,3-,4-1',
                'intimation_cc_to' => '1-1,2-1,3-,4-1',
                'additional_cc_flag' => 1,
                'intimation_to_param' => 1,
                'response_pos' => NULL,
                'response_neg' => NULL,
                'action_time' => '5',
                'expiry_time' => '2',
                'action_time_param' => 1,
                'expiry_time_param' => 3,
                'expiry_flag' => 1,
                'content' => '1',
                'closed' => 0,
                'parent_id' => NULL,
                'created_by' => NULL,
                'updated_by' => 2,
                'created_at' => NULL,
                'updated_at' => '2019-03-05 05:05:57',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'cmpny_id' => 2,
                'process_name' => 'KYC related intimation closed',
                'action' => NULL,
                'department' => 1,
                'is_first' => NULL,
                'intimation_to' => '1-1,2-1,3-,4-1',
                'intimation_cc_to' => '1-1,2-1,3-,4-1',
                'additional_cc_flag' => NULL,
                'intimation_to_param' => 0,
                'response_pos' => NULL,
                'response_neg' => NULL,
                'action_time' => '5',
                'expiry_time' => '20',
                'action_time_param' => 1,
                'expiry_time_param' => 3,
                'expiry_flag' => NULL,
                'content' => NULL,
                'closed' => 1,
                'parent_id' => NULL,
                'created_by' => NULL,
                'updated_by' => 2,
                'created_at' => NULL,
                'updated_at' => '2019-03-05 04:57:49',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}