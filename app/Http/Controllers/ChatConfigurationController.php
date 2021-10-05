<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Helpers;
use App\LeadSources;

class ChatConfigurationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check-permission:chat configuration');
    }
	
	public function index()
    {
    	$leadSourceTypeId   =   Helpers::get_company_meta("lead_src_type_chat");
		return view('chat_configuration_index',compact('leadSourceTypeId'));
	}

	public function search_list(Request $request)
	{
		$response           =   $request->all();
		$company_id 		= 	Auth::User()->cmpny_id;
		$leadSourceTypeId   =   Helpers::get_company_meta("lead_src_type_chat");
        $search_keywords    =   $response['search_keywords'];
        $results 			= 	array();	
        $results 			= 	LeadSources::where('lead_source_type_id',$leadSourceTypeId)
        								->orderBy('id', 'asc');
        if(isset($search_keywords) && !empty($search_keywords)) 
        {
            $results->where(function($results) use ($search_keywords)
            {
                $results->orWhere('name', 'like', '%' . $search_keywords . '%');
               
            });
        }

        $list_count =  $results->count();
        $results    =  $results->paginate(config('constant.pagination_constant'));
		$html = view('chat_configuration_listview')->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;		
	}

	public function generate_random_key_for_chat(Request $request)
	{
		$response 		  =	  $request->all();
		$company_id 	  =   Auth::User()->cmpny_id;
		$lead_src_id  	  =   $response['lead_src_id'];
		$unique_key	      =   false;
		do
		{
			$random_key   =   str_random(16);
			$random_count =   LeadSources::where('source_key', $random_key)->count();

			if ($random_count < 1)
			{
				$unique	= true;
			}
		}
		while(!$unique);

		if(isset($lead_src_id) && !empty($lead_src_id))
		{
			$result = LeadSources::updateOrCreate(
				[
					'id' => $lead_src_id,
				],
				[
					'source_key' => $random_key,
				]);
		}
		$result_arr	= array('success' => true,'message' => 'Successfully updated');
		return $result_arr;		

	}
}
