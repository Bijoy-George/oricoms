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
                'process_name' => 'Civil supplies related intimation on complaint registration',
                'action' => '2',
				'department' => 1,
				'is_first' => 1,
                'intimation_to' => '1-1,2-1,3-1,4-1',
                'intimation_cc_to' => '1-1,2-5,3-0,4-1',
                'intimation_to_param' => 1,
                'response_pos' => NULL,
                'response_neg' => '2',
                'action_time' => '5',
                'expiry_time' => '20',
                'action_time_param' => 1,
                'expiry_time_param' => 3,
                'expiry_flag' => 1,
                'content' => '1',
                'closed' => 0,
                'parent_id' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'process_name' => 'Civil supplies related intimation 2 days before due date',
                'action' => '2',
				'department' => 1,
				'is_first' => NULL,
                'intimation_to' => '1-1,2-1,3-1,4-1',
                'intimation_cc_to' => NULL,
                'intimation_to_param' => 0,
                'response_pos' => NULL,
                'response_neg' => '3',
                'action_time' => '5',
                'expiry_time' => '2',
                'action_time_param' => 1,
                'expiry_time_param' => 3,
                'expiry_flag' => 1,
                'content' => '1',
                'closed' => 0,
				'parent_id' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'process_name' => 'Civil supplies related intimation on due date',
                'action' => '2',
				'department' => 1,
				'is_first' => NULL,
                'intimation_to' => '1-1,2-1,3-1,4-1',
                'intimation_cc_to' => '1-1,2-1,3-0,4-1',
                'intimation_to_param' => 0,
                'response_pos' => NULL,
                'response_neg' => '4',
                'action_time' => '5',
                'expiry_time' => '2',
                'action_time_param' => 1,
                'expiry_time_param' => 3,
                'expiry_flag' => 0,
                'content' => '1',
                'closed' => 0,
				'parent_id' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'cmpny_id' => 2,
                'process_name' => 'Civil supplies related intimation after due date',
                'action' => '2',
				'department' => 1,
				'is_first' => NULL,
                'intimation_to' => '1-1,2-1,3-1,4-1',
                'intimation_cc_to' => '1-1,2-1,3-0,4-1',
                'intimation_to_param' => 0,
                'response_pos' => NULL,
                'response_neg' => '4',
                'action_time' => '5',
                'expiry_time' => '2',
                'action_time_param' => 1,
                'expiry_time_param' => 3,
                'expiry_flag' => 0,
                'content' => '1',
                'closed' => 0,
				'parent_id' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'cmpny_id' => 2,
                'process_name' => 'Civil supplies related intimation closed',
                'action' => '2',
				'department' => 1,
				'is_first' => NULL,
                'intimation_to' => '1-1,2-1,3-1,4-1',
                'intimation_cc_to' => '1-1,2-1,3-0,4-1',
                'intimation_to_param' => 0,
                'response_pos' => NULL,
                'response_neg' => NULL,
                'action_time' => NULL,
                'expiry_time' => NULL,
                'action_time_param' => 1,
                'expiry_time_param' => 3,
                'expiry_flag' => NULL,
                'content' => NULL,
                'closed' => 1,
				'parent_id' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}