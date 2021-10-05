<?php

use Illuminate\Database\Seeder;

class OriEmailFetchsAttachmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_email_fetchs_attachments')->delete();
        
        \DB::table('ori_email_fetchs_attachments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'attachment_id' => 5,
            'file_name' => '5-Fairy-forest (1).jpg',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:30',
                'updated_at' => '2018-10-15 11:15:07',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'attachment_id' => 6,
            'file_name' => '6-sightsavers (2).sql',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:31',
                'updated_at' => '2018-10-15 11:15:07',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'attachment_id' => 6,
            'file_name' => '6-login (2).sql',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:31',
                'updated_at' => '2018-10-15 11:15:07',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'cmpny_id' => 2,
                'attachment_id' => 7,
                'file_name' => '7-sightsavers.sql',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2017-08-09 10:12:32',
                'updated_at' => '2018-10-15 11:15:07',
                'deleted_at' => NULL,
            ),
            
        ));
        
        
    }
}