<?php

namespace App\Exports;
use App\Project;
use App\ProjectTask;
use App\Helpers;
use App\Tracker;
use Auth; 
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class projecttasklistreport implements FromCollection,ShouldQueue,WithHeadings
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
        $search_keywords        = $this->data['search_keywords'] ?? '';
        $status    = $this->data['status'] ?? '';
        $startdate    = $this->data['startdate'] ?? '';
        $enddate    = $this->data['enddate'] ?? '';


        $results = array();    
        $results = Project::where('status',config('constant.ACTIVE'))->orderBy('id', 'desc');

        if(isset($search_keywords) && !empty($search_keywords)) 
        {
            $results->where(function($results) use ($search_keywords){
                $results->orWhere('prjt_name', 'like', '%' . $search_keywords . '%');
            });
        }
        if(isset($status) && !empty($status)) 
        {
            $results->where('project_status', $status);
        }
        if(isset($start_date) && !empty($start_date)) 
        {
            $start_date = str_replace('/', '-', $start_date);
            $start_date = date('Y-m-d', strtotime($start_date)).' 00:00:00';
            $results->where('created_at', '>', $start_date);
        }
        if(isset($end_date) && !empty($end_date)) 
        {
            $end_date = str_replace('/', '-', $end_date);
            $end_date = date('Y-m-d', strtotime($end_date)).' 23:59:59';
            $results->where('created_at', '<=', $end_date);
        }


        $results = $results->get(); 
        $export_data    = array();
        foreach ($results as $data)
        {
          $status = Helpers::get_master_values($data->project_status);
          $member = unserialize($data->members);
          $member_name = '';
          foreach ($member as  $value) 
          {
            $member_name .= Helpers::get_username_by_id($value).',';
          }
          $member_name = rtrim($member_name,',');

          $total_track_time = Tracker::select('id','from_time','to_time','task_id')->where('task_id',$data->id)->where('user_id',Auth::user()->id)->get();
          $time = 0;
          foreach ($total_track_time as $track) 
          {
            $actual_start_at = \Carbon\Carbon::parse($track['from_time']);
            $actual_end_at   = \Carbon\Carbon::parse($track['to_time']);
            $mins            = $actual_end_at->diffInMinutes($actual_start_at, true);
            $mins            = $mins/60;
            $time = $time+$mins;
            $title =Helpers::get_task_details($track['task_id']);
          }

          $task_data    = array();
            
            $task_data['task']  = $title->title ?? '';
            $task_data['project']     = $data->prjt_name ?? '';
            $task_data['members']  = $member_name;
            $task_data['created_date']  = \Carbon\Carbon::parse($data->created_at)->format('d/m/Y');
            $task_data['due_date'] = \Carbon\Carbon::parse($data->due_date)->format('d/m/y');
            $task_data['total_time'] = $time;
            $task_data['status']     = $status;
            $export_data[]  = $task_data;

        }
        $export_data    = collect($export_data);

        return $export_data;
    }

    public function headings() : array
    {

    
      return [
          'Task',
          'Project',
          'Members',
          'Created date',
          'Due date',
          'Time Taken',
          'status'

      ];

      }

      public function map($export_data): array {

      return
      [
          $export_data['task'],
          $export_data['project'],
          $export_data['members'],
          $export_data['created_date'],
          $export_data['due_date'],
          $export_data['status'],
      ];

      }
}
