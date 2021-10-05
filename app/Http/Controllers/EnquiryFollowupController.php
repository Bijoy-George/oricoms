<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\AutomatedProcess;
use App\CampaignQueryStatus;
use App\CommonSmsEmail;
use App\CustomerNature;
use App\CustomerProfile;
use App\CustomerProfileField;
use App\CustomerResponse;
use App\Faq;
use App\FaqCategories;
use App\Feedback;
use App\FeedbackRequest;
use App\Helpdesk;
use App\HelpdeskLog;
use App\LeadFollowup;
use App\LeadFollowupLog;
use App\LocationSettings;
use App\Priority;
use App\QueryAction;
use App\QueryCategoryRelation;
use App\QueryStatus;
use App\QueryStatusRelation;
use App\QueryTypes;
use App\SupplyCards;
use App\SupplyOffices;
use App\User;
use App\UserRole;
use App\Institution;

use Auth;
use Carbon\Carbon;
use CommunicationHelper;
use Helpers;
use Illuminate\Http\Request;

class EnquiryFollowupController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
	
	/*
    * FOR CREATE ENQUIRY
    * @author ELAVARASI
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return ENQUIRY FORM
    */
	public function create(Request $request)
    {   
    	//CommunicationHelper::common_sms_response('9645059169','oricom welcomes you');
		$customer_id = request('customer_id');
		$query_ehealth = null;
		
		$customer = NULL;
                $demo = ['' => 'Select'] + config('constant.DEMO');
		if(!empty($customer_id))
		{
			$customer = CustomerProfile::find($customer_id);
		}
		$permissions = config('constant.ESCALATE_TO');
		
		$query_types = QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->select('query_type', 'id','type','short_code')->get();
		
		$customer_natures = ['' => 'Select'] + CustomerNature::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->pluck('customer_nature', 'id')->all();

		$query_actions = ['' => 'Select'] + QueryAction::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->pluck('action', 'id')->all();
		
		$priorities = ['' => 'Select'] + Priority::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->pluck('name', 'id')->all();

		$query_status = ['' => 'Select'] + QueryStatus::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->pluck('name', 'id')->all();
		
		$role_types = ['' => 'Select'] + UserRole::where('cmpny_id',Auth::user()->cmpny_id)
								->where('access_permission', 'like', '%' . $permissions . '%')
								->orderBy('role', 'asc')->pluck('role', 'id')->all();

		 $local_body_type = CustomerProfileField::where('cmpny_id',Auth::user()->cmpny_id)
                     ->where('status',config('constant.ACTIVE'))
                     ->where('field_name','local_body_type')
                     ->get();
        $customer_response_types	= ['' => 'Select Customer Response Type'] + CustomerResponse::whereNull('parent_id')->where('status', config('constant.ACTIVE'))->pluck('customer_response', 'id')->all();
        $supply_cards = ['' => 'Select'] + SupplyCards::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->pluck('name', 'id')->all();
        $district_supply_office = ['' => 'Select'] + SupplyOffices::where('cmpny_id',Auth::user()->cmpny_id)->whereNull('parent_id')->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->pluck('supply_office', 'id')->all();
        $country_arr         =LocationSettings::select('id','name','is_other')->where('parent',0)->get();

        $is_other_country = 0;
        if ($customer)
        {
        	$is_other_country = $customer->getCountry->is_other ?? 0;
        }
	$query_ehealth = null;
        if(Auth::user()->cmpny_id == 32)
		{
			if(!empty($customer_id))
			{
			
			$dnd = CustomerProfile::select('dnd')->where('id',$customer_id)->first();
			$query_ehealth = $dnd->dnd;}
			$query_types = QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->where('short_code','!=',"issue")->where('short_code','!=',"measure_taken")->orderBy('sort_order')->select('query_type', 'id','type','short_code')->get();
			$issues = QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->where('short_code','=',"issue")->orderBy('sort_order')->select('query_type', 'id','type','short_code')->get();
			$measure_taken = QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->where('short_code','=',"measure_taken")->orderBy('sort_order')->select('query_type', 'id','type','short_code')->get();
			
		}
		else{$issues = array();$measure_taken = array();}
if(!empty(request('issue')))
                {$query_ehealth = request('issue');}
//dd($query_ehealth);
//if(!empty($dnd_call)){dd($dnd_call);}
		return view('profile.enquiry.create', compact('query_types','query_ehealth','customer_natures', 'priorities','customer_id', 'role_types', 'query_status','local_body_type','district_supply_office','supply_cards','query_actions','country_arr','customer','is_other_country','customer_response_types','demo','issues','measure_taken'));
		
    }
	/*
    * FOR HELPDESK LISTING SECTION
    * @author ELAVARASI
    * @date 15/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return HELPDESK LISTING VIEW BLADE
    */
	public function helpdesk_listing(Request $request)
    {   
		$customer_id 		= request('customer_id');
		$type 				= request('type');
		$limit 				= (request('limit') == 'all')? -1 : config('constant.pagination_constant'); 
		$results 	 		= array();
		$followup_history 	= array();
		$permissions = config('constant.ESCALATE_TO');
		if($customer_id != ""){
		$results 	 = Helpdesk::select('id','docket_number','customer_id','req_title','question','answer','escalate','query_status','query_category','sub_query_category','priority','query_type','remainder_date','updated_by','created_at','country_id','state_id','district_id','local_body_type','muncipality_id','corporation_id','district_panchayath_id','block_panchayath_id','grama_panchayath_id','panchayath_id','taluk_id','village_id','ard_no','location','other_category','other_subcategory','supply_card','card_no','escalation_deadline','district_supply_office','taluk_supply_office','action_taken','demo')
								->with('GetQueryCategory')
                                                                ->with('GetSubQueryCategory')
								->where('cmpny_id',Auth::user()->cmpny_id)
								->where('customer_id',$customer_id);
								if(Auth::user()->cmpny_id != 32)
		    						 {
								if(!empty($type)){
									$results = $results->where('query_type',$type);
								}
								}
								if(Auth::user()->cmpny_id == 32)
		    						 {
								if(!empty($type)){
									$results = $results->where('query_status',$type);
								}
								}

		$results = $results->orderBy('id', 'desc')->limit($limit)->get();
		
		}		
		$query_types = ['' => 'Select '] + QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)
		->where('status',config('constant.ACTIVE'))
		->where('type',config('constant.TICKET'))->orderBy('sort_order')
		->pluck('query_type', 'id')
		->all();
		
			
		$priorities = ['' => 'Select Priority'] + Priority::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->pluck('name', 'id')->all();

		$query_status = ['' => 'Select Status'] + QueryStatus::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->pluck('name', 'id')->all();

		$query_actions = ['' => 'Select'] + QueryAction::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->pluck('action', 'id')->all();
		
		$role_types = ['' => 'Select Role'] + UserRole::where('cmpny_id',Auth::user()->cmpny_id)
								->where('access_permission', 'like', '%' . $permissions . '%')
								->orderBy('role', 'asc')->pluck('role', 'id')->all();

		$district_supply_offices = ['' => 'Select'] + SupplyOffices::where('cmpny_id',Auth::user()->cmpny_id)->whereNull('parent_id')->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->pluck('supply_office', 'id')->all();

		$supply_cards = ['' => 'Select'] + SupplyCards::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->pluck('name', 'id')->all();
		
		$i = 0;						
		foreach($results as $val)
                {	
            	$arr1               =   $val;  
            	$arr1['f_status']   =	QueryStatusRelation::select('query_type_id','query_status_id')
            							->where('cmpny_id',Auth::user()->cmpny_id)
            							->where('query_type_id',$val->query_type)
            							->where('status',config('constant.ACTIVE'))
            							->orderBy('id', 'asc')
            							->get();


			$arr1['f_status_category']   =	/*QueryCategoryRelation::select('query_type_id','category_id')
            							->where('cmpny_id',Auth::user()->cmpny_id)
            							->where('query_type_id',$val->query_type)
            							->where('status',config('constant.ACTIVE'))
            							->orderBy('id', 'asc')
            							->get();*/
            							FaqCategories::select('ori_mast_faq_categories.category_name', 'ori_mast_faq_categories.id as category_id', 'ori_mast_faq_categories.short_code')
		->join('ori_mast_query_category_relation', 'ori_mast_query_category_relation.category_id', '=', 'ori_mast_faq_categories.id')
		->where('ori_mast_query_category_relation.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_query_category_relation.query_type_id',$val->query_type)
		->where('ori_mast_faq_categories.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_faq_categories.status',config('constant.ACTIVE'))
		->whereNull('ori_mast_faq_categories.parent_category_id')
		->orderBy('ori_mast_faq_categories.sort_order')
		->get();

			$arr1['f_sub_category']   =	FaqCategories::select('id','category_name')
										->where('status',config('constant.ACTIVE'))
            							->where('parent_category_id',$val->query_category)
            							->where('status',config('constant.ACTIVE'))
            							->orderBy('category_name', 'asc')
            							->get();

			$arr1['f_taluk_supply_offices'] = ['' => 'Select'] + SupplyOffices::select('supply_office', 'id')               
												->where('parent_id',$val->district_supply_office)
												->orderBy('sort_order')
												->pluck('supply_office','id')
												->all();


            							/*$categories =  FaqCategories::select('ori_mast_faq_categories.category_name', 'ori_mast_faq_categories.id')
		->join('ori_mast_query_category_relation', 'ori_mast_query_category_relation.category_id', '=', 'ori_mast_faq_categories.id')
		->where('ori_mast_faq_categories.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_query_category_relation.cmpny_id',Auth::user()->cmpny_id);
		
		->where('ori_mast_query_category_relation.query_type_id',$type)
		->orderBy('ori_mast_faq_categories.category_name')
		->groupBy('ori_mast_faq_categories.category_name')
		->groupBy('ori_mast_faq_categories.id')
		
		$categories = $categories->get();*/




                    $followup_history[$i++]=  $arr1;
                }
              $query_type = $type;
              $faq_category = FaqCategories::where('cmpny_id',Auth::user()->cmpny_id)->pluck('category_name','id')->all();
               if(Auth::user()->cmpny_id == 32)
		     {
			
			$query_types = ['' => 'Select '] + QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)
			->where('status',config('constant.ACTIVE'))
			->where('short_code','!=',"issue")
			->where('short_code','!=',"measure_taken")
			->orderBy('sort_order')
			->pluck('query_type', 'id')
		    ->all();
			
		}
		return view('profile.enquiry.helpdesk_listing')->with(compact('query_type','followup_history','query_types','role_types','priorities','query_status','limit','district_supply_offices','supply_cards','query_actions','faq_category'));
		
    }
    public function check_query_type(Request $request)
    {
    	$query_type=$request->post('query_type');
    	$query_id=QueryTypes::select('id')->where('slug','dial_a_doctor')->first();
    	if(isset($query_id) && !empty($query_id))
    	{
    		if($query_type== $query_id->id){
    	
    	$title_name=Helpers::get_company_meta('investigation_label',Auth::user()->cmpny_id);
    	$answer_short=Helpers::get_company_meta('prescription_label',Auth::user()->cmpny_id);
    	$result_arr = array('success' => True,'title_lb' =>$title_name,'answer_short_lb'=>$answer_short);
    	return json_encode($result_arr);
    	}
    	
    }
    
    else{
    	
		 $result_arr = array('success' => false);
		 return json_encode($result_arr);
    }
            
    }
	
	/*
    * FOR FOLLOWUP LISTING SECTION
    * @author ELAVARASI
    * @date 31/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return FOLLOWUP LISTING VIEW BLADE
    */
	public function followup_listing(Request $request)
    {   
		$customer_id 		= request('customer_id');
		$type 				= request('type');
		$limit 				= (request('limit') == 'all')? -1 : config('constant.pagination_constant');
		$results 	 		= array();
		$followup_history 	= array();
		if($customer_id != ""){
		$results 	 = LeadFollowup::select('id','docket_number','customer_id','req_title','question','answer','query_status','query_category','priority','query_type','remainder_date','updated_by','created_at','batch_id','ard_no','location','other_category','other_subcategory','supply_card','card_no')
								->where('cmpny_id',Auth::user()->cmpny_id)
								->where('customer_id',$customer_id);
								if(!empty($type)){
									$results = $results->where('query_type',$type);
								}
		$results = $results->orderBy('id', 'desc')->limit($limit)->get();
		
		}		
		$query_types = ['' => 'Select'] + QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)
		->where('status',config('constant.ACTIVE'))
		->where('type',config('constant.FOLLOWUPS'))->orderBy('sort_order')
		->pluck('query_type', 'id')
		->all();
		
			
		$priorities = ['' => 'Select Priority'] + Priority::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->pluck('name', 'id')->all();
 
		$query_status = ['' => 'Select Status'] + QueryStatus::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->pluck('name', 'id')->all();

		
		$i = 0;	
$arr1['c_status'] = array();		
		foreach($results as $val)
                { 	 
            	$arr1               =   $val;  
            	$arr1['f_status']   =	QueryStatusRelation::select('query_type_id','query_status_id')
            							->where('cmpny_id',Auth::user()->cmpny_id)
            							->where('query_type_id',$val->query_type)
            							->where('status',config('constant.ACTIVE'))
            							->orderBy('id', 'asc')
            							->get();
				if(isset($val->batch_id) && !empty($val->batch_id))
				{
				$arr1['c_status']   =	CampaignQueryStatus::select('query_status')
            							->where('cmpny_id',Auth::user()->cmpny_id)
            							->where('batch_id',$val->batch_id)
            							->orderBy('id', 'asc')
            							->get();
				}

			$arr1['f_status_category']   =	/*QueryCategoryRelation::select('query_type_id','category_id')
            							->where('cmpny_id',Auth::user()->cmpny_id)
            							->where('query_type_id',$val->query_type)
            							->where('status',config('constant.ACTIVE'))
            							->orderBy('id', 'asc')
            							->get();*/
            							FaqCategories::select('ori_mast_faq_categories.category_name', 'ori_mast_faq_categories.id as category_id')
		->join('ori_mast_query_category_relation', 'ori_mast_query_category_relation.category_id', '=', 'ori_mast_faq_categories.id')
		->where('ori_mast_query_category_relation.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_query_category_relation.query_type_id',$val->query_type)
		->where('ori_mast_faq_categories.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_faq_categories.status',config('constant.ACTIVE'))
		->whereNull('ori_mast_faq_categories.parent_category_id')
		->orderBy('ori_mast_faq_categories.sort_order')
		->get();

			$arr1['f_sub_category']   =	FaqCategories::select('id','category_name')
            							->where('parent_category_id',$val->query_category)
            							->where('status',config('constant.ACTIVE'))
            							->orderBy('category_name', 'asc')
            							->get();

                    $followup_history[$i++]=  $arr1;
                }
        $query_type = $type;
		//CampaignQueryStatus::
		return view('profile.enquiry.followup_listing')->with(compact('query_type','followup_history','query_types','role_types','priorities','query_status','limit'));
		
		
    }
    
	/*
    * GET CATEGORY
     * @author ELAVARASI
    * @date 04/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return CATEGORY LIST */
	
    public function get_category(Request $request){
		$query_type = request('query_type');

		if (empty($query_type))
		{
			return collect();
		}		
		
		$results =  FaqCategories::select('ori_mast_faq_categories.category_name', 'ori_mast_faq_categories.id','ori_mast_faq_categories.short_code','ori_mast_faq_categories.is_other')
		->join('ori_mast_query_category_relation', 'ori_mast_query_category_relation.category_id', '=', 'ori_mast_faq_categories.id')
		->where('ori_mast_query_category_relation.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_query_category_relation.query_type_id',$query_type)
		->where('ori_mast_faq_categories.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_faq_categories.status',config('constant.ACTIVE'))
		->whereNull('ori_mast_faq_categories.parent_category_id')
		->orderBy('ori_mast_faq_categories.sort_order')
		->orderBy('ori_mast_faq_categories.category_name')
		->get();
		//dd($results);
		
		echo $results;
	}
	/*
    * GET SUB CATEGORY
     * @author ELAVARASI
    * @date 14/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return SUB CATEGORY LIST */
	
    public function get_sub_category(Request $request){
		$query_type = request('query_type');			
		$parent_category_id = request('parent_category_id');

		if (empty($parent_category_id))
		{
			return collect();
		}			
		
		$results =  FaqCategories::select('category_name', 'ori_mast_faq_categories.id', 'ori_mast_faq_categories.is_other')
                ->join('ori_mast_query_category_relation', 'ori_mast_query_category_relation.category_id', '=', 'ori_mast_faq_categories.id')
//		->where('ori_mast_faq_categories.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_faq_categories.status',config('constant.ACTIVE'))
		->where('parent_category_id',$parent_category_id)
		->where('query_type_id',$query_type)
		->orderBy('ori_mast_faq_categories.sort_order')
		->get();
		
		echo $results;
	}
	/*
    * GET QUERY STATUS
     * @author ELAVARASI
    * @date 04/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return FAQ LIST */
	
    public function get_query_status(Request $request){
		$query_type = request('query_type');			
		
		$results =  QueryStatus::select('ori_mast_query_status.name', 'ori_mast_query_status.id')
		->join('ori_mast_query_status_relation', 'ori_mast_query_status_relation.query_status_id', '=', 'ori_mast_query_status.id')
		->where('ori_mast_query_status_relation.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_query_status_relation.query_type_id',$query_type)
		//->where('ori_mast_query_status.cmpny_id',Auth::user()->cmpny_id)
		//->orderBy('ori_mast_query_status.name')
		->where('ori_mast_query_status.status',config('constant.ACTIVE'))
		->orderBy('ori_mast_query_status.sort_order')
		->get();
		
		echo $results;
	}
	/*
    * GET USERS BY ROLE
     * @author ELAVARASI
    * @date 31/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return FAQ LIST */
	
    public function get_users_by_role(Request $request){
		
		$role_type = request('role_type');	
		$customer_id = $request->customer_id;		
		$permissions = config('constant.ESCALATE_TO');
	
		$results =  User::select('name', 'id')
							->where('cmpny_id', Auth::user()->cmpny_id)
							->where('role_id','like','%:"' . $role_type . '";%')
							->where('access_permission', 'like', '%' . $permissions . '%')
							->orderBy('name')
							->get();
		$referedBy = CustomerProfileMeta::where('cmpny_id', Auth::user()->cmpny_id)
						->where('user_id',$customer_id)->where('field_name')->value('value');
		echo json_encode(['results' => $results,'refered_by' => $referedBy]);
	}
	
	/*
    * Saving Profile Details
     * @author ELAVARASI
    * @date 04/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return FAQ LIST */
	
    public function store(Request $request){
    	
             
                   $validation_rules	= [
    			'query_type' => 'required',
    			'query_status' => 'required',
    			'query_category' => 'required',
                            			
    			];
                if($request->post('utid'))
                {
                   $validation_rules	= [
    			'utid' => 'digits:5'
    			];

                }
		 if($request->post('query_type') == 85 || $request->post('query_type') == 86)
                {
                   $validation_rules	= [
    			'pen_no' => 'required',
			'institution' => 'required',
			'query_type' => 'required',
    			'query_status' => 'required',
    			'query_category' => 'required',
			'district_id'  => 'required',
			'nature_of_call' => 'required',
			'issue'	=>	'required',
			'complaint_resolve'	=> 'required'
    			];

                }
		if($request->post('query_type') == 88)
		{
                   $validation_rules	= [
			'institution' => 'required',
			'query_type' => 'required',
    			'query_status' => 'required',
    			'query_category' => 'required',
			'district_id'  => 'required',
			'nature_of_call' => 'required',
			'issue'	=>	'required',
			'complaint_resolve'	=> 'required'
    			];

                }

             
		if(Helpers::get_company_meta('title_required') != 2)
		{
			$validation_rules['req_title']	= 'required';
		}
		if(Helpers::get_company_meta('question_required') != 2)
		{
			$validation_rules['question']	= 'required';
		}
		if(Helpers::get_company_meta('answer_required') == 1)
		{
			$validation_rules['req_title']	= 'required';
		}
		if(Helpers::get_company_meta('escalated_to_required') == 1)
		{
			$validation_rules['escalate_to']	= 'required';
		}

		$query_title_label = !empty(Helpers::get_company_meta('title_label')) ? Helpers::get_company_meta('title_label') : 'Query Title';
		$answer_label = !empty(Helpers::get_company_meta('answer_label')) ? Helpers::get_company_meta('answer_label') : 'Answer';
		$escalated_to_label = !empty(Helpers::get_company_meta('escalated_to_label')) ? Helpers::get_company_meta('escalated_to_label') : 'Escalated To';
		$this->validate($request,$validation_rules,[
				'query_type.required' => ' The Query Type field is required.',
				'query_status.required' => ' The Query Status field is required.',
				'query_category.required' => ' The Query Category field is required.',
				'req_title.required' => " The $query_title_label title field is required.",
				'question.required' => ' The Question field is required.',
				'answer.required' => " The $answer_label field is required.",
				'escalate_to.required' => " The $escalated_to_label field is required.",
				]);
				
		$enquiry_query_type = '';	
		$query_type = request('query_type');
		$query_category = request('query_category');	
		$question = urldecode(request('question'));	
		if(Helpers::get_company_meta('question_show') == 2){
			$question = request('req_title');
		}
		$answer = urldecode(request('answer'));	
		$chk_email = request('chk_email');	
		$chk_sms = request('chk_sms');
                $customer_response_type 	= $request->post('customer_response_type');
		$customer_response 			= $request->post('customer_response');
        $demo			= $request->post('demo');
        $type_of_call			= $request->post('type_of_call');
        $source_of_call			= $request->post('source_of_call');
        $institution	= $request->post('institution');
        $issue			= $request->post('issue');
        $nature_of_call	= $request->post('nature_of_call');
        $fwc_bs			= $request->post('fwc_bs');
        $pen_no			= $request->post('pen_no');
        $utid			= $request->post('utid');
        $complaint_resolve	= $request->post('complaint_resolve');
        $measure_taken			= $request->post('measure_taken');
	$query_status  = $request->post('query_status');
		//var_dump(request('attachments')); exit;
		//echo "<pre>"; var_dump($request->file('attachments[]')); exit;
		$attachments = json_decode(request('attachments'));	
		
		$remainder_date = (!empty(request('remainder_date'))? date('Y-m-d H:i', strtotime(request('remainder_date'))): NULL );
		$docket_number = rand();
		$sub_query_category = (!empty(request('sub_query_category'))? request('sub_query_category') : NULL );
		$district_supply_office = (!empty(request('district_supply_office'))? request('district_supply_office') : NULL );
		$taluk_supply_office = (!empty(request('taluk_supply_office'))? request('taluk_supply_office') : NULL );
		//$remainder_date = (!empty(request('remainder_date'))? NULL : NULL );
		$escalate_to 	= (!empty(request('escalate_to'))? request('escalate_to') : NULL );
		$escalation_status 	= (!empty(request('escalate_to'))? 1 : NULL );
		$escalate 		= (!empty(request('escalate_to'))? request('escalate_to') : NULL );
		
		$escalation_deadline = NULL;
		$escalation_due_date = NULL;
		if(!empty(request('action'))){
			if(request('action') == 1){ // If hour
				$escalation_deadline = request('est_time')*60;
			}elseif(request('action') == 3){ // If day
				$escalation_deadline = request('est_time')*24*60;
			}else{ // If minute
				$escalation_deadline = request('est_time');
			}
			$escalation_due_date = Carbon::now()->addMinutes($escalation_deadline);
		}
		/*$escalation_deadline = (!empty(request('action'))? ((request('action') == 1)? request('est_time')*60 : (request('action') == 3)? 24*60 : request('est_time') ) : NULL );*/
		
		$other_category = (!empty(request('other_category'))? request('other_category'): NULL );
		$other_subcategory = (!empty(request('other_subcategory'))? request('other_subcategory'): NULL );
		
		//$escalation_due_date = Carbon::now()->addMinutes($escalation_deadline);		
		
		$check_query_type = QueryTypes::find($query_type);
		$faq_cat = FaqCategories::find(request('query_category'));
		$customer_id = request('customer_id');
		$action_taken	= $request->post('action_taken');
		$other_country = $request->post('other_country');
		/* if($escalate != NULL){
		Helpers::add_notifications($escalate,"Escalation","Escalation",url('/profile/0/'.$customer_id),Auth::user()->id,Auth::user()->cmpny_id);
		} */

		
		
		
		if($check_query_type->type == 1){
			/* Generate 8 digit number by primary key*/
			/*$num = Helpdesk::select('id')->where('cmpny_id',Auth::user()->cmpny_id)->orderBy('id','desc')->first();
			if(!$num){	$id_num = 1; }else{	$id_num = $num->id+1; }
			$final_no = str_repeat('0',(8-(int)strlen($id_num))).$id_num;

			$short_code = $faq_cat->short_code;
			$docket_number = "GCC/".$short_code.'/'.date('dmY').'/'.$final_no;*/

	    	$docket_number = Helpers::generate_doc_no("ticket",request('query_type'),request('query_category'));

			$enquiry_query_type = 'helpdesk';
			$res = Helpdesk::create(
				[
					'cmpny_id' => Auth::user()->cmpny_id,
					'customer_id' => request('customer_id'),
					'docket_number' => $docket_number,
					'remainder_date' => $remainder_date,
					'req_title' => request('req_title'),
					'need_followup' => (!empty(request('need_followup'))? 1 : NULL ),
					'question' => $question,							
					'answer' => $answer,								
					'short_message' => request('short_message'),								
					'query_type' => request('query_type'),									
					'query_category' => request('query_category'),									
					'sub_query_category' => $sub_query_category,
					'other_category' => $other_category,								
					'other_subcategory' => $other_subcategory,	
					'customer_nature' => request('customer_nature'),
					'action_taken'	=> $action_taken,									
					'priority' => request('priority'),
                    'customer_response_type' => $customer_response_type,
					'customer_response'	=> $customer_response,
					'demo'	=> $demo,
                    'type_of_call'	=> $type_of_call,
                    'source_of_call'	=> $source_of_call,
                    'institution'	=> $institution,
                    'issue'	=> $issue,
                    'nature_of_call'	=> $nature_of_call,
                    'fwc_bs'	=> $fwc_bs,
                    'pen_no'	=> $pen_no,
                    'utid'	=> $utid,
                    'complaint_resolve'	=> $complaint_resolve,
                    'measure_taken'	=> $measure_taken,
                    
                    
					
					'supply_card' => request('supply_cards'),	
					'card_no' => request('card_no'),	
					'ard_no' => request('ard_no'),
					'location' => request('location'),									
					'query_status' => request('query_status'),									
					'escalation_status' => $escalation_status,
					'escalate' => $escalate,
					'escalation_deadline' => $escalation_deadline,									
					'escalation_due_date' => $escalation_due_date,
					'taluk_supply_office' => $taluk_supply_office,
					'district_supply_office' => $district_supply_office,


					'country_id' => request('country_id'),								
					'other_country' => $other_country,								
					'state_id' => request('state_id'),							
					'district_id' => request('district_id'),							
					'taluk_id' => request('taluk_id'),
					'village_id' => request('village_id'),
					'local_body_type' => request('local_body_type'),
					'muncipality_id' => request('muncipality_id'),
					'corporation_id' => request('corporation_id'),
					'panchayath_type' => request('panchayath_type'),
					'district_panchayath_id' => request('district_panchayath_id'),
					'block_panchayath_id' => request('block_panchayath_id'),
					'grama_panchayath_id' => request('grama_panchayath_id'),
					'panchayath_id' => request('panchayath_id'),


					'attended_by' => Auth::user()->id,								
				]);
			$res_log = HelpdeskLog::create(
				[
					'cmpny_id' => Auth::user()->cmpny_id,
					'customer_id' => request('customer_id'),
					'docket_number' => $docket_number,
					'req_title' => request('req_title'),
					'need_followup' => (!empty(request('need_followup'))? 1 : NULL ),
					'remainder_date' => $remainder_date,
					'question' => $question,							
					'answer' => $answer,								
					'short_message' => request('short_message'),									
					'query_type' => request('query_type'),									
					'query_category' => request('query_category'),									
					'sub_query_category' => $sub_query_category,
					'other_category' => $other_category,
					'other_subcategory' => $other_subcategory,
					'customer_nature' => request('customer_nature'),
					'action_taken'	=> $action_taken,									
					'priority' => request('priority'),
                                        'customer_response_type' => $customer_response_type,
					'customer_response' => $customer_response,	
                    'demo' => $demo,
					'type_of_call'	=> $type_of_call,
                    'source_of_call'	=> $source_of_call,
                    'institution'	=> $institution,
                    'issue'	=> $issue,
                    'nature_of_call'	=> $nature_of_call,
                    'fwc_bs'	=> $fwc_bs,
                    'pen_no'	=> $pen_no,
                    'utid'	=> $utid,
                    'complaint_resolve'	=> $complaint_resolve,
                    'measure_taken'	=> $measure_taken,
					'ard_no' => request('ard_no'),
					'supply_card' => request('supply_cards'),
					'card_no' => request('card_no'),
					'location' => request('location'),									
					'query_status' => request('query_status'),									
					'escalation_status' => $escalation_status,
					'escalate' => $escalate,
					'escalation_deadline' => $escalation_deadline,									
					'escalation_due_date' => $escalation_due_date,	
					'taluk_supply_office' => $taluk_supply_office,
					'district_supply_office' => $district_supply_office,


					'country_id' => request('country_id'),
					'other_country' => $other_country,							
					'state_id' => request('state_id'),							
					'district_id' => request('district_id'),							
					'taluk_id' => request('taluk_id'),
					'village_id' => request('village_id'),
					'local_body_type' => request('local_body_type'),
					'muncipality_id' => request('muncipality_id'),
					'corporation_id' => request('corporation_id'),
					'panchayath_type' => request('panchayath_type'),
					'district_panchayath_id' => request('district_panchayath_id'),
					'block_panchayath_id' => request('block_panchayath_id'),
					'grama_panchayath_id' => request('grama_panchayath_id'),
					'panchayath_id' => request('panchayath_id'),


					'attended_by' => Auth::user()->id,								
				]);
if(!empty($query_type)){
$query_type_name = QueryTypes::select('query_type')->where('id',$query_type)->first();
$query_type_name = $query_type_name->query_type;
$query_category_name = FaqCategories::select('category_name')->where('id',$query_category)->first();
$query_category_name = $query_category_name->category_name;
$status_name = QueryStatus::select('name')->where('id',$query_status)->first();
$status_name = $status_name->name;
$Institution = null;
if(!empty($institution)){
$Institution = Institution::select('institution_name')->where('id',$institution)->first();
$Institution= $Institution->institution_name;
}
$Helpdesk_id = Helpdesk::select('id')->where('docket_number',$docket_number)->first();
$helpdesk_dockect = $Helpdesk_id->id;

$url = url('/profile/0').'/'.$customer_id.'/0/0/0/'.$helpdesk_dockect;
}
				
			if(!empty($res->id) AND $escalate != 0){
								
							$req_title = request('req_title');
							$content = "The ticket number $docket_number has been assigned to you by ".Auth::User()->name;
							$emailcontent = "The ticket number $docket_number has been assigned to you by ".Auth::User()->name."<br> <br>".$question."<br>".$answer;
							$subject = "Ticket Escalation";
							if(Auth::User()->cmpny_id == 32)
							{
								$content = "The ticket number $docket_number has been assigned to you by ".Auth::User()->name."The details are listed call from $query_type  designation $query_category issue $issue nature of call $nature_of_call";
								$emailcontent = "The ticket number $docket_number has been assigned to you by ".Auth::User()->name."<br> <br> The details are listed: call from: ".$query_type_name."<br> designation: ".$query_category_name."<br> status: ".$status_name."<br> institution: ".$Institution."<br>remark: ".$req_title."<br> complaint description: ".$answer."<br>".$url;
							}
							$n_res = Helpers::escalate_immediate_action(Auth::user()->cmpny_id,$escalate, request('customer_id'), $res->id,$content,$subject,$emailcontent);
						}
            if(!empty($chk_email))
			{
		    	Helpers::enquiry_mail_to_customer(Auth::user()->cmpny_id,'', request('customer_id'), $docket_number,'','');
			}
           if(!empty($chk_sms))
			{
		    	Helpers::enquiry_sms_to_customer(Auth::user()->cmpny_id,'', request('customer_id'), $docket_number,'','');
			}

			// code for feedback insertion //
			$type_arr = array(config('constant.CH_EMAIL'),config('constant.CH_SMS'));
			$fb_details = Feedback::wherein('fb_type',$type_arr)->where('status',config('constant.ACTIVE'))->where('query_type',request('query_type'))->where('fb_status','like','%:"'.request('query_status').'";%')->get();
			
			if($fb_details){
			   $fo_id=$res->id;
				foreach ($fb_details as  $fb_det) {
						$action_time=$fb_det->action_time;
						$cur_date=date('Y-m-d H:i');
						$action = date('Y-m-d H:i',strtotime('+'.$action_time.' minutes ',strtotime($cur_date)));

						$type=$fb_det->fb_type;
						FeedbackRequest::Create(
						[
						'cmpny_id' => Auth::user()->cmpny_id,
						'customer_id' => request('customer_id'),
						'fb_type' => $type,
						'action_time' => $action,
						'helpdesk_id' => $fo_id,  
						'status' => config('constant.INACTIVE'),
						]); 
				}
			} 
			// code for feedback insertion //
			///////// CODE FOR AUTO PROCESS WHILE ADDING A NEW COMPLAINT STARTS /////////
								
			$auto_stage_activation = Helpers::get_company_meta('auto_stage_activation',Auth::user()->cmpny_id);
			$auto_lead_stage_arr = AutomatedProcess::select('id')->where('department',request('query_category'))->where('is_first',config('constant.ACTIVE'))->first();
			if($auto_lead_stage_arr)
			{
				$auto_lead_stage = $auto_lead_stage_arr->id;
				if($auto_stage_activation == config('constant.ACTIVE'))
				{
					if(isset($auto_lead_stage) && !empty($auto_lead_stage))
					{
						if(isset($res->id) && !empty($res->id))
						{
							Helpers::auto_process_params(Auth::user()->cmpny_id,$res->id,$auto_lead_stage);
						}
					}
				}
			}
			
			///////// CODE FOR AUTO PROCESS WHILE ADDING A NEW COMPLAINT ENDS /////////
			
			
     	}else{

     		/* Generate 8 digit number by primary key*/
			/*$num = LeadFollowup::select('id')->where('cmpny_id',Auth::user()->cmpny_id)->orderBy('id','desc')->first();
			if(!$num){	$id_num = 1; }else{	$id_num = $num->id+1; }
			$final_no = str_repeat('0',(8-(int)strlen($id_num))).$id_num;

			$short_code = $faq_cat->short_code;
			$docket_number = "GCC/".$short_code.'/'.date('dmY').'/'.$final_no;*/

	    	$docket_number = Helpers::generate_doc_no("followup",request('query_type'),request('query_category'));

     		$enquiry_query_type = 'followup';
			$res = LeadFollowup::create(
				[
					'cmpny_id' => Auth::user()->cmpny_id,
					'customer_id' => request('customer_id'),
					'docket_number' => $docket_number,
					'req_title' => request('req_title'),
					'need_followup' => (!empty(request('need_followup'))? 1 : NULL ),
					'remainder_date' => $remainder_date,
					'question' => $question,							
					'answer' => $answer,								
					'short_message' => request('short_message'),									
					'query_type' => request('query_type'),									
					'query_category' => request('query_category'),									
					'sub_query_category' => $sub_query_category,
					'other_category' => $other_category,
					'other_subcategory' => $other_subcategory,
					'customer_nature' => request('customer_nature'),
					'action_taken'	=> $action_taken,

                                        'customer_response_type'		=> $customer_response_type,
					'customer_response'				=> $customer_response,
                    'demo'				=> $demo,
					'type_of_call'	=> $type_of_call,
                    'source_of_call'	=> $source_of_call,
                    'institution'	=> $institution,
                    'issue'	=> $issue,
                    'nature_of_call'	=> $nature_of_call,
                    'fwc_bs'	=> $fwc_bs,
                    'pen_no'	=> $pen_no,
                    'utid'	=> $utid,
                    'complaint_resolve'	=> $complaint_resolve,
                    'measure_taken'	=> $measure_taken,
					'country_id' => request('country_id'),
					'other_country' => $other_country,							
					'state_id' => request('state_id'),							
					'district_id' => request('district_id'),							
					'taluk_id' => request('taluk_id'),
					'village_id' => request('village_id'),
					'local_body_type' => request('local_body_type'),
					'muncipality_id' => request('muncipality_id'),
					'corporation_id' => request('corporation_id'),
					'panchayath_type' => request('panchayath_type'),
					'district_panchayath_id' => request('district_panchayath_id'),
					'block_panchayath_id' => request('block_panchayath_id'),
					'grama_panchayath_id' => request('grama_panchayath_id'),
					'panchayath_id' => request('panchayath_id'),
					'taluk_supply_office' => $taluk_supply_office,
					'district_supply_office' => $district_supply_office,


					'priority' => request('priority'),									
					'query_status' => request('query_status'),
					'ard_no' => request('ard_no'),
					'supply_card' => request('supply_cards'),
					'card_no' => request('card_no'),
					'location' => request('location'),									
					'attended_by' => Auth::user()->id,
                                        'escalate' => $escalate,								
				]);
			$res_log = LeadFollowupLog::create(
				[
					'cmpny_id' => Auth::user()->cmpny_id,
					'customer_id' => request('customer_id'),
					'docket_number' => $docket_number,
					'req_title' => request('req_title'),
					'need_followup' => (!empty(request('need_followup'))? 1 : NULL ),
					'remainder_date' => $remainder_date,
					'question' => $question,							
					'answer' => $answer,								
					'short_message' => request('short_message'),									
					'query_type' => request('query_type'),									
					'query_category' => request('query_category'),									
					'sub_query_category' => $sub_query_category,
					'other_category' => $other_category,
					'other_subcategory' => $other_subcategory,
					'customer_nature' => request('customer_nature'),
					'action_taken'	=> $action_taken,			

					'country_id' => request('country_id'),
					'other_country' => $other_country,							
					'state_id' => request('state_id'),							
					'district_id' => request('district_id'),							
					'taluk_id' => request('taluk_id'),
					'village_id' => request('village_id'),
					'local_body_type' => request('local_body_type'),
					'muncipality_id' => request('muncipality_id'),
					'corporation_id' => request('corporation_id'),
					'panchayath_type' => request('panchayath_type'),
					'district_panchayath_id' => request('district_panchayath_id'),
					'block_panchayath_id' => request('block_panchayath_id'),
					'grama_panchayath_id' => request('grama_panchayath_id'),
					'panchayath_id' => request('panchayath_id'),
					'taluk_supply_office' => $taluk_supply_office,
					'district_supply_office' => $district_supply_office,

					'priority' => request('priority'),
                                        'customer_response_type'		=> $customer_response_type,
					'customer_response'				=> $customer_response,	
                    'demo'				=> $demo,
                    'type_of_call'	=> $type_of_call,
                    'source_of_call'	=> $source_of_call,
                    'institution'	=> $institution,
                    'issue'	=> $issue,
                    'nature_of_call'	=> $nature_of_call,
                    'fwc_bs'	=> $fwc_bs,
                    'pen_no'	=> $pen_no,
                    'utid'	=> $utid,
                    'complaint_resolve'	=> $complaint_resolve,
                    'measure_taken'	=> $measure_taken,					
					'query_status' => request('query_status'),
					'ard_no' => request('ard_no'),
					'supply_card' => request('supply_cards'),
					'card_no' => request('card_no'),
					'location' => request('location'),										
					'attended_by' => Auth::user()->id,
                                        'escalate' => $escalate,					
				]);

			 if(!empty($chk_email))
			{
		    	Helpers::enquiry_mail_to_customer(Auth::user()->cmpny_id,'', request('customer_id'), $docket_number,'','');
			}
           if(!empty($chk_sms))
			{
		    	Helpers::enquiry_sms_to_customer(Auth::user()->cmpny_id,'', request('customer_id'), $docket_number,'','');
			}
			
		}

		/* Save attachments */
			if (isset($res_log->id) && !empty($attachments) && count($attachments) > 0)
                    {
                        foreach ($attachments as $attachment)
                        {
                            $new_attachment = Attachment::create([
                                'cmpny_id'                  => Auth::user()->cmpny_id,
                                'attachable_id'             => $res_log->id,
                                'attachable_type'           => $docket_number,
                                'attachment_file_name'      => $attachment->savedName,
                                'attachment_original_name'  => $attachment->originalName,
                                'attachment_mime_type'      => $attachment->mimeType,
                                'status'                    => config('constant.ACTIVE')
                            ]);
                        }
                    }
		/* Save attachments */

		/* Communication section */
		if($check_query_type->type == 1){
			if(!empty($chk_email)){
				if($escalate == 'hello'){
			
					$user_prof      =   User::where('id',$escalate)->first();
					$esc_intimations_mail_temp_id = Helpers::get_company_meta('esc_intimations_mail');
					$cmpny_name = $user_prof->getCompany->ori_cmp_org_name;
					if(!empty($user_prof->email))
                        {
                            $email_post     =   $user_prof->email;
                        }
                    //print_r($user_prof);die;
                    if(isset($email_post) && !empty($email_post))
					{
						$to = explode(',', $email_post);
						$email=$to;
						$email_cc_post = '';
                        $subject = "Escalation Mail from CRM $cmpny_name";
						$description = $answer;
							$template_id = $esc_intimations_mail_temp_id; 
							$template_arguments = ''; 
							$description = 'This email is intended to bring to your kind attention that a Complaint/Service Request pertaining to '.$cmpny_name.' had been escalated to you. Information regarding this can be found within this.' .$description. ' .Kindly check and needful. ';
							if(!empty($description) && $description!='')
							{
								$description = str_replace('\r\n', '<br>', $description);
								$description = str_replace('\n', '<br>', $description);
								$template_arguments = array();
								$template_arguments['Mail_Content'] = $description;
								$template_arguments = json_encode($template_arguments);
							}
							if(!empty($template_id) && $template_id!='')
							{ 
								
								   $converted = communication_helpers::mail_template_convert($template_id,'','',$template_arguments);
									if($converted)
									{
										$converted_arry = json_decode($converted);
										$description = $converted_arry->content;
									}
							}
						$attachment    =   array();
						$data['category_name'] = 'Escalation Mail from CRM';
						$data['email_cc_post'] = $email_cc_post;
						$data['subject'] = $subject;
						$data['content'] = $description;
						$data['attachment'] = $attachment;
						$data['mail_ref_id'] = str_random(15);
						Mail::to($email)->send(new CommonMail($data));
						if ((count(Mail::failures())<0))
						  {
							 $buffer='not sent';
						  }
						else
						 {
							 $buffer='sent';
						 }
						 
                              cc_common_sms_email::Create(
                                    [
									    'follow_id' => $user_id,
                                        'customer_id' => $user_id,
                                        'source' => config('constant.CRM_CALLCENTER'),
                                        'email' => $email_post,
                                        'sent_type' => config('constant.email_type'),
                                        'response' => $buffer,
                                        'mail_ref_id' => $data['mail_ref_id'],
                                        'content' => $description,
                                        'subject' => $subject,
                                        'status' =>config('constant.ACTIVE'),
                                        'created_by' => $user,
                                        'updated_by' => $user,
                                        'created_at' => date('Y-m-d H:i:s'),
                                    ]);
					}


				}
			}
		}else{

		}
		$result_arr = array('reset' => true, 'success' => true,'message' => 'Successfuly updated');
		return $result_arr;
			
			
	}
	/*
    * UPDATE HELPDESK
    * @author ELAVARASI
    * @date 07/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return HELPDESK LIST */
	
    public function update_helpdesk(Request $request){
		
			$this->validate($request,[
    			'answer' => 'required',    			
    			],[
				'answer.required' => ' The Answer field is required.',
				]);

    		//$customer_id = request('priority');
    		//$priority = request('priority');
    		//echo "$priority"; exit;
    		$id = request('id');
    		$customer_id = request('customer_id');
    		$prev_folo  = Helpdesk::find($id);
    		$inc = request('inc');
			$attachments = json_decode(request("attachments$inc"));	
                $customer_response_type = $request->post('customer_response_type');
	        $customer_response = $request->post('customer_response');
                $demo = $request->post('demo');
				$type_of_call			= $request->post('type_of_call');
				$source_of_call			= $request->post('source_of_call');
				$institution	= $request->post('institution');
				$issue			= $request->post('issue');
				$nature_of_call	= $request->post('nature_of_call');
				$fwc_bs			= $request->post('fwc_bs');
				$pen_no			= $request->post('pen_no');
				$utid			= $request->post('utid');
				$complaint_resolve	= $request->post('complaint_resolve');
				$measure_taken			= $request->post('measure_taken');

    		//$remainder_date = (!empty(request('remainder_date'))? date('Y-m-d H:i', request('remainder_date')): NULL );
		//	$arr['remainder_date'] = (!empty(request('remainder_date'))? date('Y-m-d H:i', strtotime(request('remainder_date'))): $prev_folo->remainder_date);
    		$arr['remainder_date'] = (!empty(request('remainder_date'))? date('Y-m-d H:i', strtotime(request('remainder_date'))): $prev_folo->remainder_date);
                $arr['query_category'] = (!empty(request('query_category'))? request('query_category') : $prev_folo->query_category);
    		$arr['sub_query_category'] = (!empty(request('sub_query_category'))? request('sub_query_category') : $prev_folo->sub_query_category);
    		$arr['query_status'] = (!empty(request('query_status'))? request('query_status') : $prev_folo->query_status);
    		$arr['priority'] = (!empty(request('priority'))? request('priority') : $prev_folo->priority);
    		$arr['answer'] = (!empty(request('answer'))? request('answer') : $prev_folo->answer);
    		$arr['short_message'] = (!empty(request('short_message'))? request('short_message') : $prev_folo->short_message);
    		$arr['escalate'] = (!empty(request('escalate_to'))? request('escalate_to') : $prev_folo->escalate);
    		$arr['escalation_status'] = (!empty(request('escalate_to'))? 1 : $prev_folo->escalation_status);


    		$escalation_deadline = $prev_folo->escalation_deadline;
    		$escalation_due_date = $prev_folo->escalation_due_date;
    		if(!empty(request('action'))){
				if(request('action') == 1){ // If hour
					$escalation_deadline = request('est_time')*60;
				}elseif(request('action') == 3){ // If day
					$escalation_deadline = request('est_time')*24*60;
				}else{ // If minute
					$escalation_deadline = request('est_time');
				}
				$escalation_due_date = Carbon::now()->addMinutes($escalation_deadline);
			}
			$arr['escalation_deadline'] = $escalation_deadline;
			$arr['escalation_due_date'] = $escalation_due_date;
			$action_taken	= $request->post('action_taken');
			$action_taken	= (!empty($action_taken)) ? $action_taken : $prev_folo->action_taken;
			$arr['action_taken']	= $action_taken;
                        $arr['customer_response_type'] 		= request('customer_response_type');
		        $arr['customer_response'] 			= request('customer_response');
                        $arr['demo'] 			= request('demo');
						
                        $arr['type_of_call'] 			= request('type_of_call');
                        $arr['source_of_call'] 			= request('source_of_call');
                        $arr['institution'] 			= request('institution');
                        $arr['issue'] 			= request('issue');
                        $arr['nature_of_call'] 			= request('nature_of_call');
                        $arr['fwc_bs'] 			= request('fwc_bs');
                        $arr['pen_no'] 			= request('pen_no');
                        $arr['utid'] 			= request('utid');
                        $arr['complaint_resolve'] 			= request('complaint_resolve');
                        $arr['measure_taken'] 			= request('measure_taken');
			/*$arr['escalation_deadline'] = (!empty(request('action'))? ((request('action') == 1)? request('est_time')*60 : (request('action') == 3)? 24*60 : request('est_time') ) : NULL );*/
		
			//$arr['escalation_due_date'] = Carbon::now()->addMinutes($arr['escalation_deadline']);

			

					/*$arr['country_id'] = request('country_id');								
					$arr['state_id'] = request('state_id');						
					$arr['district_id'] = request('district_id');
					$arr['taluk_id'] = request('taluk_id');
					$arr['village_id'] = request('village_id');
					$arr['local_body_type'] = request('local_body_type');
					$arr['muncipality_id'] = request('muncipality_id');
					$arr['corporation_id'] = request('corporation_id');
					$arr['panchayath_type'] = request('panchayath_type');
					$arr['district_panchayath_id'] = request('district_panchayath_id');
					$arr['block_panchayath_id'] = request('block_panchayath_id');
					$arr['grama_panchayath_id'] = request('grama_panchayath_id');
					$arr['panchayath_id'] = request('panchayath_id');*/


            Helpdesk::where(['id'=>$id])->update($arr);

            $res_log = HelpdeskLog::create(
				[
					'cmpny_id' => Auth::user()->cmpny_id,
					'customer_id' => request('customer_id'),
					'docket_number' => $prev_folo->docket_number,
					'req_title' => $prev_folo->req_title,
					'need_followup' => $prev_folo->need_followup,
					'remainder_date' => $arr['remainder_date'],
					'question' => $prev_folo->question,							
					'answer' => $arr['answer'],								
					'short_message' => $arr['short_message'],									
					'query_type' => $prev_folo->query_type,									
					'query_category' => $arr['query_category'],									
					'sub_query_category' => $arr['sub_query_category'],								
					'customer_nature' => $prev_folo->customer_nature,
					'action_taken'	=> $action_taken,								
					'priority' => $arr['priority'],									
					'query_status' => $arr['query_status'],									
					'escalation_status' => $arr['escalation_status'],
					'escalate' => $arr['escalate'],
					'escalation_deadline' => $arr['escalation_deadline'],							
					'escalation_due_date' => $arr['escalation_due_date'],	
                    'customer_response_type' => !empty($customer_response_type) ? $customer_response_type : $prev_folo->customer_response_type,
					'customer_response' => !empty($customer_response) ? $customer_response : $prev_folo->customer_response,
                    'demo' => !empty($demo) ? $demo : $prev_folo->demo,
                    'type_of_call' => !empty($type_of_call) ? $type_of_call : $prev_folo->type_of_call,
                    'source_of_call' => !empty($source_of_call) ? $source_of_call : $prev_folo->source_of_call,
                    'institution' => !empty($institution) ? $institution : $prev_folo->institution,
                    'issue' => !empty($issue) ? $issue : $prev_folo->issue,
                    'nature_of_call' => !empty($nature_of_call) ? $nature_of_call : $prev_folo->nature_of_call,
                    'fwc_bs' => !empty($fwc_bs) ? $fwc_bs : $prev_folo->fwc_bs,
                    'pen_no' => !empty($pen_no) ? $pen_no : $prev_folo->pen_no,
                    'utid' => !empty($utid) ? $utid : $prev_folo->utid,
                    'complaint_resolve' => !empty($complaint_resolve) ? $complaint_resolve : $prev_folo->complaint_resolve,
                    'measure_taken' => !empty($measure_taken) ? $measure_taken : $prev_folo->measure_taken,
					
					/*'country_id' => request('country_id'),								
					'state_id' => request('state_id'),							
					'district_id' => request('district_id'),							
					'taluk_id' => request('taluk_id'),
					'village_id' => request('village_id'),
					'local_body_type' => request('local_body_type'),
					'muncipality_id' => request('muncipality_id'),
					'corporation_id' => request('corporation_id'),
					'panchayath_type' => request('panchayath_type'),
					'district_panchayath_id' => request('district_panchayath_id'),
					'block_panchayath_id' => request('block_panchayath_id'),
					'grama_panchayath_id' => request('grama_panchayath_id'),
					'panchayath_id' => request('panchayath_id'),*/


					'attended_by' => Auth::user()->id,								
				]);
				
			
			
			$closed_arr = QueryStatus::select('id')->where('cmpny_id',Auth::user()->cmpny_id)->where('is_close',config('constant.ACTIVE'))->where('status',config('constant.ACTIVE'))->get();
			if(!empty($closed_arr))
			{
				foreach($closed_arr as $c_arr)
				{
					if($arr['query_status'] == $c_arr->id)
					{
						Helpers::close_escalation_by_docket(Auth::user()->cmpny_id,$prev_folo->docket_number);
					if(Auth::User()->cmpny_id == 32){
								$title = 'Escalation closed';
		$comment = 'View';	
		$docket_no = $prev_folo->docket_number;
		$user_id1 = $prev_folo->created_by;
		$fpath = url('/profile/0').'/'.$customer_id.'/0/0/0/'.$docket_no;
		$link = $fpath;
		$cmpny_id = Auth::User()->cmpny_id;
		$created_by = 0;
		$flag = config('constant.INACTIVE');
		Helpers::add_notifications($user_id1,$title,$comment,$link,$created_by,$flag,$cmpny_id);
							}
					}
					else
					{
						if(!empty($res_log->id) AND $arr['escalate'] != 0){
							
							$req_title2 = $prev_folo->req_title;
							$question2 = $prev_folo->question;
							$content = "The ticket number ".$prev_folo->docket_number." has been assigned to you by ".Auth::User()->name;
							$emailcontent = "The ticket number ".$prev_folo->docket_number." has been assigned to you by ".Auth::User()->name."<br> <br>".$req_title2."<br>".$question2;
							$subject = "Ticket Escalation";
							$n_res = Helpers::escalate_immediate_action(Auth::user()->cmpny_id,$arr['escalate'],request('customer_id'), $id,$content,$subject,$emailcontent);
						}
					}
				}
			}

            /* Save attachments */
			if (isset($res_log->id) && !empty($attachments) && count($attachments) > 0)
                    {
                        foreach ($attachments as $attachment)
                        {
                            $new_attachment = Attachment::create([
                                'cmpny_id'                  => Auth::user()->cmpny_id,
                                'attachable_id'             => $res_log->id,
                                'attachable_type'           => $res_log->docket_number,
                                'attachment_file_name'      => $attachment->savedName,
                                'attachment_original_name'  => $attachment->originalName,
                                'attachment_mime_type'      => $attachment->mimeType,
                                'status'                    => config('constant.ACTIVE')
                            ]);
                        }
                    }
			/* Save attachments */
            $result_arr = array('success' => true,'message' => 'Successfuly updated');
			return $result_arr;

    }/*
    * UPDATE FOLLOWUP
    * @author ELAVARASI
    * @date 10/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return FOLLOWUP LIST */
	
    public function update_followup(Request $request){
		
    		//$customer_id = request('priority');
    		//$priority = request('priority');
    		//echo "$priority"; exit;
    		$this->validate($request,[
    			'answer' => 'required',    			
    			],[
				'answer.required' => ' The Answer field is required.',
			]);
			
    		$id = request('id');
    		$customer_id = request('customer_id');
    		$prev_folo  = LeadFollowup::find($id);
    		//$remainder_date = (!empty(request('remainder_date'))? date('Y-m-d H:i', request('remainder_date')): NULL );
			$arr['remainder_date'] = (!empty(request('remainder_date'))? NULL : NULL );
    		$arr['query_category'] = (!empty(request('query_category'))? request('query_category') : $prev_folo->query_category);
    		$arr['sub_query_category'] = (!empty(request('sub_query_category'))? request('sub_query_category') : $prev_folo->sub_query_category);
    		$arr['query_status'] = (!empty(request('query_status'))? request('query_status') : $prev_folo->query_status);
    		$arr['priority'] = (!empty(request('priority'))? request('priority') : $prev_folo->priority);
    		$arr['answer'] = (!empty(request('answer'))? request('answer') : $prev_folo->answer);
    		$arr['short_message'] = (!empty(request('short_message'))? request('short_message') : $prev_folo->short_message);    		


            LeadFollowup::where(['id'=>$id])->update($arr);

            LeadFollowupLog::create(
				[
					'cmpny_id' => Auth::user()->cmpny_id,
					'customer_id' => request('customer_id'),
					'docket_number' => $prev_folo->docket_number,
					'req_title' => $prev_folo->req_title,
					'need_followup' => $prev_folo->need_followup,
					'remainder_date' => $arr['remainder_date'],
					'question' => $prev_folo->question,							
					'answer' => $arr['answer'],								
					'short_message' => $arr['short_message'],									
					'query_type' => $prev_folo->query_type,									
					'query_category' => $arr['query_category'],									
					'sub_query_category' => $arr['sub_query_category'],								
					'customer_nature' => $prev_folo->customer_nature,								
					'priority' => $arr['priority'],									
					'query_status' => $arr['query_status'],						
													
				]);

            $result_arr = array('success' => true,'message' => 'Successfuly updated');
			return $result_arr;

    }
	/*	  
		* get HELPDESK POPUP
		* @author PRANEESHA KP
		* @date 31/10/2018
		* @since version 1.0.0
		* @param NULL
	*/
	public function get_helpdesk_history(Request $request)
    {
		$response 		=	$request->all();
		$docket_number	=	$response['docket_number'];
		if(isset($docket_number) && !empty($docket_number)){
			$followup_log_det = HelpdeskLog::select('*')
								->where('docket_number',$docket_number)
								->orderBy('remainder_date', 'desc');
		}
		$followup_log_det     = $followup_log_det->get();
		$details    		  = $followup_log_det->first(); 		
		return view('profile.enquiry.helpdesk_history_popup',compact('followup_log_det','docket_number','details'));
	}
	/*	  
		* get FOLLOWUP POPUP
		* @author ELAVARASI
		* @date 10/11/2018
		* @since version 1.0.0
		* @param NULL
	*/
	public function get_followup_history(Request $request)
    {
		$response 		=	$request->all();
		$docket_number	=	$response['id'];
		if(isset($docket_number) && !empty($docket_number)){
			$followup_log_det = LeadFollowupLog::select('*')
								->where('docket_number',$docket_number)
								->orderBy('remainder_date', 'desc');
		}
		$followup_log_det     = $followup_log_det->get();
		$details    		  = $followup_log_det->first(); 		
		return view('profile.enquiry.followup_history_popup',compact('followup_log_det','docket_number','details'));
	}
	/*	  
		* HELPDESK REOPEN
		* @author ELAVARASI
		* @date 12/11/2018
		* @since version 1.0.0
		* @param NULL
	*/
    public function helpdesk_reopen(Request $request)
        {
        	$this->validate($request,[
    			'reason_reopen' => 'required',    			
    			],[
				'reason_reopen.required' => ' Reason for Re-oprn is required.',
				]);

            $response           =   $request->all();
    		$prev = Helpdesk::select('*')->where('docket_number',$response['docket_number'])->first();

            $follow_id          =   $prev->id;
            $query_type         =   $prev->query_type;
            $query_status       =   $prev->query_status;
            $reason_reopen      =   $response['reason_reopen'];

            $old_status = QueryStatus::select('is_close')->where('id',$prev->query_status)->first();


            $new_status = Helpers::get_company_meta('after_re_open');
            $re_open_status = Helpers::get_company_meta('re_open_status');
               
            if(!empty($new_status))
                {
                    $lead_followup  = Helpdesk::updateOrCreate(
                                        [                                   
                                            'id' => $follow_id
                                        ],
                                        [
                                        'query_status'=> $new_status,
                                        ]);
                    
                    $flight_log = HelpdeskLog::create(
                        [
                         'docket_number' => $prev->docket_number,
                         'cmpny_id' => $prev->cmpny_id,
                         'query_type' => $prev->query_type,
                         'req_title' => $prev->req_title,
                         'query_status' => $re_open_status,
                         'lead_source_id' => $prev->lead_source_id,
                         //'escalation_status' => $prev->escalation_status,
                         //'escalate' => $prev->escalate,
                         'query_category' => $prev->query_category,
                         'answer' => $reason_reopen,
                         'short_message' => $prev->short_message,
                         'customer_id' => $prev->customer_id,
                         'need_followup' => $prev->need_followup,
                         'remainder_date' => $prev->remainder_date,
                         'call_id' => $prev->call_id,                        
                        ]);
						
						$flight_log = HelpdeskLog::create(
                        [
                        'docket_number' => $prev->docket_number,
                        'cmpny_id' => $prev->cmpny_id,
                         'query_type' => $prev->query_type,
                         'req_title' => $prev->req_title,
                         'query_status' => $new_status,
                         'lead_source_id' => $prev->lead_source_id,
                         //'escalation_status' => $prev->escalation_status,
                         //'escalate' => $prev->escalate,
                         'query_category' => $prev->query_category,
                         'answer' => $reason_reopen,
                         'short_message' => $prev->short_message,
                         'customer_id' => $prev->customer_id,
                         'need_followup' => $prev->need_followup,
                         'remainder_date' => $prev->remainder_date,
                         'call_id' => $prev->call_id,
                         'status' => config('constant.ACTIVE'),
                        ]);
                    $return_data  = array('refresh' =>true,'success' => true, 'message'=>$old_status );
                }
            else
                {
                    $return_data  = array('success' => false, 'message'=>'failed' );
                }            
            echo json_encode($return_data); die;                            
        }
		
		
		/*
    * FOR EMAIL SMS LISTING SECTION
    * @author AKHIL MURUKAN
    * @date 15/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return EMAIL SMS LISTING VIEW BLADE
    */
	public function email_sms_listing(Request $request)
    {   
		$customer_id 		= request('customer_id');
		
		$user_details=CustomerProfile::with('profile_details')->where('id',$customer_id)->first();
	
		$email_array =array();
		$email_fr_lead =array();
		$mobile_array =array();
		$mobile_fr_lead =array();
		if($user_details)
		{
			if(!empty($user_details->email) &&  isset($user_details->email))
				{
				$email = $user_details->email;
                $email_fr_lead   = CommonSmsEmail::with('sendgrid_open_response')
                					->select('ori_common_sms_email.*')->where('sent_type',2)
									->orderBy('ori_common_sms_email.created_at','desc');

										 $email_fr_lead->where(function($email_fr_lead) use ($email)
										 {
												$email_fr_lead->orWhere('ori_common_sms_email.email','=',$email);
												$email_fr_lead->orWhere('ori_common_sms_email.email_cc','=',$email);
										 });
				$email_array = $email_fr_lead->limit('5')->get();
				}
            }
			if(!empty($user_details->mobile) &&  isset($user_details->mobile))
				{
				$mobile = $user_details->mobile;
                $mobile_fr_lead   = CommonSmsEmail::select('ori_common_sms_email.*')->where('sent_type',1)
									->orderBy('ori_common_sms_email.created_at','desc');

										 $mobile_fr_lead->where(function($mobile_fr_lead) use ($mobile)
										 {
												$mobile_fr_lead->orWhere('ori_common_sms_email.mobile','=',$mobile);
										 });
				$mobile_array = $mobile_fr_lead->limit('5')->get();
				}
		return view('profile.enquiry.email_sms_listing')->with(compact('email_array','mobile_array'));
		
    }
  /*
    * FOR EMAIL SMS LISTING SECTION
    * @author AKHIL MURUKAN
    * @date 15/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Escalation EMAIL SMS LISTING VIEW BLADE
    */
	public function officer_email_sms_listing(Request $request)
    {   
		$customer_id 		= request('customer_id');
		$escalation_email_array =array();
		$escalation_sms_array =array();
		$escalation_email_fr_lead =array();
		$escalation_sms_fr_lead =array();
		
		$follow_id = HelpdeskLog::where('ori_helpdesk_log.customer_id',$customer_id)
		                        ->leftjoin('ori_helpdesk', 'ori_helpdesk.docket_number', '=', 'ori_helpdesk_log.docket_number')
		                        ->where('ori_helpdesk_log.escalation_status',1)
								->orderBy('ori_helpdesk_log.id', 'desc')->pluck('ori_helpdesk.id');
		if(isset($follow_id) && !empty($follow_id))
		{			
		$escalation_email_fr_lead   = CommonSmsEmail::select('ori_common_sms_email.*')
									->with('docket_number_det')
									->where('sent_type',2)
				                    ->where('ori_common_sms_email.subject' , 'Escalation Intimation Mail')
				                    ->WhereIn('ori_common_sms_email.follow_id' ,$follow_id)
									->orderBy('ori_common_sms_email.created_at','desc');
		$escalation_sms_fr_lead   = CommonSmsEmail::select('ori_common_sms_email.*')
									->with('docket_number_det')
									->where('sent_type',1)
				                    ->where('ori_common_sms_email.subject' , 'Escalation Intimation SMS')
				                    ->WhereIn('ori_common_sms_email.follow_id' ,$follow_id)
									->orderBy('ori_common_sms_email.created_at','desc');

		}							
		$escalation_sms_array = $escalation_sms_fr_lead->limit('5')->get();
		$escalation_email_array = $escalation_email_fr_lead->limit('5')->get();
								
		return view('profile.enquiry.officer_email_sms_listing')->with(compact('escalation_email_array','escalation_sms_array'));
		
    }
	public function get_institution(Request $request){
		$dist_id = request('dist_id');

		if (empty($dist_id))
		{
			return collect();
		}		
		
		$results =  Institution::select('ori_mast_institution.institution_name', 'ori_mast_institution.id')
		->join('ori_dist_institution_relation', 'ori_dist_institution_relation.institution_id', '=', 'ori_mast_institution.id')
		->where('ori_dist_institution_relation.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_dist_institution_relation.dist_id',$dist_id)
		->where('ori_mast_institution.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_institution.status',config('constant.ACTIVE'))
		->whereNull('ori_mast_institution.parent_institution_id')
		->orderBy('ori_mast_institution.sort_order')
		->orderBy('ori_mast_institution.institution_name')
		->get();
		
		echo $results;
	}
	public function get_nature_of_call(Request $request){
		$issue = request('issue');

		if (empty($issue))
		{
			return collect();
		}		
		
		$results =  FaqCategories::select('ori_mast_faq_categories.category_name', 'ori_mast_faq_categories.id','ori_mast_faq_categories.short_code','ori_mast_faq_categories.is_other')
		->join('ori_mast_query_category_relation', 'ori_mast_query_category_relation.category_id', '=', 'ori_mast_faq_categories.id')
		->where('ori_mast_query_category_relation.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_query_category_relation.query_type_id',$issue)
		->where('ori_mast_faq_categories.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_faq_categories.status',config('constant.ACTIVE'))
		->whereNull('ori_mast_faq_categories.parent_category_id')
		->orderBy('ori_mast_faq_categories.sort_order')
		->orderBy('ori_mast_faq_categories.category_name')
		->get();
		
		echo $results;
	}
	public function get_measure_taken(Request $request){
		
		$results =  FaqCategories::select('ori_mast_faq_categories.category_name', 'ori_mast_faq_categories.id','ori_mast_faq_categories.short_code','ori_mast_faq_categories.is_other')
		->join('ori_mast_query_category_relation', 'ori_mast_query_category_relation.category_id', '=', 'ori_mast_faq_categories.id')
		->where('ori_mast_query_category_relation.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_query_category_relation.query_type_id',$issue)
		->where('ori_mast_faq_categories.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_faq_categories.status',config('constant.ACTIVE'))
		->whereNull('ori_mast_faq_categories.parent_category_id')
		->orderBy('ori_mast_faq_categories.sort_order')
		->orderBy('ori_mast_faq_categories.category_name')
		->get();
		
		echo $results;
	}
	public function get_call_from(Request $request){
		$issue = request('issue');
		
		if (empty($issue))
		{
			return collect();
		}		
		
		$results =  QueryTypes::select('query_type','id')->where('id',$issue)->get();
		
		echo $results;
	}
	public function get_agent_list(Request $request)
	{
		$agents = User::where('cmpny_id', Auth::user()->cmpny_id)
    				->where('status', config('constant.ACTIVE'))
    				->where('id', '!=',298)
    				->pluck('name', 'id')
    				->all();
		return json_encode($agents);
	}
	public function assign_agents(Request $request)
	{
		$this->validate($request, [
            'agents' => 'required'
        ]);

        $success = FALSE;
	$user_id = Auth::User()->id;
        $agents  = $request->post('agents');
	$selected_contacts  = $request->post('selected_contacts');
	 if (empty($selected_contacts))
            {
                $message = 'Please select atleast one enquiry';
                
            }
        if (!empty($selected_contacts))
        {
            $selected_contacts  = explode(',', $selected_contacts);
		foreach($selected_contacts as $id)
				{ 
		$arr['escalate'] = $agents;
		$arr['updated_by'] = $user_id;
		Helpdesk::where(['id'=>$id])->update($arr);
		}
	$success = TRUE;
        $message = 'Agents assigned successfully';	
        }
	            $result_arr=array('reset'=>false,'success' => $success,'message' => $message);
		    return json_encode($result_arr);
	}
	public function curl_test(Request $request)
	{
	$pen_number  = request('pen_number');
		$response = array();
	$c_url="http://ehealth:ehealth012@117.247.184.162:8080/callCentre-api/callCentre/getDetails/$pen_number";
	$ch = curl_init(); 
                    curl_setopt($ch,CURLOPT_URL,$c_url);
                    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($ch,CURLOPT_HEADER,false);
                    curl_setopt($ch,CURLOPT_HTTPGET, 1);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response=curl_exec($ch); 
                    curl_close($ch);
	
			
			$responseData = json_decode($response, TRUE);
		//dd($responseData);
			$a = explode(',',$response); $b = $a[7];
		if(!empty($b)){
		 $c =explode(':',$b);
		$d =$c[1]; $d = ucfirst($d); $d=trim($d, '"'); $d = ucfirst(strtolower($d));
     $district_db = LocationSettings::select('name','id')->where('name',$d)->first();
	$dist_id = $district_db->id; $dist_name = $district_db->name; 
	$newa = array("did"=>$dist_id,"dname"=>$dist_name,"test_id"=>27,'pen_number'=>$pen_number); $response = array_merge($responseData,$newa); 
	//array_push($response,$district_db);
	//$district_db = array("id"=>$dist_id, "district_name"=>$dist_name); 
	} 
	
			//$district_db = implode($district_db); 		
		//$response = $response.$district_db;dd($response);
            //$responseData = json_decode($response, TRUE);
		//echo $district_db;
      //$response = $response[1].$dist_id; $response = $response[1].$dist_name;
		return $response;
	if(!empty($b)){
		//return $district_db;
			}
		
	}
public function get_status_measure(Request $request){
		$query_type = 87;			
		$complaint_resolve = request('complaint_resolve');
		$not_closed = array("95","97");
		if($complaint_resolve == 0)
		{
		$results =  QueryStatus::select('ori_mast_query_status.name', 'ori_mast_query_status.id')
		->join('ori_mast_query_status_relation', 'ori_mast_query_status_relation.query_status_id', '=', 'ori_mast_query_status.id')
		->where('ori_mast_query_status_relation.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_query_status_relation.query_type_id',$query_type)
		->where('ori_mast_query_status.id','!=',96)
		//->where('ori_mast_query_status.cmpny_id',Auth::user()->cmpny_id)
		//->orderBy('ori_mast_query_status.name')
		->where('ori_mast_query_status.status',config('constant.ACTIVE'))
		->orderBy('ori_mast_query_status.sort_order')
		->get();
		}
		else
		{
			$results =  QueryStatus::select('ori_mast_query_status.name', 'ori_mast_query_status.id')
		->join('ori_mast_query_status_relation', 'ori_mast_query_status_relation.query_status_id', '=', 'ori_mast_query_status.id')
		->where('ori_mast_query_status_relation.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_query_status_relation.query_type_id',$query_type)
		->where('ori_mast_query_status.id',96)
		//->where('ori_mast_query_status.cmpny_id',Auth::user()->cmpny_id)
		//->orderBy('ori_mast_query_status.name')
		->where('ori_mast_query_status.status',config('constant.ACTIVE'))
		->orderBy('ori_mast_query_status.sort_order')
		->get();

		}
		
		echo $results;
	}


}
