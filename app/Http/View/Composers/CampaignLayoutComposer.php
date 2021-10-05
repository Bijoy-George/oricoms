<?php

namespace App\Http\View\Composers;

use App\Campaign;
use App\Group;
use Illuminate\View\View;

class CampaignLayoutComposer
{

	public function __construct()
	{
		//
	}

	/**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
    	$total_campaigns_count	= Campaign::count();
    	$total_groups_count		= Group::count();
        $view->with(compact('total_campaigns_count', 'total_groups_count'));
    }
}