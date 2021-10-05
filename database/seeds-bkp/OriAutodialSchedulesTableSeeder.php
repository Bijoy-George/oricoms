<?php

use Illuminate\Database\Seeder;

class OriAutodialSchedulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_autodial_schedules')->delete();
        
        \DB::table('ori_autodial_schedules')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'name' => 'auto dial one',
                'datetime_init' => '2018-01-01',
                'datetime_end' => '2018-12-30',
                'daytime_init' => '06:00:00',
                'daytime_end' => '08:00:00',
                'retries' => NULL,
                'agent_group_id' => 1,
                'max_canales' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-01-17 00:00:00',
                'updated_at' => '2018-01-31 15:14:12',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'name' => ' two auto dial',
                'datetime_init' => '2018-01-01',
                'datetime_end' => '2018-01-18',
                'daytime_init' => '07:00:00',
                'daytime_end' => '18:00:00',
                'retries' => NULL,
                'agent_group_id' => 2,
                'max_canales' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-01-31 00:00:00',
                'updated_at' => '2018-01-31 16:29:29',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'name' => 'dial test three',
                'datetime_init' => '2018-01-09',
                'datetime_end' => '2018-01-25',
                'daytime_init' => '11:00:00',
                'daytime_end' => '10:00:00',
                'retries' => NULL,
                'agent_group_id' => 3,
                'max_canales' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-01-31 00:00:00',
                'updated_at' => '2018-01-31 16:37:13',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}