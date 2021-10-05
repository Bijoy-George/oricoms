<?php

namespace App\Http\Controllers;

use App\CmpContact;
use App\CmpContactMeta;
use App\CustomerProfile;
use App\CustomerProfileField;
use App\Exports\ContactsImportFailedReport;
use App\Group;
use App\GroupContact;
use App\GroupExcelImportBatch;
use App\Http\Requests\GroupExcelImportRequest;
use App\Imports\ContactsImport;
use App\Jobs\NotifyContactImportFailedReportCompletion;
use App\Jobs\TestJob;
use App\LeadSourceType;
use App\LeadSources;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\HeadingRowImport;

class GroupContactsController extends Controller
{
    
    public function __construct()
    {
    	$this->middleware('auth');
        $this->middleware('check-permission:group lead import', ['only' => ['lead_index', 'search_list', 'add_leads']]);
        $this->middleware('check-permission:group excel import', ['only' => ['excel_index', 'map_excel_fields', 'add_leads', 'create_excel_import_batch']]);
    }

    /*
    * GROUP IMPORT LEAD LIST CONTAINER VIEW
    * @author RAHUL R.
    * @date 10/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return group import list container view with filters
    */
    public function lead_index(Group $group)
    {
    	return view('group_contacts.lead_index', compact('group'));
    }

    /*
    * GROUP IMPORT LEAD LIST VIEW
    * @author RAHUL R.
    * @date 07/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return group import lead list view
    */
    public function search_list(Request $request, Group $group)
    {
        $search_keywords    = $request->post('search_keywords');

        $fields = CustomerProfileField::select('field_name')->where('cmpny_id',Auth::User()->cmpny_id)
                     ->where('type',config('constant.DEFAULT_FEILD'))->where('report_field',1)->where('status',config('constant.ACTIVE'))->get();
        $cust_fields = CustomerProfileField::select('id','label')
                     ->where('cmpny_id',Auth::User()->cmpny_id)
                     ->where('type',config('constant.CUSTOM_FIELD'))
                     ->where('status',config('constant.ACTIVE'))
                     ->where('report_field',1)
                     ->get();
        $deflt_fields = CustomerProfileField::select('id','label','field_name')
                     ->where('cmpny_id',Auth::User()->cmpny_id)
                     ->where('type',config('constant.DEFAULT_FEILD'))
                     ->where('field_name', '!=', 'profile_photo')
                     ->where('status',config('constant.ACTIVE'))
                     ->where('report_field',1)
                     ->get();

        $profile_has_photo  = CustomerProfileField::select('id','label','field_name')
                     ->where('cmpny_id',Auth::User()->cmpny_id)
                     ->where('type',config('constant.DEFAULT_FEILD'))
                     ->where('field_name', 'profile_photo')
                     ->where('status',config('constant.ACTIVE'))
                     ->where('report_field',1)
                     ->first();

         $results   = CmpContact::select('ori_cmp_contacts.*')
                    ->join('ori_group_contacts', 'ori_group_contacts.contact_id', '=', 'ori_cmp_contacts.id')
                    ->where('ori_cmp_contacts.cmpny_id',Auth::User()->cmpny_id)
                    ->where('ori_group_contacts.group_id', $group->id)
                    ->where('ori_group_contacts.status', config('constant.ACTIVE'))
                    ->with('contact_details');

         if(isset($search_keywords) && !empty($search_keywords))
         {
            $results->where(function ($q2) use ($search_keywords,$deflt_fields) {

        
                $q2->where(function ($q3) use ($search_keywords,$deflt_fields) {
                    foreach($deflt_fields as $fields)
                    {
                        $fname = $fields->field_name;
                        $q3->orWhere($fname, 'like', '%' . $search_keywords . '%');
                    }
                }); 
                $q2->orWhereHas('contact_details', function($q4) use($search_keywords) 
                {
                    $q4->where('value', 'like', '%' . $search_keywords . '%');
                });
            }); 
                        
         }

         $list_count = $results->count();
        $results   =   $results->paginate(config('constant.pagination_constant'));

		$html =	view('group_contacts.members_listview')->with(compact('results','fields','cust_fields','deflt_fields','list_count', 'group', 'profile_has_photo'))->render();
		$result_arr=array('success' => true,'html' => $html);
		echo json_encode($result_arr);
    }

    /*
    * ADD GIVEN CONTACT LIST TO GROUP
    * @author RAHUL R.
    * @date 12/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return status and message
    */
    public function add_leads(Request $request, Group $group)
    {
    	$contact_list	= trim($request->post('contact_list'));
    	$contact_ids 	= explode(',', $contact_list);
    	$success		= false;
    	$message		= 'Could not add leads to the group';

    	do {
    		//Fetching contacts to filter valid contacts from customer profile
    		$leads	= CustomerProfile::where('ori_customer_profiles.cmpny_id',Auth::User()->cmpny_id)
    							->whereIn('ori_customer_profiles.id', $contact_ids)
    							->where('ori_customer_profiles.status', config('constant.ACTIVE'))
                                ->with('profile_details')
                                ->get();

			if (count($leads) < 1)
			{
				$message	= 'Could not find any valid contacts.';
				break;
			}

            $cust_fields = CustomerProfileField::select('id','label')
                     ->where('cmpny_id',Auth::User()->cmpny_id)
                     ->where('type',config('constant.CUSTOM_FIELD'))
                     ->where('status',config('constant.ACTIVE'))
                     ->where('report_field',1)
                     ->get();
            $deflt_fields = CustomerProfileField::select('id','label','field_name')
                 ->where('cmpny_id',Auth::User()->cmpny_id)
                 ->where('type',config('constant.DEFAULT_FEILD'))
                 ->where('status',config('constant.ACTIVE'))
                 ->where('report_field',1)
                 ->get();

			$leads->each(function($lead) use ($group,$cust_fields,$deflt_fields) {
                $lead_meta_details  = $lead->profile_details;

                $contact_id         = 0;
                $customer_contact   = CmpContact::select('id')->where(['user_id' => $lead->id])->first();

                //If Customer already exists in contact list
                if (isset($customer_contact->id) && !empty($customer_contact->id))
                {
                    //Update Contact data with new Customer Profile data
                    $contact_update_array   = array();
                    foreach ($deflt_fields as $deflt_field)
                    {
                        $deflt_field_name   = $deflt_field->field_name;
                        $contact_update_array[$deflt_field_name] = $lead->$deflt_field_name;
                    }
                    CmpContact::where('id', $customer_contact->id)
                                    ->update($contact_update_array);

                    //Create or Update Contact Meta Data with new Customer Profile Data
                    foreach ($lead_meta_details as $lead_meta_prop)
                    {
                        CmpContactMeta::updateOrCreate([
                            'cmpny_id'      => $lead->cmpny_id,
                            'contact_id'    => $customer_contact->id,
                            'field_id'      => $lead_meta_prop->field_id
                        ], [
                            'field_name'    => $lead_meta_prop->field_name,
                            'value'         => $lead_meta_prop->value,
                            'sort_order'    => $lead_meta_prop->sort_order,
                            'status'        => $lead_meta_prop->status
                        ]);
                    }

                    $contact_id = $customer_contact->id;
                }
                else
                {
                    //Create new contact from customer profile
                    $new_contact_array  = array();
                    foreach ($deflt_fields as $deflt_field)
                    {
                        $deflt_field_name   = $deflt_field->field_name;
                        $new_contact_array[$deflt_field_name]   = $lead->$deflt_field_name;
                    }

                    $new_contact_array['cmpny_id']  = $lead->cmpny_id;
                    $new_contact_array['user_id']   = $lead->id;
                    $new_contact_array['source']    = $lead->source;
                    $new_contact_array['status']    = $lead->status;

                    $new_contact = CmpContact::create($new_contact_array);

                    //Create contact meta fields from customer profile meta fields
                    foreach ($lead_meta_details as $lead_meta_prop)
                    {
                        CmpContactMeta::create([
                            'cmpny_id'      => $lead_meta_prop->cmpny_id,
                            'contact_id'    => $new_contact->id,
                            'field_name'    => $lead_meta_prop->field_name,
                            'value'         => $lead_meta_prop->value,
                            'field_id'      => $lead_meta_prop->field_id,
                            'sort_order'    => $lead_meta_prop->sort_order,
                            'status'        => $lead_meta_prop->status
                        ]);
                    }

                    $contact_id = $new_contact->id;
                }

                //Add or update contact to the group
				GroupContact::updateOrCreate([
					'group_id'		=> $group->id,
					'contact_id'	=> $contact_id,
				], [
					'cmpny_id'		=> $lead->cmpny_id,
					'status'		=> config('constant.ACTIVE')
				]);
			});

			$success 	= true;
			$message	= 'Contacts added successfully';
    	}
    	while(false);

    	$result_arr	= array('success' => $success,'message' => $message);
    	return $result_arr;
    }

    /*
    * GROUP IMPORT EXCEL LIST CONTAINER VIEW
    * @author RAHUL R.
    * @date 10/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return group excel import list container view with filters
    */
    public function excel_index(Group $group)
    {
    	$lead_source_types	= LeadSourceType::where('status', config('constant.ACTIVE'))->pluck('source_type', 'id')->all();
    	$lead_source_types	= ['' => 'Select Category'] + $lead_source_types;
    	return view('group_contacts.excel_index', compact('group', 'lead_source_types'));
    }

    /*
    * FETCH LEAD SOURCES BY LEAD SOURCE TYPE
    * @author RAHUL R.
    * @date 12/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return json encoded lead source list
    */
    public function get_lead_sources(Request $request)
    {
    	$lead_sources = [];
    	$lead_source_type = (int)$request->post('source_type');

    	if ($lead_source_type > 0)
    	{
    		$lead_sources = LeadSources::where('lead_source_type_id', $lead_source_type)
    									->where('status', config('constant.ACTIVE'))
    									->pluck('name', 'id')
    									->all();
    	}

    	return json_encode($lead_sources);

    }

    /*
    * MAP FIELDS WITH EXCEL COLUMNS
    * @author RAHUL R.
    * @date 12/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return mapping view
    */
    public function map_excel_fields(GroupExcelImportRequest $request, Group $group)
    {
        $lead_source_type   = $request->post('source_type');
        $lead_source        = $request->post('lead_source');
        $comment            = $request->post('comments');
        $original_file_name   = request('file')->getClientOriginalName();
    	$filename = time(). '.' . request('file')->getClientOriginalExtension();
    	request('file')->move(storage_path('app/import'), $filename);
        $file_path  = storage_path('app/import') . '/' . $filename;
        
        if (!file_exists($file_path))
        {
            return redirect()->back()->with('error','The file could not be uploaded.');
        }

        //Fetch Headings from excel
    	$excel_headings	= (new HeadingRowImport)->toArray('import/' . $filename);
        if (empty($excel_headings) || empty($excel_headings[0]) ||empty($excel_headings[0][0]))
        {
            return redirect()->back()->with('error','The file does not contain any heading');
        }
    	$excel_headings  = $excel_headings[0][0];
        $excel_headings = array_filter($excel_headings);

        $customer_fields    = CustomerProfileField::where('cmpny_id',Auth::User()->cmpny_id)
                            ->where('status', config('constant.ACTIVE'))
                            ->pluck('label', 'id')
                            ->all();

        return view('group_contacts.map_excel_fields', compact('filename', 'excel_headings', 'customer_fields', 'group', 'lead_source_type', 'lead_source', 'comment', 'original_file_name'));
        
    }

    public function create_excel_import_batch(Request $request, Group $group)
    {
        $file_name  = $request->post('file_name');
        $success    = false;
        $message    = 'Could not import from the given document';

        do {
            //Fetch Headings from excel
            $excel_headings = (new HeadingRowImport)->toArray('import/' . $file_name);
            if (empty($excel_headings) || empty($excel_headings[0]) ||empty($excel_headings[0][0]))
            {
                $message    = 'The file does not contain any heading';
                break;
            }

            $excel_headings  = $excel_headings[0][0];
            $excel_headings = array_filter($excel_headings);

            //Check if atleast one field is mapped
            $heading_map_selected = false;
            $field_map  = [];

            foreach ($excel_headings as $heading)
            {
                if ($request->has($heading) && !empty($request->post($heading)))
                {
                    $heading_map_selected   = true;
                    $field_map[$heading]    = $request->post($heading);
                }
            }

            if(!$heading_map_selected)
            {
                $message    = 'Please map atleast one field to start importing';
                break;
            }

            $required_fields    = CustomerProfileField::select('ori_customer_profile_fields.id', 'ori_customer_profile_fields.label')
                                    ->where('ori_customer_profile_fields.cmpny_id',Auth::User()->cmpny_id)
                                    ->where('ori_customer_profile_fields.status',config('constant.ACTIVE'))
                                    ->where('ori_customer_profile_fields.required', config('constant.ACTIVE'))
                                    ->pluck('ori_customer_profile_fields.label', 'ori_customer_profile_fields.id')
                                    ->all();

            $required_field_ids = array_keys($required_fields);
            $fields_mapped      = array_values($field_map);

            if (count(array_diff($required_field_ids, $fields_mapped)))
            {
                $message    = 'Please map all required customer fields to start importing.';
                break;
            }

            $lead_source            = $request->post('lead_source');
            $comment                = $request->post('comment');
            $skip_existing_contacts = $request->has('skip_existing_contacts') ? 1 : NULL;
            $add_to_leads           = $request->has('add_to_leads') ? 1 : NULL;
            $field_map_json         = json_encode($field_map);

            $batch  = GroupExcelImportBatch::create([
                'cmpny_id'                  => Auth::user()->cmpny_id,
                'group_id'                  => $group->id,
                'file_name'                 => $file_name,
                'field_map'                 => $field_map_json,
                'lead_source'               => $lead_source,
                'comment'                   => $comment,
                'skip_existing_contacts'    => $skip_existing_contacts,
                'add_to_leads'              => $add_to_leads,
                'status'                    => config('constant.INACTIVE')
            ]);

            $success    = true;
            $message    = 'Excel import has been initiated successfully. You will be notified on completion';

            (new ContactsImport($group, $field_map, $skip_existing_contacts, $add_to_leads, $lead_source, $batch->id))->queue('import/' . $file_name);

        }
        while(false);

        $result_arr = array('success' => $success,'message' => $message);
        return $result_arr;
    }

    public function contacts_import_failed_report(Request $request)
    {
        $batch_process_id       = $request->post('batch_process_id');
        $batch                  = GroupExcelImportBatch::find($batch_process_id);
        $failure_file_name      = "Group Contact Import Failure Report - {$batch_process_id}.xlsx";
        $failure_report_path    = '/contact_import_failure_report/'.$failure_file_name;
        $data['file_name']      = urlencode($failure_file_name);
        $data['user_id']        = Auth::user()->id;
        $data['cmpny_id']       = Auth::user()->cmpny_id;
        $data['download_url']   = url('/download_contact_import_failure_report/'.$data['file_name']);
        (new ContactsImportFailedReport($batch))->queue($failure_report_path)->chain([
            new NotifyContactImportFailedReportCompletion($data),
        ]);
    }

    /**
     * Get Imported Excel List
     * @author Rahul Raveendran
     * @date 21/11/2018
     * @since version 1.0.0
    */
    public function show_imported_excel_list(Request $request)
    {
        $group_id       = $request->post('group_id');
        $group          = Group::where('ori_groups.id', $group_id)
                            ->with('excel_batches')->first();

        $excel_batches  = $group->excel_batches;
        return view('group_contacts.imported_excel_list', compact('group', 'excel_batches'));
    }

    /*
    * Download Contact Excel Import Failure Report as Excel
    * @author Rahul Raveendran
    * @date 22/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return excel
    */
    public function download_contact_import_failure_report($file_name)
    {
        $file_name  = urldecode($file_name);
        $path = storage_path('app/contact_import_failure_report/'.$file_name);
        return response()->download($path);
    }

    public function destroy(Request $request, Group $group)
    {
        $success    = false;
        $message    = '';
        
        do {
            $contact_id = $request->post('id');
            $group->contacts()->detach($contact_id);
             //$group_delete = GroupContact::where('contact_id', $contact_id)
              //                       ->where('group_id', $group->id)
                //                      ->delete();
            $success = true;
            $message = 'Contact removed from group successfully';
        }
        while(false);

        if (!$success)
        {
            $message    = $message ?? 'Contact could not be removed.';
        }

        $result_arr = array('success' => $success, 'message' => $message, 'refresh' => true);

        echo json_encode($result_arr);
    }
}
