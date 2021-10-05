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
use App\Imports\ProfileImport;
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

class ExcelImportController extends Controller
{
    
    public function __construct()
    {
    	/* $this->middleware('auth');
        $this->middleware('check-permission:group lead import', ['only' => ['lead_index', 'search_list', 'add_leads']]);
        $this->middleware('check-permission:group excel import', ['only' => ['excel_index', 'map_excel_fields', 'add_leads', 'create_excel_import_batch']]); */
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
    	return view('import_leads.excel_index', compact('group', 'lead_source_types'));
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

        $customer_fields    = CustomerProfileField::where('cmpny_id',Auth::User()->cmpny_id)
                            ->where('status', config('constant.ACTIVE'))
                            ->pluck('label', 'id')
                            ->all();

        return view('import_leads.map_excel_fields', compact('filename', 'excel_headings', 'customer_fields', 'group', 'lead_source_type', 'lead_source', 'comment', 'original_file_name'));
        
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

            (new ProfileImport($group, $field_map, $skip_existing_contacts, $add_to_leads, $lead_source, $batch->id))->queue('import/' . $file_name);

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


}
