<?php

use Illuminate\Database\Seeder;

class OriMastLeadSourceTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('ori_mast_lead_source_type')->delete();
		
		\DB::table('ori_mast_lead_source_type')->insert(array (
			0 => 
            array (
                'id'		  => 1,
                'cmpny_id' 	  => '1',
                'source_type' => 'Social Media',
                'status' 	  => 1,
				'created_at'  => '2018-10-12 00:00:00',
				'updated_at'  => '2018-10-12 00:00:00',
            ),
			1 => 
            array (
                'id' 		  => 2,
                'cmpny_id'    => '1',
                'source_type' => 'News Paper',
                'status'      => 1,
				'created_at'  => '2018-10-12 00:00:00',
				'updated_at'  => '2018-10-12 00:00:00',
            ),
			2 => 
            array (
                'id' 		  => 3,
                'cmpny_id'    => '1',
                'source_type' => 'TV Channels',
                'status' 	  => 1,
				'created_at'  => '2018-10-12 00:00:00',
				'updated_at'  => '2018-10-12 00:00:00',
            ),
			3 => 
            array (
                'id' 		  => 4,
                'cmpny_id'    => '1',
                'source_type' => 'Chat Application',
                'status'      => 1,
				'created_at'  => '2018-10-12 00:00:00',
				'updated_at'  => '2018-10-12 00:00:00',
            ),
			4 => 
            array (
                'id'	      => 5,
                'cmpny_id' 	  => '2',
                'source_type' => 'Social Media',
                'status' 	  => 1,
				'created_at'  => '2018-10-12 00:00:00',
				'updated_at'  => '2018-10-12 00:00:00',
            ),
			5 => 
            array (
                'id' 		  => 6,
                'cmpny_id'    => '2',
                'source_type' => 'News Paper',
                'status'      => 1,
				'created_at'  => '2018-10-12 00:00:00',
				'updated_at'  => '2018-10-12 00:00:00',
            ),
			6 => 
            array (
                'id'		  => 7,
                'cmpny_id'    => '2',
                'source_type' => 'TV Channels',
                'status'      => 1,
				'created_at'  => '2018-10-12 00:00:00',
				'updated_at'  => '2018-10-12 00:00:00',
            ),
			7 => 
            array (
                'id'		  => 8,
                'cmpny_id'    => '2',
                'source_type' => 'Chat Application',
                'status'      => 1,
				'created_at'  => '2018-10-12 00:00:00',
				'updated_at'  => '2018-10-12 00:00:00',
            ),
			8 => 
            array (
                'id'		  => 9,
                'cmpny_id'    => '2',
                'source_type' => 'CRM',
                'status'      => 1,
				'created_at'  => '2018-11-13 00:00:00',
				'updated_at'  => '2018-11-13 00:00:00',
            ),
			9 => 
            array (
                'id'		  => 10,
                'cmpny_id'    => '2',
                'source_type' => 'CRM',
                'status'      => 1,
				'created_at'  => '2018-11-13 00:00:00',
				'updated_at'  => '2018-11-13 00:00:00',
            ),
		));
    }
}
