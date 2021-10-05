<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\QueryStatusQueryTypeRelation;
use App\Plan;
use App\Helpers;
use App\CompanyProfile;
use App\PackagePermission;
use App\Permission;
use App\UserRole;
use App\User;
use App\CmpRegPayment;
use App\CmpRegPaymentLog;
use App\CmpSubscriptions;
use App\PlanDuration;
use Carbon\Carbon;
use Auth;
use App\Http\Controllers\Controller;

class paymentController extends Controller
{
	
	public function __construct()
    {
        //$this->middleware('auth');
    }
	
	/**
    * Company Registration payment
    * @author Praneesha KP
    * @date 30/11/2018
    * @since version 1.0.0
    * @return order summary view
   */
	public function index($mnths=null,$plan=null,$amt=null,$cmp_id=null,$off=null,$off_amt=null,$c_amt=null,$coupon=null)
    {
		$res 	=	array();
		$res 	=  CompanyProfile::select('*')->where('id',$cmp_id)->get();
		
		return view('order_summary', compact('mnths','amt','cmp_id','off','off_amt','c_amt','coupon','res'));
    }
	
	
	/**
    * Encryption function for CcAvenue Request params 
    * @author Praneesha KP
    * @date 30/11/2018
    * @since version 1.0.0
    */
   
	public function data_encript($plainText,$key)
	{
			$secretKey = paymentController::hextobin(md5($key));
			$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
			$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
			$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
			$plainPad = paymentController::pkcs5_pad($plainText, $blockSize);
			if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
			{
				  $encryptedText = mcrypt_generic($openMode, $plainPad);
					  mcrypt_generic_deinit($openMode);
							
			} 
			return bin2hex($encryptedText);
	}
	
	/**
    * Decryption method for CcAvenue Response  
    * @author Praneesha KP
    * @date 30/11/2018
    * @since version 1.0.0
    */
	public function data_decrypt($encryptedText,$key)
	{
			$secretKey = paymentController::hextobin(md5($key));
			$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
			$encryptedText=paymentController::hextobin($encryptedText);
			$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
			mcrypt_generic_init($openMode, $secretKey, $initVector);
			$decryptedText = mdecrypt_generic($openMode, $encryptedText);
			$decryptedText = rtrim($decryptedText, "\0");
			mcrypt_generic_deinit($openMode);
			return $decryptedText;
		
	}
	//*********** Padding Function *********************

	 public function pkcs5_pad ($plainText, $blockSize)
	{
			$pad = $blockSize - (strlen($plainText) % $blockSize);
			return $plainText . str_repeat(chr($pad), $pad);
	}

	//********** Hexadecimal to Binary function for php 4.0 version ********

	public function hextobin($hexString) 
   	 { 
        	$length = strlen($hexString); 
        	$binString="";   
        	$count=0; 
        	while($count<$length) 
        	{       
        	    $subString =substr($hexString,$count,2);           
        	    $packedString = pack("H*",$subString); 
        	    if ($count==0)
		    {
				$binString=$packedString;
		    } 
        	    
		    else 
		    {
				$binString.=$packedString;
		    } 
        	    
		    $count+=2; 
        	} 
  	        return $binString; 
    }
	
	/**
    * Getting CcAvenue Request params
    * Payment starts here
    * @author Praneesha KP
    * @date 03/12/2018
    * @since version 1.0.0
    */
	
	public function ccavRequestHandler(Request $request)
    { 
			$response 			= 	$request->all();
			$order_id			=	$response['order_id'];
			$months				=	$response['months'];
			$plan				=	$response['plan'];
			$company_id			=	$response['company_id'];
			
			$percent_off		=	$response['off'];
			$off_amt			=	$response['off_amt'];
			$coupon_amt			=	$response['c_amt'];
			$coupon_code		=	$response['coupon'];
			
			if(isset($off_amt) && $off_amt != 'null' && $coupon_amt == 'null'){
				$total_discount		= $off_amt;}
			else if(isset($coupon_amt) && $coupon_amt != 'null' && $off_amt == 'null'){
				$total_discount		= $coupon_amt;
			}
			else{
				$total_discount		=	$coupon_amt+$off_amt;
			}
			
			$data =array
				('cmpny_id'   	=> $company_id,
				'plan_id' 		=> $plan,
				'order_id' 		=> $order_id,
				'subscription_period' 	=> $months,
				
				'discount_off'   	=> $off_amt,
				'coupon_code' 		=> $coupon_code,
				'total_discount' 	=> $total_discount,
				
				'status' 	    => 'Initiated');
				
			$payment 		= 	CmpRegPayment::updateOrCreate(['order_id'=> $order_id],$data);
			$payment_log 	= 	CmpRegPaymentLog::Create($data);
			
			error_reporting(0);
			$merchant_data='';
			$working_key='576C141736AC495D5087F4020CAD28FA';//Shared by CCAVENUES
			$access_code='AVDF81FK83BU09FDUB';//Shared by CCAVENUES
						
			foreach ($response as $key => $value){
				$merchant_data.=$key.'='.urlencode($value).'&';
			}

			$encrypted_data	=	paymentController::data_encript($merchant_data,$working_key);
			
				
		return view('ccavRequestHandler', compact('encrypted_data', 'access_code'));
    }
	
	/**
    * Updating payment table with CcAvenue Response
    * Updating subscyprion details
    * @author Praneesha KP
    * @date 03/12/2018
    * @since version 1.0.0
    */
	
	public function update_subscription_details(Request $request)
    {
		$response			=	$request->all();
		$payment_details	=	$response['payment_details'];
		
		$order_id="";$tracking_id="";$order_status="";$payment_mode="";$amount="";$email="";
		
		$decryptValues	=	explode('&', $payment_details);
		$dataSize		=	sizeof($decryptValues);
		$data			=	array();
		
		for($i = 0; $i < $dataSize; $i++) 
		{
			$information	=	explode('=',$decryptValues[$i]);
			if($i==0)	$order_id		=	$information[1];
			if($i==1)	$tracking_id	=	$information[1];
			if($i==3)	$order_status	=	$information[1];
			if($i==5)	$payment_mode	=	$information[1];
			if($i==10)	$amount			=	$information[1];
			if($i==18)	$email			=	$information[1];
		}
		
		$sbcryptn_status = config('constant.SUBSCRIPTION_STATUS');
		$result		=  CmpRegPayment::select('subscription_period','plan_id','cmpny_id','total_discount')
							 ->where('order_id',$order_id)
							 ->first();
									
		$sub_end_date		  =	Carbon::now()->addMonths($result['subscription_period']);
		$extended_expiry_date =	$sub_end_date->addDays(config('constant.EXTENDED_EXPIRY_IN_DAYS'));
		
		$data	=	array(
			'cmpny_id'		=>	$result['cmpny_id'],							
			'plan_id'		=>	$result['plan_id'],
			'order_id' 		=> 	$order_id,
			'tracking_id'	=>	$tracking_id,
			'payment_mode'	=>	$payment_mode,	
			'amount'		=>	$amount,
			'subscription_period'=>	$result['subscription_period'],						
			'transaction_details'=>	$payment_details,						
			'status'			 =>	$order_status);	
			
		$update_payment_log 	= 	CmpRegPaymentLog::Create($data);
		
		$update_payment 		= 	CmpRegPayment::updateOrCreate(
		[	
			'order_id'	=>$order_id
		],
		[	
			'order_id' 		=> 	$order_id,
			'tracking_id'	=>	$tracking_id,
			'payment_mode'	=>	$payment_mode,	
			'amount'		=>	$amount,
			'status'		=>	$order_status,	
		]);
		
		if(isset($order_status) && $order_status == 'Success'){
			$subscription_res 		= 	CmpSubscriptions::Create(
			[
				'cmpny_id' 			=> 	$result['cmpny_id'],
				'plan_id'			=>	$result['plan_id'],
				'transaction_id'	=>	$order_id,
				'amount'			=>	$amount,
				'discount_amount'			=>	$result['total_discount'],
				'subscription_start_date'	=>	Carbon::now(),
				'subscription_exp_date'		=>	$sub_end_date,
				'extended_expiry_date'		=>	$extended_expiry_date,
				'status'			=>	$sbcryptn_status[1],
			]);
		} 
		if(isset($order_status) && ($order_status) == 'Success')
		{
			//return view('subsriptions.subscription_success');
			return view('auth.login');
		}
		else
		{
			return view('subsriptions.subscription_failure');
		}
		
	}
	/**
    * placed order details 
    * @author Praneesha KP
    * @date 11/12/2018
    * @since version 1.0.0
    */
	
	public function order_summary(Request $request)
	{
		$response			=	$request->all(); 
		$res 				= 	array();
		$planid				=	$response['plan_id'];
		$plan				=	$response['plan'];
		$amount				=	$response['amount'];
		$cmp_id				=	$response['cmp_id'];
		$discount_amount	=	$response['discount'];//promo_discount
		$coupon_code		=	$response['coupon_code'];
		$discount_off		=	$response['discount_off'];
		$disc_off_amt		=	$response['disc_off_amt'];
		$first_sub_flag		=	$response['first_sub_flag'];
		$res				=	CompanyProfile::select('id','ori_cmp_org_plan','ori_cmp_org_email')
												->where('id',$cmp_id)
												->first();
		$amount				=	$amount-$disc_off_amt;
		
		if($res['ori_cmp_org_plan'] != $planid)
		{	
			
			$user_id = CompanyProfile::updateOrCreate(
			[
				'id' => $cmp_id,
			],
			[
				'ori_cmp_org_plan' => $planid,
			]);
			$permission_array = array();
				
				$record = PackagePermission::where('package_type',$planid)->where('status',config('constant.ACTIVE'))->get();
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
							
							$det=Permission::where('id',$selected)->first();	
							$access_permission_array[]=Array ( 'permission_id' => $selected,'permission_name' => $det->name); 
						}

					$permission_under_package = serialize($access_permission_array);
					
					$update_role = UserRole::updateOrCreate(
					[
					   'cmpny_id' => $cmp_id,
					   'role' => 'Administrator',
					],
					[
						'cmpny_id' => $cmp_id,
						'access_permission' => $permission_under_package,
					])->id;
					
					$user_id = User::updateOrCreate(
						[
						   'email' => $res['ori_cmp_org_email'],
						],
						[
							'role_id' => $update_role,
							'access_permission' => $permission_under_package,
						]);
					
				}
		}
		return view('subsriptions.order_details',compact('planid','plan','amount','coupon_code','discount_amount','discount_off','disc_off_amt','cmp_id','first_sub_flag'));
		
	}
	
	/**
    * Order summary in upgraded subscription 
    * @author Praneesha KP
    * @date 22/12/2018
    * @since version 1.0.0
    */
	public function upgraded_subscription(Request $request)
	{
		
		if (!empty(request('coupon_code')))
		{
			$coupon  = request('coupon_code');
		}else{$coupon  = '';}
		if (empty(request('term_length')))
		{
			return redirect()->back();  
		}
		$response			=	
		$request->all(); 
		$mnths				=	$response['term_length'];
		$valid_promo		=	$response['valid_promo'];
		$amt				=	$response['amt'];
		$package_type		=	$response['id_plan'];
		//$coupon				=	$response['coupon_code'];
		$off				=	$response['discount_off'];
		$off_amt			=	$response['off_amt'];
		$c_amt				=	$response['disc_amt'];
		$cmp_id				=	$response['cmp_id'];
		$res 				= 	array();
		
		$date 				= 	date('Y-m-d H:i:s');
		$res				=  	PlanDuration::select('ori_mast_plans_duration.amount','ori_mast_plans.discount')
								->leftjoin('ori_mast_plans','ori_mast_plans.id','=','ori_mast_plans_duration.plan_id')
								->where('ori_mast_plans_duration.status',config('constant.ACTIVE'))
								->where('ori_mast_plans_duration.plan_id',$package_type)
								->whereDate('ori_mast_plans_duration.start_date', '<=' , $date) 
								->whereDate('ori_mast_plans_duration.end_date', '>' , $date) 
								->first();
		/* if(isset($res['discount'])){						
			$dis_amount			=   ($res['discount'] / 100 * $res['amount']);
			$res['amount']		=	($res['amount'] - $dis_amount);	
		}  */		
		$amt				=	$mnths*$res['amount'];
          
		if(isset($valid_promo) && ($valid_promo==1))
		{
			$amt = $amt-$c_amt; 
		}
		//$amt=1;
		$res = CompanyProfile::select('*')->where('id',$cmp_id)->get();
		return view('order_summary', compact('mnths','amt','cmp_id','off','off_amt','c_amt','coupon','res'));
	}
	 
	 
	
}
