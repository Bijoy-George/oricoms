<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_countries')->delete();
        
        \DB::table('ori_countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'country_name' => 'India',
                'created_at' => '2017-07-20 00:00:00',
                'status' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'country_name' => 'UAE',
                'created_at' => '2017-07-20 00:00:00',
                'status' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'country_name' => 'Saudi Arabia',
                'created_at' => '2017-07-20 00:00:00',
                'status' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'country_name' => 'Oman',
                'created_at' => '2017-07-20 00:00:00',
                'status' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'country_name' => 'Qatar',
                'created_at' => '2017-07-20 00:00:00',
                'status' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'country_name' => 'Kuwait',
                'created_at' => '2017-07-20 00:00:00',
                'status' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'country_name' => 'Bahrain',
                'created_at' => '2017-07-20 00:00:00',
                'status' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'country_name' => 'Iran',
                'created_at' => '2017-07-20 00:00:00',
                'status' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'country_name' => 'Iraq',
                'created_at' => '2017-07-20 00:00:00',
                'status' => 1,
            ),
        ));
        
        
    }
}