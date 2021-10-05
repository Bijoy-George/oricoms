<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class CronLog extends Model
{
    use SoftDeletes;
    protected $table = 'ori_cron_logs';
    protected $guarded = [];
    
     /**
     * API Call log creation
     * @author Chinnu L
     * @date 20/07/2017
     * @since version 1.0.0
     * @param array $request
     * @return log id
    */
    public function createLog($call_path) {
            $calllog_insertion = CronLog::create(
                            [
                                'api'=>$call_path,
                                'call_start_time' => date('Y-m-d H:i:s'),
                            ]);
            return $cron_logid = $calllog_insertion->id;
    }
     /**
     * API Update api output and error reason
     * @author Chinnu L
     * @date 20/07/2017
     * @since version 1.0.0
     * @param array $request
     * @return log id
    */
    public function updateLog($cron_logid,$error='') {
        
            $updateDetails = CronLog::where('id', $cron_logid)
                ->update([
                    'call_end_time'    => date('Y-m-d H:i:s'),
                    'error_msg' => $error,
                    ]);
            if (is_null($updateDetails)) {
                return false;
            }
            return true;
    }
}
