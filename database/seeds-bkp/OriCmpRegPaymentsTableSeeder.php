<?php

use Illuminate\Database\Seeder;

class OriCmpRegPaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_cmp_reg_payments')->delete();
        
        \DB::table('ori_cmp_reg_payments')->insert(array (
            0 => 
            array (
                'id' => 2,
                'cmpny_id' => 1,
                'plan_id' => 4,
                'amount' => NULL,
                'order_id' => '635422355',
                'tracking_id' => '107482187338',
                'subscription_period' => 1,
                'payment_mode' => 'Debit Card',
                'status' => 'Success',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'plan_id' => 4,
                'amount' => NULL,
                'order_id' => '635422355',
                'tracking_id' => '107482187338',
                'subscription_period' => 1,
                'payment_mode' => 'Debit Card',
                'status' => 'Success',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}