<?php

use Illuminate\Database\Seeder;

class OriGroupContactsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_group_contacts')->delete();
        
        \DB::table('ori_group_contacts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'group_id' => 1,
                'contact_id' => 1,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-21 10:14:30',
                'updated_at' => '2018-11-21 10:14:30',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'group_id' => 1,
                'contact_id' => 2,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-21 10:14:31',
                'updated_at' => '2018-11-21 10:14:31',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'group_id' => 2,
                'contact_id' => 2,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-11-21 04:46:36',
                'updated_at' => '2018-11-21 04:46:36',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}