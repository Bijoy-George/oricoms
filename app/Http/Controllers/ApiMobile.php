<?php
namespace App\Http\Controllers;
use App\ApiCallLog;
use App\CommonSmsEmail;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\LeadSources;
use App\User;
use App\CustomerProfileField;
use App\CustomerProfile;
use App\CustomerNature;
use App\LocationSettings;
use App\LocalBodyType;
use App\CustomerProfileMeta;
use App\Tab;
use App\CustomerFcms;
use App\CompanyProfile;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers;

class ApiMobile extends Controller
{
	 private $company_id;
   public function __construct() {
		date_default_timezone_set("Asia/Kolkata");
                header('Access-Control-Allow-Origin: *');
				$this->company_id = 15;
	}
	/**
    * Login function for Mobile App
    * @author Rejeesh K.Nair
    * @date 29/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return
   */
        public function user_login(Request $request)
    {//echo "hello";die;
        $api_call_log   = new ApiCallLog;
        $apilogid       = $api_call_log->createLog($request);
        try{
                $authentication_key = request('authentication_key');
                $username       = request('user_name');
                $password       = request('password');
                $fcmRegId = request('fcmregid');
                $imeino  = request('imeino');
                $plan = 0;

                #$password      = hash('sha512', $password);
                //echo $password        = Hash::check($password);die;
                #$password      = '$2y$10$WAujBoWDvGcA0lIzvJqBT.xhIJIPLLWoFlXs8x3dYXoAmduVbJGZy';
                //$app_version  = request('app_version');
                if(((isset($authentication_key))&&(!empty($authentication_key))) && ((isset($username))&&(!empty($username))) && ((isset($password))&&(!empty($password)))){

                    $auth_check = LeadSources::where('source_key',$authentication_key)
                    ->where('status',config('constant.ACTIVE'))->count();
                    if($auth_check > 0){
                    $user_det=User::select('name', 'id','password','cmpny_id','department','role_id')
                                        ->where('email',$username)
                                        ->first();
                    if(!empty($user_det)){
                    $cmpny_profile = CompanyProfile::where('id',$user_det->cmpny_id)
                                                ->first();

                    $chat_flag = 0;
                    if(isset($cmpny_profile) && !empty($cmpny_profile))
                    {
                        $plan = $cmpny_profile->ori_cmp_org_plan;
                    }

                        if(!empty($user_det)){
                            $current_password = $user_det->password;
                            if(Hash::check($password, $current_password)){
                                    $name = $user_det->name;
                                    $user_id = $user_det->id;
                                    $company_id = $user_det->cmpny_id;
                                    $chat_agent_role = Helpers::get_company_meta('chat_agent',$company_id);
                                    $results['role_id']=unserialize($user_det->role_id);//print_r($results['role_id']);die;
                                    foreach($results['role_id'] as $role)
                                    {
                                        if($role == $chat_agent_role)
                                        {
                                            $chat_flag = 1;
                                            break;
                                        }
                                    }
                                    $results['status'] = config('constant.API_ACTIVE');
                                    $results['msg'] = 'Valid User';
                                    $results['user_id'] = $user_id;
                                    $results['name'] = $name;
                                    $results['company_id'] = $company_id;
                                    $results['plan_id'] = $plan;
                                    $results['chat_enabled'] = $chat_flag;
                                    $results['authentication_key'] = $authentication_key;
                                    $results['tabs_needed'][] = 'Dashboard';

                                    CustomerFcms::updateOrCreate(['customer_id' => $user_id,'imeiNo' => $imeino,'cmpny_id' => $company_id] , ['fcmRegId' =>$fcmRegId,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')] );//echo $user_id;die;

                                    if(Helpers::checkPermission('Helpdesk',$user_id))
                                    {
                                        $results['tabs_needed'][] = 'Helpdesk';
                                    }//echo $user_id;die;
                                    if(Helpers::checkPermission('Task',$user_id))
                                    {
                                        $results['tabs_needed'][] = 'Task';
                                    }
                                    if(Helpers::checkPermission('lead list',$user_id))
                                    {
                                        $results['tabs_needed'][] = 'Citizen';
                                    }

                                    //GET DEPARTMENT ASSIGNED FOR THE LOGIN
                                    $id_array = '';
                                    if(Helpers::checkPermission('get own department',$user_id)){

                                        $depts = unserialize($user_det->department);
                                            if($depts){
                                                $id_array = implode(',',array_values(array_filter($depts)));
                                            }
                                    }
                                    $results['Department'] = $id_array;
                                    echo json_encode($results);die;
                                    }else{
                                    $results['status'] = config('constant.API_INACTIVE');
                                    $results['msg'] = 'Invalid User';
                                    $results['user_id'] = '';
                                    $results['name'] = '';
                                    $results['authentication_key'] = '';
                                    echo json_encode($results);die;
                                    }
                            }else{
                                $result_arr= array('status'=>config('constant.API_INACTIVE'),'msg'=>'Invalid User');
                                $api_call_log->updateLog($apilogid,$this->company_id,$result_arr);
                                echo json_encode($result_arr);die;
                            }
                            }
                            else{
                            $result_arr= array('status'=>config('constant.API_INACTIVE'),'msg'=>'Invalid User');
                            $api_call_log->updateLog($apilogid,$this->company_id,$result_arr);
                            echo json_encode($result_arr);die;
                            }
                        }
                        else{
                        $result_arr= array('status'=>config('constant.API_AUTH_FAILURE'),'msg'=>'Authentication Failure');
                        $api_call_log->updateLog($apilogid,$this->company_id,$result_arr);
                        echo json_encode($result_arr);die;
                        }
                }else{
                    $result_arr= array('status'=>config('constant.API_EMPTY_MANDATORY_FIELDS'),'msg'=>'Please fill all mandatory fields');
                    $api_call_log->updateLog($apilogid,$this->company_id,$result_arr);
                    echo json_encode($result_arr);die;
                }

        }catch(\Illuminate\Database\QueryException $ex)
        {
            $error      = $ex->getMessage();
            $data       = array('status'=>'DB_ERROR');
            $api_call_log->updateLog($apilogid,$this->company_id,$data,$error);
            return $data;
        }


    }
	/**
    * Forgot password function for Mobile App
    * @author Rejeesh K.Nair
    * @date 04/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function forgot_password(Request $request)
    {
        $api_call_log   = new ApiCallLog;
        $apilogid       = $api_call_log->createLog($request);
		try{
                $authentication_key = request('authentication_key');
				$email 		= request('email');
                if(((isset($authentication_key))&&(!empty($authentication_key))) && ((isset($email))&&(!empty($email)))){
                    $auth_check = LeadSources::where('source_key',$authentication_key)
                    ->where('status',config('constant.ACTIVE'))->count();
                    if($auth_check > 0){                           
                    $user_det=User::select('id','email','name')->where('email',$username)->first();
                                        /*->toSql();
										dd($user_det);die;*/
					if(isset($user_det->id) && !empty($user_det->id)){		
							$email = $user_det->email;
							$user_id = $user_det->id;
							$name = $user_det->name;
							echo $new_password = Helpers::random_string('alnum',15);
							$results['status'] = config('constant.API_ACTIVE');
							$results['msg'] = '';
							echo json_encode($results);die;
							}else{
							$results['status'] = config('constant.API_INACTIVE');
							$results['msg'] = '';
							echo json_encode($results);die;
							}
                        }else{
                        $result_arr= array('status'=>config('constant.API_AUTH_FAILURE'),'msg'=>'Authentication Failure');
                        $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                        echo json_encode($result_arr);die;
                    }   
                }else{
                    $result_arr= array('status'=>config('constant.API_EMPTY_MANDATORY_FIELDS'),'msg'=>'Please fill all mandatory fields');
                    $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                    echo json_encode($result_arr);die;
                }
                    
        }catch(\Illuminate\Database\QueryException $ex){
            $error      = $ex->getMessage();
            $data       = array('status'=>'DB_ERROR');
            $api_call_log->updateLog($apilogid,$company_id,$data,$error);
            return $data;
        }
    }
	 /*
    * PROFILE LISTING VIEW WITH FILTERS
    * @author PRANEESHA KP
    * @date 05-07-2019
    * @since version 1.0.0
    * @param NULL
    * @return profile list
    */
    public function search_leadlist(Request $request)
    {
        $response           =   $request->all();
        $search_keywords    =   request('search_keywords');
        $from_date          =   request('startdate')  ?? '';
        $from_date          =   str_replace('/', '-', $from_date);
        $to_date            =   $request->post('enddate') ?? '';
        $to_date            =   str_replace('/', '-', $to_date);
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

        $fields = CustomerProfileField::select('field_name')->where('cmpny_id',$this->company_id)
                     ->where('type',config('constant.DEFAULT_FEILD'))->where('report_field',1)->where('status',config('constant.ACTIVE'))->get();
        $cust_fields = CustomerProfileField::select('id','label')
                     ->where('cmpny_id',$this->company_id)
                     ->where('type',config('constant.CUSTOM_FIELD'))
                     ->where('status',config('constant.ACTIVE'))
                     ->where('report_field',1)
                     ->get();
        $deflt_fields = CustomerProfileField::select('id','label','field_name')
                     ->where('cmpny_id',$this->company_id)
                     ->where('type',config('constant.DEFAULT_FEILD'))
                     ->where('status',config('constant.ACTIVE'))
                     ->where('report_field',1)
                     ->get();
        foreach($fields as $field)
        {
            $fields_str .= "'".$field->field_name."',";
        }

        $results = CustomerProfile::where('cmpny_id',$this->company_id)->orderBy('id', 'desc')->with('profile_details');
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
        //$row_count = count($cust_fields)+count($deflt_fields)+1;
        $list_count = $results->count();
        $results   =   $results->get();
        $result_arr=array('success' => true,'Customers'=>$results,'list_count'=>$list_count);
        echo json_encode($result_arr);
    }
 /*
    * Getting Profile Details
    * @author PRANEESHA KP
    * @date 02-07-2019
    * @since version 1.0.0
    * @param NULL
    * @return profile page
    */
    public function view_profile(Request $request)
    {//echo "test";die;
        $api_call_log   = new ApiCallLog;
        $apilogid       = $api_call_log->createLog($request);
        $user_id             = request('user_id');
        $cus_nature          = CustomerNature::all();
        $sources_arr         = LeadSources::select('id','name','lead_source_type_id')->where('status',config('constant.ACTIVE'))->where('cmpny_id',$this->company_id)->get();
        $country_arr         = LocationSettings::select('id','name')->where('parent',0)->get();
        $localbodytype_arr   = LocalBodyType::where('parent_id',0)->where('status',config('constant.ACTIVE'))->get();
        $user_details        = array();

        if(request('profile_id')){
                $user_details = CustomerProfile::with('profile_details','GetProfileAttachment')->where('id',request('profile_id'))->first();
        }else{
            if(request('request_mob')){
            $user_details = CustomerProfile::with('profile_details')->where('mobile',request('request_mob'))->first();
            }
        }
//echo "<pre>";print_r($user_details);die;
        $default_field = CustomerProfileField::CurrentFields(config('constant.DEFAULT_FEILD'));
        $custom_field = CustomerProfileField::CurrentFields(config('constant.CUSTOM_FIELD'));

        $tab_arr=array();
        if(!empty($user_details)){
            $customer_id    = $user_details->id;
            $tab_values     = CustomerProfileMeta::select('tab_id',DB::raw('count(tab_id) as tab_count'))->whereNotNull('relation_id')->where('status',config('constant.ACTIVE'))->where('user_id',$customer_id)->groupBy('tab_id')->groupBy('field_id')->get();

            foreach ($tab_values as $key => $value) {
                $tab_arr[$value->tab_id]=$value->tab_count;
            }
        }else{ //echo "121212";die;
            $customer_id = "";
        }
//echo $customer_id;die;
        $tab_det    = Tab::with('profile_fields.GetFieldType','profile_fields.GetOptions')->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->get();

        $location_fields    = CustomerProfileField::wherein('field_name',['country_id','state_id','district_id','local_body_type'])->where('status',config('constant.ACTIVE'))->get();
        $attchment_fields   = CustomerProfileField::where('field_name','attachments')->where('status',config('constant.ACTIVE'))->first();

        $show_cus_details = true;
        if(!Helpers::checkPermission('show hidden details','user_id') AND isset($user_details->hide_details)){
            if($user_details->hide_details == 1){
                $show_cus_details = false;
            }
        }

//echo $show_cus_details;die;
        $det['value']= 0;$det['name']='No';$hide_details[] = $det;
        $det1['value']= 1;$det1['name']='YES'; $hide_details[] = $det1;

        $det2['value']=  (int)config('constant.LEAD');$det2['name']='Lead';$profile_status[] = $det2;
        $det3['value']= (int)config('constant.CUSTOMER');$det3['name']='Customer'; $profile_status[] = $det3;
//echo $default_field;die;
        $result_arr = array('success' => true,'def_fileds' => $default_field,'custom_field' => $custom_field,'user_details'=>$user_details, 'customer_id' => $customer_id,'cus_nature'=>$cus_nature,'tab_det'=>$tab_det,'tab_arr'=>$tab_arr,'country_arr'=>$country_arr,'localbodytype_arr'=>$localbodytype_arr,'location_fields'=>$location_fields,'sources_arr'=>$sources_arr,'attchment_fields'=>$attchment_fields,'show_cus_details'=>$show_cus_details,'hide_details'=>$hide_details,'profile_status'=>$profile_status);
        echo json_encode($result_arr);

    }
	 /* Saving Profile Details
    * @author Reshma Rajan
    * @author PRANEESHA KP
    * @date 04-07-2019
    * @since version 1.0.0
    * @param NULL
    */
    public function save_profile(Request $request)
    {
        $response = $request->all();
        $api_call_log            = new ApiCallLog;
        $apilogid                = $api_call_log->createLog($request);
        // $hide_details             = request('hide_details');
        $user_id                 = request('user_id');
        $pid                     = request('pid');
        $flag= true;
        try
        {
            $single_tab =Tab::wherein('type',[1,3])->pluck('id');
            $field_det = CustomerProfileField::CurrentFields()->wherein('tab_id',$single_tab);
            $validation_arr=array();
            $company_id = $this->company_id;
            if($field_det){
            foreach ($field_det as  $field) {
                $validation_str='';
                if($field->field_name == 'mobile'){
                    $validation_str.='numeric|';
                }
                if($field->field_name == 'email'){
                    if(request('email') !=''){
                    $validation_str.='email|';
                    }
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
        $validator = Validator::make($request->all(), $validation_arr);

        if ($validator->fails()) {
        $result_arr['response'] = $validator->errors();
        $api_call_log->updateLog($apilogid,$this->company_id,$result_arr);
        echo json_encode($result_arr);
        }
        // $this->validate($request, $validation_arr);
        // $result_arr['validation']=$this->validate($request, $validation_arr);


        // validation//
        elseif($flag==true)
        {
        $default_arr=array('cmpny_id'=>$this->company_id,'status'=>config('constant.ACTIVE'));
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


            }else{
                $default_arr[$value1->field_name]=request($value1->field_name);
            }

        }
        if(request('country_code')){
             $default_arr['country_code']=request('country_code');
        }
         $results=CustomerProfile::updateOrCreate(['id' => request('pid')],$default_arr);
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
                                'cmpny_id'                  => $this->company_id,
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
            $custom_arr=array('cmpny_id'=>$this->company_id,'status'=>config('constant.ACTIVE'),'field_id'=>$value->id);

                     $custom_arr['field_name']=$value->field_name;
                     $custom_arr['cmpny_id']=$this->company_id;
                     $custom_arr['value']=request($value->field_name);
                      if($value->field_type == 5) // datepicker
                        {
                            $fname=request($value->field_name);
                            $date_format       =   explode('/',$fname);

                             if(isset($date_format[2]) && !empty($date_format[2]) && isset($date_format[1]) && !empty($date_format[1]) && isset($date_format[0]) && !empty($date_format[0]) )
                             {
                                $datevalue    =   $date_format[2].'-'.$date_format[1].'-'.$date_format[0];
                                $date_picker     =   date('Y-m-d', strtotime($datevalue));
                                $custom_arr['value']=$date_picker;
                            }

                        }
                        if(request($value->field_name) && $value->field_type == 9) // checkbox
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

                        $custom_arr=array('cmpny_id'=>$this->company_id,'status'=>config('constant.ACTIVE'),'field_id'=>$field->id);
                        $custom_arr['field_name']=$field_names;
                        $custom_arr['cmpny_id']=$this->company_id;
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
            $result_arr=array('status' => 'success','profile_id'=>$results->id);
            $api_call_log->updateLog($apilogid,$this->company_id,$result_arr);
            echo json_encode($result_arr);
          }
         else
         {
                $result_arr= array('status'=>config('constant.API_EMPTY_MANDATORY_FIELDS'),'msg'=>'Please fill all mandatory fields');
                $api_call_log->updateLog($apilogid,$this->company_id,$result_arr);
                echo json_encode($result_arr);die;
         }

        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $error      = $ex->getMessage();
            $data       = array('status'=>'DB_ERROR');
            $api_call_log->updateLog($apilogid,$this->company_id,$data,$error);
            return $data;
        }

    }
}
