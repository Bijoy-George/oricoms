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
                'is_unique' => NULL,
                'field_type' => 1,
                'field_id' => 1,
                'tab_id' => 1,
                'sort_order' => NULL,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-09-29 00:00:00',
                'updated_at' => '2018-11-14 12:42:37',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cmpny_id' => 2,
                'field_name' => 'email',
                'type' => 1,
                'required' => NULL,
                'label' => 'Email',
                'report_field' => 1,
                'is_unique' => 1,
                'field_type' => '4',
                'field_id' => 3,
                'tab_id' => 1,
                'sort_order' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-09-29 00:00:00',
                'updated_at' => '2018-11-14 12:42:51',
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
                'field_type' => 3,
                'field_id' => 4,
                'tab_id' => 1,
                'sort_order' => NULL,
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
                'type' => 1,
                'required' => 2,
                'label' => 'Aadhar',
                'report_field' => 1,
                'is_unique' => 2,
                'field_type' => 13,
                'field_id' => 12,
                'tab_id' => 1,
                'sort_order' => NULL,
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
                'field_name' => 'pancard',
                'type' => 1,
                'required' => 2,
                'label' => 'Pan Card',
                'report_field' => 1,
                'is_unique' => 2,
                'field_type' => 14,
                'field_id' => 13,
                'tab_id' => 1,
                'sort_order' => NULL,
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
                'is_unique' => 2,
                'field_type' => 1,
                'field_id' => 2,
                'tab_id' => 1,
                'sort_order' => NULL,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-09-29 00:00:00',
                'updated_at' => '2018-09-29 05:01:11',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'cmpny_id' => 2,
                'field_name' => 'dob',
                'type' => 1,
                'required' => NULL,
                'label' => 'DOB',
                'report_field' => NULL,
                'is_unique' => NULL,
                'field_type' => 5,
                'field_id' => 5,
                'tab_id' => 1,
                'sort_order' => 1,
                'status' => 2,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-09-29 00:00:00',
                'updated_at' => '2018-11-14 13:23:24',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'cmpny_id' => 2,
                'field_name' => 'address',
                'type' => 1,
                'required' => 2,
                'label' => 'Address',
                'report_field' => 2,
                'is_unique' => 2,
                'field_type' => 8,
                'field_id' => 6,
                'tab_id' => 1,
                'sort_order' => NULL,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-09-29 00:00:00',
                'updated_at' => '2018-11-14 13:20:40',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'cmpny_id' => 2,
                'field_name' => 'profile_status',
                'type' => 1,
                'required' => 2,
                'label' => 'Profile Status',
                'report_field' => 2,
                'is_unique' => 2,
                'field_type' => NULL,
                'field_id' => NULL,
                'tab_id' => 1,
                'sort_order' => NULL,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-09-29 00:00:00',
                'updated_at' => '2018-11-14 13:20:40',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
                'cmpny_id' => 2,
                'field_name' => 'source',
                'type' => 1,
                'required' => 2,
                'label' => 'Lead Source',
                'report_field' => 2,
                'is_unique' => 2,
                'field_type' => NULL,
                'field_id' => NULL,
                'tab_id' => 1,
                'sort_order' => NULL,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => '2018-09-29 00:00:00',
                'updated_at' => '2018-11-14 13:20:40',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}