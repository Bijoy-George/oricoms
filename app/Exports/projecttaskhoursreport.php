<?php

namespace App\Exports;
use App\Project;
use App\ProjectTask;
use App\User;
use App\Helpers;
use App\Tracker;
use Carbon\Carbon;
use Auth; 
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class projecttaskhoursreport implements FromCollection,ShouldQueue,WithHeadings
{

	use Exportable;
	public $data;
	 public function __construct($data)
    {
        $this->data = $data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   
        $startdate    = $this->data['startdate'] ?? '';
        $enddate    = $this->data['enddate'] ?? '';
        $project_id    = $this->data['project_id'] ?? '';
        if(isset($startdate) && !empty($startdate)) 
        {
            $start_date = str_replace('/', '-', $startdate);
            $start_date = date('Y-m-d', strtotime($start_date)).' 00:00:00';
            //$results->where('from_time', '>=', $start_date);
        }
		else
		{
			$start_date = date('Y-m-d').' 00:00:00';
		}
        if(isset($enddate) && !empty($enddate)) 
        {
            $end_date = str_replace('/', '-', $enddate);
            $end_date = date('Y-m-d', strtotime($end_date)).' 23:59:59';
           // $results->where('from_time', '<=', $end_date);
        }
		else
		{
			$end_date = date('Y-m-d').' 23:59:59';
		}
       
        $results = array();    
        $out_array = array();
        $res_array = array();
		$users = User::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('name')->pluck('id');//echo "<pre>";print_r($users);die;
		if(count($users)>0)
		{
			$i = 0;
			foreach($users as $user)
			{
                $taken_time = 0;
                $task_arr = array();
				$out_array[$i]['user_id'] = $user;

                 $res_array = Tracker::select('ori_tracker.id','ori_tracker.task_id','ori_tracker.from_time','ori_tracker.to_time')
                           ->where('ori_tracker.user_id',$user)
                           ->where('ori_tracker.from_time','>=',$start_date)
                           ->where('ori_tracker.from_time','<=',$end_date);
			
			     if(isset($project_id) && !empty($project_id)) 
				 {
					 $res_array =  $res_array->join('ori_project_tasks','ori_project_tasks.id','=','ori_tracker.task_id')->where('ori_project_tasks.project_id',$project_id);
				 }
                // dd($res_array);           
				$results = $res_array;//print_r($res_array);
				$res_array = $res_array->get();//print_r($res_array);
				
                if(count($res_array)>0)
				{
					foreach($res_array as $res)//echo $res_array->from_time;die;
					{
						$from = Carbon::parse($res->from_time);

						$to = Carbon::parse($res->to_time);
						$diff_in_mins = $to->diffInMinutes($from);//echo $diff_in_mins.'-';
						$taken_time = $taken_time + $diff_in_mins;//return $taken_time;
						$task_arr[] = $res->task_id;//echo $diff_in_mins.'---';
					}
				}
				$out_array[$i]['taken_time'] = round($taken_time/60,1);//echo $taken_time.'takennnn'.$user.'<br>';
				$out_array[$i]['task_ids'] = array_unique($task_arr);
				$i++;

			}
			
		}

     
        $export_data    = array();
        foreach ($out_array as $data)
        {
      
         
            $task_data    = array();
            $pname    = array();
            $p_name    = "";
			foreach($data['task_ids'] as $tsk_id){
			$pid = Helpers::get_task_details($tsk_id)->project_id; 
			$pname[] = Helpers::get_project_details($pid)->prjt_name;}
			$p_name = implode(",",$pname);
			
            $task_data['members']  = Helpers::get_username_by_id($data['user_id']);
            $task_data['spent_time']  = $data['taken_time'];
            $task_data['project_name']     = $p_name;
            $export_data[]  = $task_data;
        }
	   
        $export_data    = collect($export_data);

       
        return $export_data;
    }

    public function headings() : array
    {

    
      return [
          'Members',
          'Spent Time',
          'Projects',
          

      ];

      }

      public function map($export_data): array {

      return
      [
          $export_data['members'],
          $export_data['spent_time'],
          $export_data['project_name'],
         
      ];

      }
}
