<?php

use Illuminate\Database\Seeder;

class OriCompanyProfilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ori_company_profiles')->delete();
        
        \DB::table('ori_company_profiles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ori_cmp_org_name' => 'Company 1',
                'ori_cmp_org_email' => 'company1@gmai.com',
                'ori_cmp_org_phone' => '9963528741',
                'ori_cmp_org_address' => 'tvm',
                'created_at' => '2018-10-08 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'status' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'ori_cmp_org_name' => 'Company 2',
                'ori_cmp_org_email' => 'company2@gmai.com',
                'ori_cmp_org_phone' => '9977528741',
                'ori_cmp_org_address' => 'kztm',
                'created_at' => '2018-10-08 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'status' => 1,
            ),
        ));
        
        
    }
}