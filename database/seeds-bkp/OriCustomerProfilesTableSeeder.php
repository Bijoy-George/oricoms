<?php

use Illuminate\Database\Seeder;

class OriCustomerProfilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_customer_profiles')->delete();
        
        \DB::table('ori_customer_profiles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'first_name' => 'Reshma',
                'middle_name' => NULL,
                'last_name' => 'R',
                'email' => 'reshma.rajan@orisys.in',
                'country_code' => '+91',
                'mobile' => '9562540883',
                'gender' => NULL,
                'dob' => NULL,
                'address' => NULL,
                'customer_nature' => NULL,
                'source' => 0,
                'profile_status' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-10-15 05:47:06',
                'updated_at' => '2018-10-15 05:47:06',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'first_name' => 'Akhil',
                'middle_name' => NULL,
                'last_name' => 'M',
                'email' => 'akhil.murukan@orisys.in',
                'country_code' => '+91',
                'mobile' => '9633662214',
                'gender' => NULL,
                'dob' => NULL,
                'address' => NULL,
                'customer_nature' => NULL,
                'source' => 0,
                'profile_status' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-10-15 05:48:52',
                'updated_at' => '2018-10-15 05:48:52',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
