<?php

use Illuminate\Database\Seeder;

class OriHelpdeskLogTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_helpdesk_log')->delete();
        
        \DB::table('ori_helpdesk_log')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'customer_id' => 1,
                'docket_number' => '700058487',
                'remainder_date' => NULL,
                'req_title' => 'Test complaint',
                'question' => '<p>Test complaint question</p>',
                'answer' => '<p>Test complaint answer</p>',
                'short_message' => 'Test complaint answer short',
                'query_type' => 5,
                'query_category' => 2,
                'sub_query_category' => NULL,
                'customer_nature' => 1,
                'priority' => 2,
                'need_followup' => NULL,
                'lead_source_id' => NULL,
                'query_status' => 2,
                'escalation_status' => NULL,
                'escalate' => NULL,
                'escalation_deadline' => NULL,
                'escalation_due_date' => NULL,
                'take_up_status' => 0,
                'call_id' => NULL,
                'outbound_calls' => 0,
                'batch_id' => NULL,
                'agent_id' => NULL,
                'attended_by' => 2,
                'assigned_agent' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-10-31 05:43:29',
                'updated_at' => '2018-10-31 05:43:29',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}