<?php

use Illuminate\Database\Seeder;

class OriCompanySubscriptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_company_subscriptions')->delete();
        
        \DB::table('ori_company_subscriptions')->insert(array (
            0 => 
            array (
                'id' => 6,
                'cmpny_id' => 2,
                'plan_id' => 4,
                'transaction_id' => '700000691',
                'amount' => NULL,
                'discount_amount' => NULL,
                'subscription_start_date' => '2018-12-03 12:04:52',
                'subscription_exp_date' => '2019-06-03 12:04:52',
                'extended_expiry_date' => '2018-12-03 12:04:52',
                'status' => 'Success',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 7,
                'cmpny_id' => 1,
                'plan_id' => 4,
                'transaction_id' => '700000691',
                'amount' => NULL,
                'discount_amount' => NULL,
                'subscription_start_date' => '2018-12-03 12:04:52',
                'subscription_exp_date' => '2019-01-03 12:04:52',
                'extended_expiry_date' => '2018-12-03 12:04:52',
                'status' => 'Success',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 9,
                'cmpny_id' => 1,
                'plan_id' => 4,
                'transaction_id' => '700000691',
                'amount' => NULL,
                'discount_amount' => NULL,
                'subscription_start_date' => '2018-12-03 12:04:52',
                'subscription_exp_date' => '2019-01-03 12:04:52',
                'extended_expiry_date' => '2018-12-10 12:04:52',
                'status' => 'Success',
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 10,
                'cmpny_id' => 1,
                'plan_id' => 4,
                'transaction_id' => '700000691',
                'amount' => NULL,
                'discount_amount' => NULL,
                'subscription_start_date' => '2018-12-03 12:04:52',
                'subscription_exp_date' => '2019-01-03 12:04:52',
                'extended_expiry_date' => '2019-01-10 12:04:52',
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