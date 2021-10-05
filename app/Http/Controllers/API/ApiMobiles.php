<?php
namespace App\Http\Controllers\API;
use App\ApiCallLog;
use App\CommonSmsEmail;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\LeadSources;
use App\CompanyProfile;
use App\QueryTypes;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers;

class ApiMobiles extends Controller
{
   public function __construct() {
		date_default_timezone_set("Asia/Kolkata");
                header('Access-Control-Allow-Origin: *');
	}
	/**
    * Login function for Mobile App
    * @author PRANEESHA KP
    * @date 11/04/2019
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function user_login(Request $request)
    {
        $api_call_log   = new ApiCallLog;
        $apilogid       = $api_call_log->createLog($request);
        try{
			
                $authentication_key = request('authentication_key');
				$username 			= request('user_name');
				$password 			= request('password');
				$company_id			= "";
				
				if(((isset($authentication_key))&&(!empty($authentication_key))) && ((isset($username))&&(!empty($username))) && ((isset($password))&&(!empty($password)))){
					
                    $auth_check = LeadSources::where('source_key',$authentication_key)
                    ->where('status',config('constant.ACTIVE'))->count();
					   
                    if($auth_check > 0)
					{                       
						$user_det=User::select('name', 'id','password','cmpny_id')
											->where('email',$username)
											//->where('cmpny_id',$company_id)
											->first();
						if(!empty($user_det)){					
							$current_password = $user_det->password;
						}
						if(isset($current_password) && !empty($current_password) && Hash::check($password, $current_password))
						{
								
								
								$name = $user_det->name;
								$user_id = $user_det->id;
								$company_id = $user_det->cmpny_id;
								$results['status'] = config('constant.API_ACTIVE');
								$results['message'] = '';
								$results['user_id'] = $user_id;
								$results['name'] = $name;
								$results['company_id'] = $company_id;
								$results['authentication_key'] = $authentication_key;
								
								$cmpny_query_types = QueryTypes::select('ori_mast_query_type.id', 'ori_mast_query_type.query_type')
													->where('ori_mast_query_type.status', config('constant.ACTIVE'))
													->where('ori_mast_query_type.cmpny_id', $company_id)
													->pluck('query_type', 'id')
													->all();
													
								$results['query_types'] = $cmpny_query_types;
								
								if($company_id	== config('constant.ORICOM_ADMIN'))
								{
									$results['api_url'][] = "company-listing";
								}
								else
								{
									$results['api_url'][] = "helpdesk_summary";
									$results['api_url'][] = "escalation_summary";
									$results['api_url'][] = "general_enquiry_pie_chart";
								}
						}
						else
						{
								$results['status'] = config('constant.API_INACTIVE');
								$results['message'] = 'INVALID USER ';
								$results['user_id'] = '';
								$results['name'] = '';
								$results['authentication_key'] = '';
								//echo json_encode($results);die;
						}
						
						$api_call_log->updateLog($apilogid,$company_id,$results);
                        echo json_encode($results);die;
						
                    }
					else
					{
                        $result_arr= array('status'=>config('constant.API_AUTH_FAILURE'),'message'=>'Authentication Failure');
                        $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                        echo json_encode($result_arr);die;
                    }   
                }else{
                    $result_arr= array('status'=>config('constant.API_EMPTY_MANDATORY_FIELDS'),'message'=>'Please fill all mandatory fields');
                    $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                    echo json_encode($result_arr);die;
                }
                    
        }catch(\Illuminate\Database\QueryException $ex)
        {
            $error      = $ex->getMessage();
            $data       = array('status'=>'DB_ERROR');
            $api_call_log->updateLog($apilogid,$company_id,$data,$error);
            return $data;
        }


    }
	
	
	/**
    * Listing projects for Mobile App
    * @author PRANEESHA KP
    * @date 11/04/2019
    * @since version 1.0.0
    * @param NULL
    * @return
   */
   
    public function company_listing(Request $request)
    {
        $api_call_log   = new ApiCallLog;
        $apilogid       = $api_call_log->createLog($request);
        try{
			
                $authentication_key = request('authentication_key');
				$cmp_id 			= request('company_id');
				$company_id			= config('constant.ORICOM_ADMIN');
				
				if(((isset($authentication_key))&&(!empty($authentication_key))) && ((isset($cmp_id))&&(!empty($cmp_id))) && ($cmp_id == $company_id))
				{
					
                    $auth_check = LeadSources::where('source_key',$authentication_key)
                    ->where('status',config('constant.ACTIVE'))->count();
					
                    if($auth_check > 0)
					{                           
						$results	= CompanyProfile::select('ori_cmp_org_name','ori_cmp_org_email','ori_cmp_org_phone','ori_cmp_org_address','ori_cmp_org_city','ori_cmp_org_state','ori_cmp_org_pincode','ori_cmp_org_plan','ori_cmp_org_country','ori_cmp_org_base_url')
									->where('status',config('constant.ACTIVE'))
									->get();
						$company = array();
						$quries_date_line_chart_series = array();
						$company['status'] = config('constant.API_ACTIVE');
						$company['messsage'] = 'Success'; 
						
						$lists	= array();
						
						foreach($results as $cmp => $cmp_val)
						{
							$cmp_dets['name']     = $cmp_val['ori_cmp_org_name'];
							$cmp_dets['email']    = $cmp_val['ori_cmp_org_email'];
							$cmp_dets['phone']    = $cmp_val['ori_cmp_org_phone'];
							$cmp_dets['address']  = $cmp_val['ori_cmp_org_address'];
							$cmp_dets['city']     = $cmp_val['ori_cmp_org_city'];
							$cmp_dets['state']    = $cmp_val['ori_cmp_org_state'];
							$cmp_dets['pincode']  = $cmp_val['ori_cmp_org_pincode'];
							$cmp_dets['country']  = $cmp_val['ori_cmp_org_country'];
							$cmp_dets['plan']     = $cmp_val['ori_cmp_org_plan'];
							$cmp_dets['base_url'] = $cmp_val['ori_cmp_org_base_url'];
							$company_details[] 	  = $cmp_dets;
						}
						
						$company['company_details'] = $company_details;
						
						$api_call_log->updateLog($apilogid,$company_id,$company);
                        echo json_encode($company);die;
						
                    }
					else
					{
                        $result_arr= array('status'=>config('constant.API_AUTH_FAILURE'),'message'=>'Authentication Failure');
                        $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                        echo json_encode($result_arr);die;
                    }   
                }else{
                    $result_arr= array('status'=>config('constant.API_EMPTY_MANDATORY_FIELDS'),'message'=>'Please fill all mandatory fields');
                    $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                    echo json_encode($result_arr);die;
                 }
                   
        }catch(\Illuminate\Database\QueryException $ex)
        {
            $error      = $ex->getMessage();
            $data       = array('status'=>'DB_ERROR');
            $api_call_log->updateLog($apilogid,$company_id,$data,$error);
            return $data;
        }


    }
	
}
