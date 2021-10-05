<?php

use Illuminate\Database\Seeder;

class OriMastPlansTableSeeder extends Seeder
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
            'plan_des' => 'oricom trial version product(Silver)',
                'discount' => '10',
                'sort_order' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-13 06:15:28',
                'updated_at' => '2018-11-26 11:55:59',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'plan' => 'Gold',
            'plan_des' => 'oricom trial version product(Gold)',
                'discount' => '20',
                'sort_order' => 2,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-13 06:15:37',
                'updated_at' => '2018-11-13 06:15:37',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'plan' => 'Platinum',
            'plan_des' => 'oricom trial version product(Platinum)',
                'discount' => '30',
                'sort_order' => 3,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-13 06:15:43',
                'updated_at' => '2018-11-13 06:15:43',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'plan' => 'Diamond',
            'plan_des' => 'oricom trial version product(Diamond)',
                'discount' => '40',
                'sort_order' => 4,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-11-13 06:15:49',
                'updated_at' => '2018-11-13 06:15:49',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}