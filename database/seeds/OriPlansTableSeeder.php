<?php

use Illuminate\Database\Seeder;

class OriPlansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_mast_plans')->delete();
        
        \DB::table('ori_mast_plans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'plan' => 'Silver',
                'status' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'plan' => 'Gold',
                'status' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'plan' => 'Platinum',
                'status' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'plan' => 'Diamond',
                'status' => 4,
            ),
        ));
        
        
    }
}