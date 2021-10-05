<?php

use Illuminate\Database\Seeder;

class OriFbDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_fb_details')->delete();
        
        \DB::table('ori_fb_details')->insert(array (
            0 => 
            array (
                'id' => 4,
                'cmpny_id' => 2,
                'customer_id' => 1,
                'reference_id' => NULL,
                'thread_id' => 1,
                'call_id' => NULL,
                'fb_type' => 5,
                'comments' => 'good',
                'rating' => 5,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-22 10:37:24',
                'updated_at' => '2018-11-22 10:37:24',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}