<?php

use Illuminate\Database\Seeder;

class OriAutomatedProcessStagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_automated_process_stages')->delete();
        
        \DB::table('ori_automated_process_stages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'stage_name' => 'Lead to customer',
				'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'stage_name' => 'Idle for customer',
				'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}