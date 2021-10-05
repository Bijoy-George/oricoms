<?php

use Illuminate\Database\Seeder;

class OriChannelGatewayTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_channel_gateway')->delete();
        
        \DB::table('ori_channel_gateway')->insert(array (
            0 => 
            array (
                'id' => 1,
                'channel_id' => 2,
                'name' => 'PHP',
                'status' => 2,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-27 00:00:00',
                'updated_at' => '2018-11-27 00:00:00',
                'deleted_at' => '2018-11-27 00:00:00',
            ),
            1 => 
            array (
                'id' => 2,
                'channel_id' => 2,
                'name' => 'Gmail',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-27 00:00:00',
                'updated_at' => '2018-11-27 00:00:00',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'channel_id' => 2,
                'name' => 'Mailgun',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-27 00:00:00',
                'updated_at' => '2018-11-27 00:00:00',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'channel_id' => 2,
                'name' => 'SendGrid',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-27 00:00:00',
                'updated_at' => '2018-11-27 00:00:00',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'channel_id' => 2,
                'name' => 'SMTP',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-27 00:00:00',
                'updated_at' => '2018-11-27 00:00:00',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'channel_id' => 1,
                'name' => 'ElitBuzz',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-27 00:00:00',
                'updated_at' => '2018-11-27 00:00:00',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'channel_id' => 1,
                'name' => 'ValueFirst',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-27 00:00:00',
                'updated_at' => '2018-11-27 00:00:00',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'channel_id' => 2,
                'name' => 'Mailchimp',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-27 00:00:00',
                'updated_at' => '2018-11-27 00:00:00',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'channel_id' => 1,
                'name' => 'ESMS',
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-27 00:00:00',
                'updated_at' => '2018-11-27 00:00:00',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}