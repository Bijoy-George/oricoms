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
                'created_at' => '2018-10-13 08:35:32',
                'updated_at' => '2018-10-13 08:35:32',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'role management',
                'created_at' => '2018-10-13 08:35:48',
                'updated_at' => '2018-10-13 08:35:48',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'user management',
                'created_at' => '2018-10-13 08:38:27',
                'updated_at' => '2018-10-13 08:38:27',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'plan create',
                'created_at' => '2018-10-13 08:42:36',
                'updated_at' => '2018-10-13 08:42:36',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'plan edit',
                'created_at' => '2018-10-13 08:42:46',
                'updated_at' => '2018-10-13 08:42:46',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'plan list',
                'created_at' => '2018-10-13 08:42:54',
                'updated_at' => '2018-10-13 08:42:54',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'plan delete',
                'created_at' => '2018-10-13 08:43:49',
                'updated_at' => '2018-10-13 08:43:49',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'query type create',
                'created_at' => '2018-10-13 08:47:28',
                'updated_at' => '2018-10-13 08:47:28',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'query type edit',
                'created_at' => '2018-10-13 08:47:48',
                'updated_at' => '2018-10-13 08:47:48',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'query type list',
                'created_at' => '2018-10-13 08:47:57',
                'updated_at' => '2018-10-13 08:47:57',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'query type delete',
                'created_at' => '2018-10-13 08:48:05',
                'updated_at' => '2018-10-13 08:48:05',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'query status create',
                'created_at' => '2018-10-13 08:49:40',
                'updated_at' => '2018-10-13 08:49:40',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'query status edit',
                'created_at' => '2018-10-13 09:14:54',
                'updated_at' => '2018-10-13 09:14:54',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'query status list',
                'created_at' => '2018-10-13 09:15:05',
                'updated_at' => '2018-10-13 09:15:05',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'query status delete',
                'created_at' => '2018-10-13 09:15:13',
                'updated_at' => '2018-10-13 09:15:13',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'customer nature create',
                'created_at' => '2018-10-13 09:16:11',
                'updated_at' => '2018-10-13 09:16:11',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'customer nature edit',
                'created_at' => '2018-10-13 09:16:27',
                'updated_at' => '2018-10-13 09:16:27',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'customer nature list',
                'created_at' => '2018-10-13 09:17:19',
                'updated_at' => '2018-10-13 09:17:19',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'customer nature delete',
                'created_at' => '2018-10-13 09:17:31',
                'updated_at' => '2018-10-13 09:17:31',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'customer priority create',
                'created_at' => '2018-10-13 09:23:07',
                'updated_at' => '2018-10-13 09:23:07',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'customer priority edit',
                'created_at' => '2018-10-13 09:23:16',
                'updated_at' => '2018-10-13 09:23:16',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'customer priority list',
                'created_at' => '2018-10-13 09:23:33',
                'updated_at' => '2018-10-13 09:23:33',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'customer priority delete',
                'created_at' => '2018-10-13 09:23:41',
                'updated_at' => '2018-10-13 09:23:41',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'faq create',
                'created_at' => '2018-10-13 09:24:28',
                'updated_at' => '2018-10-13 09:24:28',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'faq edit',
                'created_at' => '2018-10-13 09:24:37',
                'updated_at' => '2018-10-13 09:24:37',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'faq list',
                'created_at' => '2018-10-13 09:24:46',
                'updated_at' => '2018-10-13 09:24:46',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'faq delete',
                'created_at' => '2018-10-13 09:24:54',
                'updated_at' => '2018-10-13 09:24:54',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'view faq categories',
                'created_at' => '2018-10-13 09:25:42',
                'updated_at' => '2018-10-13 09:25:42',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'settings view',
                'created_at' => '2018-10-13 09:26:04',
                'updated_at' => '2018-10-13 09:26:04',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'template create',
                'created_at' => '2018-10-13 09:27:23',
                'updated_at' => '2018-10-13 09:27:23',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'template edit',
                'created_at' => '2018-10-13 09:27:41',
                'updated_at' => '2018-10-13 09:27:41',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'template list',
                'created_at' => '2018-10-13 09:27:49',
                'updated_at' => '2018-10-13 09:27:49',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'template delete',
                'created_at' => '2018-10-13 09:28:33',
                'updated_at' => '2018-10-13 09:28:33',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'profile create',
                'created_at' => '2018-10-13 09:30:15',
                'updated_at' => '2018-10-13 09:30:15',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'profile view',
                'created_at' => '2018-10-13 09:30:25',
                'updated_at' => '2018-10-13 09:30:25',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'lead list',
                'created_at' => '2018-10-13 09:31:05',
                'updated_at' => '2018-10-13 09:31:05',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'changepassword',
                'created_at' => '2018-10-13 09:31:19',
                'updated_at' => '2018-10-13 09:31:19',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'question management',
                'created_at' => '2018-10-13 09:32:11',
                'updated_at' => '2018-10-13 09:32:11',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'feedback settings',
                'created_at' => '2018-10-13 09:32:34',
                'updated_at' => '2018-10-13 09:32:34',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'service request all list',
                'created_at' => '2018-10-13 09:33:09',
                'updated_at' => '2018-10-13 09:33:09',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'escalation summary chart',
                'created_at' => '2018-10-13 09:33:24',
                'updated_at' => '2018-10-13 09:33:24',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'campaign management',
                'created_at' => '2018-10-13 10:24:49',
                'updated_at' => '2018-10-13 10:24:49',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}