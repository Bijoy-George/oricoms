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
                'ori_cmp_org_name' => 'Oricom',
                'ori_cmp_org_email' => 'admin@oricom.in',
                'ori_cmp_org_phone' => '8086800203',
                'ori_cmp_org_address' => 'D3,6th floor,Bhavani Building,Technopark,Trivandrum',
                'ori_cmp_org_country_code' => NULL,
                'ori_cmp_org_mobile' => NULL,
                'ori_cmp_org_city' => NULL,
                'ori_cmp_org_state' => NULL,
                'ori_cmp_org_pincode' => NULL,
                'ori_cmp_org_country' => NULL,
                'ori_cmp_org_plan' => 4,
                'created_at' => '2018-10-08 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'status' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'ori_cmp_org_name' => 'orisys',
                'ori_cmp_org_email' => 'admin@orisys.in',
                'ori_cmp_org_phone' => '9963528741',
                'ori_cmp_org_address' => 'Trivandrum',
                'ori_cmp_org_country_code' => NULL,
                'ori_cmp_org_mobile' => NULL,
                'ori_cmp_org_city' => NULL,
                'ori_cmp_org_state' => NULL,
                'ori_cmp_org_pincode' => NULL,
                'ori_cmp_org_country' => NULL,
                'ori_cmp_org_plan' => 4,
                'created_at' => '2018-10-08 00:00:00',
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'status' => 1,
            ),
        ));
        
        
    }
}