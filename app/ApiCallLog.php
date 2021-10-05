<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiCallLog extends Model
{
   protected $table = 'ori_api_call_logs';
   protected $guarded = [];
   
   /**
     * API Call log creation
     * @author Loraine Varghese
     * @date 12/10/2018
     * @since version 1.0.0
     * @param array $request
     * @return log id
    */
	
	public function createLog($request) 
	{
		$api_path         = $request->path();
		$inputs           = json_encode($request->all());
		$headers          = json_encode($request->header());
		$apilog_insertion = ApiCallLog::create(
			[
				'cmpny_id'=>0,
				'api'=>$api_path,
				'inputs' => $inputs,
				'headers' => $headers
			]);
		return $apilogid = $apilog_insertion->id;
    }
	
	/**
     * API Update api output and error reason
     * @author Loraine Varghese
     * @date 12/10/2018
     * @since version 1.0.0
     * @param array $request
     * @return log id
    */
    public function updateLog($apilogid,$cmpnyid,$data=array(),$error='') 
	{
		$updateDetails = ApiCallLog::where('id', $apilogid)
			->update([
				'cmpny_id'  => $cmpnyid,
				'output'    => json_encode($data),
				'error_msg' => $error,
				]);
		if (is_null($updateDetails)) 
		{
			return false;
		}
		return true;
    }
}
