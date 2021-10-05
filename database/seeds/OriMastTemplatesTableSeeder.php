<?php

use Illuminate\Database\Seeder;

class OriMastTemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_mast_templates')->delete();
        
        \DB::table('ori_mast_templates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'title' => 'Complaint Expiry Intimation Mail',
                'subject' => 'Complaint Expiry Intimation Mail',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p></p>
<p>Dear Madam/Sir,</p>
<p></p>
<p>A complaint registered with Docket Number [[ docket_no ]] has been expired. Please do the needful as soon as possible.</p>
<p></p>
<p>Thanking you</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 2,
                'sort_order' => 3,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-22 14:00:24',
                'updated_at' => '2019-02-22 17:44:49',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'title' => 'vibultest',
                'subject' => 'vibul',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p></p>
<p>Dear Madam/Sir,</p>
<p></p>
<p>A complaint registered with Docket Number [[ docket_no ]] has been expired. Please do the needful as soon as possible.</p>
<p></p>
<p>Thanking you</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-23 10:56:24',
                'updated_at' => '2019-02-28 12:52:58',
                'deleted_at' => '2019-02-28 00:00:00',
            ),
            2 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'title' => 'test',
                'subject' => 'vibul sms',
                'content' => 'This is the test sms for testing team',
                'type' => 1,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-23 10:59:02',
                'updated_at' => '2019-01-22 13:23:06',
                'deleted_at' => '2019-02-28 00:00:00',
            ),
            3 => 
            array (
                'id' => 4,
                'cmpny_id' => 2,
                'title' => 'Feedback Email',
                'subject' => 'Thank You from GCC',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p>Dear [[ First Name ]],</p>
<p>Thank you for getting in touch with us.We would like to further assist you by learning more about your experience.Please take a moment of your time to rate our services.Browse the link&nbsp;</p>
<p>[[ Mail_Content ]]</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-23 11:01:42',
                'updated_at' => '2019-02-22 17:48:08',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'cmpny_id' => 2,
                'title' => 'Survey Email',
                'subject' => 'GCC Survey',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p>Dear Sir/Madam,</p>
<p>Greetings.</p>
<p>We would like to find out the reasons for the lack of progress so that we can provide you better service and support.In order to proceed further you may kindly click on the below link.</p>
<p>[[ survey_url ]]</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-27 17:31:26',
                'updated_at' => '2019-02-22 17:48:59',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'cmpny_id' => 2,
                'title' => 'test push',
                'subject' => 'test push template',
                'content' => 'test push template content',
                'type' => 6,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-28 09:40:53',
                'updated_at' => '2018-11-28 09:40:53',
                'deleted_at' => '2019-02-28 00:00:00',
            ),
            6 => 
            array (
                'id' => 7,
                'cmpny_id' => 2,
                'title' => 'Feedback Test',
                'subject' => 'Testing  Feedback',
                'content' => '<p>feedback testing [[feedback url]]</p>',
                'type' => 2,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-30 13:03:01',
                'updated_at' => '2018-11-30 13:03:01',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'cmpny_id' => 2,
                'title' => 'Chat ticket acknowledgement',
                'subject' => 'Chat ticket acknowledgement',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p></p>
<p>Dear [[ First Name ]],</p>
<p>This message is to confirm that we have received your request and have opened a ticket for your issue. The new ticket number is: [[ Docket number ]]. We will be contacting you if we need further information. If you would like to check on the status of your ticket, Please reach us at +1234567890.</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-12-03 15:34:46',
                'updated_at' => '2019-02-23 11:26:17',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 14,
                'cmpny_id' => 2,
                'title' => 'Test SMS Template',
                'subject' => 'Test SMS Subject',
                'content' => 'This is a test SMS from Oricoms',
                'type' => 1,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-11 12:03:12',
                'updated_at' => '2019-01-11 12:03:12',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 16,
                'cmpny_id' => 2,
                'title' => 'push',
                'subject' => 'push test',
                'content' => 'test push',
                'type' => 6,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-11 14:32:59',
                'updated_at' => '2019-01-11 14:32:59',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 17,
                'cmpny_id' => 2,
                'title' => 'Escalation Intimation Mail',
                'subject' => 'Escalation Intimation Mail',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p>Dear [[ First Name ]],<br><br>[[ table ]]</p>
<p></p>
<p>Warm Regards,</p>
<p>Government Contact Center</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-12 16:44:52',
                'updated_at' => '2019-02-22 17:52:40',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 18,
                'cmpny_id' => 2,
                'title' => 'Escalation Intimation SMS',
                'subject' => 'Escalation Intimation SMS',
                'content' => 'Dear [[ First Name ]],
[[ table ]]',
                'type' => 1,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-12 16:45:55',
                'updated_at' => '2019-02-15 16:02:59',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 19,
                'cmpny_id' => 2,
                'title' => 'Escalation due date approaching for agent',
                'subject' => 'Escalation due date approaching for agent',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p>Dear [[ First Name ]],<br>Escalations on following dockets are approaching it\'s due date.<br>[[ table ]]</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-12 16:46:18',
                'updated_at' => '2019-02-22 17:53:27',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 20,
                'cmpny_id' => 2,
                'title' => 'Escalation due date approaching for agent sms',
                'subject' => 'Escalation due date approaching for agent sms',
                'content' => 'Escalation due date is approching for following dockets [[ table ]]',
                'type' => 1,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-12 16:46:42',
                'updated_at' => '2019-01-12 16:46:42',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 21,
                'cmpny_id' => 2,
                'title' => 'Escalation due date expired for agent',
                'subject' => 'Escalation due date expired for agent',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p></p>
<p>Dear [[ First Name ]],<br>Escalations on following dockets have been expired.<br>[[ table ]]</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-12 16:47:33',
                'updated_at' => '2019-02-23 11:28:03',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 22,
                'cmpny_id' => 2,
                'title' => 'Escalation due date expired for agent sms',
                'subject' => 'Escalation due date expired for agent sms',
                'content' => 'Escalation on dockets [[ table ]] have been expired',
                'type' => 1,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-12 16:48:44',
                'updated_at' => '2019-01-12 16:48:44',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 23,
                'cmpny_id' => 2,
                'title' => 'sales automation mail',
                'subject' => 'sales automation mail',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p>sales automation mail contents</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-14 15:56:51',
                'updated_at' => '2019-02-22 17:54:34',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 24,
                'cmpny_id' => 2,
                'title' => 'sales automation sms',
                'subject' => 'sales automation sms',
                'content' => 'sales automation sms',
                'type' => 1,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-14 15:57:17',
                'updated_at' => '2019-01-14 15:57:17',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 25,
                'cmpny_id' => 2,
                'title' => 'sales automation manual call',
                'subject' => 'sales automation manual call',
                'content' => 'sales automation manual call content',
                'type' => 1,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-14 15:57:50',
                'updated_at' => '2019-01-14 15:57:50',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 26,
                'cmpny_id' => 2,
                'title' => 'sales automation autodial',
                'subject' => 'sales automation autodial',
                'content' => 'sales automation autodial content',
                'type' => 1,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-14 15:58:32',
                'updated_at' => '2019-01-14 15:58:32',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 27,
                'cmpny_id' => 2,
                'title' => 'Greetings mail template',
                'subject' => 'Greetings mail',
                'content' => '<p>tests</p>',
                'type' => 2,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-17 16:12:39',
                'updated_at' => '2019-01-17 16:12:39',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 28,
                'cmpny_id' => 2,
                'title' => 'Chat Conversation',
                'subject' => 'Chat Conversation',
                'content' => '<p></p>
<meta charset="utf-8">
<title></title>
<p><link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet"></p>
<table border="0" cellspacing="0" cellpadding="5" style="margin: 20px auto; max-width: 700px; width: 700px;">
<tbody>
<tr>
<td></td>
</tr>
<tr>
<td>
<div style="padding: 30px 25px; background-color: #fff; border-radius: 10px; -webkit-border-radius: 10px;">
<p>Dear [[ First Name ]],</p>
<p>Greetings.</p>
<p>Here\'s a copy of the chat conversation:</p>
<p><span>[[ content ]]</span></p>
<p></p>
</div>
</td>
</tr>
<tr>
<td></td>
</tr>
</tbody>
</table>',
                'type' => 2,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-17 18:00:03',
                'updated_at' => '2019-02-22 17:56:25',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 29,
                'cmpny_id' => 2,
                'title' => 'Complaint Registration Mail',
                'subject' => 'Complaint Registration Mail',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p>Dear Sir,</p>
<p>A new complaint has been submitted</p>
<p></p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-18 11:43:35',
                'updated_at' => '2019-02-22 17:57:19',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 30,
                'cmpny_id' => 2,
                'title' => 'Complaint approching the due date',
                'subject' => 'Complaint approching the due date',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p>Dear Sir,</p>
<p></p>
<p>The following complaint [[ complaint ]] is approching its due date</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-18 11:44:37',
                'updated_at' => '2019-02-22 17:58:05',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 31,
                'cmpny_id' => 2,
                'title' => 'Complaint due date is reached',
                'subject' => 'Complaint due date is reached',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p>Dear Sir,</p>
<p></p>
<p>The following complaint [[ complaint ]] due date is today. Please take necessary actions</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-18 11:45:55',
                'updated_at' => '2019-02-22 17:58:46',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 32,
                'cmpny_id' => 2,
                'title' => 'Complaint due date is expired',
                'subject' => 'Complaint due date is expired',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p>Dear Sir,</p>
<p></p>
<p>Following complaint [[ complaint ]] due date is already expired. Please do the needful.</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-18 11:47:18',
                'updated_at' => '2019-02-22 18:00:08',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 33,
                'cmpny_id' => 2,
                'title' => 'Enquiry Email',
                'subject' => 'Enquiry Email',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p>Thank you for contacting us.</p>
<p>A Reference ID-[[ Docket Number ]] has been assigned for your query, please quote this as a reference no. for all your future correspondence with us.</p>
<p>We acknowledge the receipt of your confirmation</p>
<p>You can expect to receive a reply shortly.</p>
<p></p>
<p>Warm Regards,</p>
<p>Government Contact Center</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-21 16:05:05',
                'updated_at' => '2019-02-22 18:01:11',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 34,
                'cmpny_id' => 2,
                'title' => 'Feedback Template',
                'subject' => 'Feedback',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p>Dear [[ First Name ]],</p>
<p>Thank you for getting in touch with us.We would like to further assist you by learning more about your experience.Please take a moment of your time to rate our services.Browse the link&nbsp;</p>
<p>[[ Mail_Content ]]</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-21 16:19:44',
                'updated_at' => '2019-02-22 18:02:05',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 35,
                'cmpny_id' => 2,
                'title' => 'Enquiry SMS',
                'subject' => 'Enquiry SMS',
                'content' => 'Ref ID-[[ Docket Number ]] has been assigned for your query, Please use this for your future ref.',
                'type' => 1,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-22 10:56:21',
                'updated_at' => '2019-01-22 11:13:37',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 36,
                'cmpny_id' => 2,
                'title' => 'Survey SMS',
                'subject' => 'Survey SMS',
                'content' => '[[ survey_url ]]',
                'type' => 1,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-22 11:43:15',
                'updated_at' => '2019-01-22 11:43:15',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 37,
                'cmpny_id' => 2,
                'title' => 'Campaign Test Email Template',
                'subject' => 'Campaign Test Mail',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p>Dear [[ First Name ]],</p>
<p>This is the test campaigning mail from Government Contact Center.</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-22 13:03:30',
                'updated_at' => '2019-02-22 18:02:41',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 38,
                'cmpny_id' => 2,
                'title' => 'Campaign Test SMS Template',
                'subject' => 'Campaign Test SMS',
                'content' => 'This is test campaigning SMS from Government Contact Center.',
                'type' => 1,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-01-22 16:17:17',
                'updated_at' => '2019-01-22 16:17:17',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 39,
                'cmpny_id' => 2,
                'title' => 'Header template',
                'subject' => 'Header template',
                'content' => '<p><meta name="viewport" content="width=device-width"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="x-apple-disable-message-reformatting"><meta charset="utf-8">
<title>Mail</title>
</p>
<!--header -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<table style="width: 100%;">
<tbody>
<tr>
<td style="text-align: left;"><img width="100px" src="http://68.183.84.156/img/gcc_logo.png"></td>
<td style="text-align: center;"><img width="100px" src="http://68.183.84.156/img/gok-logo.png"></td>
<td style="text-align: right;"><img width="100px" src="http://68.183.84.156/img/It-mission.png"></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--header -->
<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;"></td>
</tr>
</tbody>
</table>',
                'type' => 2,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 2,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-13 16:41:15',
                'updated_at' => '2019-02-28 12:49:10',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 40,
                'cmpny_id' => 2,
                'title' => 'Footer template',
                'subject' => 'Footer template',
                'content' => '<p></p>
<!--Content -->
<p></p>
<!--Footer -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<table style="width: 100%;">
<tbody>
<tr valign="top">
<td style="text-align: center; color: #888;" valign="top">Government Contact Centre-Kerala | Kerala State IT Mission <img width="40px" src="http://68.183.84.156/img/right-bottom.png"></td>
</tr>
</tbody>
</table>
</td>
</tr>
<!--Footer --></tbody>
</table>',
                'type' => 2,
                'is_show' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-13 16:41:58',
                'updated_at' => '2019-02-23 11:23:29',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 49,
                'cmpny_id' => 2,
                'title' => 'Escalation Summary Report',
                'subject' => 'Escalation Summary Report',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p>Dear [[ First Name ]],<br>your [[ period ]] escalation summary report is given below.<br>[[ table ]]</p>
<p></p>
<p>Warm Regards,</p>
<p>Government Contact Center</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-15 15:53:56',
                'updated_at' => '2019-02-22 18:03:55',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 50,
                'cmpny_id' => 2,
                'title' => 'Escalation Summary Report SMS',
                'subject' => 'Escalation Summary Report SMS',
                'content' => 'Dear [[ First Name ]]
your [[ period ]] escalation summary report is given below
[[ table ]]',
                'type' => 1,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-15 15:54:46',
                'updated_at' => '2019-02-15 15:55:38',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 51,
                'cmpny_id' => 2,
                'title' => 'Escalation Closing Mail',
                'subject' => 'Escalation Closed Intimation',
                'content' => '<p></p>
<!--Content -->
<table style="width: 100%; max-width: 700px; background: #ffffff; margin: 0 auto;">
<tbody>
<tr>
<td style="padding: 20px;">
<p></p>
<p>Dear [[ First Name ]],</p>
<p></p>
<p>Escalation on the following docket [[ table ]] has been closed</p>
<p></p>
<p>Thanking you</p>
</td>
</tr>
<!--Content --></tbody>
</table>',
                'type' => 2,
                'is_show' => 2,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2019-02-15 17:10:42',
                'updated_at' => '2019-02-22 18:04:42',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}