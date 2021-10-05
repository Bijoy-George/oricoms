<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\AutomatedProcessRelationsCustomer;
use App\ChatThread;
use App\CommonSmsEmail;
use App\CustomerNature;
use App\CustomerProfile;
use App\CustomerProfileField;
use App\CustomerProfileLog;
use App\CustomerProfileMeta;
use App\Exports\DishaLeadlistReport;
use App\Exports\LeadlistReport;
use App\Helpdesk;
use App\Helpers;
use App\Http\Controllers\Controller;
use App\Imports\CustomerImport;
use App\Jobs\DishaLeadExport;
use App\Jobs\LeadWithHelpdeskExport;
use App\Jobs\NotifyLeadlsistReportCompletion;
use App\LeadSources;
use App\LocalBody;
use App\LocalBodyType;
use App\LocationSettings;
use App\SurveyDetail;
use App\SurveyQuestion;
use App\QueryTypes;
use App\Tab;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\HeadingRowImport;
use Validator;
   /*
    * Profile Controller
    * @author Reshma Rajan
    * @date 1/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return
    */
class CustomerProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('check-permission:lead list',   ['only' => ['listing','search_leadlist']]);
		$this->middleware('check-permission:lead list',   ['only' => ['pipeline','search_pipelinelist']]);
        $this->middleware('check-permission:profile view',   ['only' => ['index','view_profile','search_profile']]);
        $this->middleware('check-permission:profile create',   ['only' => ['save_profile','more_profile_fields']]);
    }
   /*
    * Getting Profile Details
    * @author Reshma Rajan
    * @date 1/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return profile page
    */
    public function index($request_mob=null,$profile_id=null,$p_survey_id=null,$query_type_id=null,$caller_id=null,$doc_no=null,$emailid=null,$profile_status=null)
    {
         
        if($request_mob !=0)
        {
            $request_mob = $request_mob;
            $request_mob = str_replace(" ", "", $request_mob);
            $request_mob = str_replace("+", "", $request_mob);
           
            if(strlen($request_mob) == 10)
            {
                $request_mob =$request_mob;
            }
            else{
                $ptn = "/^0/";  // Regex
                $str = $request_mob;
                $rpltxt = "91";  // Replacement string
                $request_mob = preg_replace($ptn, $rpltxt, $str);
                $request_mob = '+'.$request_mob;
            }
        }
        $deflt_fields = CustomerProfileField::select('id','label','field_name')
                     ->where('type',config('constant.DEFAULT_FEILD'))
                     ->where('status',config('constant.ACTIVE'))
                     ->wherein('field_name',config('constant.PROFILE_SEARCH'))
                     ->get();
                     //print_r($deflt_fields);die;

        return view('profile.index',compact('profile_id','request_mob','deflt_fields','p_survey_id','query_type_id','caller_id','doc_no','emailid','profile_status'));
    }
	/*
    * Getting Profile Details
    * @author Reshma Rajan
    * @date 3/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return profile page
    */
	public function view_profile(Request $request)
    {
        $cus_nature          =CustomerNature::all();
        $sources_arr         =LeadSources::where('status',config('constant.ACTIVE'))->get();
        $country_arr         =LocationSettings::select('id','name','is_other')->where('parent',0)->where('type','country')->get();
        $localbodytype_arr   =LocalBodyType::where('parent_id',0)->where('status',config('constant.ACTIVE'))->get();
        $user_details        =array();
        $search_val          =request('search_val');
        $pro_status     	 =request('profile_status');
        if(request('profile_id')){
                $user_details=CustomerProfile::with('profile_details','GetProfileAttachment')->where('id',request('profile_id'))->first();
        }else{
            if(request('request_mob')){
            $user_details=CustomerProfile::with('profile_details')->where('mobile',request('request_mob'))->first();
            }
        }
		
            
        $default_field = CustomerProfileField::CurrentFields(config('constant.DEFAULT_FEILD'));
        $custom_field = CustomerProfileField::CurrentFields(config('constant.CUSTOM_FIELD'));
        
        $tab_arr=array();
        if($user_details){
            $customer_id = $user_details->id;
            $tab_values=CustomerProfileMeta::select('tab_id',DB::raw('count(tab_id) as tab_count'))->whereNotNull('relation_id')->where('status',config('constant.ACTIVE'))->where('user_id',$customer_id)->groupBy('tab_id')->groupBy('field_id')->get();
        
            foreach ($tab_values as $key => $value) {
                $tab_arr[$value->tab_id]=$value->tab_count;
            }
        }else{
            $customer_id = "";
        }

        /*$tab_det=Tab::with(['profile_fields'=> function ($q){ 
            $q->where('status',config('constant.ACTIVE'))->orderBy('sort_order'); 
            }])->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->get();*/
        $tab_det=Tab::with('profile_fields.GetFieldType','profile_fields.GetOptions')->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->get();
        // dd($tab_det);
        // dd($user_details->country_code);
        $location_fields=CustomerProfileField::wherein('field_name',['country_id','state_id','district_id','local_body_type'])->where('status',config('constant.ACTIVE'))->get();
        $attchment_fields=CustomerProfileField::where('field_name','attachments')->where('status',config('constant.ACTIVE'))->first();

        
        $show_cus_details = true;
        if(!Helpers::checkPermission('show hidden details') AND isset($user_details->hide_details)){
            if($user_details->hide_details == 1){
                $show_cus_details = false;
            }
        }
        $query_types = QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->select('query_type', 'id','type','short_code')->get();
if(Auth::user()->cmpny_id == 32)
        {
            $query_types = QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->where('short_code','!=',"issue")->where('short_code','!=',"measure_taken")->orderBy('sort_order')->select('query_type', 'id','type','short_code')->get();
        }
        $html = view('profile.user_profile')->with(compact('default_field','query_types','user_details','custom_field','search_val','cus_nature','tab_det','tab_arr','country_arr','localbodytype_arr','location_fields','sources_arr','attchment_fields','show_cus_details','pro_status'))->render();
        $result_arr = array('success' => true,'html' => $html, 'customer_id' => $customer_id);
        return json_encode($result_arr);
        
    }
	/*
    * PROFILE LISTING VIEW
    * @author RINKU.E.B.
    * @date 01/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return profile list
    */
	
	public function listing($company_id=null)
	{ 
        $countries         = ['' => 'Select Country'] + LocationSettings::where('parent',0)->pluck('name', 'id')->all();
        return view('leadlist.index', compact('countries'));
	}
	/*
    * PROFILE LISTING VIEW WITH FILTERS
    * @author RINKU.E.B.
    * @date 01/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return profile list
    */
	public function search_leadlist(Request $request)
	{
		$response           =   $request->all();
        $search_keywords    =   $response['search_keywords'];
        $country            = $request->post('country');
        $from_date          = $request->post('startdate') ?? '';
        $from_date          = str_replace('/', '-', $from_date);
        $to_date            = $request->post('enddate') ?? '';
        $to_date            = str_replace('/', '-', $to_date);
		if (!empty($from_date))
        {
            $from_date          =   date('Y-m-d', strtotime($from_date)).' 00:00:01';
        }
        if (!empty($to_date))
        {
            $to_date            =   date('Y-m-d', strtotime($to_date));
        }
		if($to_date <= '2000-01-01')
		{
			$to_date = '';
		}
		else
		{
			$to_date = $to_date.' 23:59:59';
		}
		
        $results = array();
		$fields = array();
		$fields_str = '';
		
		$fields = CustomerProfileField::select('field_name')->where('cmpny_id',Auth::User()->cmpny_id)
					 ->where('type',config('constant.DEFAULT_FEILD'))->where('report_field',1)->where('status',config('constant.ACTIVE'))->get();
		$cust_fields = CustomerProfileField::select('id','label')
					 ->where('cmpny_id',Auth::User()->cmpny_id)
					 ->where('type',config('constant.CUSTOM_FIELD'))
                     ->where('status',config('constant.ACTIVE'))
					 ->where('report_field',1)
                     ->orderBy(DB::raw('sort_order IS NULL'))
                     ->orderBy('sort_order')
					 ->get();
		$deflt_fields = CustomerProfileField::select('id','label','field_name')
					 ->where('cmpny_id',Auth::User()->cmpny_id)
					 ->where('type',config('constant.DEFAULT_FEILD'))
                     ->where('field_name', '!=', 'profile_photo')
                     ->where('status',config('constant.ACTIVE'))
					 ->where('report_field',1)
                     ->orderBy(DB::raw('sort_order IS NULL'))
                     ->orderBy('sort_order')
					 ->get();
        $profile_has_photo  = CustomerProfileField::select('id','label','field_name')
                     ->where('cmpny_id',Auth::User()->cmpny_id)
                     ->where('type',config('constant.DEFAULT_FEILD'))
                     ->where('field_name', 'profile_photo')
                     ->where('status',config('constant.ACTIVE'))
                     ->where('report_field',1)
                     ->first();

		foreach($fields as $field)
		{
			$fields_str .= "'".$field->field_name."',";
		}

		$results = CustomerProfile::where('cmpny_id',Auth::User()->cmpny_id)->orderBy('id', 'desc')->with('profile_details');
			if(isset($search_keywords) && !empty($search_keywords))
			{
				$results->where(function ($q2) use ($search_keywords,$deflt_fields) {

		    
					$q2->where(function ($q3) use ($search_keywords,$deflt_fields) {
						foreach($deflt_fields as $fields)
						{
							$fname = $fields->field_name;
							$q3->orWhere($fname, 'like', '%' . $search_keywords . '%');
						}
					}); 
					$q2->orWhereHas('profile_details', function($q4) use($search_keywords) 
					{
						$q4->where('value', 'like', '%' . $search_keywords . '%');
					});
				}); 
							
			}
            if(isset($country) && !empty($country))
            {
                $results->where('country_id', $country);
            }
			if(isset($from_date) && !empty($from_date))
			{
				$results->where('created_at','>=',$from_date);
			}
			if(isset($to_date) && !empty($to_date))
			{
				$results->where('created_at','<=',$to_date);
			}
		$row_count = count($cust_fields)+count($deflt_fields)+1;
		$list_count = $results->count();
		$results   =   $results->paginate(config('constant.pagination_constant'));

        //Customer Profile Status Counts

        $total_customer_count = CustomerProfile::where('cmpny_id',Auth::User()->cmpny_id)
                                        ->orderBy('id', 'desc')
                                        ->count();

        $customer_status_stats  = CustomerProfile::select('profile_status', DB::raw('COUNT(*) AS status_customer_count'))
                                        ->where('cmpny_id',Auth::User()->cmpny_id)
                                        ->orderBy('id', 'desc')->with('profile_details')
                                        ->groupBy('profile_status')
                                        ->get();

        $profile_status = config('constant.profile_status');

        $status_customer_counts = array();
        $status_icons   = ['fa-user-tie', 'fa-user-check', 'fa-user-tag', 'fa-user-times', 'fa-star'];
        $status_colors  = ['#7f7f7f', '#f2c572', '#81a489', '#c04c31', '#3597dc'];
        $i = 0;
        foreach ($profile_status as $status_value => $status_name)
        {
            $status_count = $customer_status_stats->where('profile_status', $status_value)->first();
            $status_customer_counts[$status_value]   = [
                'status_name'       => $status_name,
                'customer_count'    => $status_count->status_customer_count ?? 0,
                'status_icon'       => $status_icons[$i] ?? 'fa-users',
                'status_color'      => $status_colors[$i] ?? '#7f7f7f'
            ];

            $i++;
        }

        $view = 'leadlist.listview';
        if ($request->path() == 'group_lead_search')
        {
            $view   = 'group_contacts.lead_listview';
        }

		$html =	view($view)->with(compact('results','fields','cust_fields','deflt_fields','list_count','row_count','profile_has_photo', 'total_customer_count', 'status_customer_counts'))->render();

		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;
	}

    /*
    * Saving Profile Details
    * @author Reshma Rajan
    * @date 3/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return profile page
    */
    public function save_profile(Request $request)
    {
       DB::beginTransaction();
      // try { 
        // validation//

        $single_tab=Tab::wherein('type',[1,3])->pluck('id');
        $field_det = CustomerProfileField::CurrentFields()->wherein('tab_id',$single_tab);
        // dd($field_det);
        $validation_arr=array();
         $company_id = auth()->user()->cmpny_id;
        if($field_det){
            foreach ($field_det as  $field) {
                $validation_str=''; 
                /*if($field->field_name == 'mobile'){
                    $validation_str.='numeric|';
                }*/
                if($field->field_type ==4){
                    if(request('email') !=''){
                    $validation_str.='email|';
                    }
                // if($field->type == 'email'){
                //     if(request('email') !=''){
                //     $validation_str.='email|';
                //     }
                }
                if($field->required == 1){
                    $validation_str.='required|';
                }

                if($field->type == config('constant.DEFAULT_FEILD'))
                {
                    $table_name='ori_customer_profiles';
                    $table_field=$field->field_name;
                    if($field->is_unique == 1 && request($field->field_name)){
                    $validation_str.='unique:'.$table_name.','.$table_field.','.request('pid').',id,cmpny_id,'.$company_id;
                    
                    }
                }else{
                    $table_name='ori_customer_profile_meta';
                    $table_field='value';
                    if($field->is_unique == 1 && request($field->field_name)){
                    $validation_str.='unique:'.$table_name.','.$table_field.','.request('pid').',user_id,cmpny_id,'.$company_id;
                    
                    }
                }
                

                $validation_arr[$field->field_name] =$validation_str;
            }
        }
        $this->validate($request, $validation_arr);
        

        // validation//

        $default_arr=array('cmpny_id'=>Auth::User()->cmpny_id,'status'=>config('constant.ACTIVE'));
        $default_field_det = CustomerProfileField::where('status',config('constant.ACTIVE'))->wherein('type',[1,3])->get();
       
        foreach ($default_field_det as  $value1) {
            
            
            if($value1->field_type == 5) // datepicker
            {
                
                $default_arr[$value1->field_name]=NULL;
                $fname=request($value1->field_name);
                if(!empty($fname)){
                    $date_format       =   explode('/', $fname);
                     if(isset($date_format[2]) && !empty($date_format[2]) && isset($date_format[1]) && !empty($date_format[1]) && isset($date_format[0]) && !empty($date_format[0]))
                     {
                        $datevalue    =   $date_format[2].'-'.$date_format[1].'-'.$date_format[0];
                        $date_picker     =   date('Y-m-d', strtotime($datevalue));
                        $default_arr[$value1->field_name]=$date_picker;
                    }
                }
                //print_r($default_arr);die;
                  
            }else{
                $default_arr[$value1->field_name]=request($value1->field_name);
            }

        }
        
        if(request('country_code')){
             $default_arr['country_code']=request('country_code');
        }
        if(request('query_type_f')){
             $default_arr['dnd']=request('query_type_f');
             // dd($default_arr);
        }
    if(Auth::User()->cmpny_id == 32){
             $default_arr['country_id']=1;
             // dd($default_arr);
        }

    if(request('first_name')){
             $default_arr['first_name']=request('first_name');
             // dd($default_arr);
        }
        $other_country  = $request->post('other_country');
        if (isset($other_country) && !empty($other_country))
        {
            $default_arr['other_country']   = $other_country;
        }

        $other_state  = $request->post('other_state');
        if (isset($other_state) && !empty($other_state))
        {
            $default_arr['other_state']   = $other_state;
        }

        
         $results=CustomerProfile::updateOrCreate(['id' => request('pid')],$default_arr);
		 
	///////// CODE FOR AUTO PROCESS WHILE ADDING A NEW LEAD STARTS 
	if($results->wasRecentlyCreated) 
	{
		$cmpny_id = Auth::User()->cmpny_id;
		$auto_stage_activation = Helpers::get_company_meta('auto_stage_activation_customer',$cmpny_id);
		$auto_lead_stage = Helpers::get_company_meta('sales_automation_lead_stage',$cmpny_id);
		if($auto_stage_activation == config('constant.ACTIVE'))
		{
			if(isset($auto_lead_stage) && !empty($auto_lead_stage))
			{
			Helpers::auto_process_params_customer($cmpny_id,$results->id,$auto_lead_stage);
			//$fresults = CustomerProfile::where('id',$customer_id)->where('cmpny_id',$cmpny_id)->first();
				if($results)
				{
				$upd = array(
				'[[ First Name ]]' => $results->first_name
				);
				$updarr = array('mail_field' => json_encode($upd));
				AutomatedProcessRelationsCustomer::where('customer_id',$results->id)->where('cmpny_id',$cmpny_id)->update($updarr);
				}
			}
		}
	}
	///////// CODE FOR AUTO PROCESS WHILE ADDING A NEW LEAD ENDS /////////
	
         $default_arr['user_id']=$results->id;
         $attach = request('attachments');    
         $attachments=json_decode($attach);
         //print_r($attachments);die;
         /* Save attachments */
            if (isset($results->id) && !empty($attachments))
                    {
                        foreach ($attachments as $attachment)
                        {
                            $new_attachment = Attachment::create([
                                'cmpny_id'                  => Auth::user()->cmpny_id,
                                'attachable_id'             => $results->id,
                                'attachable_type'           => CustomerProfile::class,
                                'attachment_file_name'      => $attachment->savedName,
                                'attachment_original_name'  => $attachment->originalName,
                                'attachment_mime_type'      => $attachment->mimeType,
                                'status'                    => config('constant.ACTIVE')
                            ]);
                        }
                    }
        /* Save attachments */

         $log_values=CustomerProfileLog::Create($default_arr);
         $single_tab=Tab::where('type','!=',2)->pluck('id');
         
         $custom_field_det = CustomerProfileField::CurrentFields(config('constant.CUSTOM_FIELD'))->wherein('tab_id',$single_tab);
        // dd($custom_field_det);die;
         foreach ($custom_field_det as $value) {
             $custom_arr=array('cmpny_id'=>Auth::User()->cmpny_id,'status'=>config('constant.ACTIVE'),'field_id'=>$value->id);

                     $custom_arr['field_name']=$value->field_name;
                     $custom_arr['cmpny_id']=Auth::User()->cmpny_id;
                     $custom_arr['value']=request($value->field_name);
                      if($value->field_type == 5) // datepicker
                        {
                            $custom_arr['value'] = NULL;
                            $fname=request($value->field_name);
                            if(!empty($fname)){
                                $custom_arr['value']    = date('Y-m-d', strtotime($fname));
                            // $date_format       =   explode('/',$fname);
                          
                            //  if(isset($date_format[2]) && !empty($date_format[2]) && isset($date_format[1]) && !empty($date_format[1]) && isset($date_format[0]) && !empty($date_format[0]) )
                            //  {
                            //     $datevalue    =   $date_format[2].'-'.$date_format[1].'-'.$date_format[0];
                            //     $date_picker     =   date('Y-m-d', strtotime($datevalue));
                            //     $custom_arr['value']=$date_picker;

                            // }
                        }
                            
                        }
                        if((request($value->field_name) && $value->field_type == 9) || (request($value->field_name) && $value->field_type == 11)) // checkbox
                        {  
                            $fname=request($value->field_name);
                            $custom_arr['value']=serialize($fname);
                          
                        }
                     $custom_arr['user_id']=$results->id;
                     $custom_arr['tab_id']=$value->tab_id;
                     $cond_arr=array('user_id'=>$results->id,'field_name'=>$value->field_name);

                    CustomerProfileMeta::updateOrCreate($cond_arr,$custom_arr);
             
         }
         $tab_details=Tab::with(['profile_fields' => function ($q){
                    $q->where('status',config('constant.ACTIVE')); 
                  }])->where('status',config('constant.ACTIVE'))->where('type',2)->orderBy('sort_order')->get();
         $response           =   $request->all();
        
         foreach ($tab_details as $key => $value) {
 
               $tab_name=str_replace(' ', '_', strtolower($value->name));
                if(request($tab_name))
                {

                for ($i=1; $i < request($tab_name); $i++) { 
                    
                
                    foreach ($value['profile_fields'] as $key => $field) {
                        $field_names=trim($field->field_name.$i);
                         $field_type=trim($field->field_type.$i);
                        $field_values=request($field_names);

                        $validation_arr=array();
                        $validation_str=''; 
                        if($field->required == 1){
                            $validation_str.='required|';
                        }
                        $table_name='ori_customer_profile_meta';
                        $table_field='value';
                        if($field->is_unique == 1 && $field_values){
                            $validation_str.='unique:'.$table_name.','.$table_field.','.request('pid').',user_id,cmpny_id,'.$company_id;
                        }
                        $validation_arr[$field_names] =$validation_str;
                        $this->validate($request, $validation_arr);
                        // validation//

                        $custom_arr=array('cmpny_id'=>Auth::User()->cmpny_id,'status'=>config('constant.ACTIVE'),'field_id'=>$field->id);
                        $custom_arr['field_name']=$field_names;
                        $custom_arr['cmpny_id']=Auth::User()->cmpny_id;
                        if($field_type == 5) // datepicker
                        {
                            $date_format       =   explode('/',$field_values);
                           
                             if(isset($date_format[2]) && !empty($date_format[2]) && isset($date_format[1]) && !empty($date_format[1]) && isset($date_format[0]) && !empty($date_format[0]) )
                             {
                                $datevalue    =   $date_format[2].'-'.$date_format[1].'-'.$date_format[0];
                                $date_picker     =   date('Y-m-d', strtotime($datevalue));
                                $custom_arr['value1']=$date_picker;
                            }
                            
                        }else{
                        $custom_arr['value']=trim($field_values);
                        }
                        $custom_arr['relation_id']=$i;
                        $custom_arr['tab_id']=$field->tab_id;
                        $custom_arr['user_id']=$results->id;
                        $cond_arr=array('user_id'=>$results->id,'field_name'=>$field_names);
                        CustomerProfileMeta::updateOrCreate($cond_arr,$custom_arr);
                    }
                }
                }
            
            
         }
         DB::commit();
         $result_arr=array('status' => 'success','profile_id'=>$results->id);
         echo json_encode($result_arr);
       /* } catch (\Exception $e) {
            DB::rollback();
            $msg=$e->error;
            dd($msg);
            $result_arr=array('status' => 'false','profile_id'=>'');
            echo json_encode($result_arr);
        }*/
    }
     /*
    * Searching Profile Details
    * @author Reshma Rajan
    * @date 6/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return profile page
    */

     public function search_profile(Request $request)
    {
        $deflt_fields = CustomerProfileField::select('id','label','field_name')
                         ->where('cmpny_id',Auth::User()->cmpny_id)
                         ->where('type',config('constant.DEFAULT_FEILD'))
                         ->where('status',config('constant.ACTIVE'))
                         ->wherein('field_name',config('constant.PROFILE_SEARCH'))
                         ->get();
        $user_details=CustomerProfile::with('profile_details');
        if(request('profile_id')){
            $user_details->where('id',request('profile_id'));
        }
        
        if(request('search_keywords')){
            $search_keywords=request('search_keywords');
            $user_details->where(function($user_details) use ($search_keywords,$deflt_fields){
                    $user_details->where(function ($user_details) use ($search_keywords,$deflt_fields) {
                        foreach($deflt_fields as $fields)
                        {
                            $field_str = $fields->field_name;
                            $user_details->orWhere($field_str, 'like', '%' . $search_keywords . '%');
                        }
                    });
                   
                 });
        }else{
            if(request('phone')){
                $user_details->where('mobile',request('phone'));
            }
        }
       
        $user_details=$user_details->limit(5)->get();
        $arr=array('default_field'=>$deflt_fields,'user_det'=>$user_details);
        echo json_encode($arr);

        
    }
    public function get_profile_header(Request $request)
    {
        if(request('customer_id')){
        $user_details=CustomerProfile::with('profile_details','company');
        
            $user_details->where('id',request('customer_id'));
        $user_details=$user_details->first();
        $field_det = CustomerProfileField::where('field_name','profile_photo')->where('status',config('constant.ACTIVE'))->first();

        $show_cus_details = true;
        if(!Helpers::checkPermission('show hidden details') AND $user_details->hide_details == 1){
            $show_cus_details = false;
        }

        return view('profile.profile_header',compact('user_details','field_det','show_cus_details'));
       
        
        }
        
    }
    
	
	public function getUsers()
{
    $users = CustomerProfile::paginate(config('constant.pagination_constant'));

   //return view('index', compact('users'));
	$html = view('index')->with(compact('users'))->render();
		//pr($html);
		$response = response()->json(['success' => true, 'html' => $html]);
		//$response json_decode($response);
		//$response = json_decode($response, true);
		return $html;
		
		//echo $html; exit;
		
	
}

    /*
    * Fetch Customer Profile Fields
    * @author RAHUL R.
    * @date 23/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return json encoded field list
    */
    public function fetch_customer_fields(Request $request)
    {
        $customer_fields    = array();

        $customer_fields    = CustomerProfileField::where('cmpny_id',Auth::User()->cmpny_id)
                            ->where('status', config('constant.ACTIVE'))
                            ->pluck('label', 'id')
                            ->all();

        return json_encode($customer_fields);
    }

     /*
    * Fetch survey DEtails
    * @author Reshma Rajan.
    * @date 28/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return survey details in profile page
    */
    public function survey_in_profile(Request $request)
    {
        if(request('customer_id'))
        {
            $p_survey_id=request('p_survey_id');
            $survey_det=SurveyDetail::with(['survey_details' => function ($q){
                    $q->where('status',config('constant.ACTIVE')); 
                       $q->where(function($q){
                       $q->orwhere('expiry_date', '>',Carbon::now());
                       $q->orwhere('expiry_date','');
                       $q->orwhereNull('expiry_date');
                       
                       });
                  }])->where('customer_id',request('customer_id'))->where('status',config('constant.INACTIVE'))->get();

            $question_ans=array();
            foreach ($survey_det as $key => $value) {
               $survey_id=$value->survey_id;
               if(!empty($value['survey_details']['survey_name_lang1'])){
                    $survey_qstn=SurveyQuestion::with('survey_eng_qstn')->where('survey_id',$survey_id)->where('status',config('constant.ACTIVE'))->get();
                    $lang_type=config('constant.LANG_ENG');
               }else{
                    $survey_qstn=SurveyQuestion::with('survey_mal_qstn')->where('survey_id',$survey_id)->where('status',config('constant.ACTIVE'))->get();
                    $lang_type=config('constant.LANG_MALA');
               }
               
               $value['lang_type']=$lang_type;
               $value['question_ans']=$survey_qstn;
             
            }
            $auth=LeadSources::where('cmpny_id',Auth::user()->cmpny_id)
                    ->where('status',config('constant.ACTIVE'))->first();
            $authentication=$auth->source_key;
            if(count($survey_det) > 0){
            return view('profile.survey_listing')->with(compact('survey_det','authentication','p_survey_id'));
            }
        }
    }
    


    /*
    * FOR CHATHISTORY LISTING SECTION
    * @author LORAINE
    * @date 14/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return CHATHISTORY LISTING VIEW BLADE
    */
    public function chathistory_listing(Request $request)
    {
        $customer_id        = request('customer_id');
        $results            = array();
        $chat_history       = array();
        
        if($customer_id != "")
        {               
            $chat_history = ChatThread::with(['ChatThreadLogs' => function ($q) { $q->orderBy('id', 'desc')->limit(5); }])->where('cust_id', $customer_id)->get();
        }
        return view('profile.chathistory_listing')->with(compact('chat_history','customer_id'));
    }

    function more_profile_fields(Request $request)
    {
        
        
        if(request('i'))
        {   
            $p_fields=Tab::with('profile_fields')->where('status',config('constant.ACTIVE'))->where('id',request('tabid'))->orderBy('sort_order')->first();
            $m=request('i');
            return view('profile.add_more_fields', compact('m','p_fields'));
        }
       
    
    }
     /*
    * Getting locations
    * @author Reshma Rajan
    * @date 13/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return  profile page
    */
    function get_location(Request $request)
    {   

        if(request('id')){
            $user_det=array();
            if(request('id') && request('customer_id')){  
            $user_det=Helpers::get_location_details(request('form_id'),request('customer_id'));  
            }
            $parent_id  = $request->post('id');
            $parent = LocationSettings::find($parent_id);
            $state = LocationSettings::where('parent',request('id'))->where('status',config('constant.ACTIVE'));
            if ($parent && $parent->type == 'country')
            {
                $state->orWhere(function($query) {
                    $query->where('type', 'state')
                        ->where('is_other', 1);
                });
            }
            $state = $state->get();
            $result=array('location'=>$state,'user_det'=>$user_det);
            return $result;
        }
    }
     /*
    * Getting localbody
    * @author Reshma Rajan
    * @date 14/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return  profile page
    */
    function get_localbody(Request $request)
    {   
        if(request('distid') && request('localbody_type')){
             $user_det=array();
            if(request('customer_id')){    
            $user_det=Helpers::get_location_details(request('form_id'),request('customer_id'));  
            }
            $localbody = LocalBody::where('localbodyTypeId',request('localbody_type'))->where('district_id',request('distid'))->where('parent_id',0)->where('status',config('constant.ACTIVE'))->get();
            $result=array('localbody'=>$localbody,'user_det'=>$user_det);
            return $result;
        }
    }
     /*
    * Getting get_panchayath
    * @author Reshma Rajan
    * @date 14/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return  profile page
    */
    function get_panchayath_details(Request $request)
    {   
        if(request('distid')){
             $user_det=array();
            if(request('customer_id')){    
            $user_det=Helpers::get_location_details(request('form_id'),request('customer_id'));  
            }
            $localbodytype_arr=LocalBodyType::where('parent_id',1)->where('status',config('constant.ACTIVE'))->get();
             $result=array('localbodytype_arr'=>$localbodytype_arr,'user_det'=>$user_det);
            return $result;
        
        }
    }

     /*
    * Getting get_panchayath
    * @author Reshma Rajan
    * @date 14/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return  profile page
    */
    function get_panchayath(Request $request)
    {   
        if(request('distid') && request('panchayath_type')){
        $localbodytype_arr=LocalBody::where('district_id',request('distid'))->where('parent_id',0)->where('localbodyTypeId',request('panchayath_type'))->where('status',config('constant.ACTIVE'))->get();
            $user_det=array();
            if(request('customer_id')){    
            $user_det=Helpers::get_location_details(request('form_id'),request('customer_id'));  
            }
        $result=array('localbodytype_arr'=>$localbodytype_arr,'user_det'=>$user_det);
        return $result;
       
        }
    }

      /*
    * Getting locations
    * @author Reshma Rajan
    * @date 13/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return  profile page
    */
    function get_block_panchayath(Request $request)
    {   
		if(request('id')){
         $user_det=array();
        if(request('customer_id')){    
        $user_det=Helpers::get_location_details(request('form_id'),request('customer_id'));  
        }
        $panchayath = LocalBody::where('parent_id',request('id'))->where('status',config('constant.ACTIVE'))->get();
        $result=array('panchayath'=>$panchayath,'user_det'=>$user_det);
        return $result;
	
        }
    }
	/*
    * Getting locations
    * @author Reshma Rajan
    * @date 9/01/2019
    * @since version 1.0.0
    * @param NULL
    * @return  profile page
    */
    function get_taluk_village(Request $request)
    {   
        if(request('district_id') && request('type')){
        if(request('customer_id')){    
        $user_det=Helpers::get_location_details(request('form_id'),request('customer_id'));  
        }
		else{
			$user_det=[];
		}
        $taluk_village = LocalBody::where('district_id',request('district_id'))->where('localbodyTypeId',request('type'))->where('parent_id',0)->where('status',config('constant.ACTIVE'))->get();
        $result=array('taluk_village'=>$taluk_village,'user_det'=>$user_det);
        return $result;
        }
    }
	
	/*
    * Customer import container view
    * @author Elavarasi S
    * @date 28/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return customer import container view
    */
    public function import_customer_index(Request $request)
    {
        return view('customer_import.import_customer_index', compact($request));
    }

    /*
    * MAP FIELDS WITH EXCEL COLUMNS
    * @author Elavarasi S
    * @date 28/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return mapping view
    */
    public function import_customer_select_fields(Request $request)
    {
        $this->validate($request,[
                'file' => 'required',                
                ],[
                'file.required' => ' The file is required.',
                ]);


        $comment            = $request->post('comments');
        $original_file_name   = request('file')->getClientOriginalName();
        $filename = time(). '.' . request('file')->getClientOriginalExtension();
        request('file')->move(storage_path('app/import'), $filename);
        $file_path  = storage_path('app/import') . '/' . $filename;
        
        if (!file_exists($file_path))
        {
            return redirect()->back()->with('error','The file could not be uploaded.');
        }

        //Fetch Headings from excel
        $excel_headings = (new HeadingRowImport)->toArray('import/' . $filename);
        if (empty($excel_headings) || empty($excel_headings[0]) ||empty($excel_headings[0][0]))
        {
            return redirect()->back()->with('error','The file does not contain any heading');
        }
        $excel_headings  = $excel_headings[0][0];
          $excel_headings = array_filter($excel_headings);
        $customer_fields    = CustomerProfileField::where('cmpny_id',Auth::User()->cmpny_id)
                            ->where('status', config('constant.ACTIVE'))
                            ->pluck('label', 'id')
                            ->all();
                        //var_dump($customer_fields); exit;
        return view('customer_import.import_customer_select_fields', compact('filename', 'excel_headings', 'customer_fields', 'comment', 'original_file_name'));

        
    }
    /*
    * Import customer from assigned fields
    * @author Elavarasi S
    * @date 28/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return mapping view
    */
    public function customer_excel_import_batch(Request $request)
    {
        $file_name  = $request->post('file_name');
        $success    = false;
        $message    = 'Could not import from the given document';

        do {
            //Fetch Headings from excel
            $excel_headings = (new HeadingRowImport)->toArray('import/' . $file_name);
            if (empty($excel_headings) || empty($excel_headings[0]) ||empty($excel_headings[0][0]))
            {
                $message    = 'The file does not contain any heading';
                break;
            }

            $excel_headings  = $excel_headings[0][0];

            //Check if atleast one field is mapped
            $heading_map_selected = false;
            $field_map  = [];

            foreach ($excel_headings as $heading)
            {
                if ($request->has($heading) && !empty($request->post($heading)))
                {
                    $heading_map_selected   = true;
                    $field_map[$heading]    = $request->post($heading);
                }
            }

            if(!$heading_map_selected)
            {
                $message    = 'Please map atleast one field to start importing';
                break;
            }

            $required_fields    = CustomerProfileField::select('ori_customer_profile_fields.id', 'ori_customer_profile_fields.label')
                                    ->where('ori_customer_profile_fields.cmpny_id',Auth::User()->cmpny_id)
                                    ->where('ori_customer_profile_fields.status',config('constant.ACTIVE'))
                                    ->where('ori_customer_profile_fields.required', config('constant.ACTIVE'))
                                    ->pluck('ori_customer_profile_fields.label', 'ori_customer_profile_fields.id')
                                    ->all();

            $required_field_ids = array_keys($required_fields);
            $fields_mapped      = array_values($field_map);

            if (count(array_diff($required_field_ids, $fields_mapped)))
            {
               //$message    = 'Please map all required customer fields to start importing.';
                //break;
            }

            $comment                = $request->post('comment');
            $skip_existing_contacts = $request->has('skip_existing_contacts') ? 1 : NULL;
            $add_to_leads           = $request->has('add_to_leads') ? 1 : NULL;
            $field_map_json         = json_encode($field_map);


           /* $batch  = GroupExcelImportBatch::create([
                'cmpny_id'                  => Auth::user()->cmpny_id,
                'group_id'                  => $group->id,
                'file_name'                 => $file_name,
                'field_map'                 => $field_map_json,
                'lead_source'               => $lead_source,
                'comment'                   => $comment,
                'skip_existing_contacts'    => $skip_existing_contacts,
                'add_to_leads'              => $add_to_leads,
                'status'                    => config('constant.INACTIVE')
            ]);*/

            $success    = true;
            $message    = 'Excel import has been initiated successfully. You will be notified on completion';
            (new CustomerImport(1, $field_map, $skip_existing_contacts, $add_to_leads, 1, 100))->queue('import/' . $file_name);

        }
        while(false);

        $result_arr = array('success' => $success,'message' => $message);
        return $result_arr;
    }

    public function import_customer_table(Request $request){
        $filename = request('filename');
        $path = $path = public_path('uploads/customer/').$filename;
        $data = Excel::load($path, function($reader) {})->get();
        $customer_id    = request('customer_id');
        $first_name    = request('first_name');
        $enrollment_id    = request('enrollment_id');
        $scheme_id    = request('scheme_id');
        $mobile_number    = request('mobile_number');
        $country_code    = request('country_code');
        $duration    = request('duration');
        $join_date    = request('join_date');
        
        $end_date    = request('end_date');
        //$end_date = Carbon::parse($end_date)->format('Y-m-d');
        $amount    = request('amount');
        $branch_id    = request('branch_id');
        $mykalyan_id    = request('mykalyan_id');
        $collection_id    = request('collection_id');
        $last_installment_date    = request('last_installment_date');
        //$last_installment_date = Carbon::parse($last_installment_date)->format('Y-m-d');
        $mode_of_payment    = request('mode_of_payment');
        $installed_count    = request('installed_count');
        $no_of_inst_due    = request('no_of_inst_due');
                
        $fname    = request('fname');
        
        $autostage    = request('autostage');
          
        $user_id = Auth::User()->id;
        $comment = request('comment');
        
        ///// CODE FOR FILE NAME SAVING STARTS HERE ////
                $check = array(
                    'import_filename' => $filename, 
                            );
                $file_arr = array(
                'comment' => $comment,
                'file_path' => $path,
                'import_time' => date('Y-m-d h:i:s'),
                'status' => config('constant.ACTIVE'),
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
                );
                cmp_import_files::firstOrCreate($check,$file_arr);
                
                
                
                ///// CODE FOR FILE NAME SAVING ENDS HERE  ////     
        
        
        if(!empty($data) && $data->count() && isset($data))
        {
            $total=$new=$ext_count=0;
            foreach ($data->toArray() as $key => $value) 
            {
                $count=count($value);
                
                if(!empty($value)  && isset($value))
                {
                    foreach ($value as $v) 
                    { 
                    //print_r($v);exit;
                    $cust_id=NULL;
                    $f_name=NULL;
                    $e_id=NULL;
                    $c_code =NULL;
                    $s_id =NULL;
                    $m_number=NULL;
                    $s_duration=NULL;
                    $j_date=NULL;
                    $e_date=NULL;
                    $s_amount=NULL;
                    $b_id=NULL;
                    $m_id=NULL;
                    $cl_id=NULL;
                    $l_p_date=NULL;
                    $mop=NULL;
                    $inst_count=NULL;
                    $no_ist_due=NULL;
        
                    if(isset($v[$customer_id]) && !empty($v[$customer_id])){
                      $cust_id = $v[$customer_id];
                    }
                    if(isset($v[$first_name]) && !empty($v[$first_name])){
                      $f_name = $v[$first_name];
                    }
                    if(isset($v[$enrollment_id]) && !empty($v[$enrollment_id])){
                      $e_id = $v[$enrollment_id];
                    }
                    if(isset($v[$country_code]) && !empty($v[$country_code])){
                      $c_code = $v[$country_code];
                    }
                    if(isset($v[$scheme_id]) && !empty($v[$scheme_id])){
                      $s_id = $v[$scheme_id];
                    }
                     if(isset($v[$duration]) && !empty($v[$duration])){
                      $s_duration = $v[$duration];
                    }
                     if(isset($v[$mobile_number]) && !empty($v[$mobile_number])){
                      $m_number = $v[$mobile_number];
                    }
                    if(isset($v[$join_date]) && !empty($v[$join_date])){
                      $j_date = $v[$join_date];
                      $j_date = Carbon::parse($j_date)->format('Y-m-d');
                    }
                     if(isset($v[$end_date]) && !empty($v[$end_date])){
                      $e_date = $v[$end_date];
                      $e_date = Carbon::parse($e_date)->format('Y-m-d');
                    }
                     if(isset($v[$amount]) && !empty($v[$amount])){
                      $s_amount = $v[$amount];
                    }
                     if(isset($v[$branch_id]) && !empty($v[$branch_id])){
                      $b_id = $v[$branch_id];
                    }
                     if(isset($v[$mykalyan_id]) && !empty($v[$mykalyan_id])){
                      $m_id = $v[$mykalyan_id];
                    }
                     if(isset($v[$collection_id]) && !empty($v[$collection_id])){
                      $cl_id = $v[$collection_id];
                    }
                     if(isset($v[$last_installment_date]) && !empty($v[$last_installment_date])){
                      $l_p_date = $v[$last_installment_date];
                      $l_p_date = Carbon::parse($l_p_date)->format('Y-m-d');
                    }
                     if(isset($v[$mode_of_payment]) && !empty($v[$mode_of_payment])){
                      $mop = $v[$mode_of_payment];
                    }
                     if(isset($v[$installed_count]) && !empty($v[$installed_count])){
                      $inst_count = $v[$installed_count];
                    }
                     if(isset($v[$no_of_inst_due]) && !empty($v[$no_of_inst_due])){
                      $no_ist_due = $v[$no_of_inst_due];
                    }
                    
                    $insert_data = ['kalyan_cust_id' => $cust_id,'first_name' => $f_name,'country_code' => $c_code, 'mobile_number' => $m_number];

                        $total++;   

                            
                    if(($insert_data['kalyan_cust_id']!=null))
                    {
                        $comment  = request('comment');
                        $customer_stage  = request('customer_stage');
                        
                        $exst_id = '';
                    
                        if(!empty($insert_data['kalyan_cust_id']))
                        {
                            $mob_exst = cc_customer_profile::where('kalyan_cust_id',$insert_data['kalyan_cust_id'])->first();
                            if($mob_exst)
                            {
                                $exst_id = $mob_exst->id;
                                $c_scheme_payment_data = ['customer_id' => $exst_id,'collection_id' => $cl_id,'scheme_id' =>$s_id, 'last_payment_date' => $l_p_date, 'mode_of_payment' => $mop, 'amount' => $s_amount, 'installed_count' => $inst_count, 'no_installment_due' => $no_ist_due];
                                $sch_pay_arr = array(
                                    'customer_id' => $c_scheme_payment_data['customer_id'],
                                    'collection_id' => $c_scheme_payment_data['collection_id'],
                                    'scheme_id' => $c_scheme_payment_data['scheme_id'],
                                    'last_payment_date' => $c_scheme_payment_data['last_payment_date'],
                                    'mode_of_payment' => $c_scheme_payment_data['mode_of_payment'],
                                    'amount' => $c_scheme_payment_data['amount'],
                                    'installed_count' => $c_scheme_payment_data['installed_count'],
                                    'no_installment_due' => $c_scheme_payment_data['no_installment_due'],
                                );
                                $ins_scheme_pay =   cc_customer_scheme_payment::create($sch_pay_arr);
                                
                                $ext_count++;
                                
                                ///////// CODE FOR AUTO PROCESS STARTS /////////
                                
                                $response = config('constant.AUTO_PROCESS_RESPONSE_POSITIVE');
                                $flag = null;
                                helpers::auto_process_updation($exst_id,$response,$flag);
                                
                                ///////// CODE FOR AUTO PROCESS ENDS /////////
                                
                            } else {
                                $new++; 
                                $list_arr = array(
                                    'kalyan_cust_id' => $insert_data['kalyan_cust_id'],
                                    'first_name' => $insert_data['first_name'],
                                    'country_code' => $insert_data['country_code'],
                                    'mobile_number' => $insert_data['mobile_number'],
                                    'status' => config('constant.ACTIVE'),
                                );
                                $ins =  cc_customer_profile::create($list_arr);
                                $ins_id = $ins->id;
                                
                                ///////// CODE FOR AUTO PROCESS STARTS /////////
                                
                                $auto_id = config('constant.AUTO_PROCESS_NEW_LEAD');
                                helpers::auto_process_params($ins_id,$auto_id);
                                
                                ///////// CODE FOR AUTO PROCESS ENDS /////////
                                
                                
                                $cc_scheme_details     =   cc_scheme_details::select('id')->where('scheme_id',$s_id)->first();
                                $sc_id = $cc_scheme_details->id;
                                $c_scheme_data = ['customer_id' => $ins_id,'enrollment_id' => $e_id,'scheme_id' => $s_id, 'join_date' => $j_date, 'end_date' => $e_date, 'amount' => $s_amount];
                                $sch_arr = array(
                                    'customer_id' => $c_scheme_data['customer_id'],
                                    'enrollment_id' => $c_scheme_data['enrollment_id'],
                                    'scheme_id' => $c_scheme_data['scheme_id'],
                                    'join_date' => $c_scheme_data['join_date'],
                                    'end_date' => $c_scheme_data['end_date'],
                                    'amount' => $c_scheme_data['amount'],
                                    'amount_due' => $c_scheme_data['amount'],
                                );
                                $ins_scheme =   cc_customer_scheme_relation::create($sch_arr);
                                
                                $c_scheme_payment_data = ['customer_id' => $ins_id,'collection_id' => $cl_id,'scheme_id' =>$s_id, 'last_payment_date' => $l_p_date, 'mode_of_payment' => $mop, 'amount' => $s_amount, 'installed_count' => $inst_count, 'no_installment_due' => $no_ist_due];
                                $sch_pay_arr = array(
                                    'customer_id' => $c_scheme_payment_data['customer_id'],
                                    'collection_id' => $c_scheme_payment_data['collection_id'],
                                    'scheme_id' => $c_scheme_payment_data['scheme_id'],
                                    'last_payment_date' => $c_scheme_payment_data['last_payment_date'],
                                    'mode_of_payment' => $c_scheme_payment_data['mode_of_payment'],
                                    'amount' => $c_scheme_payment_data['amount'],
                                    'installed_count' => $c_scheme_payment_data['installed_count'],
                                    'no_installment_due' => $c_scheme_payment_data['no_installment_due'],
                                );
                                $ins_scheme_pay =   cc_customer_scheme_payment::create($sch_pay_arr);
                            }
                        }
                    }
                }
            }
            return redirect()->route('importcustomer')->with('success',$new.'/'.$total.' Records successfully inserted. '.$ext_count.' existing records updated');    
        }
        return redirect()->route('importcustomer')->with('error','Please Check your file, Something is wrong there.');
        }
    }

     public function upload_profile_files(Request $request)
    {
        if(request('delete_pic')==1)
        {

          CustomerProfile::updateOrCreate(['id' => request('profile_pid')],['profile_photo'=>null]);
          $result_arr = array('reset' => true,'success' => true,'message' => 'Successfuly updated');
        }
        elseif(request('profile_pid')){
          
           
            $attachments=json_decode(request('profile_photo'));
            foreach ($attachments as $attachment)
            {
                $new_attachment = CustomerProfile::updateOrCreate([
                    'id' =>request('profile_pid')
                ],[
                    
                    'profile_photo'      => $attachment->savedName,
                    
                ]);
            }
                    
            $result_arr = array('reset' => true, 'success' => true,'message' => 'Successfuly updated');
        }
            return $result_arr;
    }
	/*
    * PROFILE LISTING VIEW
    * @author AKHIL MURUKAN
    * @date 22/03/2018
    * @since version 1.0.0
    * @param NULL
    * @return pipeline list
    */
	
	public function pipeline($company_id=null)
	{ 
        return view('pipelinelist.index');
	}
	/*
    * LISTING VIEW WITH FILTERS
	* @author AKHIL MURUKAN
    * @date 22/03/2018
    * @since version 1.0.0
    * @param NULL
    * @return pipeline list
    */
	public function search_pipelinelist(Request $request)
	{
		$response           =   $request->all();
        $search_keywords    =   $response['search_keywords'];
        $from_date          = $request->post('startdate') ?? '';
        $from_date          = str_replace('/', '-', $from_date);
        $to_date            = $request->post('enddate') ?? '';
        $to_date            = str_replace('/', '-', $to_date);
		if (!empty($from_date))
        {
            $from_date          =   date('Y-m-d', strtotime($from_date)).' 00:00:01';
        }
        if (!empty($to_date))
        {
            $to_date            =   date('Y-m-d', strtotime($to_date));
        }
		if($to_date <= '2000-01-01')
		{
			$to_date = '';
		}
		else
		{
			$to_date = $to_date.' 23:59:59';
		}
		$profile_status = config('constant.profile_status'); 
        $results = array();
        $results_all = array();
		$deflt_fields = CustomerProfileField::select('id','label','field_name')
					 ->where('cmpny_id',Auth::User()->cmpny_id)
					 ->where('type',config('constant.DEFAULT_FEILD'))
                     ->where('status',config('constant.ACTIVE'))
					 ->where('report_field',1)
					 ->get();
					 $all_count =0;
        foreach($profile_status as $key =>$type)
		{
			$results = CustomerProfile::where('cmpny_id',Auth::User()->cmpny_id)
										->where('profile_status',$key)
										->orderBy('id', 'desc')->with('profile_details');
				if(isset($search_keywords) && !empty($search_keywords))
				{
					$results->where(function ($q2) use ($search_keywords,$deflt_fields) {

				
						$q2->where(function ($q3) use ($search_keywords,$deflt_fields) {
							foreach($deflt_fields as $fields)
							{
								$fname = $fields->field_name;
								$q3->orWhere($fname, 'like', '%' . $search_keywords . '%');
							}
						}); 
						$q2->orWhereHas('profile_details', function($q4) use($search_keywords) 
						{
							$q4->where('value', 'like', '%' . $search_keywords . '%');
						});
					}); 
								
				}
				if(isset($from_date) && !empty($from_date))
				{
					$results->where('created_at','>=',$from_date);
				}
				if(isset($to_date) && !empty($to_date))
				{
					$results->where('created_at','<=',$to_date);
				}
				$results   =   $results->get();
				$all_count   =   $all_count + $results->count();
			
			$results_all[$key] =	$results;
        }
        $view = 'pipelinelist.listview';
        
		$html =	view($view)->with(compact('results_all','all_count'))->render();

		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;
	}
	
	
	 /*
    * Update Profile status
    * @author PRANEESHA KP
    * @date 11-06-2019
    * @since version 1.0.0
    * @param NULL
    */
    public function update_profile_status(Request $request)
    {
		$profile_id          		= request('profile_id');
		$profile_status          	= request('profile_status');
		
		$status = CustomerProfile::updateOrCreate(
        [
                'id' 			  => $profile_id
        ],
        [
				'cmpny_id'        => Auth::user()->cmpny_id,
				'profile_status'  => $profile_status,
		]); 
		
		
    }
public function get_email_sms_detail(Request $request)
{

        $response = $request->all();
        $id=$response['id'];
        $results=CommonSmsEmail::with('sendgrid_open_response','sendgrid_delivered_response','sendgrid_response')->find($id);
        if($results)
        {
            $data['mail_ref_id']  = $results->mail_ref_id;
            $data['sent_type']  = $results->sent_type;
            $data['sms_type']  = $results->sms_type;
            $data['campaign_id']  = $results->campaign_id;
            $data['mobile']  = $results->mobile;
            $data['email']  = $results->email;
            $data['content']  = $results->content;
            $data['subject']  = $results->subject;
            $data['created_at']  = $results->created_at;
            $data['updated_at']  = $results->updated_at;
            $mail_details = array();
           

        }
        return json_encode($results);
    }
public function get_sms_details(Request $request)
{
    $response = $request->all();
        $id=$response['id'];
        $results=CommonSmsEmail::find($id);
        if($results)
        {
            $data['mail_ref_id']  = $results->mail_ref_id;
            $data['sent_type']  = $results->sent_type;
            $data['sms_type']  = $results->sms_type;
            $data['campaign_id']  = $results->campaign_id;
            $data['mobile']  = $results->mobile;
            $data['email']  = $results->email;
            $data['content']  = $results->content;
            $data['subject']  = $results->subject;
            $data['created_at']  = $results->created_at;
            $data['updated_at']  = $results->updated_at;
            $mail_details = array();
           

        }
        return json_encode($results);
    }

     public function exportleads(Request $request)
    {
        $search_keywords = $request->post('search_keywords');
        $country         = $request->post('country');
        $startdate       = $request->post('startdate');
        $enddate         = $request->post('enddate');
        $user_id         = Auth::user()->id;
        $cmpny_id        = Auth::user()->cmpny_id;
        $now             = time();
         $file_name         = 'Lead Report - '.$now.'.xlsx';
        $path='/export_leads/'.$file_name;

        $data = [
            'user_id'  => $user_id,
            'cmpny_id' => $cmpny_id,
             'file_name'        => urlencode($file_name),
             'search_keywords'  => $search_keywords,
             'country'          => $country,
             'startdate'        => $startdate,
             'enddate'          => $enddate
        ];
        (new LeadlistReport($data))->queue($path)->chain([
            new NotifyLeadlsistReportCompletion($data),

        ]);


    }

    public function export_leads_with_helpdesk(Request $request)
    {
        $search_keywords = $request->post('search_keywords');
        $startdate       = $request->post('startdate');
        $enddate         = $request->post('enddate');
        $user_id         = Auth::user()->id;
        $cmpny_id        = Auth::user()->cmpny_id;
        $now             = time();
         $file_name         = 'Lead Report - '.$now.'.csv';
        $path='/export_leads/'.$file_name;

        $data = [
            'user_id'  => $user_id,
            'cmpny_id' => $cmpny_id,
             'file_name'        => urlencode($file_name),
             'search_keywords'  => $search_keywords,
             'startdate'        => $startdate,
             'enddate'          => $enddate,
             'last_processed_id' => 0,
             'processed_count'  => 0
        ];
        
        LeadWithHelpdeskExport::dispatch($data);


    }

    public function export_disha_leads(Request $request)
    {
        $search_keywords = $request->post('search_keywords');
        $country         = $request->post('country');
        $startdate       = $request->post('startdate');
        $enddate         = $request->post('enddate');
        $user_id         = Auth::user()->id;
        $cmpny_id        = Auth::user()->cmpny_id;
        $now             = time();
         $file_name         = 'Lead Report - '.$now.'.csv';
        $path='/export_leads/'.$file_name;

        $data = [
            'user_id'  => $user_id,
            'cmpny_id' => $cmpny_id,
             'file_name'        => urlencode($file_name),
             'search_keywords'  => $search_keywords,
             'country'          => $country,
             'startdate'        => $startdate,
             'enddate'          => $enddate,
             'last_processed_id' => 0,
             'last_helpdesk_id'  => 0,
             'processed_count'  => 0
        ];
        
        DishaLeadExport::dispatch($data);


    }

    public function export_disha_leads_old(Request $request)
    {
        $search_keywords = $request->post('search_keywords');
        $startdate       = $request->post('startdate');
        $enddate         = $request->post('enddate');
        $user_id         = Auth::user()->id;
        $cmpny_id        = Auth::user()->cmpny_id;
        $now             = time();
         $file_name         = 'Lead Report - '.$now.'.xlsx';
        $path='/export_leads/'.$file_name;

        $data = [
            'user_id'  => $user_id,
            'cmpny_id' => $cmpny_id,
             'file_name'        => urlencode($file_name),
             'search_keywords'  => $search_keywords,
             'startdate'        => $startdate,
             'enddate'          => $enddate
        ];
        (new DishaLeadlistReport($data))->queue($path)->chain([
            new NotifyLeadlsistReportCompletion($data),

        ]);


    }

    public function download_leadlist_report($file_name)
    {
        $file_name  = urldecode($file_name);
        $path = storage_path('app/export_leads/'.$file_name);
        return response()->download($path);
    }

    /*
    * Get Profile by email
    * @author Rahul Raveendran
    * @date 23-10-2019
    * @since version 1.0.0
    * @param NULL
    */
    public function get_profile_by_email(Request $request)
    {
        $email = trim($request->post('email'));
        $customer = CustomerProfile::select('id')->where('email', $email)->first();
        $result = array();
        if ($customer)
        {
            $result = ['status' => config('constant.ACTIVE'), 'customer_id' => $customer->id];
        }
        else
        {
            $result = ['status' => 0, 'customer_id' => NULL];
        }

        return json_encode($result);
    }
	
	/*
    * Getting OFFICER DETAILS based on the location id
    * @author RINKU.E.B.
    * @date 28/03/2020
    * @since version 1.0.0
    * @param NULL
    * @return  profile page
    */
    function get_officer_details(Request $request)
    {   

        if(request('loc_id')){
            $result = '';
            if(request('loc_id')){  
            $result=Helpers::get_officer_details(request('loc_id')); //print_r($result); 
            }
            return $result;
        }
    }
	
	/*
    * Getting OFFICER DETAILS based on the location id
    * @author RINKU.E.B.
    * @date 30/03/2020
    * @since version 1.0.0
    * @param NULL
    * @return  profile page
    */
    function get_call_url(Request $request)
    {   

        if(request('contact_no')){
            $result = array();
            if(request('contact_no')){  
            //$result['url'] = config('constant.callcenter_url');
            $result['url'] = config('constant.dishacallcenter_url');
			$result['number'] = request('contact_no');
			$result['extension'] = Auth::user()->extension; 
			$result['callerid'] = Helpers::get_company_meta('outbound_caller_id');  
            }
            return $result;
        }
    }
	
	
}
