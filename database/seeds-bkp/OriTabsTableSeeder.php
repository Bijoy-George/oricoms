<?php

use Illuminate\Database\Seeder;

class OriTabsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_tabs')->delete();
        
        \DB::table('ori_tabs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'name' => 'Basic Details',
                'type' => 3,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-12-05 06:47:20',
                'updated_at' => '2018-12-05 06:49:48',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'name' => 'Communication',
                'type' => 1,
                'sort_order' => 0,
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => '2018-12-05 06:47:44',
                'updated_at' => '2018-12-05 06:49:54',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}