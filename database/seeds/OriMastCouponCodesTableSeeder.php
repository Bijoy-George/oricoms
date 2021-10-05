<?php

use Illuminate\Database\Seeder;

class OriMastCouponCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_mast_coupon_codes')->delete();
        
        \DB::table('ori_mast_coupon_codes')->insert(array (
            0 => 
            array (
                'id' => 3,
                'plan_id' => 4,
                'coupon_name' => 'ABC',
                'coupon_code' => 'SP010',
                'discount' => '10',
                'disc_flag' => 1,
                'duration' => '1',
                'valid_from' => '2018-12-01 00:00:00',
                'valid_to' => '2018-12-29 00:00:00',
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 4,
                'plan_id' => 4,
                'coupon_name' => 'ABCD',
                'coupon_code' => 'SP020',
                'discount' => '20',
                'disc_flag' => 1,
                'duration' => '1',
                'valid_from' => '2018-12-31 00:00:00',
                'valid_to' => '2019-01-22 00:00:00',
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}