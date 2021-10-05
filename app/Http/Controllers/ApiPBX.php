<?php
namespace App\Http\Controllers;
use App\ApiCallLog;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\CardDetail;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiPBX extends Controller
{
   public function __construct() {
		date_default_timezone_set("Asia/Kolkata");
                header('Access-Control-Allow-Origin: *');
	}
	/**
    * Login function for Mobile App
    * @author RINKU.E.B.
    * @date 09/04/2020
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function get_card_credentials(Request $request)
    {//echo "helo";die;
        $api_call_log   = new ApiCallLog;
        $apilogid       = $api_call_log->createLog($request);
        $updated_arr=array();
        $condition_arr=array();
        $result_arr=array();
		//$authentication 	= 	request('card_details');echo $authentication;die;
		try{
			
                $authentication_key = '123456789';
				$card_details =	stripslashes(request('card_details'));//echo $card_details;die;
                $card_details_arr = json_decode($card_details);//echo "<pre>";print_r($card_details_arr);//die;
					if(isset($authentication_key) && !empty($authentication_key))
					{
						if(count($card_details_arr) >0)
						{
							foreach($card_details_arr as $c_array)
							{//echo $c_array->mobile_no;die; //echo "<pre>";print_r($c_array);die;
								if(isset($c_array->mobile_no) && !empty($c_array->mobile_no) && isset($c_array->card_no) && !empty($c_array->card_no))
								{
									$condition_arr['card_no'] = $c_array->card_no;
									$updated_arr['mobile_no'] = $c_array->mobile_no;
									$updated_arr['created_at'] = $c_array->created_at;
									$res = CardDetail::updateOrCreate($condition_arr,$updated_arr);
									$result_arr= array('status'=>'success','msg'=>'added');
								}						
								else
								{
									$result_arr= array('status'=>'failure','msg'=>'empty data');
									
								}
								$api_call_log->updateLog($apilogid,'',$result_arr);
								echo json_encode($result_arr);//die;
							}							
						}						
					}
					else
					{
                    $result_arr= array('status'=>'Authentication Failure');
                    $api_call_log->updateLog($apilogid,'',$result_arr);
                    echo json_encode($result_arr);die;
                }
                    
        }catch(\Illuminate\Database\QueryException $ex)
        {
            $error      = $ex->getMessage();
            $data       = array('status'=>'DB_ERROR');
            $api_call_log->updateLog($apilogid,'',$data,$error);
            return $data;
        }


    }
	
}
