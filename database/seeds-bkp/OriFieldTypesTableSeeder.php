<?php

use Illuminate\Database\Seeder;

class OriFieldTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_field_types')->delete();
        
        \DB::table('ori_field_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'text',
                'type' => 'text',
                'expression' => NULL,
                'min_length' => NULL,
                'max_length' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'dropdown',
                'type' => NULL,
                'expression' => NULL,
                'min_length' => NULL,
                'max_length' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'mobile',
                'type' => 'text',
                'expression' => '[a-zA-Z0-9-]+',
                'min_length' => 3,
                'max_length' => 13,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'email',
                'type' => 'email',
                'expression' => '[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$',
                'min_length' => NULL,
                'max_length' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'datepicker',
                'type' => NULL,
                'expression' => NULL,
                'min_length' => NULL,
                'max_length' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'datetime',
                'type' => NULL,
                'expression' => NULL,
                'min_length' => NULL,
                'max_length' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'timepicker',
                'type' => NULL,
                'expression' => NULL,
                'min_length' => NULL,
                'max_length' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'textarea',
                'type' => 'textarea',
                'expression' => NULL,
                'min_length' => NULL,
                'max_length' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'checkbox',
                'type' => NULL,
                'expression' => NULL,
                'min_length' => NULL,
                'max_length' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'radio',
                'type' => NULL,
                'expression' => NULL,
                'min_length' => NULL,
                'max_length' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'multiselect',
                'type' => NULL,
                'expression' => NULL,
                'min_length' => NULL,
                'max_length' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'url',
                'type' => 'text',
                'expression' => NULL,
                'min_length' => NULL,
                'max_length' => NULL,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'aadhar',
                'type' => 'text',
                'expression' => '[a-zA-Z0-9-]+',
                'min_length' => 12,
                'max_length' => 12,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'pancard',
                'type' => 'text',
                'expression' => '[a-zA-Z0-9-]+',
                'min_length' => 10,
                'max_length' => 10,
                'status' => 1,
                'created_by' => NULL,
                'updated_by' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'passport',
                'type' => 'text',
                'expression' => '[a-zA-Z0-9-]+',
                'min_length' => 8,
                'max_length' => 12,
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