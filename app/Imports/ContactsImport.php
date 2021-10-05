<?php

namespace App\Imports;

use App\AutomatedProcessRelations;
use App\CmpContact;
use App\CmpContactMeta;
use App\CustomerProfile;
use App\CustomerProfileField;
use App\CustomerProfileMeta;
use App\Exports\ContactsImportFailedReport;
use App\GroupContact;
use App\GroupExcelImportBatch;
use App\GroupExcelImportFailedRow;
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

class ContactsImport implements ToCollection, WithHeadingRow, ShouldQueue, WithValidation, WithChunkReading, SkipsOnFailure, SkipsOnError
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
            $customer   = null;
            $default_db_fields  = CustomerProfileField::where('ori_customer_profile_fields.type', config('constant.DEFAULT_FEILD'))
                                    ->where('ori_customer_profile_fields.status', config('constant.ACTIVE'))
                                    ->where('ori_customer_profile_fields.cmpny_id', $this->group->cmpny_id)
                                    ->orderBy('ori_customer_profile_fields.sort_order', 'asc')
                                    ->get();
            $custom_db_fields   = CustomerProfileField::where('ori_customer_profile_fields.type', config('constant.CUSTOM_FIELD'))
                                    ->where('ori_customer_profile_fields.status', config('constant.ACTIVE'))
                                    ->where('ori_customer_profile_fields.cmpny_id', $this->group->cmpny_id)
                                    ->orderBy('ori_customer_profile_fields.sort_order', 'asc')
                                    ->get();
            $contact_exist  = false;
            $customer_exist = false;
            $validation_rule_data    = array();
            foreach ($this->field_map as $excel_heading => $field_id)
            {
                $db_field = CustomerProfileField::find($field_id);
                $selected_fields_data[$field_id]    = $db_field;

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
            }

            //Find if contact exist with the mapped unique data
            do
            {
                if (!empty($unique_data))
                {
                    //Check if contact exist with unique data
                    foreach ($unique_data as $field_id => $value)
                    {
                        $field_name = $selected_fields_data[$field_id]->field_name;
                        $contact = CmpContact::with('contact_details')
                                    ->where('ori_cmp_contacts.'.$field_name, $value)
                                    ->first();

                        if ($contact)
                        {
                            break 2;
                        }
                    }
                }

                //If no contact exist with unique_data
                if (!empty($unique_custom_data))
                {
                    foreach ($unique_custom_data as $field_id => $value)
                    {
                        $contact = CmpContact::with('contact_details')
                                    ->whereHas('contact_details', function($query) use($field_id, $value) {
                                        $query->where('field_id', $field_id);
                                        $query->where('value', $value);
                                    })
                                    ->first();

                        if ($contact)
                        {
                            break 2;
                        }
                    }
                }
            }
            while(false);

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
                                    ->whereHas('profile_details', function($query) use ($field_id, $value) {
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

            //If no contact exist but customer exist with mapped data, create new contact with data from customer
            if (!$contact && $customer)
            {
                $contact_data = array();
                foreach ($default_db_fields as $db_field)
                {
                    $field_name = $db_field->field_name;
                    $contact_data[$field_name]  = $customer->$field_name;
                }
                $contact_data['user_id']    = $customer->id;
                $contact_data['cmpny_id']   = $this->group->cmpny_id;
                $contact_data['source']     = $this->lead_source;
                $contact_data['status']     = config('constant.ACTIVE');

                $contact = CmpContact::create($contact_data);

                $custom_customer_data   = $customer->profile_details;
                $contact_meta_data  = array();
                foreach ($custom_customer_data as $customer_field)
                {
                    $contact_meta_data[]    = array(
                        'cmpny_id'      => $this->group->cmpny_id,
                        'contact_id'    => $contact->id,
                        'field_name'    => $customer_field->field_name,
                        'value'         => $customer_field->value,
                        'field_id'      => $customer_field->field_id,
                        'sort_order'    => $customer_field->sort_order,
                        'status'        => $customer_field->status
                    );
                }

                CmpContactMeta::insert($contact_meta_data);
                $contact = CmpContact::where('ori_cmp_contacts.id', $contact->id)
                                ->with('contact_details')
                                ->first();

                break;
            }

            if ($contact)
            {
                $contact_exist = true;
            }
            if ($customer)
            {
                $customer_exist = true;
            }

            if ($contact_exist && !$this->skip_existing)
            {
                $contact_data = array();
                foreach ($default_data as $field_id => $value)
                {
                    $field_name = $selected_fields_data[$field_id]->field_name;
                    $contact_data[$field_name]  = $value;
                }
                if (empty(array_filter(array_values($contact_data))))
                {
                    continue;
                }
                $contact->fill($contact_data);

                foreach ($custom_data as $field_id => $value)
                {
                    $field_name = $selected_fields_data[$field_id]->field_name;
                    $sort_order = $selected_fields_data[$field_id]->sort_order;
                    $contact_custom_field_data  = CmpContactMeta::updateOrCreate([
                        'cmpny_id'      => $this->group->cmpny_id,
                        'contact_id'    => $contact->id,
                        'field_id'      => $field_id
                    ],[
                        'field_name'    => $field_name,
                        'value'         => $value,
                        'sort_order'    => $sort_order,
                        'status'        => config('constant.ACTIVE')
                    ]);
                }
                $contact->load('contact_details');
            }
            //Else if no contact or customer exists with the given mapped data, create new contact with excel data
            elseif (!$contact_exist)
            {
                $contact_data = array();
                foreach ($default_data as $field_id => $value)
                {
                    $field_name = $selected_fields_data[$field_id]->field_name;
                    $contact_data[$field_name]  = $value;
                }

                if (empty(array_filter(array_values($contact_data))))
                {
                    continue;
                }

                $contact_data['cmpny_id']   = $this->group->cmpny_id;
                $contact_data['source']     = $this->lead_source;
                $contact_data['status']     = config('constant.ACTIVE');

                $contact = CmpContact::create($contact_data);

                $contact_meta_data  = array();
                foreach ($custom_data as $field_id => $value)
                {
                    $field_name = $selected_fields_data[$field_id]->field_name;
                    $sort_order = $selected_fields_data[$field_id]->sort_order;
                    $contact_meta_data[]    = array(
                        'cmpny_id'      => $this->group->cmpny_id,
                        'contact_id'    => $contact->id,
                        'field_name'    => $field_name,
                        'value'         => $value,
                        'field_id'      => $field_id,
                        'sort_order'    => $sort_order,
                        'status'        => config('constant.ACTIVE')
                    );
                }
                if (!empty($contact_meta_data))
                {
                    CmpContactMeta::insert($contact_meta_data);
                }

                $contact->load('contact_details');
            }

            $group_contact  = GroupContact::updateOrCreate([
                'cmpny_id'      => $this->group->cmpny_id,
                'group_id'      => $this->group->id,
                'contact_id'    => $contact->id
            ], [
                'status'    => config('constant.ACTIVE')
            ]);

            $batch->last_processed_id = $row_id;
            $batch->save();

            if ($this->add_to_leads)
            {
                try {
                    Validator::make($row->toArray(), $validation_rule_data)->validate();
                }
                catch(ValidationException $e)
                {
                    GroupExcelImportFailedRow::create([
                        'cmpny_id'          => $this->group->cmpny_id,
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
                    $field_value    = $field_value ?? $contact->$field_name;

                    $customer_data[$field_name]   = $field_value;
                }
                $customer_data['cmpny_id']          = $this->group->cmpny_id;
                $customer_data['source']            = $this->lead_source;
                $customer_data['profile_status']    = config('constant.LEAD');
                $customer_data['status']            = config('constant.ACTIVE');

                if (!$customer)
                {
                    $customer = CustomerProfile::create($customer_data);
                }
                else
                {
                    $customer = CustomerProfile::updateOrCreate([
                        'id'    => $customer->id
                    ], $customer_data);
                }

                foreach ($custom_db_fields as $db_field)
                {
                    $field_name       = $db_field->field_name;
                    $field_id         = $db_field->id;
                    $sort_order       = $db_field->sort_order;
                    $field_value      = $default_data[$field_id] ?? NULL;
                    $contact_field    = $contact->contact_details->where('field_id', $field_id)->first();
                    if ($contact_field)
                    {
                        $field_value = $field_value ?? $contact_field->value;
                    }

                    $customer_meta_field    = CustomerProfileMeta::updateOrCreate([
                        'cmpny_id'  => $this->group->cmpny_id,
                        'user_id'   => $customer->id,
                        'field_id'  => $field_id
                    ], [
                        'field_name'    => $field_name,
                        'value'         => $field_value,
                        'sort_order'    => $sort_order,
                        'status'        => config('constant.ACTIVE')
                    ]);
                }

                $contact->user_id   = $customer->id;
                $contact->save();

                // $auto_stage_activation = Helpers::get_company_meta('auto_stage_activation', $this->group->cmpny_id);
                // $auto_lead_stage = Helpers::get_company_meta('sales_automation_lead_stage', $this->group->cmpny_id);
                /////////// AUTOMATED PROCESS CODES STARTS HERE ////////////

                // if($auto_stage_activation==1)
                // {
                //     if(isset($auto_lead_stage) && !empty($auto_lead_stage))
                //     {
                //         Helpers::auto_process_params($this->group->cmpny_id,$customer->id,$auto_lead_stage);
                //         // $fresults = CustomerProfile::where('id',$customer_id)->first();
                //         if($customer)
                //         {
                //             $upd = array(
                //             '[[ First Name ]]' => $customer->first_name
                //             );
                //             $updarr = array('mail_field' => json_encode($upd));
                //             AutomatedProcessRelations::where('customer_id',$customer->id)->where('cmpny_id',$this->group->cmpny_id)->limit(1)->update($updarr);
                //         }
                //     }
                // }
                /////////// AUTOMATED PROCESS CODES ENDS HERE ////////////
            }
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    /**
     * @param Failure[] $failures
     */
    public function onFailure(Failure ...$failures)
    {
        // Handle the failures how you'd like.
        dd($failures);
    }

    /**
     * @param \Throwable $e
     */
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
        dd($e);
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
