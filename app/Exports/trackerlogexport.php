<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Auth;
use App\Tracker;
use App\Helpers;

class trackerlogexport implements FromCollection,ShouldQueue,WithHeadings
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
        $prjt_id        = $this->data['prjt_id'] ?? '';
        $task    = $this->data['task'] ?? '';
        $from_time    = $this->data['from_time'] ?? '';
        $to_time    = $this->data['to_time'] ?? '';
        $status    = $this->data['status'] ?? '';

        $results = array();    
        $results = Tracker::with('task.project')->where('user_id',Auth::User()->id)->orderBy('id', 'asc');

        if(isset($from_time) && !empty($from_time))
		{
			$from_time = str_replace('/', '-', $from_time);
			$from_time = date('Y-m-d', strtotime($from_time)).' 00:00:00';
			$results->where('from_time', '>=', $from_time);
		}
		if(isset($to_time) && !empty($to_time))
		{
			$to_time = str_replace('/', '-', $to_time);
			$to_time = date('Y-m-d', strtotime($to_time)).' 23:59:59';
			$results->where('to_time', '<=', $to_time);
		}
		if(isset($status) && !empty($status))
		{
			$results->where('status', $status);
		}
		if(isset($prjt_id) && !empty($prjt_id)) 
        {
        $results->whereHas('task.project', function($results) use ($prjt_id){
            $results->where('project_id','=',$prjt_id);

        });
        }
		if(isset($task) && !empty($task))
		{
			$results->where('task_id', $task);
		}


        $results = $results->get();
        $export_data    = array();
        foreach ($results as $data)
        {
          
            $tracker_data    = array();
            $tracker_data['task']       =   $data->task->title ?? '';
            $tracker_data['project']     = $data->task->project->prjt_name;
            $tracker_data['from'] = \Carbon\Carbon::parse($data->from_time);
            $tracker_data['to'] = \Carbon\Carbon::parse($data->to_time);
           	$t1 = \Carbon\Carbon::parse($data->from_time);
			$t2 = \Carbon\Carbon::parse($data->to_time);
			$diff = $t1->diffInMinutes($t2);  
			$diff = $diff/60;  
            $tracker_data['hours']  = $diff;
            $tracker_data['status']     = Helpers::get_master_values($data->status);
            $export_data[]  = $tracker_data;
        }

        $export_data    = collect($export_data);


        return $export_data;
    }

    public function headings() : array
    {

    
      return [
          'Task',
          'Project',
          'From',
          'To',
          'Hours',
          'status'

      ];

      }

      public function map($export_data): array {

      return
      [
          $export_data['task'],
          $export_data['project'],
          $export_data['from'],
          $export_data['to'],
          $export_data['Hours'],
          $export_data['status']
      ];

    }
}
