<?php

use Illuminate\Database\Seeder;

class OriChannelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_channels')->delete();
        
        \DB::table('ori_channels')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'SMS',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-10-10 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Email',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-10-10 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Manual Call',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-10-17 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
			3 => 
            array (
                'id' => 4,
                'name' => 'Auto Dial',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-10-17 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
			4 => 
            array (
                'id' => 5,
                'name' => 'Chat',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-10-17 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
			5 => 
            array (
                'id' => 6,
                'name' => 'Push Messages',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-10-17 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}