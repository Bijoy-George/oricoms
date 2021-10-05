<?php
namespace App\Http\Controllers;
use App\ApiCallLog;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberType;
use Brick\PhoneNumber\PhoneNumberFormat;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers;
use App\CommunicationHelper;
use App\Afterhourcall; 

class ApiCallcenter extends Controller
{
    public function __construct() {
		date_default_timezone_set("Asia/Kolkata");
                header('Access-Control-Allow-Origin: *');
	}
    /**
     * push user list for voicebroadcast
     * @author          Chinnu L
     * @since           Version 1.0
     * @date            22-12-2018
     * @since version 1.0.0
     */
    public function push_custom_voicebroadcast_list()
    {
        try{
        
//            $today = date('Y-m-d');
            $usetlist = array();
            $userid = array();
            $voicebroadcast_det=cc_common_sms_email::select('cc_common_sms_email.id','cc_common_sms_email.customer_id','cc_common_sms_email.cmpny_id','cc_common_sms_email.mobile','cc_common_sms_email.VBC_time')
                    ->where('sent_type',config('constant.CO_VOICE_BROADCAST'))
                    ->whereNotNull('VBC_time')
                    ->where('VBC_time','!=','')
                    ->where('cc_common_sms_email.status',config('constant.INACTIVE'))
                    ->limit(20)->get();
           
            if(!empty($voicebroadcast_det) && count($voicebroadcast_det)>0)
            {
                    foreach ($voicebroadcast_det as $value)
                    {
                        
                            if(!in_array($value->mobile, $userid))
                            {
                                $VBC_time = $value->VBC_time;
                                $VBC_time = Carbon::createFromFormat('Y-m-d H:i:s', $VBC_time)->subMinutes(1);
                                $VBC_time = $VBC_time->format('Y-m-d H:i:s a');
                                
                                $usetlist[] = array(
                                        "id" => $value->id,
                                        "customer_id" => $value->customer_id,
                                        "cmpny_id" => $value->cmpny_id,
                                        "mobile" => $value->mobile,
                                        "VBC_time" => $value->VBC_time
                                    );
                                $userid[] = $value->mobile;
                            }
                            $ids[] = $value->id;
                        
                    }
                    $details = array(
                        'status' => config('constant.ACTIVE'),
                    );
                   // cc_common_sms_email::wherein('id',$ids)->update($details);
            }
            return json_encode($usetlist);die;
            } catch (Exception $ex) {
                    $error      = $ex->getMessage();
                    $api_call_log   = new ApiCallLog;
                    $apilogid       = $api_call_log->createLog($request);
                    $data       = array('status'=>'DB_ERROR');
                    $api_call_log->updateLog($apilogid,$company_id,$data,$error);
            return $data;
        }
    }  
          /*  afterhour calls
     * @author AKHIL MURUKAN
    * @date 28/09/2018
    * @since version 1.0.0
    * @param NULL
    * @return
   */
        public function insert_abandonedcalls(Request $request)
	{

            try
            {
                $response = $request->all();
                if(isset($response['data']))
                {
                    $data = json_decode($response['data']);
                    if(!empty($data))
                    {
                        foreach ($data as $value) 
                        {
                            
                      //  print_r($value);die;
                            if(isset($value->number) && !empty($value->number)&& $value->number != 'unknown' && isset($value->dat) && !empty($value->dat))
                            {

                                    $request_mob = $value->number;
                                    if(strlen($request_mob) == 10)
                                    {
                                            $request_mob ='91'.$request_mob;
                                    }
                                    if(strlen($request_mob)>8 ) {
                                            $request_mob = CommunicationHelper::sanitize_uae_number($request_mob);
                                            $request_mob = '+'.$request_mob;
                                            $number = PhoneNumber::parse($request_mob);
                                            //$number = PhoneNumber::parse('+447123456789');
                                            //$number->getRegionCode(); // GB
                                            $country_code = $number->getCountryCode(); // 44
                                            $country_code = '+'.$country_code;
                                            $ph_mumber = $number->getNationalNumber(); // 7123456789
                                    }
                                    else 
                                    {
                                            $country_code = '';
                                            $ph_mumber = $request_mob;
                                    }
                                    

                                   $condition_arr['cmpny_id'] = 2;
                                   $condition_arr['Phone'] = $ph_mumber;
                                   $condition_arr['country_code'] = $country_code;
                                   $condition_arr['type'] = $value->type;
                                   $condition_arr['created_at'] = $value->dat;



                                   $results=Afterhourcall::firstOrCreate($condition_arr);
                                   if(isset($results->id))
                                   { //echo $results;
                                      $return_array[] = $value->uniqueid;
                                   }
                            }
                        }
                    }
                }
            }
            
          catch (Exception $ex) {
                    $error      = $ex->getMessage();
                    $api_call_log   = new ApiCallLog;
                    $apilogid       = $api_call_log->createLog($request);
                    $data       = array('status'=>'DB_ERROR');
                    $api_call_log->updateLog($apilogid,$company_id,$data,$error);
          }
            return $return_array;

	}
	

}
