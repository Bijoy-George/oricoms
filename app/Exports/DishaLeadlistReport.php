<?php

namespace App\Exports;

use App\CustomerProfile;
use App\CustomerProfileField;
use App\Helpdesk;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DishaLeadlistReport implements FromCollection,ShouldQueue,WithHeadings,WithCustomChunkSize
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
        $search_keywords = $this->data['search_keywords'] ?? '';
        $cmpny_id        =  $this->data['cmpny_id'] ?? '';
        $startdate       = $this->data['startdate'] ?? '';
        $enddate       =   $this->data['enddate'] ?? '';
        $leads     = array();

        $leads        = CustomerProfile::select('ori_customer_profiles.created_by','ori_customer_profiles.created_at', 'ori_customer_profiles.first_name', 'ori_customer_profiles.last_name','ori_customer_profiles.district_id','ori_customer_profiles.address','ori_customer_profiles.mobile','ori_helpdesk.req_title', 'ori_helpdesk.answer','ori_helpdesk.short_message','ori_mast_faq_categories.category_name')
        	->leftJoin('ori_helpdesk', 'ori_helpdesk.customer_id', '=', 'ori_customer_profiles.id')
        	->leftJoin('ori_mast_faq_categories', 'ori_mast_faq_categories.id', '=', 'ori_helpdesk.sub_query_category')
        	->where('ori_customer_profiles.cmpny_id',$cmpny_id)->with('profile_details','GetLeadSource','GetCreator','getDistrict')->orderBy('ori_customer_profiles.id', 'desc');

        if(isset($search_keywords) && !empty($search_keywords)) 
        {
                $leads->where(function($leads) use ($search_keywords){
                    $leads->orWhere('ori_customer_profiles.first_name', 'like', '%' . $search_keywords . '%');
                    $leads->orWhere('ori_customer_profiles.email', 'like', '%' . $search_keywords . '%');
                    $leads->orWhere('ori_customer_profiles.mobile', 'like', '%' . $search_keywords . '%');
                });
    	}
          if(isset($startdate) && !empty($startdate) && isset($enddate) && !empty($enddate))
        {
            $s_date        =   explode('/', $startdate);

            if(isset($s_date[2]) && !empty($s_date[2]) && isset($s_date[1]) && !empty($s_date[1]) && isset($s_date[0]) && !empty($s_date[0]) )
            {
            $startdate    =   $s_date[2].'-'.$s_date[1].'-'.$s_date[0];
            $startdate    =   date('Y-m-d', strtotime($startdate));
            }
            $e_date        =   explode('/', $enddate);
            
            if(isset($e_date[2]) && !empty($e_date[2]) && isset($e_date[1]) && !empty($e_date[1]) && isset($e_date[0]) && !empty($e_date[0]) )
            {
            $enddate      =   $e_date[2].'-'.$e_date[1].'-'.$e_date[0];
            $enddate      =   date('Y-m-d', strtotime($enddate));
            }
            $enddate      =   date('Y-m-d', strtotime($enddate));
            $leads->where('ori_customer_profiles.created_at', '>=', $startdate.' 00:00:00')
            ->where('ori_customer_profiles.created_at', '<=', $enddate.' 23:59:59');
        } 

        $leads = $leads->get();

        $export_data   = array();

     foreach ($leads as $lead) 
        {
        	// $latest_helpdesk	= Helpdesk::select('req_title', 'answer','short_message','sub_query_category')->where('customer_id', $lead->id)->whereNull('deleted_at')->orderBy('id','DESC')->first();
            $leads_data  = array();
            $leads_data['agent_number']	= $lead->GetCreator->agent_number ?? '';
            $leads_data['created_date']		= !empty($lead->created_at) ? date('d/m/Y', strtotime($lead->created_at)) : '';
            $leads_data['created_time']		= !empty($lead->created_at) ? date('H:i', strtotime($lead->created_at)) : '';
            $leads_data['customer_name']  = $lead->first_name;
			$leads_data['customer_name']	.= (isset($lead->last_name) && !empty($lead->last_name)) ? ' ' . $lead->last_name : '';
             $leads_data['district']	= $lead->getDistrict->name ?? '';
             $leads_data['address']	= $lead->address;
             $leads_data['mobile']	= $lead->mobile;
             $leads_data['nearest_health_facility']	= $lead->profile_details->where('field_id', 245)->first()->value ?? '';
			$leads_data['number_of_family_members']	= $lead->profile_details->where('field_id', 246)->first()->value ?? '';
			$leads_data['date_of_arrival']	= $lead->profile_details->where('field_id', 247)->first()->value ?? '';
			$leads_data['purpose_of_call']	= $lead->req_title ?? '';
			$leads_data['type_of_call']	= $lead->category_name ?? '';
			$leads_data['action_taken']	= strip_tags(str_replace("&nbsp;", '',$lead->answer)) ?? '';
			$leads_data['remarks']	= $lead->short_message ?? '';
             $export_data[]     = $leads_data;
        }

        $export_data	= collect($export_data);

        return $export_data;
    }

    public function headings() : array
    {
        return [
            'Agent Number',
            'Date',
            'Time',
            'Name',
            'District',
            'Address',
            'Phone No.',
            'Nearest Health Facility',
            'No. of family members of the caller',
            'Date of arrival in home',
            'Purpose of the call',
            'Type of call',
            'Action taken',
            'Remarks'
        ];
    }

    public function map($export_data): array {
        return [
            $export_data['agent_number'],
            $export_data['created_date'],
            $export_data['created_time'],
            $export_data['customer_name'],
            $export_data['district'],
            $export_data['address'],
            $export_data['mobile'],
            $export_data['nearest_health_facility'],
            $export_data['number_of_family_members'],
            $export_data['date_of_arrival'],
            $export_data['purpose_of_call'],
            $export_data['type_of_call'],
            $export_data['action_taken'],
            $export_data['remarks']
        ];
    }

    public function chunkSize(): int
    {
    	return 100;
    }
}
