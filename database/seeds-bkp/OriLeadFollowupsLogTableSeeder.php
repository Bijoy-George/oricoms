<?php

use Illuminate\Database\Seeder;

class OriLeadFollowupsLogTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_lead_followups_log')->delete();
        
        \DB::table('ori_lead_followups_log')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'customer_id' => 1,
                'docket_number' => '882563849',
                'remainder_date' => NULL,
                'req_title' => 'Test followup',
                'question' => '<p>Test followup question</p>',
                'answer' => '<p>Test followup answer</p>',
                'short_message' => 'Test followup answer short',
                'query_type' => 9,
                'query_category' => 1,
                'sub_query_category' => NULL,
                'customer_nature' => 2,
                'priority' => 1,
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
                'created_at' => '2018-10-31 05:55:24',
                'updated_at' => '2018-10-31 05:55:24',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}