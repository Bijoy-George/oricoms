<?php

use Illuminate\Database\Seeder;

class OriMastPlansDurationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_mast_plans_duration')->delete();
        
        \DB::table('ori_mast_plans_duration')->insert(array (
            0 => 
            array (
                'id' => 1,
                'plan_id' => 1,
                'amount' => 100,
                'duration' => '1 month',
                'start_date' => '2018-12-28 13:28:45',
                'end_date' => '2019-01-28 00:00:00',
                'status' => 1,
                'sort_order' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'plan_id' => 1,
                'amount' => 200,
                'duration' => '1 month',
                'start_date' => '2018-11-28 00:00:00',
                'end_date' => '2018-12-28 00:00:00',
                'status' => 1,
                'sort_order' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'plan_id' => 2,
                'amount' => 200,
                'duration' => '1 month',
                'start_date' => '2018-12-28 13:28:45',
                'end_date' => '2019-01-28 00:00:00',
                'status' => 1,
                'sort_order' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'plan_id' => 2,
                'amount' => 300,
                'duration' => '1 month',
                'start_date' => '2018-11-28 00:00:00',
                'end_date' => '2018-12-28 00:00:00',
                'status' => 1,
                'sort_order' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 35,
                'plan_id' => 3,
                'amount' => 300,
                'duration' => '1 month',
                'start_date' => '2018-12-28 13:28:45',
                'end_date' => '2019-01-28 00:00:00',
                'status' => 1,
                'sort_order' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 36,
                'plan_id' => 3,
                'amount' => 400,
                'duration' => '1 month',
                'start_date' => '2018-11-28 00:00:00',
                'end_date' => '2018-12-28 00:00:00',
                'status' => 1,
                'sort_order' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 37,
                'plan_id' => 4,
                'amount' => 400,
                'duration' => '1 month',
                'start_date' => '2018-12-28 13:28:45',
                'end_date' => '2019-01-28 00:00:00',
                'status' => 1,
                'sort_order' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 38,
                'plan_id' => 4,
                'amount' => 500,
                'duration' => '1 month',
                'start_date' => '2018-11-28 00:00:00',
                'end_date' => '2018-12-28 00:00:00',
                'status' => 1,
                'sort_order' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}