<?php

use Illuminate\Database\Seeder;

class OriBasicTemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_basic_templates')->delete();
        
        \DB::table('ori_basic_templates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'template_type' => 2,
                'subject' => 'Escalation Intimation Mail',
                'content' => '<p>Dear [[ First Name ]],</p>
<p>Escalation summary report is given below.</p>
<p>[[ table ]]</p>',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'template_type' => 1,
                'subject' => 'Escalation Intimation SMS',
                'content' => '<p>Dear [[ First Name ]],</p>
<p>Escalation summary report is given below.</p>
<p>[[ table ]]</p>',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'template_type' => 2,
                'subject' => 'Escalation due date approaching for agent',
                'content' => '<p>Dear [[ First Name ]],</p>
<p>Escalations on following dockets are approaching it\'s due date.</p>
<p>[[ table ]]</p>',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'template_type' => 1,
                'subject' => 'Escalation due date approaching for agent sms',
                'content' => 'Escalation due date is approching for following dockets [[ table ]] ',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'template_type' => 2,
                'subject' => 'Escalation due date expired for agent ',
                'content' => '<p>Dear [[ First Name ]],</p>
<p>Escalations on following dockets have been expired.</p>
<p>[[ table ]]</p>',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'template_type' => 1,
                'subject' => 'Escalation due date expired for agent sms',
                'content' => 'Escalation on dockets [[ table ]] have been expired ',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'template_type' => 2,
                'subject' => 'Escalation Closed',
                'content' => '<p>Dear [[ First Name ]],</p>
<p>Please see the closed escalation details</p>
<p>[[ table ]]</p>',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'template_type' => 2,
                'subject' => 'Content Missing For Sales Automation!!!',
                'content' => '<p>Dear Admin,</p>
<p>Mail content is missing for the following auto process [[ Auto_process ]] with stage id [[ Auto_process_id ]]. Please do the necessary as soon as possible.</p>
',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'template_type' => 2,
                'subject' => 'Auto Mail Response',
                'content' => '<p>Dear <span>[[ First Name ]]</span>,</p>
<p>Your mail has been received. We will contact you back soon.</p>',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'template_type' => 2,
                'subject' => 'Sales Automation Leads Mail',
                'content' => 'Sales automation leads mail',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'template_type' => 1,
                'subject' => 'Sales Automation Leads SMS',
                'content' => 'Sales automation leads SMS',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'template_type' => 1,
                'subject' => 'Sales Automation Leads Manual Call',
                'content' => 'Sales automation leads Manual Call',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'template_type' => 1,
                'subject' => 'Sales Automation Leads Autodial',
                'content' => 'Sales automation leads Autodial',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}