<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\CompanyProfile;
use Auth;
use App\CompanyMeta;
use App\Plan;
use App\PlanDuration;
use App\User;
use App\UserRole;
use App\PasswordHistory;
use App\PasswordSecurity;
use App\CouponCodes;
use App\Permission;
use Carbon\Carbon;
use App\Helpers;
use Illuminate\Support\Facades\Hash;
use App\CustomerProfile;
use App\PackagePermission;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;


/*
    * Profile Controller
    * @author AKHIL MURUKAN
    * @author PRANEESHA KP
    * @date 11/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return
*/


class CompanyRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
	
   /*
    * Available Plan details
    * @author AKHIL MURUKAN
    * @author PRANEESHA KP
    * @date 11/13/2018
    * @since version 1.0.0
    * @param NULL
    * @return profile page
    */
    public function index()
    {
		$date = date('Y-m-d H:i:s');
		$plan_list 	  =  PlanDuration::where('status',config('constant.ACTIVE'))
						 ->whereDate('start_date', '<=' , $date) 
						 ->whereDate('end_date', '>' , $date) 
						 ->get();
		foreach($plan_list as $plan)
		{
			$planid	=	$plan->plan_id;
			$amount	=	$plan->amount;
			$res			   =  CouponCodes::select('ori_mast_coupon_codes.coupon_code','ori_mast_coupon_codes.discount','ori_mast_coupon_codes.disc_flag')
									->whereDate('ori_mast_coupon_codes.valid_from', '<' , $date)
									->where('plan_id',$planid)
									->whereDate('ori_mast_coupon_codes.valid_to', '>=' , $date) 
									->first();
			$plan->coupon_code	= $res['coupon_code'];
			$plan->discount		= $res['discount'];
			$plan->disc_flag	= $res['disc_flag'];
			if(isset($plan->disc_flag) && ($plan->disc_flag == 1))
			{
				$plan->discount = ($plan->discount * 100/$amount);
			}
									
		}
		return view('auth.choose_plan',compact('plan_list'));
    }
	
	
	
	public function addtocart(Request $request)
    {   
	
		$this->validate($request,[
            'term_length' => 'required',
            'amt' => 'required',
		],[
			'term_length.required' => 'Please choose subscription duration.',
			'amt.required' => 'Choose your subscription.',
		]);
		$response          =  $request->all();
		$mnths				=	$response['term_length'];
		$valid_promo		=	$response['valid_promo'];
		$amount            =  $response['amt'];
		$plan              =  $response['plan'];
		$planid            =  $response['id_plan'];
		$coupon_code       =  $response['coupon_code'];
		$discount_amount   =  $response['disc_amt'];
		$discount_off      =  $response['discount_off'];
		$disc_off_amt      =  $response['off_amt'];
		
		return view('auth.registration',compact('amount','plan','planid','coupon_code','discount_amount','discount_off','disc_off_amt','mnths','valid_promo'));
		
    }

        public function edit($id)
    {
        $company = CompanyProfile::findOrFail($id);
        // $list = CompanyProfile::select('id','ori_cmp_org_name','ori_cmp_org_email','ori_cmp_org_phone','ori_cmp_org_mobile','ori_cmp_org_address','ori_cmp_org_city','ori_cmp_org_state','ori_cmp_org_pincode','ori_cmp_org_country')->get();
        // dd($company);   

        return view('auth.registration',compact('company'));
    }
	
	public function store(Request $request)
    {
		$this->validate($request,[
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:50|unique:ori_users,email|unique:ori_company_profiles,ori_cmp_org_email,'.request('email'),
			'username' => 'required|string|max:50|unique:ori_users,username,NULL,id,deleted_at,NULL',
			// 'phone' => 'required|numeric|digits_between:10,15',
			'mobile' => 'required|numeric|digits_between:10,15',
			// 'address' => 'required|max:100',
			// 'city' => 'required|string|max:100',
			// 'state' => 'required|string|max:100',
			// 'pincode' => 'required|numeric|digits_between:5,10',
			// 'country' => 'required|string|max:100',
			'package_type' => 'required',
			'term_length' => 'required',
			'password' => 'required|string|min:8|confirmed',
		],[
			'username.unique' => 'Username has been already taken.',
			'term_length.required' => 'Please choose subscription duration.',
			'phone.numeric' => 'Please enter valid phone number.',
			'phone.digits_between' => 'Please enter valid phone number.',
    	]);
			
		$response           =   $request->all();
        $name               =   $response['name'];   
        $email              =   $response['email'];   
        $phone              =   $response['phone'];   
        $address            =   $response['address'];   
        $package_type       =   $response['package_type'];   
        $username           =   $response['username'];   
        $password           =   $response['password'];   
        $term_length        =   $response['term_length'];
        $amt        		=   $response['amt'];
        $mobile        		=   $response['mobile'];
        $city        		=   $response['city'];
        $state        		=   $response['state'];
        $pincode        	=   $response['pincode'];
        $country        	=   $response['country'];
        $amt        		=   $response['amt'];
        $country_code       =   $response['country_code'];
        $valid_promo        =   $response['valid_promo'];
        $coup_amt       	=   $response['disc_amt'];
        $coupon       		=   $response['coupon_code'];
		
		$percent_off        =   $response['discount_off'];
        $off_amt       		=   $response['off_amt'];
		
		
		$date 				= 	date('Y-m-d H:i:s');
		$res				=  	PlanDuration::select('ori_mast_plans_duration.amount','ori_mast_plans.discount')
								->leftjoin('ori_mast_plans','ori_mast_plans.id','=','ori_mast_plans_duration.plan_id')
								->where('ori_mast_plans_duration.status',config('constant.ACTIVE'))
								->where('ori_mast_plans_duration.plan_id',$package_type)
								->whereDate('ori_mast_plans_duration.start_date', '<=' , $date) 
								->whereDate('ori_mast_plans_duration.end_date', '>' , $date) 
								->first();
		if(isset($res['discount'])){						
			$dis_amount			=   ($res['discount'] / 100 * $res['amount']);
			$res['amount']		=	($res['amount'] - $dis_amount);	
		} 		
		$amount				=	$term_length*$res['amount'];
          
		
		if(isset($valid_promo) && ($valid_promo==1))
		{
			$amount = $amount-$coup_amt; 
		}
		//$amount           	=   1; 
		
		 $user_id = CompanyProfile::updateOrcreate([
          'ori_cmp_org_name' 	=> $name,
          'ori_cmp_org_email' 	=> $email,
          'ori_cmp_org_phone' 	=> $phone,
          'ori_cmp_org_address' => $address,
          'ori_cmp_org_country_code' => $country_code,
          'ori_cmp_org_mobile' 	=> $mobile,
          'ori_cmp_org_city' 	=> $city,
          'ori_cmp_org_state' 	=> $state,
          'ori_cmp_org_pincode' => $pincode,
          'ori_cmp_org_country' => $country,
          'ori_cmp_org_plan' 	=> $package_type,
          'status' => config('constant.ACTIVE'),
		]);
        if(isset($user_id->id) && !empty($user_id->id))
			{
				$company_id = $user_id->id;
				$permission_array = array();
				
				$record = PackagePermission::where('package_type',$package_type)->where('status',config('constant.ACTIVE'))->get();
				if(count($record) > 0)
				{
					foreach($record as $pack_per)
					{
						$access_permission = unserialize($pack_per->permission_under_package);
							foreach ($access_permission as $row)
							{
									$access_perm[]=$row['permission_id'];
							}				
					}
					$access_perm_array = array_unique($access_perm);
					foreach($access_perm_array as $selected)
						{
							
							//print_r($selected);die;
							$det=Permission::where('id',$selected)->first();	
							$access_permission_array[]=Array ( 'permission_id' => $selected,'permission_name' => $det->name); 
						}

					$permission_under_package = serialize($access_permission_array);
					
					/*** create role***/
					$create['role'] = 'Administrator';
					$create['access_permission'] = $permission_under_package;
					$create['created_by'] = 1;
					$create['updated_by'] = 1;
					$create['cmpny_id'] = $company_id;
					$craete_role = UserRole::create($create);
					/************/
					/*** create user***/
					if(isset($craete_role->id) && !empty($craete_role->id))
					{
						$role_id[] =$craete_role->id;
						$chat_name = NULL;
						  if (isset($email) && !empty($email))
						  {
							$agent_email  = $email;

								$temp_agentusername = explode('@',$agent_email); // get agent user name from email
							$chat_name=$temp_agentusername[0];
						  }
						$user_id = User::updateOrcreate([
							  'name' => $name,
							  'cmpny_id' => $company_id,
							  'username' => $username,
							  'email' => $email,
							  'phone' => $phone,
							  'address' => $address,
							  'access_permission' => $permission_under_package,
							  'password' => Hash::make($password),
							  'role_id' => serialize($role_id),
							  'current_chat_count' => 0,
							  'chat_flag' => config('constant.ACTIVE'),
							  'status' => config('constant.ACTIVE'),
							  'chat_name'=>$chat_name
						  ]);
							$passwordHistory = PasswordHistory::create([
								'user_id' => $user_id->id,
								'cmpny_id' => $user_id->cmpny_id,
								'password' => Hash::make($password)
							]);
							$passwordSecurity = passwordSecurity::updateOrCreate(
								[
									'user_id' => $user_id->id,
									'cmpny_id' => $user_id->cmpny_id,
								],
								[
									'password_expiry_days' => config('constant.password_expiry_days'),
									'password_updated_at' => Carbon::now()
								]);
					}
					/************/
					helpers::add_basic_master_data($company_id);
				}
			 
			}
		if(is_null($user_id))
		{
		   return redirect()->back();
        } 
		else 
		{ 
			$name		=	rawurlencode($name);
			$email		=	rawurlencode($email);
			$phone		=	rawurlencode($phone);    
			$address	=	rawurlencode($address);
			$mobile		=	rawurlencode($mobile);
			$city		=	rawurlencode($city);
			$state		=	rawurlencode($state);
			$pincode	=	rawurlencode($pincode);
			$country	=	rawurlencode($country);
			
			$result_arr=array('months'=>$term_length,'plan'=>$package_type,'amount'=>$amount,'company_id'=>$company_id,'status'=>'success','success' => true,'message' => 'success','percent_off'=>$percent_off,'off_amt'=>$off_amt,'coup_amt'=>$coup_amt,'coupon'=>$coupon);
			return json_encode($result_arr);
		}
	}
	/**
    * placed order details 
    * @author Praneesha KP
    * @date 11/12/2018
    * @since version 1.0.0
    */
	
	public function choose_subcr_period(Request $request)
	{
		
		$response			=	$request->all(); 
		$res 				= 	array();
		$planid				=	$response['plan_id'];
		$plan				=	$response['plan'];
		$amount				=	$response['amount'];
		$discount_amount	=	$response['discount'];//promo_discount
		$coupon_code		=	$response['coupon_code'];
		$discount_off		=	$response['discount_off'];
		$disc_off_amt		=	$response['disc_off_amt'];
		$amount				=	$amount-$disc_off_amt;

		
		return view('subsriptions.order_details',compact('amount','plan','planid','coupon_code','discount_amount','discount_off','disc_off_amt'));
	}
}
