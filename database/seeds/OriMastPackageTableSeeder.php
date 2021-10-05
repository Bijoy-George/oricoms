<?php

use Illuminate\Database\Seeder;

class OriMastPackageTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_mast_package')->delete();
        
        \DB::table('ori_mast_package')->insert(array (
            0 => 
            array (
                'id' => 1,
                'package_name' => 'permission management',
                'package_type' => 4,
                'permission_under_package' => 'a:1:{i:0;a:2:{s:13:"permission_id";s:1:"1";s:15:"permission_name";s:21:"permission management";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:44:58',
                'updated_at' => '2018-11-16 18:44:58',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'package_name' => 'package management',
                'package_type' => 4,
                'permission_under_package' => 'a:1:{i:0;a:2:{s:13:"permission_id";s:2:"45";s:15:"permission_name";s:18:"package management";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:45:14',
                'updated_at' => '2018-11-16 18:45:14',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'package_name' => 'role management',
                'package_type' => 4,
                'permission_under_package' => 'a:1:{i:0;a:2:{s:13:"permission_id";s:1:"2";s:15:"permission_name";s:15:"role management";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:45:26',
                'updated_at' => '2018-11-16 18:45:26',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'package_name' => 'user management',
                'package_type' => 4,
                'permission_under_package' => 'a:1:{i:0;a:2:{s:13:"permission_id";s:1:"3";s:15:"permission_name";s:15:"user management";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:45:37',
                'updated_at' => '2018-11-16 18:45:37',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'package_name' => 'plan management',
                'package_type' => 4,
                'permission_under_package' => 'a:4:{i:0;a:2:{s:13:"permission_id";s:1:"4";s:15:"permission_name";s:11:"plan create";}i:1;a:2:{s:13:"permission_id";s:1:"5";s:15:"permission_name";s:9:"plan edit";}i:2;a:2:{s:13:"permission_id";s:1:"6";s:15:"permission_name";s:9:"plan list";}i:3;a:2:{s:13:"permission_id";s:1:"7";s:15:"permission_name";s:11:"plan delete";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:46:46',
                'updated_at' => '2018-11-16 18:46:46',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'package_name' => 'query type management',
                'package_type' => 4,
                'permission_under_package' => 'a:4:{i:0;a:2:{s:13:"permission_id";s:1:"8";s:15:"permission_name";s:17:"query type create";}i:1;a:2:{s:13:"permission_id";s:1:"9";s:15:"permission_name";s:15:"query type edit";}i:2;a:2:{s:13:"permission_id";s:2:"10";s:15:"permission_name";s:15:"query type list";}i:3;a:2:{s:13:"permission_id";s:2:"11";s:15:"permission_name";s:17:"query type delete";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:47:25',
                'updated_at' => '2018-11-16 18:47:25',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'package_name' => 'query status management',
                'package_type' => 4,
                'permission_under_package' => 'a:4:{i:0;a:2:{s:13:"permission_id";s:2:"12";s:15:"permission_name";s:19:"query status create";}i:1;a:2:{s:13:"permission_id";s:2:"13";s:15:"permission_name";s:17:"query status edit";}i:2;a:2:{s:13:"permission_id";s:2:"14";s:15:"permission_name";s:17:"query status list";}i:3;a:2:{s:13:"permission_id";s:2:"15";s:15:"permission_name";s:19:"query status delete";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:48:11',
                'updated_at' => '2018-11-16 18:48:11',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'package_name' => 'customer nature',
                'package_type' => 4,
                'permission_under_package' => 'a:4:{i:0;a:2:{s:13:"permission_id";s:2:"16";s:15:"permission_name";s:22:"customer nature create";}i:1;a:2:{s:13:"permission_id";s:2:"17";s:15:"permission_name";s:20:"customer nature edit";}i:2;a:2:{s:13:"permission_id";s:2:"18";s:15:"permission_name";s:20:"customer nature list";}i:3;a:2:{s:13:"permission_id";s:2:"19";s:15:"permission_name";s:22:"customer nature delete";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:48:31',
                'updated_at' => '2018-11-22 12:29:28',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'package_name' => 'customer priority',
                'package_type' => 4,
                'permission_under_package' => 'a:4:{i:0;a:2:{s:13:"permission_id";s:2:"20";s:15:"permission_name";s:24:"customer priority create";}i:1;a:2:{s:13:"permission_id";s:2:"21";s:15:"permission_name";s:22:"customer priority edit";}i:2;a:2:{s:13:"permission_id";s:2:"22";s:15:"permission_name";s:22:"customer priority list";}i:3;a:2:{s:13:"permission_id";s:2:"23";s:15:"permission_name";s:24:"customer priority delete";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:48:56',
                'updated_at' => '2018-11-16 18:48:56',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'package_name' => 'settings view',
                'package_type' => 4,
                'permission_under_package' => 'a:4:{i:0;a:2:{s:13:"permission_id";s:2:"29";s:15:"permission_name";s:13:"settings view";}i:1;a:2:{s:13:"permission_id";s:2:"37";s:15:"permission_name";s:14:"changepassword";}i:2;a:2:{s:13:"permission_id";s:3:"104";s:15:"permission_name";s:13:"chat settings";}i:3;a:2:{s:13:"permission_id";s:3:"105";s:15:"permission_name";s:19:"escalation settings";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:49:35',
                'updated_at' => '2019-01-30 10:31:58',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'package_name' => 'faq management',
                'package_type' => 4,
                'permission_under_package' => 'a:6:{i:0;a:2:{s:13:"permission_id";s:2:"24";s:15:"permission_name";s:10:"faq create";}i:1;a:2:{s:13:"permission_id";s:2:"25";s:15:"permission_name";s:8:"faq edit";}i:2;a:2:{s:13:"permission_id";s:2:"26";s:15:"permission_name";s:8:"faq list";}i:3;a:2:{s:13:"permission_id";s:2:"27";s:15:"permission_name";s:10:"faq delete";}i:4;a:2:{s:13:"permission_id";s:2:"28";s:15:"permission_name";s:19:"view faq categories";}i:5;a:2:{s:13:"permission_id";s:3:"125";s:15:"permission_name";s:12:"faq activate";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:50:00',
                'updated_at' => '2019-02-28 17:24:12',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'package_name' => 'template management',
                'package_type' => 4,
                'permission_under_package' => 'a:4:{i:0;a:2:{s:13:"permission_id";s:2:"30";s:15:"permission_name";s:15:"template create";}i:1;a:2:{s:13:"permission_id";s:2:"31";s:15:"permission_name";s:13:"template edit";}i:2;a:2:{s:13:"permission_id";s:2:"32";s:15:"permission_name";s:13:"template list";}i:3;a:2:{s:13:"permission_id";s:2:"33";s:15:"permission_name";s:15:"template delete";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:50:22',
                'updated_at' => '2018-11-16 18:50:22',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'package_name' => 'profile management',
                'package_type' => 4,
                'permission_under_package' => 'a:4:{i:0;a:2:{s:13:"permission_id";s:2:"34";s:15:"permission_name";s:14:"profile create";}i:1;a:2:{s:13:"permission_id";s:2:"35";s:15:"permission_name";s:12:"profile view";}i:2;a:2:{s:13:"permission_id";s:3:"101";s:15:"permission_name";s:21:"profile customization";}i:3;a:2:{s:13:"permission_id";s:3:"121";s:15:"permission_name";s:19:"show hidden details";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:52:20',
                'updated_at' => '2019-02-27 11:23:05',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'package_name' => 'lead management',
                'package_type' => 4,
                'permission_under_package' => 'a:9:{i:0;a:2:{s:13:"permission_id";s:2:"36";s:15:"permission_name";s:9:"lead list";}i:1;a:2:{s:13:"permission_id";s:2:"51";s:15:"permission_name";s:23:"lead source type create";}i:2;a:2:{s:13:"permission_id";s:2:"52";s:15:"permission_name";s:21:"lead source type edit";}i:3;a:2:{s:13:"permission_id";s:2:"53";s:15:"permission_name";s:21:"lead source type list";}i:4;a:2:{s:13:"permission_id";s:2:"54";s:15:"permission_name";s:23:"lead source type delete";}i:5;a:2:{s:13:"permission_id";s:2:"55";s:15:"permission_name";s:18:"lead source create";}i:6;a:2:{s:13:"permission_id";s:2:"56";s:15:"permission_name";s:16:"lead source edit";}i:7;a:2:{s:13:"permission_id";s:2:"57";s:15:"permission_name";s:16:"lead source list";}i:8;a:2:{s:13:"permission_id";s:2:"58";s:15:"permission_name";s:18:"lead source delete";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:52:36',
                'updated_at' => '2019-01-11 11:43:28',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'package_name' => 'task list',
                'package_type' => 4,
                'permission_under_package' => 'a:9:{i:0;a:2:{s:13:"permission_id";s:2:"40";s:15:"permission_name";s:24:"service request all list";}i:1;a:2:{s:13:"permission_id";s:2:"41";s:15:"permission_name";s:24:"escalation summary chart";}i:2;a:2:{s:13:"permission_id";s:2:"43";s:15:"permission_name";s:12:"escalated to";}i:3;a:2:{s:13:"permission_id";s:3:"100";s:15:"permission_name";s:8:"escalate";}i:4;a:2:{s:13:"permission_id";s:3:"107";s:15:"permission_name";s:4:"Task";}i:5;a:2:{s:13:"permission_id";s:3:"110";s:15:"permission_name";s:23:"enquiry by source graph";}i:6;a:2:{s:13:"permission_id";s:3:"111";s:15:"permission_name";s:23:"enquiry date wise count";}i:7;a:2:{s:13:"permission_id";s:3:"112";s:15:"permission_name";s:21:"ticket followup graph";}i:8;a:2:{s:13:"permission_id";s:3:"119";s:15:"permission_name";s:18:"escalation reports";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:53:26',
                'updated_at' => '2019-02-21 12:23:41',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'package_name' => 'help desk',
                'package_type' => 4,
                'permission_under_package' => 'a:9:{i:0;a:2:{s:13:"permission_id";s:2:"43";s:15:"permission_name";s:12:"escalated to";}i:1;a:2:{s:13:"permission_id";s:2:"44";s:15:"permission_name";s:13:"followup view";}i:2;a:2:{s:13:"permission_id";s:2:"47";s:15:"permission_name";s:16:"Followups Reopen";}i:3;a:2:{s:13:"permission_id";s:2:"48";s:15:"permission_name";s:21:"followup history edit";}i:4;a:2:{s:13:"permission_id";s:2:"99";s:15:"permission_name";s:18:"export in helpdesk";}i:5;a:2:{s:13:"permission_id";s:3:"106";s:15:"permission_name";s:8:"Helpdesk";}i:6;a:2:{s:13:"permission_id";s:3:"117";s:15:"permission_name";s:21:"followup excel report";}i:7;a:2:{s:13:"permission_id";s:3:"118";s:15:"permission_name";s:19:"followup pdf report";}i:8;a:2:{s:13:"permission_id";s:3:"120";s:15:"permission_name";s:25:"enquiry by category graph";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-16 18:54:11',
                'updated_at' => '2019-02-21 13:42:33',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'package_name' => 'survey management',
                'package_type' => 4,
                'permission_under_package' => 'a:3:{i:0;a:2:{s:13:"permission_id";s:2:"46";s:15:"permission_name";s:17:"survey management";}i:1;a:2:{s:13:"permission_id";s:2:"49";s:15:"permission_name";s:13:"survey report";}i:2;a:2:{s:13:"permission_id";s:3:"108";s:15:"permission_name";s:23:"survey statistics graph";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-21 18:46:27',
                'updated_at' => '2019-02-18 12:31:56',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'package_name' => 'feedback management',
                'package_type' => 4,
                'permission_under_package' => 'a:3:{i:0;a:2:{s:13:"permission_id";s:2:"39";s:15:"permission_name";s:17:"feedback settings";}i:1;a:2:{s:13:"permission_id";s:2:"50";s:15:"permission_name";s:15:"feedback report";}i:2;a:2:{s:13:"permission_id";s:3:"109";s:15:"permission_name";s:25:"feedback statistics graph";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-21 18:47:07',
                'updated_at' => '2019-02-18 12:32:12',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'package_name' => 'lead source management',
                'package_type' => 4,
                'permission_under_package' => 'a:8:{i:0;a:2:{s:13:"permission_id";s:2:"51";s:15:"permission_name";s:23:"lead source type create";}i:1;a:2:{s:13:"permission_id";s:2:"52";s:15:"permission_name";s:21:"lead source type edit";}i:2;a:2:{s:13:"permission_id";s:2:"53";s:15:"permission_name";s:21:"lead source type list";}i:3;a:2:{s:13:"permission_id";s:2:"54";s:15:"permission_name";s:23:"lead source type delete";}i:4;a:2:{s:13:"permission_id";s:2:"55";s:15:"permission_name";s:18:"lead source create";}i:5;a:2:{s:13:"permission_id";s:2:"56";s:15:"permission_name";s:16:"lead source edit";}i:6;a:2:{s:13:"permission_id";s:2:"57";s:15:"permission_name";s:16:"lead source list";}i:7;a:2:{s:13:"permission_id";s:2:"58";s:15:"permission_name";s:18:"lead source delete";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-22 11:06:10',
                'updated_at' => '2018-11-22 11:06:10',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'package_name' => 'question management',
                'package_type' => 4,
                'permission_under_package' => 'a:1:{i:0;a:2:{s:13:"permission_id";s:2:"38";s:15:"permission_name";s:19:"question management";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-22 11:17:23',
                'updated_at' => '2018-11-22 11:17:54',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'package_name' => 'campaign management',
                'package_type' => 4,
                'permission_under_package' => 'a:5:{i:0;a:2:{s:13:"permission_id";s:2:"42";s:15:"permission_name";s:19:"campaign management";}i:1;a:2:{s:13:"permission_id";s:2:"71";s:15:"permission_name";s:15:"campaign create";}i:2;a:2:{s:13:"permission_id";s:2:"72";s:15:"permission_name";s:13:"campaign edit";}i:3;a:2:{s:13:"permission_id";s:2:"73";s:15:"permission_name";s:13:"campaign list";}i:4;a:2:{s:13:"permission_id";s:2:"74";s:15:"permission_name";s:15:"campaign delete";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-22 11:33:15',
                'updated_at' => '2018-11-30 11:34:04',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'package_name' => 'sales automation',
                'package_type' => 4,
                'permission_under_package' => 'a:4:{i:0;a:2:{s:13:"permission_id";s:2:"59";s:15:"permission_name";s:23:"sales automation create";}i:1;a:2:{s:13:"permission_id";s:2:"60";s:15:"permission_name";s:21:"sales automation edit";}i:2;a:2:{s:13:"permission_id";s:2:"61";s:15:"permission_name";s:21:"sales automation list";}i:3;a:2:{s:13:"permission_id";s:2:"62";s:15:"permission_name";s:23:"sales automation delete";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-22 11:36:28',
                'updated_at' => '2018-11-22 11:36:28',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'package_name' => 'intimation settings',
                'package_type' => 4,
                'permission_under_package' => 'a:4:{i:0;a:2:{s:13:"permission_id";s:2:"63";s:15:"permission_name";s:26:"intimation settings create";}i:1;a:2:{s:13:"permission_id";s:2:"64";s:15:"permission_name";s:24:"intimation settings edit";}i:2;a:2:{s:13:"permission_id";s:3:"102";s:15:"permission_name";s:12:"company meta";}i:3;a:2:{s:13:"permission_id";s:3:"103";s:15:"permission_name";s:15:"channel gateway";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-22 15:27:01',
                'updated_at' => '2019-01-28 12:45:22',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'package_name' => 'notifications',
                'package_type' => 4,
                'permission_under_package' => 'a:1:{i:0;a:2:{s:13:"permission_id";s:2:"65";s:15:"permission_name";s:17:"notification list";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-22 15:32:48',
                'updated_at' => '2018-11-22 15:32:48',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'package_name' => 'group management',
                'package_type' => 4,
                'permission_under_package' => 'a:7:{i:0;a:2:{s:13:"permission_id";s:2:"66";s:15:"permission_name";s:16:"group management";}i:1;a:2:{s:13:"permission_id";s:2:"67";s:15:"permission_name";s:12:"group create";}i:2;a:2:{s:13:"permission_id";s:2:"68";s:15:"permission_name";s:10:"group edit";}i:3;a:2:{s:13:"permission_id";s:2:"69";s:15:"permission_name";s:10:"group list";}i:4;a:2:{s:13:"permission_id";s:2:"70";s:15:"permission_name";s:12:"group delete";}i:5;a:2:{s:13:"permission_id";s:2:"84";s:15:"permission_name";s:17:"group lead import";}i:6;a:2:{s:13:"permission_id";s:2:"85";s:15:"permission_name";s:18:"group excel import";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-30 11:35:11',
                'updated_at' => '2018-11-30 11:35:11',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'package_name' => 'campaign reports',
                'package_type' => 4,
                'permission_under_package' => 'a:9:{i:0;a:2:{s:13:"permission_id";s:2:"75";s:15:"permission_name";s:29:"campaign email delivery graph";}i:1;a:2:{s:13:"permission_id";s:2:"76";s:15:"permission_name";s:32:"campaign batch efficiency report";}i:2;a:2:{s:13:"permission_id";s:2:"77";s:15:"permission_name";s:27:"campaign email batch report";}i:3;a:2:{s:13:"permission_id";s:2:"78";s:15:"permission_name";s:27:"campaign sms delivery graph";}i:4;a:2:{s:13:"permission_id";s:2:"79";s:15:"permission_name";s:25:"campaign sms batch report";}i:5;a:2:{s:13:"permission_id";s:2:"80";s:15:"permission_name";s:30:"campaign autodial status graph";}i:6;a:2:{s:13:"permission_id";s:2:"81";s:15:"permission_name";s:30:"campaign autodial batch report";}i:7;a:2:{s:13:"permission_id";s:2:"82";s:15:"permission_name";s:32:"campaign manualcall status graph";}i:8;a:2:{s:13:"permission_id";s:2:"83";s:15:"permission_name";s:32:"campaign manualcall batch report";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-30 11:36:43',
                'updated_at' => '2018-11-30 11:36:43',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'package_name' => 'tab management',
                'package_type' => 4,
                'permission_under_package' => 'a:4:{i:0;a:2:{s:13:"permission_id";s:2:"86";s:15:"permission_name";s:19:"customer tab create";}i:1;a:2:{s:13:"permission_id";s:2:"87";s:15:"permission_name";s:19:"customer tab delete";}i:2;a:2:{s:13:"permission_id";s:2:"88";s:15:"permission_name";s:17:"customer tab edit";}i:3;a:2:{s:13:"permission_id";s:2:"89";s:15:"permission_name";s:17:"customer tab list";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-12-05 18:44:31',
                'updated_at' => '2018-12-05 18:44:31',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'package_name' => 'chat management',
                'package_type' => 4,
                'permission_under_package' => 'a:1:{i:0;a:2:{s:13:"permission_id";s:2:"90";s:15:"permission_name";s:18:"chat configuration";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-12-07 12:04:28',
                'updated_at' => '2018-12-07 12:04:28',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'package_name' => 'chat auto reply management',
                'package_type' => 4,
                'permission_under_package' => 'a:2:{i:0;a:2:{s:13:"permission_id";s:2:"91";s:15:"permission_name";s:26:"view auto reply categories";}i:1;a:2:{s:13:"permission_id";s:2:"92";s:15:"permission_name";s:15:"auto reply list";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2019-01-08 10:34:48',
                'updated_at' => '2019-01-08 10:34:48',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'package_name' => 'call management',
                'package_type' => 4,
                'permission_under_package' => 'a:2:{i:0;a:2:{s:13:"permission_id";s:2:"93";s:15:"permission_name";s:26:"agent manual outbound call";}i:1;a:2:{s:13:"permission_id";s:2:"94";s:15:"permission_name";s:13:"outbound call";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2019-01-11 15:28:26',
                'updated_at' => '2019-01-11 16:52:58',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'package_name' => 'master management',
                'package_type' => 4,
                'permission_under_package' => 'a:10:{i:0;a:2:{s:13:"permission_id";s:2:"96";s:15:"permission_name";s:16:"designation list";}i:1;a:2:{s:13:"permission_id";s:2:"97";s:15:"permission_name";s:18:"designation create";}i:2;a:2:{s:13:"permission_id";s:2:"98";s:15:"permission_name";s:16:"designation edit";}i:3;a:2:{s:13:"permission_id";s:3:"113";s:15:"permission_name";s:18:"supply office list";}i:4;a:2:{s:13:"permission_id";s:3:"114";s:15:"permission_name";s:20:"supply office create";}i:5;a:2:{s:13:"permission_id";s:3:"115";s:15:"permission_name";s:18:"supply office edit";}i:6;a:2:{s:13:"permission_id";s:3:"116";s:15:"permission_name";s:20:"supply office delete";}i:7;a:2:{s:13:"permission_id";s:3:"122";s:15:"permission_name";s:18:"supply card create";}i:8;a:2:{s:13:"permission_id";s:3:"123";s:15:"permission_name";s:16:"supply card edit";}i:9;a:2:{s:13:"permission_id";s:3:"124";s:15:"permission_name";s:16:"supply card list";}}',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2019-01-16 11:15:07',
                'updated_at' => '2019-02-27 11:22:48',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}