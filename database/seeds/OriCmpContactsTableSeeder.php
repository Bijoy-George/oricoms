<?php

use Illuminate\Database\Seeder;

class OriCmpContactsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_cmp_contacts')->delete();
        
        \DB::table('ori_cmp_contacts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'user_id' => 1,
                'first_name' => 'Reshma',
                'middle_name' => NULL,
                'last_name' => 'R',
                'email' => 'reshma.rajan@orisys.in',
                'country_code' => NULL,
                'mobile' => '9562540883',
                'gender' => NULL,
                'dob' => NULL,
                'address' => NULL,
                'customer_nature' => NULL,
                'source' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-11-21 10:14:30',
                'updated_at' => '2018-11-21 10:14:30',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'user_id' => 2,
                'first_name' => 'Akhil',
                'middle_name' => NULL,
                'last_name' => 'M',
                'email' => 'akhil.murukan@orisys.in',
                'country_code' => NULL,
                'mobile' => '9633662214',
                'gender' => NULL,
                'dob' => NULL,
                'address' => NULL,
                'customer_nature' => NULL,
                'source' => 0,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => '2018-11-21 10:14:30',
                'updated_at' => '2018-11-21 04:46:36',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}