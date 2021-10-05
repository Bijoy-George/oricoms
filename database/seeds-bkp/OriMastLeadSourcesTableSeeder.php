<?php

use Illuminate\Database\Seeder;

class OriMastLeadSourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('ori_mast_lead_sources')->delete();
		
		\DB::table('ori_mast_lead_sources')->insert(array (
			0 => 
            array (
                'id'                  => 1,
                'cmpny_id'  		  => 2,
                'name' 				  => 'Facebookchat',
				'lead_source_type_id' => 8,
				'source_key'          => '1#bC9#bD3?uM2/dH1#fb',
                'status'			  => 1,
				'created_at' 		  => '2018-10-12 00:00:00',
				'updated_at' 		  => '2018-10-12 00:00:00',
            ),
			1 => 
            array (
                'id'                  => 2,
                'cmpny_id'  		  => 1,
                'name' 				  => 'Whatsappchat',
				'lead_source_type_id' => 4,
				'source_key'          => '8cHxmmUl$bSHT$z',
                'status'			  => 1,
				'created_at' 		  => '2018-10-12 00:00:00',
				'updated_at' 		  => '2018-10-12 00:00:00',
            ),
			2 => 
            array (
                'id'                  => 3,
                'cmpny_id'  		  => 1,
                'name' 				  => 'Facebookchat',
				'lead_source_type_id' => 4,
				'source_key'          => '3hHmophL$FdrThd',
                'status'			  => 1,
				'created_at' 		  => '2018-10-12 00:00:00',
				'updated_at' 		  => '2018-10-12 00:00:00',
            ),
			3 => 
            array (
                'id'                  => 4,
                'cmpny_id'  		  => 2,
                'name' 				  => 'Whatsappchat',
				'lead_source_type_id' => 8,
				'source_key'          => '*B6)Z3m](P"ZUfi',
                'status'			  => 1,
				'created_at' 		  => '2018-10-12 00:00:00',
				'updated_at' 		  => '2018-10-12 00:00:00',
            ),
			4 => 
            array (
                'id'                  => 5,
                'cmpny_id'  		  => 2,
                'name' 				  => 'Feedback',
				'lead_source_type_id' => 9,
				'source_key'          => '4g~Z<rdv6mAb![@',
                'status'			  => 1,
				'created_at' 		  => '2018-10-12 00:00:00',
				'updated_at' 		  => '2018-10-12 00:00:00',
            ),
			5 => 
            array (
                'id'                  => 6,
                'cmpny_id'  		  => 1,
                'name' 				  => 'Feedback',
				'lead_source_type_id' => 10,
				'source_key'          => 'CXBb##5R?x1B".e',
                'status'			  => 1,
				'created_at' 		  => '2018-10-12 00:00:00',
				'updated_at' 		  => '2018-10-12 00:00:00',
            ),
		));
    }
}
