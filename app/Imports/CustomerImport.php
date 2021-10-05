<?php

namespace App\Imports;

use App\CmpContact;
use App\CmpContactMeta;
use App\CustomerProfile;
use App\Helpdesk;
use App\User;
use App\LocationSettings;
use App\FaqCategories;
use App\CustomerProfileField;
use App\CustomerProfileMeta;
use App\Exports\ContactsImportFailedReport;
use App\GroupContact;
use App\GroupExcelImportBatch;
use App\GroupExcelImportFailedRow;
use App\AutomatedProcessRelations;
use App\AutomatedProcessRelationsCustomer;
use App\Helpers;
use Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Validators\Failure;

class CustomerImport implements ToCollection, WithHeadingRow, ShouldQueue, WithValidation, WithChunkReading, SkipsOnFailure, SkipsOnError
{
    use Importable;
	
    public $group;
	public $field_map;
	public $skip_existing;
	public $add_to_leads;
	public $lead_source;
    public $batch_id;

	public function __construct($group, $field_map, $skip_existing, $add_to_leads, $lead_source, $batch_id)
	{
        $this->group            = $group;
		$this->field_map		= $field_map;
		$this->skip_existing	= $skip_existing;
		$this->add_to_leads		= $add_to_leads;
		$this->lead_source		= $lead_source;
        $this->batch_id         = $batch_id;
	}
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $helpdesk_data      = array();
		//$date = "";
		//$time = "";
		Log::info('Success');

        $batch = GroupExcelImportBatch::find($this->batch_id);
        $row_id = $batch->last_processed_id ?? 0;
        foreach ($collection as $row)
        {
            $row_id++;
            $selected_fields_data   = array();
            $unique_data = array();
            $unique_custom_data = array();
            $default_data = array();
            $custom_data = array();
            $contact    = null;
            $customer   = null; $cmpny_id = 2;
            $default_db_fields  = CustomerProfileField::where('ori_customer_profile_fields.type', config('constant.DEFAULT_FEILD'))
                                    ->where('ori_customer_profile_fields.status', config('constant.ACTIVE'))
                                    ->where('ori_customer_profile_fields.cmpny_id', $cmpny_id)
                                    ->orderBy('ori_customer_profile_fields.sort_order', 'asc')
                                    ->get();
            $custom_db_fields   = CustomerProfileField::where('ori_customer_profile_fields.type', config('constant.CUSTOM_FIELD'))
                                    ->where('ori_customer_profile_fields.status', config('constant.ACTIVE'))
                                    ->where('ori_customer_profile_fields.cmpny_id', $cmpny_id)
                                    ->orderBy('ori_customer_profile_fields.sort_order', 'asc')
                                    ->get();

            $contact_exist  = false;
            $customer_exist = false;
            $validation_rule_data    = array();
			
            foreach ($this->field_map as $excel_heading => $field_id)
            {
                
				$db_field = CustomerProfileField::find($field_id);
				
                $selected_fields_data[$field_id]    = $db_field;
                //print_r($selected_fields_data[$field_id]);die;
                if ($db_field->type == config('constant.DEFAULT_FEILD'))
                {
                    $default_data[$field_id]    = $row[$excel_heading];
                    if ($db_field->is_unique == config('constant.ACTIVE'))
                    {
                        $unique_data[$field_id] = $row[$excel_heading];
                    }
                }
                elseif ($db_field->type == config('constant.CUSTOM_FIELD'))
                {
                    $custom_data[$field_id]    = $row[$excel_heading];
                    if ($db_field->is_unique == config('constant.ACTIVE'))
                    {
                        $unique_custom_data[$field_id] = $row[$excel_heading];
                    }
                }

                if ($db_field->required == 1)
                {
                    $validation_rule_data[$excel_heading]    = 'required';
                }
				/* if($excel_heading == "agent_number_disha_counselor"){
					$agent_user_id=User::where('agent_number',)->first();
				} */
            }

            

            //Find if profile exist with the mapped unique data if no contact exist with the data
            do {
                if (!empty($unique_data))
                {
                    //Check if customer exist with unique data
                    foreach ($unique_data as $field_id => $value)
                    {
                        $field_name = $selected_fields_data[$field_id]->field_name;
                        $customer = CustomerProfile::with('profile_details')
                                        ->where('ori_customer_profiles.'.$field_name, $value)
                                        ->first();

                        if ($customer)
                        {
                            break 2;
                        }
                    }
                }

                //If no customer exist with unique_data
                if (!empty($unique_custom_data))
                {
                    foreach ($unique_custom_data as $field_id => $value)
                    {  
					  
                        $customer = CustomerProfile::with('profile_details')
                                    ->whereHas('profile_details', function($query) {
                                        $query->where('field_id', $field_id);
                                        $query->where('value', $value);
                                    })
                                    ->first();

                        if ($customer)
                        {
                            break 2;
                        }
                    }
                }
            }
            while(false);


            if ($contact)
            {
                $contact_exist = true;
            }
            if ($customer)
            {
                $customer_exist = true;
            }

            if (!$customer)
            {
                try {
                    Validator::make($row->toArray(), $validation_rule_data)->validate();
                }
                catch(ValidationException $e)
                {
                    GroupExcelImportFailedRow::create([
                        'cmpny_id'          => 2,
                        'batch_process_id'  => $batch->id,
                        'row_id'            => $row_id,
                        'row_data'          => json_encode($row),
                        'failure_type'      => config('constant.EXCEL_IMPORT_FAILURE_TYPES.VALIDATION'),
                        'failure_message'   => $e->getMessage(),
                        'status'            => config('constant.ACTIVE')
                    ]);
                    continue;
                }
                $customer_data      = array();

	
                foreach ($default_db_fields as $db_field)
                {

                    $field_name     = $db_field->field_name;
                    $field_id       = $db_field->id;
                    $field_value    = $default_data[$field_id] ?? NULL;
                    $field_value    = $field_value ?? 1;
					$customer_data[$field_name]   = $field_value;
			    //// * START 24/03/2020 *///	    
	                if($field_name == 'district_id'){
						$district_id = LocationSettings::select('id')->where('type', 'district')
                                       ->where('name',$field_value)->first();
					   $customer_data['district_id']   = $district_id['id'];
					
					}
				//// * END 24/03/2020 *///	
                    
					
                }
				
                $customer_data['cmpny_id']          = $cmpny_id;
                $customer_data['source']            = $this->lead_source;
                $customer_data['profile_status']    = config('constant.LEAD');
                $customer_data['status']            = config('constant.ACTIVE');
                $customer_data['created_by']            = config('constant.ACTIVE');
                                   

                $customer = CustomerProfile::create($customer_data);
			
				
                foreach ($custom_db_fields as $db_field)
                {
                    $created_id = null;
					$field_name       = $db_field->field_name;
                    $field_id         = $db_field->id;
					
				    $sort_order       = $db_field->sort_order;
                    $field_value      = $custom_data[$field_id] ?? NULL;
                    $contact_field    = 0;
                    if ($contact_field)
                    {
                        $field_value = $field_value ?? $contact_field->value;
                    }
					
					
                    $customer_meta_field    = CustomerProfileMeta::updateOrCreate([
                        'cmpny_id'  => $cmpny_id,
                        'user_id'   => $customer->id,
                        'field_id'  => $field_id
                    ], [
                        'field_name'    => $field_name.'1',
                        'value'         => $field_value,
                        'sort_order'    => $sort_order,
                        'status'        => config('constant.ACTIVE'),
						
						
                    ]);
					
			//// * START 24/03/2020 *///	
                    			
                    if($field_name == 'agent_id'){
						
						$id  = User::select('id')->where('agent_number',$field_value)->whereNotNull('agent_number')
                                ->first();
						 
						$created_id=$id['id'];
						$helpdesk_data['created_by'] = $created_id;
						$update = CustomerProfile::where('id',$customer->id)->update(['created_by'=>$created_id]);
					}
					if($field_name == 'date'){
						$date1 = strtr($field_value, '/', '-');
                      	$date = date('Y-m-d', strtotime($date1));
						//echo $date = strtotime($field_value);
					   
					}
					if($field_name == 'time'){
						$time = $field_value;
					   
					}
					
				    if($field_name == 'type_of_call'){
						$sub_query_category = FaqCategories::select('id')->where('category_name',$field_value)->first();
				
					}
					
					if($field_name == 'purpose_of_call'){$helpdesk_data['question'] = $field_value;}
					if($field_name == 'action_taken'){$helpdesk_data['answer'] = $field_value;}
					if($field_name == 'remarks'){$helpdesk_data['short_message'] = $field_value;}
					$helpdesk_data['cmpny_id']  = $cmpny_id;
					$helpdesk_data['customer_id'] = $customer->id;
			//// * END 24/03/2020 *///
				}
			//// * START 24/03/2020 *///
			    $helpdesk_data['sub_query_category'] = $sub_query_category['id'];
		        $datetime = date('Y-m-d H:i:s', strtotime("2020-04-20 $time"));	
                $helpdesk_data['created_at'] = $datetime;				
				$helpdesk = Helpdesk::where('id',$customer->id)->updateOrCreate($helpdesk_data);
				$customer_created_by  = CustomerProfile::select('created_by')->where('id',$customer->id)->first();
				$helpdesk_update = Helpdesk::where('id',$helpdesk->id)->update(['created_by'=>$customer_created_by['attended_by']]);
				
			//// * END 24/03/2020 *///	
				
               // $contac/t->user_id   = $customer->id;
                //$contact->save();

                ///////// CODE FOR AUTO PROCESS WHILE ADDING A NEW LEAD STARTS /////////
								
				$auto_stage_activation = Helpers::get_company_meta('auto_stage_activation_customer',$cmpny_id);
				$auto_lead_stage = Helpers::get_company_meta('sales_automation_lead_stage',$cmpny_id);
				if($auto_stage_activation == config('constant.ACTIVE'))
				{
					if(isset($auto_lead_stage) && !empty($auto_lead_stage))
					{
					Helpers::auto_process_params_customer($cmpny_id,$customer->id,$auto_lead_stage);
					//$fresults = CustomerProfile::where('id',$customer_id)->where('cmpny_id',$cmpny_id)->first();
						if($customer)
						{
						$upd = array(
						'[[ First Name ]]' => $customer->first_name
						);
						$updarr = array('mail_field' => json_encode($upd));
						AutomatedProcessRelationsCustomer::where('customer_id',$customer->id)->where('cmpny_id',$cmpny_id)->update($updarr);
						}
					}
				}
								
				///////// CODE FOR AUTO PROCESS WHILE ADDING A NEW LEAD ENDS /////////
            }
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function chunkSize(): int
    {
        return 10;
    }

    /**
     * @param Failure[] $failures
     */
    public function onFailure(Failure ...$failures)
    {
        // Handle the failures how you'd like.
        // dd($failures);
    }

    /**
     * @param \Throwable $e
     */
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
        // dd($e);
    }

    public function rules(): array
    {
        $validation_rule_data = array();
        foreach ($this->field_map as $excel_heading => $field_id)
        {
            $db_field = CustomerProfileField::find($field_id);
            if ($db_field->required == 1)
            {
                $validation_rule_data[$excel_heading]    = 'required';
            }
        }
        return $validation_rule_data;
    }
}
