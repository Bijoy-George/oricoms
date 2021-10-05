<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use App\FeedbackDetail;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping; 
class UserExport implements FromCollection, ShouldQueue, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    private $search_value;
    public function __construct($details) {
        $this->search_value = $details;
    }
  
     public function collection()
    {
        $search_criteria=$this->search_value;
        $cond_arr=array('status'=>1,'cmpny_id'=>$search_criteria['cmpny_id']);
        if(isset($search_criteria['rating_id']) && !empty($search_criteria['rating_id']))
        {
            $cond_arr['rating']=$search_criteria['rating_id'];
        }
        if(isset($search_criteria['search_keyword']) && !empty($search_criteria['search_keyword']))
        {
            $cond_arr['fb_type']=$search_criteria['search_keyword']; 
        }
         $fb_details=FeedbackDetail::with('feedback_profile')->with('channels')->with('chat_reference')->with(['feedback_reference' => function ($q) use($search_criteria) { 
                if(isset($search_criteria['agent_id']) && !empty($search_criteria['agent_id'])) {
                    $q->Where('ori_helpdesk.created_by',$search_criteria['agent_id']);
                }
        }])->where($cond_arr)
        ->get();
        return $fb_details;
        
    }
   /* public function query()
    {
    	$search_criteria=$this->search_value;
    	$cond_arr=array('status'=>1,'cmpny_id'=>$search_criteria['cmpny_id']);
    	if(isset($search_criteria['rating_id']) && !empty($search_criteria['rating_id']))
        {
        	$cond_arr['rating']=$search_criteria['rating_id'];
        }
        if(isset($search_criteria['search_keyword']) && !empty($search_criteria['search_keyword']))
        {
        	$cond_arr['fb_type']=$search_criteria['search_keyword']; 
        }
    	 $fb_details=FeedbackDetail::query();
         //->with('feedback_profile','feedback_reference')
         //->where($cond_arr)
         /*->whereHas('feedback_reference', function($q) use($search_criteria) {
                if(isset($search_criteria['agent_id']) && !empty($search_criteria['agent_id'])) {
                    $q->Where('ori_helpdesk.created_by',$search_criteria['agent_id']);
                }
        });*/
       
       /* return $fb_details;
       
        
        
    }*/
    public function headings() : array
    {
        return [
            'Sl No',
            'Customer Name',
            'Docket Number',
            'comments',
            'Rating',
            'Channel',
            'Agent Name',
            'Submitted on',
        ];
    }

    public function map($fb_details): array {
      $rating_arr=config('constant.FB_RATING'); 
      if(!empty($fb_details['reference_id']))
      {
        $ref_id=$fb_details['reference_id'];
      }else if(!empty($fb_details['reference_id']))
      {
        $ref_id=$fb_details['thread_id'];
      }else{
        $ref_id='';
      }
      if(isset($fb_details['feedback_reference'][0]['name']) && !empty($fb_details['feedback_reference'][0]['name'])){
        $name=$fb_details['feedback_reference'][0]['name'];
      }else  if(isset($fb_details['chat_reference'][0]['name']) && !empty($fb_details['chat_reference'][0]['name'])){
        $name=$fb_details['chat_reference'][0]['name'];
      }else{
        $name='';
      }
      if(isset($fb_details['channels']['name']) && !empty($fb_details['channels']['name'])){
        $channel=$fb_details['channels']['name'];
      }else {
        $channel='';
      }
      
     
        return [
            $fb_details->id,
            $fb_details['feedback_profile']['first_name'],
            $ref_id,
            $fb_details['comments'],
            $rating_arr[$fb_details['rating']],
            $channel,
            $name,
            $fb_details['created_at']->format('d-m-Y H:i:s A'),
            
        ];
    }
}
