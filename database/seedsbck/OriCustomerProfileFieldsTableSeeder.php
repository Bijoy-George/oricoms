<?php

use Illuminate\Database\Seeder;

class OriCustomerProfileFieldsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_customer_profile_fields')->delete();
        
        \DB::table('ori_customer_profile_fields')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cmpny_id' => 2,
                'field_name' => 'first_name',
                'type' => 1,
                'required' => 1,
                'label' => 'First Name',
                'report_field' => 1,
                'is_unique' => 2,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-09-29 00:00:00',
                'updated_at' => '2018-09-29 05:01:11',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'field_name' => 'email',
                'type' => 1,
                'required' => 2,
                'label' => 'Email',
                'report_field' => 1,
                'is_unique' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-09-29 00:00:00',
                'updated_at' => '2018-09-29 05:01:11',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'cmpny_id' => 2,
                'field_name' => 'mobile',
                'type' => 1,
                'required' => 1,
                'label' => 'Mobile',
                'report_field' => 1,
                'is_unique' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-09-29 00:00:00',
                'updated_at' => '2018-09-29 05:01:11',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'cmpny_id' => 2,
                'field_name' => 'aadhar',
                'type' => 2,
                'required' => 1,
                'label' => 'Aadhar',
                'report_field' => 1,
                'is_unique' => 2,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-09-29 00:00:00',
                'updated_at' => '2018-09-29 05:01:11',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'cmpny_id' => 2,
                'field_name' => 'pan_card',
                'type' => 2,
                'required' => 2,
                'label' => 'Pan Card',
                'report_field' => 1,
                'is_unique' => 2,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-09-29 00:00:00',
                'updated_at' => '2018-09-29 05:01:11',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'cmpny_id' => 2,
                'field_name' => 'last_name',
                'type' => 1,
                'required' => 1,
                'label' => 'Last Name',
                'report_field' => 1,
                'is_unique' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-09-29 00:00:00',
                'updated_at' => '2018-09-29 05:01:11',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}