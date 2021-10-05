<?php

use Illuminate\Database\Seeder;

class OriUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_users')->delete();
        
        \DB::table('ori_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 1,
                'name' => 'Oricom',
                'email' => 'admin@oricom.in',
                'username' => 'oricom',
                'chat_name' => 'oricom',
                'phone' => '80868000203',
                'address' => 'D3,6th floor, Bhavani Building, Technopark,Trivandrum',
                'password' => '$2y$10$WAujBoWDvGcA0lIzvJqBT.xhIJIPLLWoFlXs8x3dYXoAmduVbJGZy',
                'extension' => NULL,
                'role_id' => 'a:1:{i:0;s:1:"1";}',
                'remember_token' => NULL,
                'access_permission' => 'a:89:{i:0;a:2:{s:13:"permission_id";s:1:"1";s:15:"permission_name";s:8:"faq view";}i:1;a:2:{s:13:"permission_id";s:1:"2";s:15:"permission_name";s:7:"faq new";}i:2;a:2:{s:13:"permission_id";s:1:"3";s:15:"permission_name";s:10:"faq remove";}i:3;a:2:{s:13:"permission_id";s:1:"4";s:15:"permission_name";s:17:"import export faq";}i:4;a:2:{s:13:"permission_id";s:1:"5";s:15:"permission_name";s:10:"leads view";}i:5;a:2:{s:13:"permission_id";s:1:"6";s:15:"permission_name";s:12:"leads remove";}i:6;a:2:{s:13:"permission_id";s:1:"7";s:15:"permission_name";s:19:"import export leads";}i:7;a:2:{s:13:"permission_id";s:1:"8";s:15:"permission_name";s:14:"dashboard view";}i:8;a:2:{s:13:"permission_id";s:1:"9";s:15:"permission_name";s:13:"settings view";}i:9;a:2:{s:13:"permission_id";s:2:"10";s:15:"permission_name";s:14:"changepassword";}i:10;a:2:{s:13:"permission_id";s:2:"11";s:15:"permission_name";s:6:"logout";}i:11;a:2:{s:13:"permission_id";s:2:"12";s:15:"permission_name";s:17:"profile form view";}i:12;a:2:{s:13:"permission_id";s:2:"13";s:15:"permission_name";s:8:"faq view";}i:13;a:2:{s:13:"permission_id";s:2:"14";s:15:"permission_name";s:20:"suggested chits view";}i:14;a:2:{s:13:"permission_id";s:2:"15";s:15:"permission_name";s:13:"followup view";}i:15;a:2:{s:13:"permission_id";s:2:"16";s:15:"permission_name";s:15:"followup remove";}i:16;a:2:{s:13:"permission_id";s:2:"17";s:15:"permission_name";s:20:"announced chits view";}i:17;a:2:{s:13:"permission_id";s:2:"18";s:15:"permission_name";s:26:"announced chits management";}i:18;a:2:{s:13:"permission_id";s:2:"20";s:15:"permission_name";s:21:"permission management";}i:19;a:2:{s:13:"permission_id";s:2:"21";s:15:"permission_name";s:15:"role management";}i:20;a:2:{s:13:"permission_id";s:2:"22";s:15:"permission_name";s:24:"customer suggestion view";}i:21;a:2:{s:13:"permission_id";s:2:"23";s:15:"permission_name";s:16:"fetch email view";}i:22;a:2:{s:13:"permission_id";s:2:"28";s:15:"permission_name";s:23:"customer announced view";}i:23;a:2:{s:13:"permission_id";s:2:"29";s:15:"permission_name";s:22:"service level settings";}i:24;a:2:{s:13:"permission_id";s:2:"30";s:15:"permission_name";s:15:"officer shedule";}i:25;a:2:{s:13:"permission_id";s:2:"33";s:15:"permission_name";s:20:"Expert followup edit";}i:26;a:2:{s:13:"permission_id";s:2:"34";s:15:"permission_name";s:21:"followup history edit";}i:27;a:2:{s:13:"permission_id";s:2:"36";s:15:"permission_name";s:24:"leadstatistics dashgraph";}i:28;a:2:{s:13:"permission_id";s:2:"37";s:15:"permission_name";s:34:"total announced chit sub dashgraph";}i:29;a:2:{s:13:"permission_id";s:2:"38";s:15:"permission_name";s:18:"followup dashgraph";}i:30;a:2:{s:13:"permission_id";s:2:"40";s:15:"permission_name";s:22:"Followyup calanderview";}i:31;a:2:{s:13:"permission_id";s:2:"41";s:15:"permission_name";s:17:"view auction room";}i:32;a:2:{s:13:"permission_id";s:2:"42";s:15:"permission_name";s:30:"agent task for lead conversion";}i:33;a:2:{s:13:"permission_id";s:2:"43";s:15:"permission_name";s:12:"whatsapp web";}i:34;a:2:{s:13:"permission_id";s:2:"44";s:15:"permission_name";s:12:"setextension";}i:35;a:2:{s:13:"permission_id";s:2:"45";s:15:"permission_name";s:22:"mail template settings";}i:36;a:2:{s:13:"permission_id";s:2:"46";s:15:"permission_name";s:12:"outboundcall";}i:37;a:2:{s:13:"permission_id";s:2:"47";s:15:"permission_name";s:16:"email sms report";}i:38;a:2:{s:13:"permission_id";s:2:"48";s:15:"permission_name";s:21:"view unattended calls";}i:39;a:2:{s:13:"permission_id";s:2:"49";s:15:"permission_name";s:19:"suggested chits new";}i:40;a:2:{s:13:"permission_id";s:2:"54";s:15:"permission_name";s:26:"dashboard facebook twitter";}i:41;a:2:{s:13:"permission_id";s:2:"55";s:15:"permission_name";s:24:"dashboard customer count";}i:42;a:2:{s:13:"permission_id";s:2:"56";s:15:"permission_name";s:21:"dashboard leads count";}i:43;a:2:{s:13:"permission_id";s:2:"57";s:15:"permission_name";s:26:"dashboard open issue count";}i:44;a:2:{s:13:"permission_id";s:2:"58";s:15:"permission_name";s:29:"dashboard pending issue count";}i:45;a:2:{s:13:"permission_id";s:2:"59";s:15:"permission_name";s:25:"dashboard escalated count";}i:46;a:2:{s:13:"permission_id";s:2:"60";s:15:"permission_name";s:25:"general enquiry pie chart";}i:47;a:2:{s:13:"permission_id";s:2:"61";s:15:"permission_name";s:19:"follow up pie chart";}i:48;a:2:{s:13:"permission_id";s:2:"62";s:15:"permission_name";s:25:"service sequest pie chart";}i:49;a:2:{s:13:"permission_id";s:2:"63";s:15:"permission_name";s:20:"complaints pie chart";}i:50;a:2:{s:13:"permission_id";s:2:"64";s:15:"permission_name";s:33:"dashboard enquriy date line chart";}i:51;a:2:{s:13:"permission_id";s:2:"65";s:15:"permission_name";s:12:"funnel graph";}i:52;a:2:{s:13:"permission_id";s:2:"66";s:15:"permission_name";s:35:"dashboard service request bar chart";}i:53;a:2:{s:13:"permission_id";s:2:"68";s:15:"permission_name";s:20:"latest faq dashgraph";}i:54;a:2:{s:13:"permission_id";s:2:"69";s:15:"permission_name";s:20:"kyc status pie chart";}i:55;a:2:{s:13:"permission_id";s:2:"71";s:15:"permission_name";s:29:"latest subscription dashgraph";}i:56;a:2:{s:13:"permission_id";s:2:"73";s:15:"permission_name";s:15:"user management";}i:57;a:2:{s:13:"permission_id";s:2:"74";s:15:"permission_name";s:20:"manual outbound call";}i:58;a:2:{s:13:"permission_id";s:2:"76";s:15:"permission_name";s:22:"call center wall board";}i:59;a:2:{s:13:"permission_id";s:2:"77";s:15:"permission_name";s:16:"mail sms reports";}i:60;a:2:{s:13:"permission_id";s:2:"78";s:15:"permission_name";s:11:"branch view";}i:61;a:2:{s:13:"permission_id";s:2:"79";s:15:"permission_name";s:17:"autodial schedule";}i:62;a:2:{s:13:"permission_id";s:2:"80";s:15:"permission_name";s:13:"agent reports";}i:63;a:2:{s:13:"permission_id";s:2:"81";s:15:"permission_name";s:17:"automated process";}i:64;a:2:{s:13:"permission_id";s:2:"85";s:15:"permission_name";s:19:"campaign management";}i:65;a:2:{s:13:"permission_id";s:2:"86";s:15:"permission_name";s:8:"escalate";}i:66;a:2:{s:13:"permission_id";s:2:"87";s:15:"permission_name";s:12:"escalated to";}i:67;a:2:{s:13:"permission_id";s:2:"88";s:15:"permission_name";s:22:"call center wall board";}i:68;a:2:{s:13:"permission_id";s:2:"89";s:15:"permission_name";s:16:"Followups Reopen";}i:69;a:2:{s:13:"permission_id";s:2:"91";s:15:"permission_name";s:21:"sms template settings";}i:70;a:2:{s:13:"permission_id";s:2:"93";s:15:"permission_name";s:11:"api reports";}i:71;a:2:{s:13:"permission_id";s:2:"94";s:15:"permission_name";s:15:"statistics view";}i:72;a:2:{s:13:"permission_id";s:2:"95";s:15:"permission_name";s:12:"save profile";}i:73;a:2:{s:13:"permission_id";s:2:"96";s:15:"permission_name";s:20:"lead statistics view";}i:74;a:2:{s:13:"permission_id";s:2:"97";s:15:"permission_name";s:25:"dashboard lead line chart";}i:75;a:2:{s:13:"permission_id";s:2:"98";s:15:"permission_name";s:24:"mail sms statistics view";}i:76;a:2:{s:13:"permission_id";s:2:"99";s:15:"permission_name";s:27:"autoprocess statistics view";}i:77;a:2:{s:13:"permission_id";s:3:"100";s:15:"permission_name";s:12:"tickets view";}i:78;a:2:{s:13:"permission_id";s:3:"101";s:15:"permission_name";s:17:"feedback settings";}i:79;a:2:{s:13:"permission_id";s:3:"102";s:15:"permission_name";s:17:"chat history view";}i:80;a:2:{s:13:"permission_id";s:3:"103";s:15:"permission_name";s:26:"chat feedback history view";}i:81;a:2:{s:13:"permission_id";s:3:"104";s:15:"permission_name";s:24:"service request all list";}i:82;a:2:{s:13:"permission_id";s:3:"105";s:15:"permission_name";s:13:"FC Calculator";}i:83;a:2:{s:13:"permission_id";s:3:"106";s:15:"permission_name";s:12:"finance plan";}i:84;a:2:{s:13:"permission_id";s:3:"107";s:15:"permission_name";s:18:"export in helpdesk";}i:85;a:2:{s:13:"permission_id";s:3:"108";s:15:"permission_name";s:24:"escalation summary chart";}i:86;a:2:{s:13:"permission_id";s:3:"109";s:15:"permission_name";s:22:"deregistered customers";}i:87;a:2:{s:13:"permission_id";s:3:"111";s:15:"permission_name";s:15:"export in leads";}i:88;a:2:{s:13:"permission_id";s:3:"112";s:15:"permission_name";s:16:"download history";}}',
                'logged_in' => 2,
                'session_id' => 'sLaospicunXpHjkWh191iMHOBWepxmw6piht7a50',
                'last_logged_in_at' => '2018-10-05 06:52:43',
                'chat_login_time' => NULL,
                'current_chat_count' => 0,
                'chat_flag' => 1,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-10-05 06:51:53',
                'updated_at' => '2018-10-05 06:52:43',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'name' => 'orisys',
                'email' => 'admin@orisys.in',
                'username' => 'admin',
                'chat_name' => 'admin',
                'phone' => '9895588804',
                'address' => 'Mani Bhavan ,PLRA F9 Panickers Lane, Sasthamangalam',
                'password' => '$2y$10$ji.XpC0z6eYQ/9vcxSiAruQwWGv4h436GOphBUB0lQPdxGZ/gT58a',
                'extension' => NULL,
                'role_id' => 'a:1:{i:0;s:1:"2";}',
                'remember_token' => 'cxyzVrRjDbK9jkGiNT3mMh5UdWNNBbJOQ5BdUtAuNEytIAsOck4I3Ju9HAoz',
                'access_permission' => 'a:89:{i:0;a:2:{s:13:"permission_id";s:1:"1";s:15:"permission_name";s:8:"faq view";}i:1;a:2:{s:13:"permission_id";s:1:"2";s:15:"permission_name";s:7:"faq new";}i:2;a:2:{s:13:"permission_id";s:1:"3";s:15:"permission_name";s:10:"faq remove";}i:3;a:2:{s:13:"permission_id";s:1:"4";s:15:"permission_name";s:17:"import export faq";}i:4;a:2:{s:13:"permission_id";s:1:"5";s:15:"permission_name";s:10:"leads view";}i:5;a:2:{s:13:"permission_id";s:1:"6";s:15:"permission_name";s:12:"leads remove";}i:6;a:2:{s:13:"permission_id";s:1:"7";s:15:"permission_name";s:19:"import export leads";}i:7;a:2:{s:13:"permission_id";s:1:"8";s:15:"permission_name";s:14:"dashboard view";}i:8;a:2:{s:13:"permission_id";s:1:"9";s:15:"permission_name";s:13:"settings view";}i:9;a:2:{s:13:"permission_id";s:2:"10";s:15:"permission_name";s:14:"changepassword";}i:10;a:2:{s:13:"permission_id";s:2:"11";s:15:"permission_name";s:6:"logout";}i:11;a:2:{s:13:"permission_id";s:2:"12";s:15:"permission_name";s:17:"profile form view";}i:12;a:2:{s:13:"permission_id";s:2:"13";s:15:"permission_name";s:8:"faq view";}i:13;a:2:{s:13:"permission_id";s:2:"14";s:15:"permission_name";s:20:"suggested chits view";}i:14;a:2:{s:13:"permission_id";s:2:"15";s:15:"permission_name";s:13:"followup view";}i:15;a:2:{s:13:"permission_id";s:2:"16";s:15:"permission_name";s:15:"followup remove";}i:16;a:2:{s:13:"permission_id";s:2:"17";s:15:"permission_name";s:20:"announced chits view";}i:17;a:2:{s:13:"permission_id";s:2:"18";s:15:"permission_name";s:26:"announced chits management";}i:18;a:2:{s:13:"permission_id";s:2:"20";s:15:"permission_name";s:21:"permission management";}i:19;a:2:{s:13:"permission_id";s:2:"21";s:15:"permission_name";s:15:"role management";}i:20;a:2:{s:13:"permission_id";s:2:"22";s:15:"permission_name";s:24:"customer suggestion view";}i:21;a:2:{s:13:"permission_id";s:2:"23";s:15:"permission_name";s:16:"fetch email view";}i:22;a:2:{s:13:"permission_id";s:2:"28";s:15:"permission_name";s:23:"customer announced view";}i:23;a:2:{s:13:"permission_id";s:2:"29";s:15:"permission_name";s:22:"service level settings";}i:24;a:2:{s:13:"permission_id";s:2:"30";s:15:"permission_name";s:15:"officer shedule";}i:25;a:2:{s:13:"permission_id";s:2:"33";s:15:"permission_name";s:20:"Expert followup edit";}i:26;a:2:{s:13:"permission_id";s:2:"34";s:15:"permission_name";s:21:"followup history edit";}i:27;a:2:{s:13:"permission_id";s:2:"36";s:15:"permission_name";s:24:"leadstatistics dashgraph";}i:28;a:2:{s:13:"permission_id";s:2:"37";s:15:"permission_name";s:34:"total announced chit sub dashgraph";}i:29;a:2:{s:13:"permission_id";s:2:"38";s:15:"permission_name";s:18:"followup dashgraph";}i:30;a:2:{s:13:"permission_id";s:2:"40";s:15:"permission_name";s:22:"Followyup calanderview";}i:31;a:2:{s:13:"permission_id";s:2:"41";s:15:"permission_name";s:17:"view auction room";}i:32;a:2:{s:13:"permission_id";s:2:"42";s:15:"permission_name";s:30:"agent task for lead conversion";}i:33;a:2:{s:13:"permission_id";s:2:"43";s:15:"permission_name";s:12:"whatsapp web";}i:34;a:2:{s:13:"permission_id";s:2:"44";s:15:"permission_name";s:12:"setextension";}i:35;a:2:{s:13:"permission_id";s:2:"45";s:15:"permission_name";s:22:"mail template settings";}i:36;a:2:{s:13:"permission_id";s:2:"46";s:15:"permission_name";s:12:"outboundcall";}i:37;a:2:{s:13:"permission_id";s:2:"47";s:15:"permission_name";s:16:"email sms report";}i:38;a:2:{s:13:"permission_id";s:2:"48";s:15:"permission_name";s:21:"view unattended calls";}i:39;a:2:{s:13:"permission_id";s:2:"49";s:15:"permission_name";s:19:"suggested chits new";}i:40;a:2:{s:13:"permission_id";s:2:"54";s:15:"permission_name";s:26:"dashboard facebook twitter";}i:41;a:2:{s:13:"permission_id";s:2:"55";s:15:"permission_name";s:24:"dashboard customer count";}i:42;a:2:{s:13:"permission_id";s:2:"56";s:15:"permission_name";s:21:"dashboard leads count";}i:43;a:2:{s:13:"permission_id";s:2:"57";s:15:"permission_name";s:26:"dashboard open issue count";}i:44;a:2:{s:13:"permission_id";s:2:"58";s:15:"permission_name";s:29:"dashboard pending issue count";}i:45;a:2:{s:13:"permission_id";s:2:"59";s:15:"permission_name";s:25:"dashboard escalated count";}i:46;a:2:{s:13:"permission_id";s:2:"60";s:15:"permission_name";s:25:"general enquiry pie chart";}i:47;a:2:{s:13:"permission_id";s:2:"61";s:15:"permission_name";s:19:"follow up pie chart";}i:48;a:2:{s:13:"permission_id";s:2:"62";s:15:"permission_name";s:25:"service sequest pie chart";}i:49;a:2:{s:13:"permission_id";s:2:"63";s:15:"permission_name";s:20:"complaints pie chart";}i:50;a:2:{s:13:"permission_id";s:2:"64";s:15:"permission_name";s:33:"dashboard enquriy date line chart";}i:51;a:2:{s:13:"permission_id";s:2:"65";s:15:"permission_name";s:12:"funnel graph";}i:52;a:2:{s:13:"permission_id";s:2:"66";s:15:"permission_name";s:35:"dashboard service request bar chart";}i:53;a:2:{s:13:"permission_id";s:2:"68";s:15:"permission_name";s:20:"latest faq dashgraph";}i:54;a:2:{s:13:"permission_id";s:2:"69";s:15:"permission_name";s:20:"kyc status pie chart";}i:55;a:2:{s:13:"permission_id";s:2:"71";s:15:"permission_name";s:29:"latest subscription dashgraph";}i:56;a:2:{s:13:"permission_id";s:2:"73";s:15:"permission_name";s:15:"user management";}i:57;a:2:{s:13:"permission_id";s:2:"74";s:15:"permission_name";s:20:"manual outbound call";}i:58;a:2:{s:13:"permission_id";s:2:"76";s:15:"permission_name";s:22:"call center wall board";}i:59;a:2:{s:13:"permission_id";s:2:"77";s:15:"permission_name";s:16:"mail sms reports";}i:60;a:2:{s:13:"permission_id";s:2:"78";s:15:"permission_name";s:11:"branch view";}i:61;a:2:{s:13:"permission_id";s:2:"79";s:15:"permission_name";s:17:"autodial schedule";}i:62;a:2:{s:13:"permission_id";s:2:"80";s:15:"permission_name";s:13:"agent reports";}i:63;a:2:{s:13:"permission_id";s:2:"81";s:15:"permission_name";s:17:"automated process";}i:64;a:2:{s:13:"permission_id";s:2:"85";s:15:"permission_name";s:19:"campaign management";}i:65;a:2:{s:13:"permission_id";s:2:"86";s:15:"permission_name";s:8:"escalate";}i:66;a:2:{s:13:"permission_id";s:2:"87";s:15:"permission_name";s:12:"escalated to";}i:67;a:2:{s:13:"permission_id";s:2:"88";s:15:"permission_name";s:22:"call center wall board";}i:68;a:2:{s:13:"permission_id";s:2:"89";s:15:"permission_name";s:16:"Followups Reopen";}i:69;a:2:{s:13:"permission_id";s:2:"91";s:15:"permission_name";s:21:"sms template settings";}i:70;a:2:{s:13:"permission_id";s:2:"93";s:15:"permission_name";s:11:"api reports";}i:71;a:2:{s:13:"permission_id";s:2:"94";s:15:"permission_name";s:15:"statistics view";}i:72;a:2:{s:13:"permission_id";s:2:"95";s:15:"permission_name";s:12:"save profile";}i:73;a:2:{s:13:"permission_id";s:2:"96";s:15:"permission_name";s:20:"lead statistics view";}i:74;a:2:{s:13:"permission_id";s:2:"97";s:15:"permission_name";s:25:"dashboard lead line chart";}i:75;a:2:{s:13:"permission_id";s:2:"98";s:15:"permission_name";s:24:"mail sms statistics view";}i:76;a:2:{s:13:"permission_id";s:2:"99";s:15:"permission_name";s:27:"autoprocess statistics view";}i:77;a:2:{s:13:"permission_id";s:3:"100";s:15:"permission_name";s:12:"tickets view";}i:78;a:2:{s:13:"permission_id";s:3:"101";s:15:"permission_name";s:17:"feedback settings";}i:79;a:2:{s:13:"permission_id";s:3:"102";s:15:"permission_name";s:17:"chat history view";}i:80;a:2:{s:13:"permission_id";s:3:"103";s:15:"permission_name";s:26:"chat feedback history view";}i:81;a:2:{s:13:"permission_id";s:3:"104";s:15:"permission_name";s:24:"service request all list";}i:82;a:2:{s:13:"permission_id";s:3:"105";s:15:"permission_name";s:13:"FC Calculator";}i:83;a:2:{s:13:"permission_id";s:3:"106";s:15:"permission_name";s:12:"finance plan";}i:84;a:2:{s:13:"permission_id";s:3:"107";s:15:"permission_name";s:18:"export in helpdesk";}i:85;a:2:{s:13:"permission_id";s:3:"108";s:15:"permission_name";s:24:"escalation summary chart";}i:86;a:2:{s:13:"permission_id";s:3:"109";s:15:"permission_name";s:22:"deregistered customers";}i:87;a:2:{s:13:"permission_id";s:3:"111";s:15:"permission_name";s:15:"export in leads";}i:88;a:2:{s:13:"permission_id";s:3:"112";s:15:"permission_name";s:16:"download history";}}',
                'logged_in' => 2,
                'session_id' => 'qiGPD0HuwoRiaRoOqESqickgpys9wFeuJxUAqVir',
                'last_logged_in_at' => '2018-11-16 06:36:06',
                'chat_login_time' => NULL,
                'current_chat_count' => 0,
                'chat_flag' => 1,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-10-05 13:29:35',
                'updated_at' => '2018-11-16 06:37:25',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'name' => 'Tagent',
                'email' => 'testagent@gmail.com',
                'username' => 'tagent',
                'chat_name' => 'testagent',
                'phone' => '1234567890',
                'address' => 'TVM',
                'password' => '$2y$10$HR/iBcF7hF6acQJD.yfWbuvsGWaTkncUEdXEkdoLQn37exJL7j5Na',
                'extension' => NULL,
                'role_id' => 'a:1:{i:0;s:1:"4";}',
                'remember_token' => 'oOeTEZX0PdncNyDSG3590YfyevhGeFtncOosG621er7s407mg4jLdUW9usV8',
                'access_permission' => 'a:41:{i:0;a:2:{s:13:"permission_id";s:1:"1";s:15:"permission_name";s:21:"permission management";}i:1;a:2:{s:13:"permission_id";s:1:"2";s:15:"permission_name";s:15:"role management";}i:2;a:2:{s:13:"permission_id";s:1:"3";s:15:"permission_name";s:15:"user management";}i:3;a:2:{s:13:"permission_id";s:1:"4";s:15:"permission_name";s:11:"plan create";}i:4;a:2:{s:13:"permission_id";s:1:"5";s:15:"permission_name";s:9:"plan edit";}i:5;a:2:{s:13:"permission_id";s:1:"6";s:15:"permission_name";s:9:"plan list";}i:6;a:2:{s:13:"permission_id";s:1:"7";s:15:"permission_name";s:11:"plan delete";}i:7;a:2:{s:13:"permission_id";s:1:"8";s:15:"permission_name";s:17:"query type create";}i:8;a:2:{s:13:"permission_id";s:1:"9";s:15:"permission_name";s:15:"query type edit";}i:9;a:2:{s:13:"permission_id";s:2:"10";s:15:"permission_name";s:15:"query type list";}i:10;a:2:{s:13:"permission_id";s:2:"11";s:15:"permission_name";s:17:"query type delete";}i:11;a:2:{s:13:"permission_id";s:2:"12";s:15:"permission_name";s:19:"query status create";}i:12;a:2:{s:13:"permission_id";s:2:"13";s:15:"permission_name";s:17:"query status edit";}i:13;a:2:{s:13:"permission_id";s:2:"14";s:15:"permission_name";s:17:"query status list";}i:14;a:2:{s:13:"permission_id";s:2:"15";s:15:"permission_name";s:19:"query status delete";}i:15;a:2:{s:13:"permission_id";s:2:"16";s:15:"permission_name";s:22:"customer nature create";}i:16;a:2:{s:13:"permission_id";s:2:"17";s:15:"permission_name";s:20:"customer nature edit";}i:17;a:2:{s:13:"permission_id";s:2:"18";s:15:"permission_name";s:20:"customer nature list";}i:18;a:2:{s:13:"permission_id";s:2:"19";s:15:"permission_name";s:22:"customer nature delete";}i:19;a:2:{s:13:"permission_id";s:2:"20";s:15:"permission_name";s:24:"customer priority create";}i:20;a:2:{s:13:"permission_id";s:2:"21";s:15:"permission_name";s:22:"customer priority edit";}i:21;a:2:{s:13:"permission_id";s:2:"22";s:15:"permission_name";s:22:"customer priority list";}i:22;a:2:{s:13:"permission_id";s:2:"23";s:15:"permission_name";s:24:"customer priority delete";}i:23;a:2:{s:13:"permission_id";s:2:"24";s:15:"permission_name";s:10:"faq create";}i:24;a:2:{s:13:"permission_id";s:2:"25";s:15:"permission_name";s:8:"faq edit";}i:25;a:2:{s:13:"permission_id";s:2:"26";s:15:"permission_name";s:8:"faq list";}i:26;a:2:{s:13:"permission_id";s:2:"27";s:15:"permission_name";s:10:"faq delete";}i:27;a:2:{s:13:"permission_id";s:2:"28";s:15:"permission_name";s:19:"view faq categories";}i:28;a:2:{s:13:"permission_id";s:2:"29";s:15:"permission_name";s:13:"settings view";}i:29;a:2:{s:13:"permission_id";s:2:"30";s:15:"permission_name";s:15:"template create";}i:30;a:2:{s:13:"permission_id";s:2:"31";s:15:"permission_name";s:13:"template edit";}i:31;a:2:{s:13:"permission_id";s:2:"32";s:15:"permission_name";s:13:"template list";}i:32;a:2:{s:13:"permission_id";s:2:"33";s:15:"permission_name";s:15:"template delete";}i:33;a:2:{s:13:"permission_id";s:2:"34";s:15:"permission_name";s:14:"profile create";}i:34;a:2:{s:13:"permission_id";s:2:"35";s:15:"permission_name";s:12:"profile view";}i:35;a:2:{s:13:"permission_id";s:2:"36";s:15:"permission_name";s:9:"lead list";}i:36;a:2:{s:13:"permission_id";s:2:"37";s:15:"permission_name";s:14:"changepassword";}i:37;a:2:{s:13:"permission_id";s:2:"38";s:15:"permission_name";s:19:"question management";}i:38;a:2:{s:13:"permission_id";s:2:"39";s:15:"permission_name";s:17:"feedback settings";}i:39;a:2:{s:13:"permission_id";s:2:"40";s:15:"permission_name";s:24:"service request all list";}i:40;a:2:{s:13:"permission_id";s:2:"41";s:15:"permission_name";s:24:"escalation summary chart";}}',
                'logged_in' => 2,
                'session_id' => 'dcu6VE4oQMzxWgIAdVaJXxqe6C2T2fDaC8Os8hBx',
                'last_logged_in_at' => '2018-11-16 06:29:31',
                'chat_login_time' => NULL,
                'current_chat_count' => 0,
                'chat_flag' => 1,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-11-13 12:46:28',
                'updated_at' => '2018-11-16 06:35:55',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'cmpny_id' => 2,
                'name' => 'Agent',
                'email' => 'agent1@gmail.com',
                'username' => 'agent1',
                'chat_name' => 'agent1',
                'phone' => '1234567890',
                'address' => 'TVM',
                'password' => '$2y$10$qAC/yDSZFjgHfeSHbMdgK.sRUHTwInVEm5ukaygii7ZWAcsoGgQga',
                'extension' => NULL,
                'role_id' => 'a:1:{i:0;s:1:"4";}',
                'remember_token' => NULL,
                'access_permission' => 'a:41:{i:0;a:2:{s:13:"permission_id";s:1:"1";s:15:"permission_name";s:21:"permission management";}i:1;a:2:{s:13:"permission_id";s:1:"2";s:15:"permission_name";s:15:"role management";}i:2;a:2:{s:13:"permission_id";s:1:"3";s:15:"permission_name";s:15:"user management";}i:3;a:2:{s:13:"permission_id";s:1:"4";s:15:"permission_name";s:11:"plan create";}i:4;a:2:{s:13:"permission_id";s:1:"5";s:15:"permission_name";s:9:"plan edit";}i:5;a:2:{s:13:"permission_id";s:1:"6";s:15:"permission_name";s:9:"plan list";}i:6;a:2:{s:13:"permission_id";s:1:"7";s:15:"permission_name";s:11:"plan delete";}i:7;a:2:{s:13:"permission_id";s:1:"8";s:15:"permission_name";s:17:"query type create";}i:8;a:2:{s:13:"permission_id";s:1:"9";s:15:"permission_name";s:15:"query type edit";}i:9;a:2:{s:13:"permission_id";s:2:"10";s:15:"permission_name";s:15:"query type list";}i:10;a:2:{s:13:"permission_id";s:2:"11";s:15:"permission_name";s:17:"query type delete";}i:11;a:2:{s:13:"permission_id";s:2:"12";s:15:"permission_name";s:19:"query status create";}i:12;a:2:{s:13:"permission_id";s:2:"13";s:15:"permission_name";s:17:"query status edit";}i:13;a:2:{s:13:"permission_id";s:2:"14";s:15:"permission_name";s:17:"query status list";}i:14;a:2:{s:13:"permission_id";s:2:"15";s:15:"permission_name";s:19:"query status delete";}i:15;a:2:{s:13:"permission_id";s:2:"16";s:15:"permission_name";s:22:"customer nature create";}i:16;a:2:{s:13:"permission_id";s:2:"17";s:15:"permission_name";s:20:"customer nature edit";}i:17;a:2:{s:13:"permission_id";s:2:"18";s:15:"permission_name";s:20:"customer nature list";}i:18;a:2:{s:13:"permission_id";s:2:"19";s:15:"permission_name";s:22:"customer nature delete";}i:19;a:2:{s:13:"permission_id";s:2:"20";s:15:"permission_name";s:24:"customer priority create";}i:20;a:2:{s:13:"permission_id";s:2:"21";s:15:"permission_name";s:22:"customer priority edit";}i:21;a:2:{s:13:"permission_id";s:2:"22";s:15:"permission_name";s:22:"customer priority list";}i:22;a:2:{s:13:"permission_id";s:2:"23";s:15:"permission_name";s:24:"customer priority delete";}i:23;a:2:{s:13:"permission_id";s:2:"24";s:15:"permission_name";s:10:"faq create";}i:24;a:2:{s:13:"permission_id";s:2:"25";s:15:"permission_name";s:8:"faq edit";}i:25;a:2:{s:13:"permission_id";s:2:"26";s:15:"permission_name";s:8:"faq list";}i:26;a:2:{s:13:"permission_id";s:2:"27";s:15:"permission_name";s:10:"faq delete";}i:27;a:2:{s:13:"permission_id";s:2:"28";s:15:"permission_name";s:19:"view faq categories";}i:28;a:2:{s:13:"permission_id";s:2:"29";s:15:"permission_name";s:13:"settings view";}i:29;a:2:{s:13:"permission_id";s:2:"30";s:15:"permission_name";s:15:"template create";}i:30;a:2:{s:13:"permission_id";s:2:"31";s:15:"permission_name";s:13:"template edit";}i:31;a:2:{s:13:"permission_id";s:2:"32";s:15:"permission_name";s:13:"template list";}i:32;a:2:{s:13:"permission_id";s:2:"33";s:15:"permission_name";s:15:"template delete";}i:33;a:2:{s:13:"permission_id";s:2:"34";s:15:"permission_name";s:14:"profile create";}i:34;a:2:{s:13:"permission_id";s:2:"35";s:15:"permission_name";s:12:"profile view";}i:35;a:2:{s:13:"permission_id";s:2:"36";s:15:"permission_name";s:9:"lead list";}i:36;a:2:{s:13:"permission_id";s:2:"37";s:15:"permission_name";s:14:"changepassword";}i:37;a:2:{s:13:"permission_id";s:2:"38";s:15:"permission_name";s:19:"question management";}i:38;a:2:{s:13:"permission_id";s:2:"39";s:15:"permission_name";s:17:"feedback settings";}i:39;a:2:{s:13:"permission_id";s:2:"40";s:15:"permission_name";s:24:"service request all list";}i:40;a:2:{s:13:"permission_id";s:2:"41";s:15:"permission_name";s:24:"escalation summary chart";}}',
                'logged_in' => 0,
                'session_id' => 'XMKFCRAIpUyHwAv2UH2QxVsobUoMXEneQcuCXXm6',
                'last_logged_in_at' => '2018-11-16 06:37:39',
                'chat_login_time' => NULL,
                'current_chat_count' => 0,
                'chat_flag' => 1,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-11-16 06:36:57',
                'updated_at' => '2018-11-16 06:37:39',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}