<?php

namespace App\Exports;
use App\CustomerProfile;
use App\CustomerProfileField;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithMapping;

class LeadlistReport implements FromCollection,ShouldQueue,WithHeadings
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
        $country = $this->data['country'] ?? '';
        $cmpny_id        =  $this->data['cmpny_id'] ?? '';
        $startdate       = $this->data['startdate'] ?? '';
        $enddate       =   $this->data['enddate'] ?? '';
        $leads     = array();


        $fields = CustomerProfileField::select('field_name')->where('cmpny_id',$cmpny_id)
                     ->where('type',config('constant.DEFAULT_FEILD'))->where('report_field',1)->where('status',config('constant.ACTIVE'))->get();
        	$cust_fields = CustomerProfileField::select('id','label')
					 ->where('cmpny_id',$cmpny_id)
					 ->where('type',config('constant.CUSTOM_FIELD'))
                     ->where('status',config('constant.ACTIVE'))
					 ->where('report_field',1)
					 ->get();
		$deflt_fields = CustomerProfileField::select('id','label','field_name')
					 ->where('cmpny_id',$cmpny_id)
					 ->where('type',config('constant.DEFAULT_FEILD'))
                     ->where('status',config('constant.ACTIVE'))
					 ->where('report_field',1)
					 ->get();
        $leads        = CustomerProfile::where('cmpny_id',$cmpny_id)->with('profile_details','GetLeadSource')->orderBy('id', 'desc');

        if(isset($search_keywords) && !empty($search_keywords)) 
        {
                $leads->where(function($leads) use ($search_keywords){
                    $leads->orWhere('first_name', 'like', '%' . $search_keywords . '%');
                    $leads->orWhere('email', 'like', '%' . $search_keywords . '%');
                    $leads->orWhere('mobile', 'like', '%' . $search_keywords . '%');
                });
    	}
        if(isset($country) && !empty($country))
        {
            $leads->where('country_id', $country);
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

            $leads_data  = array();
             foreach($deflt_fields as $fields)
             {
                $label[] = $fields->label;
                if ($fields->field_name == 'country_id')
                {
                    $labelvalue = $lead->getCountry->name;
                }
                else if ($fields->field_name == 'state_id')
                {
                    $labelvalue = $lead->getState->name;
                }
                else if ($fields->field_name == 'district_id')
                {
                    $labelvalue = $lead->getDistrict->name;
                }
                else
                {
                 $labelvalue = $lead[$fields->field_name];
                }
                 $leads_data[] = $labelvalue ?? '';

             }
            $details = $lead->profile_details ?? NULL;

              foreach ($cust_fields as $val) {

                $fieldid = $val->id;
               $label[]= $val->label;
                $flag = FALSE;

                foreach ($details as  $detail) {
                    if($detail->field_id == $fieldid)
                    {
                        $leads_data[] = $detail['ProfileOptions']['options'] ??  $detail['ProfileOptions']['options'] ?? $detail->value ?? $detail->value ?? '';
                        $flag = TRUE;
                        break;
                    }
                }
                if (!$flag)
                {
                    $leads_data[]   = '';
                }
             }
             // $leads_data[]  = $lead->GetLeadSource['name'] ?? '';
             // $leads_data [] = config('constant.profile_status')[$lead->profile_status];
             // $leads_data[]  = $lead->created_at;
             $export_data[]     = $leads_data;
        }
        $export_data	= collect($export_data);

        return $export_data;

	}
  	public function headings() : array
    {
          $cmpny_id        =  $this->data['cmpny_id'] ?? '';
        $cust_fields = CustomerProfileField::select('id','label')
                     ->where('cmpny_id',$cmpny_id)
                     ->where('type',config('constant.CUSTOM_FIELD'))
                     ->where('status',config('constant.ACTIVE'))
                     ->where('report_field',1)
                     ->get();
        $deflt_fields = CustomerProfileField::select('id','label','field_name')
                     ->where('cmpny_id',$cmpny_id)
                     ->where('type',config('constant.DEFAULT_FEILD'))
                     ->where('status',config('constant.ACTIVE'))
                     ->where('report_field',1)
                     ->get();
                       foreach($deflt_fields as $fields)
             {
                $label[] = $fields->label;
             }

              foreach ($cust_fields as $val) {

               $label[]= $val->label;
           }
           // $label = array_merge($label,['Lead Source','Profile Status','Created At']);
            return $label;
    }
}



