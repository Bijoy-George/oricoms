<?php

use Illuminate\Database\Seeder;

class OriIntimationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_intimations')->delete();
        
        \DB::table('ori_intimations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'user_id' => 1,
                'channel' => 2,
                'time_interval' => 6,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-09-24 10:29:15',
                'updated_at' => '2018-09-24 10:29:15',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'user_id' => 1,
                'channel' => 1,
                'time_interval' => 6,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-09-26 10:25:22',
                'updated_at' => '2018-09-26 10:25:22',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'cmpny_id' => 2,
                'user_id' => 1,
                'channel' => 3,
                'time_interval' => 5,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-09-26 10:25:22',
                'updated_at' => '2018-09-26 10:25:22',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}