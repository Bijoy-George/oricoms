<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(CountriesTableSeeder::class);
		$this->call(OriMastPlansTableSeeder::class);
        //$this->call(OriMastTemplatesTableSeeder::class);
        $this->call(OriCompanyProfilesTableSeeder::class);
     //   $this->call(OriMastPlansTableSeeder::class);
       // $this->call(OriMastPlansTableSeeder::class);
        $this->call(OriRolesTableSeeder::class);
        $this->call(OriPermissionsTableSeeder::class);
        $this->call(OriUsersTableSeeder::class);
		$this->call(OriCustomerProfileFieldsTableSeeder::class);
        $this->call(OriMastQueryTypeTableSeeder::class);
		$this->call(OriMastQueryStatusTableSeeder::class);
		//$this->call(OriMastLeadStatusTableSeeder::class);
		$this->call(OriChannelsTableSeeder::class);
		$this->call(OriMastFaqCategoriesTableSeeder::class);
		$this->call(OriChannelsTableSeeder::class);
		$this->call(OriChannelsTableSeeder::class);
		$this->call(OriMastQueryCategoryRelationTableSeeder::class);
        $this->call(OriCompanyChannelsTableSeeder::class);
        $this->call(OriQuestionsTableSeeder::class);
        $this->call(OriMastQueryStatusRelationTableSeeder::class);
        $this->call(OriMastCustomerNatureTableSeeder::class);
		$this->call(OriMastLeadSourceTypeTableSeeder::class);
		$this->call(OriMastLeadSourcesTableSeeder::class);
        $this->call(OriEmailFetchsTableSeeder::class);
       // $this->call(OriEmailFetchsAttachmentsTableSeeder::class);
        $this->call(OriCustomerProfilesTableSeeder::class);
        $this->call(OriFbDetailsTableSeeder::class);
        $this->call(OriFbSettingsTableSeeder::class);

        $this->call(OriMastPriorityTableSeeder::class);
        $this->call(OriHelpdeskTableSeeder::class);
        $this->call(OriHelpdeskLogTableSeeder::class);
        $this->call(OriLeadFollowupsTableSeeder::class);
        $this->call(OriLeadFollowupsLogTableSeeder::class);
        $this->call(OriAutomatedProcessStagesTableSeeder::class);
		$this->call(OriAutomatedProcessTableSeeder::class);
        $this->call(OriIntimationsTableSeeder::class);
    }

}
