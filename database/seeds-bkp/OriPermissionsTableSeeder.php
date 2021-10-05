<?php

use Illuminate\Database\Seeder;

class OriPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_permissions')->delete();
        
        \DB::table('ori_permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'permission management',
                'created_at' => '2018-10-13 14:05:32',
                'updated_at' => '2018-10-13 14:05:32',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'role management',
                'created_at' => '2018-10-13 14:05:48',
                'updated_at' => '2018-10-13 14:05:48',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'user management',
                'created_at' => '2018-10-13 14:08:27',
                'updated_at' => '2018-10-13 14:08:27',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'plan create',
                'created_at' => '2018-10-13 14:12:36',
                'updated_at' => '2018-10-13 14:12:36',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'plan edit',
                'created_at' => '2018-10-13 14:12:46',
                'updated_at' => '2018-10-13 14:12:46',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'plan list',
                'created_at' => '2018-10-13 14:12:54',
                'updated_at' => '2018-10-13 14:12:54',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'plan delete',
                'created_at' => '2018-10-13 14:13:49',
                'updated_at' => '2018-10-13 14:13:49',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'query type create',
                'created_at' => '2018-10-13 14:17:28',
                'updated_at' => '2018-10-13 14:17:28',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'query type edit',
                'created_at' => '2018-10-13 14:17:48',
                'updated_at' => '2018-10-13 14:17:48',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'query type list',
                'created_at' => '2018-10-13 14:17:57',
                'updated_at' => '2018-10-13 14:17:57',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'query type delete',
                'created_at' => '2018-10-13 14:18:05',
                'updated_at' => '2018-10-13 14:18:05',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'query status create',
                'created_at' => '2018-10-13 14:19:40',
                'updated_at' => '2018-10-13 14:19:40',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'query status edit',
                'created_at' => '2018-10-13 14:44:54',
                'updated_at' => '2018-10-13 14:44:54',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'query status list',
                'created_at' => '2018-10-13 14:45:05',
                'updated_at' => '2018-10-13 14:45:05',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'query status delete',
                'created_at' => '2018-10-13 14:45:13',
                'updated_at' => '2018-10-13 14:45:13',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'customer nature create',
                'created_at' => '2018-10-13 14:46:11',
                'updated_at' => '2018-10-13 14:46:11',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'customer nature edit',
                'created_at' => '2018-10-13 14:46:27',
                'updated_at' => '2018-10-13 14:46:27',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'customer nature list',
                'created_at' => '2018-10-13 14:47:19',
                'updated_at' => '2018-10-13 14:47:19',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'customer nature delete',
                'created_at' => '2018-10-13 14:47:31',
                'updated_at' => '2018-10-13 14:47:31',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'customer priority create',
                'created_at' => '2018-10-13 14:53:07',
                'updated_at' => '2018-10-13 14:53:07',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'customer priority edit',
                'created_at' => '2018-10-13 14:53:16',
                'updated_at' => '2018-10-13 14:53:16',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'customer priority list',
                'created_at' => '2018-10-13 14:53:33',
                'updated_at' => '2018-10-13 14:53:33',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'customer priority delete',
                'created_at' => '2018-10-13 14:53:41',
                'updated_at' => '2018-10-13 14:53:41',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'faq create',
                'created_at' => '2018-10-13 14:54:28',
                'updated_at' => '2018-10-13 14:54:28',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'faq edit',
                'created_at' => '2018-10-13 14:54:37',
                'updated_at' => '2018-10-13 14:54:37',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'faq list',
                'created_at' => '2018-10-13 14:54:46',
                'updated_at' => '2018-10-13 14:54:46',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'faq delete',
                'created_at' => '2018-10-13 14:54:54',
                'updated_at' => '2018-10-13 14:54:54',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'view faq categories',
                'created_at' => '2018-10-13 14:55:42',
                'updated_at' => '2018-10-13 14:55:42',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'settings view',
                'created_at' => '2018-10-13 14:56:04',
                'updated_at' => '2018-10-13 14:56:04',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'template create',
                'created_at' => '2018-10-13 14:57:23',
                'updated_at' => '2018-10-13 14:57:23',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'template edit',
                'created_at' => '2018-10-13 14:57:41',
                'updated_at' => '2018-10-13 14:57:41',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'template list',
                'created_at' => '2018-10-13 14:57:49',
                'updated_at' => '2018-10-13 14:57:49',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'template delete',
                'created_at' => '2018-10-13 14:58:33',
                'updated_at' => '2018-10-13 14:58:33',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'profile create',
                'created_at' => '2018-10-13 15:00:15',
                'updated_at' => '2018-10-13 15:00:15',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'profile view',
                'created_at' => '2018-10-13 15:00:25',
                'updated_at' => '2018-10-13 15:00:25',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'lead list',
                'created_at' => '2018-10-13 15:01:05',
                'updated_at' => '2018-10-13 15:01:05',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'changepassword',
                'created_at' => '2018-10-13 15:01:19',
                'updated_at' => '2018-10-13 15:01:19',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'question management',
                'created_at' => '2018-10-13 15:02:11',
                'updated_at' => '2018-10-13 15:02:11',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'feedback settings',
                'created_at' => '2018-10-13 15:02:34',
                'updated_at' => '2018-10-13 15:02:34',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'service request all list',
                'created_at' => '2018-10-13 15:03:09',
                'updated_at' => '2018-10-13 15:03:09',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'escalation summary chart',
                'created_at' => '2018-10-13 15:03:24',
                'updated_at' => '2018-10-13 15:03:24',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'campaign management',
                'created_at' => '2018-10-13 15:54:49',
                'updated_at' => '2018-10-13 15:54:49',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'escalated to',
                'created_at' => '2018-11-13 13:06:14',
                'updated_at' => '2018-11-13 13:06:14',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'followup view',
                'created_at' => '2018-11-13 13:06:30',
                'updated_at' => '2018-11-13 13:06:30',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'emailfetch',
                'created_at' => '2018-11-13 13:06:32',
                'updated_at' => '2018-11-13 13:06:32',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'survey management',
                'created_at' => '2018-11-13 13:10:01',
                'updated_at' => '2018-11-13 13:10:01',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Followups Reopen',
                'created_at' => '2018-11-21 16:41:30',
                'updated_at' => '2018-11-21 16:41:30',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'followup history edit',
                'created_at' => '2018-11-21 16:41:44',
                'updated_at' => '2018-11-21 16:41:44',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'survey report',
                'created_at' => '2018-11-21 18:45:42',
                'updated_at' => '2018-11-21 18:45:42',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'feedback report',
                'created_at' => '2018-11-21 18:47:26',
                'updated_at' => '2018-11-21 18:47:26',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'lead source type create',
                'created_at' => '2018-11-21 18:50:15',
                'updated_at' => '2018-11-21 18:50:15',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'lead source type edit',
                'created_at' => '2018-11-21 18:50:23',
                'updated_at' => '2018-11-21 18:50:23',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'lead source type list',
                'created_at' => '2018-11-21 18:50:30',
                'updated_at' => '2018-11-21 18:50:30',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'lead source type delete',
                'created_at' => '2018-11-21 18:50:38',
                'updated_at' => '2018-11-21 18:50:38',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'lead source create',
                'created_at' => '2018-11-21 18:51:06',
                'updated_at' => '2018-11-21 18:51:06',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'lead source edit',
                'created_at' => '2018-11-21 18:51:14',
                'updated_at' => '2018-11-21 18:51:14',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'lead source list',
                'created_at' => '2018-11-21 18:51:20',
                'updated_at' => '2018-11-21 18:51:20',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'lead source delete',
                'created_at' => '2018-11-21 18:51:26',
                'updated_at' => '2018-11-21 18:51:26',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'sales automation create',
                'created_at' => '2018-11-22 11:30:36',
                'updated_at' => '2018-11-22 11:30:36',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'sales automation edit',
                'created_at' => '2018-11-22 11:30:45',
                'updated_at' => '2018-11-22 11:30:45',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'sales automation list',
                'created_at' => '2018-11-22 11:30:51',
                'updated_at' => '2018-11-22 11:30:51',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'sales automation delete',
                'created_at' => '2018-11-22 11:30:59',
                'updated_at' => '2018-11-22 11:30:59',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'intimation settings create',
                'created_at' => '2018-11-22 15:26:06',
                'updated_at' => '2018-11-22 15:26:06',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'intimation settings edit',
                'created_at' => '2018-11-22 15:26:11',
                'updated_at' => '2018-11-22 15:26:11',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'notification list',
                'created_at' => '2018-11-22 15:32:06',
                'updated_at' => '2018-11-22 15:32:06',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'group management',
                'created_at' => '2018-11-30 10:17:32',
                'updated_at' => '2018-11-30 10:18:27',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'group create',
                'created_at' => '2018-11-30 10:18:45',
                'updated_at' => '2018-11-30 10:18:45',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'group edit',
                'created_at' => '2018-11-30 10:19:19',
                'updated_at' => '2018-11-30 10:19:19',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'group list',
                'created_at' => '2018-11-30 10:20:34',
                'updated_at' => '2018-11-30 10:20:34',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'group delete',
                'created_at' => '2018-11-30 10:21:00',
                'updated_at' => '2018-11-30 10:21:00',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'campaign create',
                'created_at' => '2018-11-30 10:32:21',
                'updated_at' => '2018-11-30 10:32:21',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'campaign edit',
                'created_at' => '2018-11-30 10:32:37',
                'updated_at' => '2018-11-30 10:32:37',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'campaign list',
                'created_at' => '2018-11-30 10:32:54',
                'updated_at' => '2018-11-30 10:32:54',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'campaign delete',
                'created_at' => '2018-11-30 10:33:09',
                'updated_at' => '2018-11-30 10:33:09',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'campaign email delivery graph',
                'created_at' => '2018-11-30 11:21:21',
                'updated_at' => '2018-11-30 11:21:21',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'campaign batch efficiency report',
                'created_at' => '2018-11-30 11:21:33',
                'updated_at' => '2018-11-30 11:21:33',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'campaign email batch report',
                'created_at' => '2018-11-30 11:21:44',
                'updated_at' => '2018-11-30 11:21:44',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'campaign sms delivery graph',
                'created_at' => '2018-11-30 11:22:00',
                'updated_at' => '2018-11-30 11:22:00',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'campaign sms batch report',
                'created_at' => '2018-11-30 11:22:15',
                'updated_at' => '2018-11-30 11:22:15',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'campaign autodial status graph',
                'created_at' => '2018-11-30 11:22:26',
                'updated_at' => '2018-11-30 11:22:26',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'campaign autodial batch report',
                'created_at' => '2018-11-30 11:22:39',
                'updated_at' => '2018-11-30 11:22:39',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'campaign manualcall status graph',
                'created_at' => '2018-11-30 11:22:52',
                'updated_at' => '2018-11-30 11:22:52',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'campaign manualcall batch report',
                'created_at' => '2018-11-30 11:23:03',
                'updated_at' => '2018-11-30 11:23:03',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'group lead import',
                'created_at' => '2018-11-30 11:31:28',
                'updated_at' => '2018-11-30 11:31:28',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'group excel import',
                'created_at' => '2018-11-30 11:31:40',
                'updated_at' => '2018-11-30 11:31:40',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'customer tab create',
                'created_at' => '2018-12-05 18:44:02',
                'updated_at' => '2018-12-05 18:44:02',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'customer tab delete',
                'created_at' => '2018-12-05 18:44:06',
                'updated_at' => '2018-12-05 18:44:06',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'customer tab edit',
                'created_at' => '2018-12-05 18:44:10',
                'updated_at' => '2018-12-05 18:44:10',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'customer tab list',
                'created_at' => '2018-12-05 18:44:14',
                'updated_at' => '2018-12-05 18:44:14',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'chat configuration',
                'created_at' => '2018-12-07 12:03:49',
                'updated_at' => '2018-12-07 12:03:49',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'view auto reply categories',
                'created_at' => '2019-01-08 10:33:11',
                'updated_at' => '2019-01-08 10:33:11',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'auto reply list',
                'created_at' => '2019-01-08 10:33:31',
                'updated_at' => '2019-01-08 10:33:31',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'agent manual outbound call',
                'created_at' => '2019-01-11 15:26:30',
                'updated_at' => '2019-01-11 15:26:30',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            93 => 
            array (
                'id' => 94,
                'name' => 'outbound call',
                'created_at' => '2019-01-11 16:51:29',
                'updated_at' => '2019-01-11 16:51:29',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'outboundcall',
                'created_at' => '2019-01-11 17:23:08',
                'updated_at' => '2019-01-11 17:26:45',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => '2019-01-11 17:26:45',
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'designation list',
                'created_at' => '2019-01-16 11:14:19',
                'updated_at' => '2019-01-16 18:01:49',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'designation create',
                'created_at' => '2019-01-16 11:14:25',
                'updated_at' => '2019-01-16 18:01:32',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'designation edit',
                'created_at' => '2019-01-16 11:14:29',
                'updated_at' => '2019-01-16 18:01:42',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'export in helpdesk',
                'created_at' => '2019-01-18 11:02:33',
                'updated_at' => '2019-01-18 11:02:33',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            99 => 
            array (
                'id' => 100,
                'name' => 'escalate',
                'created_at' => '2019-01-18 12:06:58',
                'updated_at' => '2019-01-18 12:06:58',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            100 => 
            array (
                'id' => 101,
                'name' => 'profile customization',
                'created_at' => '2019-01-18 15:01:02',
                'updated_at' => '2019-01-18 15:01:02',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            101 => 
            array (
                'id' => 102,
                'name' => 'company meta',
                'created_at' => '2019-01-18 15:01:13',
                'updated_at' => '2019-01-18 15:01:13',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            102 => 
            array (
                'id' => 103,
                'name' => 'channel gateway',
                'created_at' => '2019-01-28 12:44:47',
                'updated_at' => '2019-01-28 12:44:47',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            103 => 
            array (
                'id' => 104,
                'name' => 'chat settings',
                'created_at' => '2019-01-30 10:31:33',
                'updated_at' => '2019-01-30 10:31:33',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
            104 => 
            array (
                'id' => 105,
                'name' => 'escalation settings',
                'created_at' => '2019-01-30 10:31:42',
                'updated_at' => '2019-01-30 10:31:42',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}