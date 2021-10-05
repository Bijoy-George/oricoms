<?php

namespace App\Http\Controllers;

use App\AutomatedProcess;
use App\AutomatedProcessCustomer;
use App\Campaign;
use App\CampaignBatch;
use App\CampaignGroup;
use App\CampaignMeta;
use App\Channel;
use App\CmpContact;
use App\CommonSmsEmail;
use App\CompanyProfile;
use App\CustomerProfileField;
use App\Exports\AutodialBatchReport;
use App\Exports\EmailBatchReport;
use App\Exports\ManualCallBatchReport;
use App\Exports\PushBatchReport;
use App\Exports\SmsBatchReport;
use App\Group;
use App\GroupContact;
use App\Http\Requests\SaveCampaignRequest;
use App\Http\Requests\SaveGroupRequest;
use App\Jobs\NotifyAutodialBatchReportCompletion;
use App\Jobs\NotifyEmailBatchReportCompletion;
use App\Jobs\NotifyManualCallBatchReportCompletion;
use App\Jobs\NotifySmsBatchReportCompletion;
use App\Jobs\NotifyPushBatchReportCompletion;
use App\LeadFollowup;
use App\LeadSourceType;
use App\QueryStatus;
use App\SurveyQuestion;
use Auth;
use Carbon\Carbon;
use DB;
use Helpers;
use Illuminate\Http\Request;

class CampaignController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check-permission:campaign create', ['only' => ['create']]);
        $this->middleware('check-permission:campaign edit',   ['only' => ['edit']]);
        $this->middleware('check-permission:campaign edit|campaign create',   ['only' => ['store','store_campaign_metadata']]);
        $this->middleware('check-permission:campaign list',   ['only' => ['index','search_list']]);
        $this->middleware('check-permission:campaign delete',   ['only' => ['destroy']]);
        $this->middleware('check-permission:campaign email delivery graph',   ['only' => ['email_send_status_count']]);
        $this->middleware('check-permission:campaign batch efficiency report',   ['only' => ['show_batch_efficiency_stats']]);
        $this->middleware('check-permission:campaign email batch report',   ['only' => ['email_batch_report', 'download_email_batch_report']]);
        $this->middleware('check-permission:campaign sms delivery graph',   ['only' => ['sms_send_status_count']]);
        $this->middleware('check-permission:campaign sms batch report',   ['only' => ['sms_batch_report', 'download_sms_batch_report']]);
        $this->middleware('check-permission:campaign autodial status graph',   ['only' => ['autodial_called_status_count']]);
        $this->middleware('check-permission:campaign autodial batch report',   ['only' => ['autodial_batch_report', 'download_autodial_batch_report']]);
        $this->middleware('check-permission:campaign manualcall status graph',   ['only' => ['manualcall_status_count']]);
        $this->middleware('check-permission:campaign manualcall batch report',   ['only' => ['manualcall_batch_report', 'download_manualcall_batch_report']]);
    }

    public function index()
    {
    	return view('campaigns.index');
    }

    /*
    * GROUP CREATION VIEW
    * @author RAHUL R.
    * @date 08/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return group creation view
    */
    public function create()
    {
    	$lead_source_types	= LeadSourceType::where('status', config('constant.ACTIVE'))->pluck('source_type', 'id')->all();
        $survey_details  = SurveyQuestion::with(['survey_questions' => function ($q) { 
            $q->where('status', config('constant.ACTIVE'));
            //$q->orwhere('expiry_date', '>',Carbon::now());
            $q->orwhere('expiry_date', '>=',date('Y-m-d').' 00:00:00 ');
            $q->orwhere('expiry_date','');
            $q->orwhereNull('expiry_date');
        }])->where('status', config('constant.ACTIVE'))->where(function($res){
                    $res->orWhere('qstn_id_lang1','>',0)->orWhere('qstn_id_lang2','>',0);
                   
                })->groupBy('survey_id')->get(); 
       
    	$lead_source_types	= ['' => 'Select Category'] + $lead_source_types;
        $autoprocess_parent_stages  = AutomatedProcessCustomer::pluck('process_name', 'id')->all();
        $autoprocess_parent_stages = ['' => 'Select Goal Stage'] + $autoprocess_parent_stages;
        $sales_automation_activated = Helpers::get_company_meta('auto_stage_activation_customer');
    	return view('campaigns.create', compact('lead_source_types','survey_details', 'autoprocess_parent_stages','sales_automation_activated'));
    }

    /*
    * SHOW CAMPAIGN DETAILS
    * @author RAHUL R.
    * @date 21/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return show campaign details
    */
    public function show(Campaign $campaign)
    {
        $batches    = CampaignBatch::where('campaign_id', $campaign->id)
                        ->with('creator', 'communications', 'converted_customers')
                        ->orderBy('ori_campaign_batches.id', 'desc')
                        ->paginate(config('constant.pagination_constant'));

        foreach ($batches as $batch)
        {
            $converted_customers_count  = CommonSmsEmail::where('batch_id', $batch->id)
                                            ->where('campaign_efficiency', 1)
                                            ->groupBy('contact_id')
                                            ->count();

            $batch->efficiency  = (!empty($batch->total_target_count)) ? ($converted_customers_count * 100)/$batch->total_target_count : 0;
            $batch->efficiency  = round($batch->efficiency, 2);
        }

        return view('campaigns.show', compact('campaign', 'batches'));
    }

    /*
    * CAMPAIGN UPDATION VIEW
    * @author RAHUL R.
    * @date 17/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return campaign updation view
    */
    public function edit(Campaign $campaign)
    {
        $campaign->load('meta_data', 'batches');
        $lead_source_types  = LeadSourceType::where('status', config('constant.ACTIVE'))->pluck('source_type', 'id')->all();
        $lead_source_types  = ['' => 'Select Category'] + $lead_source_types;
        $survey_details  = SurveyQuestion::with(['survey_questions' => function ($q) { 
            $q->where('status', config('constant.ACTIVE'));
            $q->where(function($q){
            $q->orwhere('expiry_date', '>=',date('Y-m-d').' 00:00:00 ');
            $q->orwhere('expiry_date','');
            $q->orwhereNull('expiry_date');
            });
        }])->where('status', config('constant.ACTIVE'))->where(function($res){
                    $res->orWhere('qstn_id_lang1','!=',NULL)->orWhere('qstn_id_lang2','!=',NULL);
                   
                })->groupBy('survey_id')->get(); 
   // dd($survey_details);die;
        // $autoprocess_parent_stages  = AutomatedProcess::where('parent_id', 0)->pluck('process_name', 'id')->all();
        // $autoprocess_parent_stages = ['' => 'Select Goal Stage'] + $autoprocess_parent_stages;
        $autoprocess_parent_stages  = AutomatedProcessCustomer::pluck('process_name', 'id')->all();
        $autoprocess_parent_stages = ['' => 'Select Goal Stage'] + $autoprocess_parent_stages;
        $sales_automation_activated = Helpers::get_company_meta('auto_stage_activation_customer');
        return view('campaigns.create', compact('campaign','lead_source_types','survey_details','autoprocess_parent_stages','sales_automation_activated'));
    }

    /*
    * CREATE OR UPDATE CAMPAIGN
    * @author RAHUL R.
    * @date 16/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return create or update campaign 
    */
    public function store(SaveCampaignRequest $request)
    {
    	$name           = $request->post('name');
        $goal_stage     = $request->post('goal_stage');
        $group_ids      = $request->post('groups');
        $type           = $request->post('type');
        $cmpny_id       = auth()->user()->cmpny_id;
        $success        = false;
        $message        = '';
        $campaign_id    = $request->post('id');
        $campaign_id    = $campaign_id ?? 0;

        do {
            if (empty($group_ids) || !is_array($group_ids) || count($group_ids) < 1)
            {
                $message    = 'Please select atleast one group.';
                break;
            }

            $groups = Group::whereIn('id', $group_ids)->get();

            if (count($groups) < 1)
            {
                $message    = 'Invalid Groups Selected.';
                break;
            }

            if ($campaign_id)
            {
                Campaign::where('id', $campaign_id)
                    ->update([
                        'name'          => $name,
                        'goal_stage'    => $goal_stage,
                        'campaign_type' => $type,
                    ]);

                $campaign = Campaign::find($campaign_id);

            }
            else
            { 
                $campaign   = Campaign::create([
                    'cmpny_id'      => $cmpny_id,
                    'name'          => $name,
                    'goal_stage'    => $goal_stage,
                    'campaign_type' => $type,
                    'status'        => config('constant.ACTIVE')
                ]);
            }

            if (!isset($campaign->id) || empty($campaign->id))
            {
                $message    = 'Could not save campaign.';
                break;
            }

            foreach ($groups as $group)
            {
                CampaignGroup::updateOrCreate([
                    'campaign_id' => $campaign->id,
                    'group_id'    => $group->id
                ], [
                    'cmpny_id'  => $cmpny_id,
                    'status'    => config('constant.ACTIVE')
                ]);
            }

            $selected_group_ids = $groups->pluck('id')->all();
            $removed_campaign_group_ids    = $campaign->groups->whereNotIn('id', $selected_group_ids)->pluck('id')->all();

            //Inactivate removed groups from campaign
            CampaignGroup::where('campaign_id', $campaign->id)
                        ->whereIn('group_id', $removed_campaign_group_ids)
                        ->update([
                            'status'    => config('constant.INACTIVE')
                        ]);

            // foreach ($campaign_groups as $campaign_group)
            // {
            //     $campaign_group->status = config('constant.INACTIVE');
            //     $campaign_group->save();
            // }

            $campaign_id = $campaign->id;
            $success    = true;
        }
        while(false);

        if ($success)
        {
            $message    = "Campaign Saved Successfully";
        }
        else {
            $message    = $message ?? "Campaign could not be saved";
        }

        $result_arr = array('success' => $success, 'message' => $message);

        if ($success)
        {
            $result_arr['data'] = [
                'campaign_id'   => $campaign_id
            ];
        }

        echo json_encode($result_arr);

    }

    /*
    * CREATE OR UPDATE CAMPAIGN META DATA
    * @author RAHUL R.
    * @date 16/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return create or update campaign meta data
    */
    public function store_campaign_metadata(Request $request)
    {
        $campaign_id        = $request->post('campaign_id');
        $lead_source_type   = $request->post('lead_source_type');
        $lead_source        = $request->post('lead_source');
        $budget             = $request->post('budget');
        $field1             = $request->post('field1');
        $field1_content     = $request->post('field1_content');
        $field2             = $request->post('field2');
        $field2_content     = $request->post('field2_content');
        $field3             = $request->post('field3');
        $field3_content     = $request->post('field3_content');
        $success            = false;
        $message            = '';

        do {
            $campaign = Campaign::find($campaign_id);
            if (!isset($campaign->id) || empty($campaign->id))
            {
                $message    = 'Invalid Campaign.';
                break;
            }

            $campaign_meta = CampaignMeta::updateOrCreate([
                'campaign_id'           => $campaign->id,
            ], [
                'cmpny_id'              => $campaign->cmpny_id,
                'source_type'           => $lead_source_type,
                'source_id'             => $lead_source,
                'budget'                => $budget,
                'field1'                => $field1,
                'field2'                => $field2,
                'field3'                => $field3,
                'field1_description'    => $field1_content,
                'field2_description'    => $field2_content,
                'field3_description'    => $field3_content,
                'status'                => config('constant.ACTIVE')
            ]);

            if (!isset($campaign_meta->id) || empty($campaign_meta->id))
            {
                $message    = 'Could not save campaign metadata.';
                break;
            }

            $success = true;
        }
        while(false);

        if ($success)
        {
            $message    = "Campaign Saved Successfully";
        }
        else {
            $message    = $message ?? "Campaign metadata could not be saved";
        }

        $result_arr = array('success' => $success, 'message' => $message);

        echo json_encode($result_arr);
    }

    /*
    * CAMPAIGN LIST VIEW
    * @author RAHUL R.
    * @date 07/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return campaign list view
    */
    public function search_list(Request $request)
    {
        $search_keywords    = $request->post('search_keywords');

        $campaigns  = Campaign::where('status', config('constant.ACTIVE'))->with('creator', 'groups');

        if (isset($search_keywords) && !empty($search_keywords))
        {
            $campaigns->where(function($query) use ($search_keywords) {
                $query->where('ori_campaigns.name', 'like', '%'.$search_keywords.'%');
            });
        }

        $campaigns = $campaigns->orderBy('ori_campaigns.created_at', 'DESC')->paginate(config('constant.pagination_constant'));

        //Fetch unique contacts count
        foreach ($campaigns as $campaign)
        {
            $groups = $campaign->groups;
            $group_ids = $groups->pluck('id')->all();
            $campaign_contacts = GroupContact::select(DB::raw("COUNT(DISTINCT contact_id) as members_count"))
                                    ->whereIn('group_id', $group_ids)
                                    ->where('status', config('constant.ACTIVE'))
                                    ->first();
            // $campaign_contacts  = collect([]);
            // foreach ($groups as $group)
            // {
            //     $campaign_contacts  = $campaign_contacts->merge($group->contacts);
            // }
            // $unique_contacts_count  = count($campaign_contacts->unique('id'));
            $campaign->members_count    = $campaign_contacts->members_count;
        }
        $html   = view('campaigns.listview')->with(compact('campaigns'))->render();
        $result_arr=array('success' => true,'html' => $html);
        return json_encode($result_arr);
    }

    /*
    * DELETE CAMPAIGN
    * @author RAHUL R.
    * @date 17/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return status json 
    */
    public function destroy(Campaign $campaign)
    {
        $success    = false;
        $message    = '';
        
        do {
            $campaign->delete();
            $success = true;
            $message = 'Campaign Deleted Successfully';
        }
        while(false);

        if (!$success)
        {
            $message    = $message ?? 'Campaign could not be deleted.';
        }

        $result_arr = array('success' => $success, 'message' => $message, 'refresh' => true);

        echo json_encode($result_arr);
    }

    /**
    * Email Status Count
    * @author Rahul R.
    * @date 21/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return email status count
   */ 

    public function email_send_status_count(Request $request)
    {
        $batch_id    = $request->post('batch_id');
        $data['graph_title'] = 'Email Delivery Status';
        $data['graph'] = '';
              
        $results = CommonSmsEmail::where('batch_id', $batch_id)
                            ->where('sent_type', config('constant.CH_EMAIL'))
                            ->count();

        $data['total_mail_count'] = $results;

        $queued_emails     =   CommonSmsEmail::select('ori_common_sms_email.id')
            ->where('batch_id',$batch_id)
            ->where('sent_type', config('constant.CH_EMAIL'))
            ->where('ori_common_sms_email.status', config('constant.EMAIL_DELIVERY_STATUS.QUEUED'))
            ;
            
        $total_queued_mail   = $queued_emails->get();
        $data['total_queued_mail'] = $total_queued_mail->count();
        $data['graph'] .= "{ name: 'In CRM Queue', y: ". $data['total_queued_mail']."},";

        $moved_emails     =   CommonSmsEmail::select('ori_common_sms_email.id')
            ->where('batch_id',$batch_id)
            ->where('sent_type', config('constant.CH_EMAIL'))
            ->where('ori_common_sms_email.status', config('constant.EMAIL_DELIVERY_STATUS.MOVED'))
            ;
            
        $total_moved_mail   = $moved_emails->get();
        $data['total_moved_mail'] = $total_moved_mail->count();
        $data['graph'] .= "{ name: 'Moved to Provider', y: ". $data['total_moved_mail']."},";
             
        $results1     =   CommonSmsEmail::select('ori_common_sms_email.id')
            ->where('batch_id',$batch_id)
            ->where('sent_type', config('constant.CH_EMAIL'))
            ->where('ori_common_sms_email.status', config('constant.EMAIL_DELIVERY_STATUS.PROCESSED'))
            ;
            
        $total_processed_mail   = $results1->get();
        $data['total_processed_mail'] = $total_processed_mail->count();
        $data['graph'] .= "{ name: 'Processed', y: ". $data['total_processed_mail']."},";
            
        $results2     =   CommonSmsEmail::select('ori_common_sms_email.id')
                ->where('batch_id',$batch_id)
                ->where('sent_type', config('constant.CH_EMAIL'))
                ->where('ori_common_sms_email.status', config('constant.EMAIL_DELIVERY_STATUS.DELIVERED'))
                    ;
        $total_delivered_mail   = $results2->get();
        $data['total_delivered_mail'] = $total_delivered_mail->count();
        $data['graph'] .= "{ name: 'Delivered', y: ". $data['total_delivered_mail']."},";
            
        $results3     =   CommonSmsEmail::select('ori_common_sms_email.id')
                ->where('batch_id',$batch_id)
                ->where('sent_type', config('constant.CH_EMAIL'))
                ->where('ori_common_sms_email.status', config('constant.EMAIL_DELIVERY_STATUS.OPENED'))
                    ;
        $total_open_mail   = $results3->get();
        $data['total_open_mail'] = $total_open_mail->count();
        $data['graph'] .= "{ name: 'Opened Emails', y: ". $data['total_open_mail']."},";
            
        $results4     =   CommonSmsEmail::select('ori_common_sms_email.id')
                ->where('batch_id',$batch_id)
                ->where('sent_type', config('constant.CH_EMAIL'))
                ->where('ori_common_sms_email.status', config('constant.EMAIL_DELIVERY_STATUS.DEFFERED'))
                    ;
        $total_deferred_mail   = $results4->distinct()->get();
        $data['total_deferred_mail'] = $total_deferred_mail->count();
        $data['graph'] .= "{ name: 'Deferred Emails', y: ". $data['total_deferred_mail']."},";
            
        $results5     =   CommonSmsEmail::select('ori_common_sms_email.id')
                ->where('batch_id',$batch_id)
                ->where('sent_type', config('constant.CH_EMAIL'))
                ->where('ori_common_sms_email.status', config('constant.EMAIL_DELIVERY_STATUS.BOUNCED'))
                    ;
        $total_bounce_mail   = $results5->get();
        $data['total_bounce_mail'] = $total_bounce_mail->count();
        $data['graph'] .= "{ name: 'Bounced Emails', y: ". $data['total_bounce_mail']."},";
            
        $results6     =   CommonSmsEmail::select('ori_common_sms_email.id')
                ->where('batch_id',$batch_id)
                ->where('sent_type', config('constant.CH_EMAIL'))
                ->where('ori_common_sms_email.status', config('constant.EMAIL_DELIVERY_STATUS.DROPPED'));
        $total_dropped_mail   = $results6->get();
        $data['total_dropped_mail'] = $total_dropped_mail->count();
        $data['graph'] .= "{ name: 'Dropped Emails', y: ". $data['total_dropped_mail']."},";
            
         $results7     =   CommonSmsEmail::select('ori_common_sms_email.id')
                ->where('batch_id',$batch_id)
                ->where('sent_type', config('constant.CH_EMAIL'))
                ->where('ori_common_sms_email.status', config('constant.EMAIL_DELIVERY_STATUS.CLICKED'))
                    ;
        $total_click_mail   = $results7->get();
        $data['total_click_mail'] = $total_click_mail->count();
        $data['graph'] .= "{ name: 'Clicked Emails', y: ". $data['total_click_mail']."}";
            
//          $data['total_not_delivered_mail'] = (int)$data['total_processed_mail'] - (int)$data['total_delivered_mail'];
            $data['total_not_delivered_mail'] = (int)$data['total_delivered_mail'] - (int)$data['total_processed_mail'];
            $data['total_not_open_mail'] = (int)$data['total_delivered_mail'] - (int)$data['total_open_mail'];
          //  echo json_encode($data);  
            $batch_details = CampaignBatch::find($batch_id);
             echo view('campaigns.campaign_data_graph', compact('data','batch_id','batch_details'));

    }

    /**
     * Get Detailed Batch Efficiency Stats
     * @author Rahul Raveendran
     * @date 21/11/2018
     * @since version 1.0.0
    */
    public function show_batch_efficiency_stats(Request $request)
    {
      $campaign_id  = $request->post('campaign_id');
      $batch_id     = $request->post('batch_id');
      $batch_efficiency_stats   = [];

      if (!isset($campaign_id) || empty($campaign_id) || !isset($batch_id) || empty($batch_id))
      {
        return false;
      }

      $batch_details = CampaignBatch::select('ori_campaign_batches.id', 'ori_campaign_batches.title', DB::raw("DATE(ori_campaign_batches.created_at) AS creation_date"))
                                        ->where('ori_campaign_batches.id',$batch_id)
                                        ->first();

      $batch_creation_date  = $batch_details->creation_date;

      // $group_wise_stats = CommonSmsEmail::select('ori_groups.id', 'ori_groups.name', DB::raw("COUNT(DISTINCT(ori_common_sms_email.customer_id)) AS total_customers"))
      //                     ->join('ori_groups', 'ori_groups.id', '=', 'ori_common_sms_email.group_id')
      //                     ->where('ori_common_sms_email.campaign_id', $campaign_id)
      //                     ->where('ori_common_sms_email.batch_id', $batch_id)
      //                     ->groupBy('ori_groups.id')
      //                     ->get();
      $group_ids   = CommonSMSEmail::select(DB::raw("DISTINCT(ori_common_sms_email.group_id)"))
                        ->where('ori_common_sms_email.batch_id', $batch_id)
                        ->whereNotNull('ori_common_sms_email.group_id')
                        ->pluck('group_id')->all();

     foreach ($group_ids as $group_id)
     {
        $group = Group::find($group_id);
        $total_customers_count = CommonSmsEmail::select(DB::raw("COUNT(DISTINCT(ori_common_sms_email.customer_id)) AS total_customers"))
                            ->where('ori_common_sms_email.batch_id', $batch_id)
                            ->where('ori_common_sms_email.group_id', $group_id)->first();
        $total_customers_count = $total_customers_count->total_customers;

      $total_converted_customers_count  = CommonSmsEmail::select(DB::raw("DISTINCT(ori_common_sms_email.customer_id)"))
                                      ->where('ori_common_sms_email.campaign_id', $campaign_id)
                                      ->where('ori_common_sms_email.batch_id', $batch_id)
                                      ->where('ori_common_sms_email.group_id', $group_id)
                                      ->where('ori_common_sms_email.campaign_efficiency', 1)
                                      ->count();
        $batch_date_converted_customers_count  = CommonSmsEmail::select(DB::raw("DISTINCT(ori_common_sms_email.customer_id)"))
                                      ->where('ori_common_sms_email.campaign_id', $campaign_id)
                                      ->where('ori_common_sms_email.batch_id', $batch_id)
                                      ->where('ori_common_sms_email.group_id', $group_id)
                                      ->whereRaw("DATE(ori_common_sms_email.goal_stage_date) = ?", [$batch_creation_date])
                                      ->where('ori_common_sms_email.campaign_efficiency', 1)
                                      ->count();

        $subsequent_dates_converted_customers_count  = CommonSmsEmail::select(DB::raw("DISTINCT(ori_common_sms_email.customer_id)"))
                                      ->where('ori_common_sms_email.campaign_id', $campaign_id)
                                      ->where('ori_common_sms_email.batch_id', $batch_id)
                                      ->where('ori_common_sms_email.group_id', $group_id)
                                      ->where(function($query) use($batch_creation_date) {
                                          $query->whereRaw("DATE(ori_common_sms_email.goal_stage_date) != ?", [$batch_creation_date])
                                                ->orWhereNull('ori_common_sms_email.goal_stage_date');
                                      })
                                      ->where('ori_common_sms_email.campaign_efficiency', 1)
                                      ->count();

        $group_efficiency = (!empty($total_customers_count)) ? ($total_converted_customers_count / $total_customers_count) * 100 : 0;

        $batch_efficiency_stats[$group_id] = array();
        $batch_efficiency_stats[$group_id]['group_name'] = $group->name;
        $batch_efficiency_stats[$group_id]['total_customers']  = $total_customers_count;
        $batch_efficiency_stats[$group_id]['on_date_converted_customers']  = $batch_date_converted_customers_count;
        $batch_efficiency_stats[$group_id]['subsequent_dates_converted_customers']  = $subsequent_dates_converted_customers_count;
        $batch_efficiency_stats[$group_id]['group_efficiency'] = $group_efficiency;
     }

     return view('campaigns.batch_efficiency_stats', compact('batch_efficiency_stats', 'batch_details'));

    }

    /*
    * Export Email Batch Report as Excel
    * @author Rahul Raveendran
    * @date 21/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return excel
    */
    public function email_batch_report(Request $request)
    {
        $batch_id   = $request->post('batch_id');
        $batch      = CampaignBatch::find($batch_id);
        $file_type  = $request->post('file_type');
        $report_types   = ['xlsx', 'csv'];
        $user_id = Auth::user()->id;
        $cmpny_id = Auth::user()->cmpny_id;
        if (!in_array($file_type, $report_types))
        {
            return false;
        }

        $batch->load('campaign_det');
        $file_name  = "Email Batch Report - {$batch->campaign_det->name} - {$batch->title}.{$file_type}";
        $path='/email_batch_report/'.$file_name;

        $data = [
            'batch' => $batch,
            'user_id'   => $user_id,
            'cmpny_id'  => $cmpny_id,
            'file_name' => urlencode($file_name)
        ];

        (new EmailBatchReport($data))->queue($path)->chain([
            new NotifyEmailBatchReportCompletion($data),
        ]);
    }

    /*
    * Download exported Email Batch Report as Excel
    * @author Rahul Raveendran
    * @date 22/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return excel
    */
    public function download_email_batch_report($file_name)
    {
        $file_name  = urldecode($file_name);
        $path = storage_path('app/email_batch_report/'.$file_name);
        return response()->download($path);
    }

    /**
    * SMS Status Count
    * @author Rahul R.
    * @date 22/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return email status count
   */ 
    public function sms_send_status_count(Request $request)
    {
        $batch_id = $request->post('batch_id');
        $data['graph_title'] = 'SMS Delivery Status';
        $data['graph'] = '';

        $batch_details = CampaignBatch::find($batch_id);
      
        $total_count    = CommonSmsEmail::select('ori_common_sms_email.id')
                                ->where('ori_common_sms_email.batch_id',$batch_id)
                                ->where('ori_common_sms_email.sent_type',config('constant.CH_SMS'))
                                ->count();

        $queued_count   = CommonSmsEmail::select('ori_common_sms_email.id')
                                ->where('ori_common_sms_email.batch_id',$batch_id)
                                ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.QUEUED'))
                                ->where('ori_common_sms_email.sent_type',config('constant.CH_SMS'))
                                ->count();
        $data['graph'] .= "{ name: 'In CRM Queue', y: ". $queued_count."},";

        $send_to_provider_count     = CommonSmsEmail::select('ori_common_sms_email.id')
                                        ->where('ori_common_sms_email.batch_id',$batch_id)
                                        ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.MOVED'))
                                        ->where('ori_common_sms_email.sent_type',config('constant.CH_SMS'))
                                        ->count();
        $data['graph'] .= "{ name: 'Sent to provider', y: ". $send_to_provider_count."},";

        $delivered_count  = CommonSmsEmail::select('ori_common_sms_email.id')
                                ->where('ori_common_sms_email.batch_id',$batch_id)
                                ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.DELIVERED'))
                                ->where('ori_common_sms_email.sent_type',config('constant.CH_SMS'))
                                ->count();
        $data['graph'] .= "{ name: 'Total Delivered', y: ". $delivered_count."},";

        $invalid_number_count   = CommonSmsEmail::select('ori_common_sms_email.id')
                                    ->where('ori_common_sms_email.batch_id',$batch_id)
                                    ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.INVALID_NUMBER'))
                                    ->where('ori_common_sms_email.sent_type',config('constant.CH_SMS'))
                                    ->count();
        $data['graph'] .= "{ name: 'Invalid Number', y: ". $invalid_number_count."},";

        $absent_subscriber_count    = CommonSmsEmail::select('ori_common_sms_email.id')
                                        ->where('ori_common_sms_email.batch_id',$batch_id)
                                        ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.ABSENT_SUBSCRIBER'))
                                        ->where('ori_common_sms_email.sent_type',config('constant.CH_SMS'))
                                        ->count();
        $data['graph'] .= "{ name: 'Absent Subscriber', y: ". $absent_subscriber_count."},";

        $memory_exceed_count  = CommonSmsEmail::select('ori_common_sms_email.id')
                                    ->where('ori_common_sms_email.batch_id',$batch_id)
                                    ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.MEMORY_EXCEEDED'))
                                    ->where('ori_common_sms_email.sent_type',config('constant.CH_SMS'))
                                    ->count();
        $data['graph'] .= "{ name: 'Memory Capacity Exceeded', y: ". $memory_exceed_count."},";

        $mobile_equipment_error_count   = CommonSmsEmail::select('ori_common_sms_email.id')
                                            ->where('ori_common_sms_email.batch_id',$batch_id)
                                            ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.MOBILE_EQUIPMENT_ERROR'))
                                            ->where('ori_common_sms_email.sent_type',config('constant.CH_SMS'))
                                            ->count();
        $data['graph'] .= "{ name: 'Mobile Equipment Error', y: ". $mobile_equipment_error_count."},";

        $network_error_count    = CommonSmsEmail::select('ori_common_sms_email.id')
                                    ->where('ori_common_sms_email.batch_id',$batch_id)
                                    ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.NETWORK_ERROR'))
                                    ->where('ori_common_sms_email.sent_type',config('constant.CH_SMS'))
                                    ->count();
        $data['graph'] .= "{ name: 'Network Error', y: ". $network_error_count."},";

        $sms_barred_count   = CommonSmsEmail::select('ori_common_sms_email.id')
                                ->where('ori_common_sms_email.batch_id',$batch_id)
                                ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.BARRED'))
                                ->where('sent_type',config('constant.CH_SMS'))
                                ->count();
        $data['graph'] .= "{ name: 'Barred', y: ". $sms_barred_count."},";

        $invalid_sender_count   = CommonSmsEmail::select('ori_common_sms_email.id')
                                    ->where('ori_common_sms_email.batch_id',$batch_id)
                                    ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.INVALID_SENDER_ID'))
                                    ->where('ori_common_sms_email.sent_type',config('constant.CH_SMS'))
                                    ->count();
        $data['graph'] .= "{ name: 'Invalid Sender ID', y: ". $invalid_sender_count."},";

        $ndnc_failure_count = CommonSmsEmail::select('ori_common_sms_email.id')
                                ->where('ori_common_sms_email.batch_id',$batch_id)
                                ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.NDNC_FAILURE'))
                                ->where('ori_common_sms_email.sent_type',config('constant.CH_SMS'))
                               ->count();
        $data['graph'] .= "{ name: 'NDNC Failure', y: ". $ndnc_failure_count."},";

        $unknown_error_count    = CommonSmsEmail::select('ori_common_sms_email.id')
                                    ->where('ori_common_sms_email.batch_id',$batch_id)
                                    ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.UNKNOWN_ERROR'))
                                    ->where('ori_common_sms_email.sent_type',config('constant.CH_SMS'))
                               ->count();
        $data['graph'] .= "{ name: 'Unknown Error', y: ". $unknown_error_count."},";

        $undelivered_count  = CommonSmsEmail::select('ori_common_sms_email.id')
                                ->where('ori_common_sms_email.batch_id',$batch_id)
                                ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.UNDELIVERED'))
                                ->where('ori_common_sms_email.sent_type',config('constant.CH_SMS'))
                                ->count();
        $data['graph'] .= "{ name: 'Total Undelivered', y: ". $undelivered_count."},";

        $submited_to_operator_count   = CommonSmsEmail::select('ori_common_sms_email.id')->where('ori_common_sms_email.batch_id',$batch_id)
                                ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.SUBMITTED_TO_OPERATOR'))
                                ->where('sent_type',config('constant.CH_SMS'))
                               ->count();
        $data['graph'] .= "{ name: 'Total Submited to Operator', y: ". $submited_to_operator_count."},";
        $rejected_count = CommonSmsEmail::select('ori_common_sms_email.id')
                            ->where('ori_common_sms_email.batch_id',$batch_id)
                            ->where('ori_common_sms_email.status',config('constant.SMS_DELIVERY_STATUS.REJECTED'))
                            ->where('sent_type',config('constant.CH_SMS'))
                            ->count();
        $data['graph'] .= "{ name: 'Total Rejected', y: ". $rejected_count."}";

        echo view('campaigns.campaign_sms_delivery_graph', compact('data','batch_id','batch_details'));
    }

    /**
    * Push Status Count
    * @author Rahul R.
    * @date 09/10/2019
    * @since version 1.0.0
    * @param NULL
    * @return push status count
   */
    public function push_send_status_count(Request $request)
    {
        $batch_id = $request->post('batch_id');
        $data['graph_title'] = 'Push Delivery Status';
        $data['graph'] = '';

        $batch_details = CampaignBatch::find($batch_id);

        $total_count = CommonSmsEmail::select('ori_common_sms_email.id')
                                ->where('ori_common_sms_email.batch_id',$batch_id)
                                ->where('ori_common_sms_email.sent_type',config('constant.CH_PUSH_MESSAGES'))
                                ->count();

        $in_crm_queue_count  = CommonSmsEmail::select('ori_common_sms_email.id')
                                ->where('ori_common_sms_email.batch_id',$batch_id)
                                ->where('ori_common_sms_email.sent_type',config('constant.CH_PUSH_MESSAGES'))
                                ->where('ori_common_sms_email.status', config('constant.INACTIVE'))
                                ->count();
        $data['graph'] .= "{ name: 'In CRM Queue', y: ". $in_crm_queue_count."},";

        $sent_count = CommonSmsEmail::select('ori_common_sms_email.id')
                                ->where('ori_common_sms_email.batch_id',$batch_id)
                                ->where('ori_common_sms_email.sent_type',config('constant.CH_PUSH_MESSAGES'))
                                ->where('ori_common_sms_email.status', config('constant.ACTIVE'))
                                ->count();
        $data['graph'] .= "{ name: 'Sent', y: ". $sent_count."},";

        $fcm_mismatch_count = CommonSmsEmail::select('ori_common_sms_email.id')
                                ->where('ori_common_sms_email.batch_id',$batch_id)
                                ->where('ori_common_sms_email.sent_type',config('constant.CH_PUSH_MESSAGES'))
                                ->where('ori_common_sms_email.status', config('constant.ACTIVE'))
                                ->count();
        $data['graph'] .= "{ name: 'FCM Mismatch', y: ". $sent_count."},";

        $no_fcm_count = CommonSmsEmail::select('ori_common_sms_email.id')
                                ->where('ori_common_sms_email.batch_id',$batch_id)
                                ->where('ori_common_sms_email.sent_type',config('constant.CH_PUSH_MESSAGES'))
                                ->where('ori_common_sms_email.status', 4)
                                ->count();
        $data['graph'] .= "{ name: 'No FCM', y: ". $no_fcm_count."}";

        echo view('campaigns.campaign_push_delivery_graph', compact('data','batch_id','batch_details'));
    }

    /*
    * Initiate Export SMS Batch Report as Excel
    * @author Rahul Raveendran
    * @date 22/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return excel
    */
    public function sms_batch_report(Request $request)
    {
        $batch_id   = $request->post('batch_id');
        $batch      = CampaignBatch::find($batch_id);
        $file_type  = $request->post('file_type');
        $report_types   = ['xlsx', 'xls', 'csv'];
        $user_id = Auth::user()->id;
        $cmpny_id = Auth::user()->cmpny_id;
        if (!in_array($file_type, $report_types))
        {
            return false;
        }

        $batch->load('campaign_det');
        $file_name  = "SMS Batch Report - {$batch->campaign_det->name} - {$batch->title}.{$file_type}";
        $path='/sms_batch_report/'.$file_name;

        $data = [
            'batch' => $batch,
            'user_id'   => $user_id,
            'cmpny_id'  => $cmpny_id,
            'file_name' => urlencode($file_name)
        ];

        (new SmsBatchReport($data))->queue($path)->chain([
            new NotifySmsBatchReportCompletion($data),
        ]);
    }

    /*
    * Download exported SMS Batch Report as Excel
    * @author Rahul Raveendran
    * @date 22/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return excel
    */
    public function download_sms_batch_report($file_name)
    {
        $file_name  = urldecode($file_name);
        $path = storage_path('app/sms_batch_report/'.$file_name);
        return response()->download($path);
    }

    /*
    * Download exported Push Batch Report as Excel
    * @author Rahul Raveendran
    * @date 10/10/2019
    * @since version 1.0.0
    * @param NULL
    * @return excel
    */
    public function download_push_batch_report($file_name)
    {
        $file_name  = urldecode($file_name);
        $path = storage_path('app/push_batch_report/'.$file_name);
        return response()->download($path);
    }

    /*
    * Initiate Export Push Batch Report as Excel
    * @author Rahul Raveendran
    * @date 09-10-2019
    * @since version 1.0.0
    * @param NULL
    * @return excel
    */
    public function push_batch_report(Request $request)
    {
        $batch_id   = $request->post('batch_id');
        $batch      = CampaignBatch::find($batch_id);
        $file_type  = $request->post('file_type');
        $report_types   = ['xlsx', 'csv'];
        $user_id = Auth::user()->id;
        $cmpny_id = Auth::user()->cmpny_id;
        if (!in_array($file_type, $report_types))
        {
            return false;
        }

        $batch->load('campaign_det');
        $file_name  = "Push Batch Report - {$batch->campaign_det->name} - {$batch->title}.{$file_type}";
        $path='/push_batch_report/'.$file_name;

        $data = [
            'batch' => $batch,
            'user_id'   => $user_id,
            'cmpny_id'  => $cmpny_id,
            'file_name' => urlencode($file_name)
        ];

        (new PushBatchReport($data))->queue($path)->chain([
            new NotifyPushBatchReportCompletion($data),
        ]);
    }

    /**
    * Autodial Status Count
    * @author Rahul R.
    * @date 27/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return autodial status count
   */ 

    public function autodial_called_status_count(Request $request)
    {
        $batch_id = $request->post('batch_id');
        $data['graph_title'] = 'Autodial Called Status';
        $data['graph'] = '';

        $batch_details = CampaignBatch::find($batch_id);

        $in_crm_queue_call   = CommonSmsEmail::where('ori_common_sms_email.sent_type',config('constant.CH_AUTODIAL'))
                            ->where('ori_common_sms_email.batch_id',$batch_id)
                            ->where('ori_common_sms_email.status',config('constant.CALLCENTRE_STATUS.QUEUE'))
                            ->count();
        $data['graph'] .= "{ name: 'In CRM Queue', y: ". $in_crm_queue_call."},";

        $onqueue_call   = CommonSmsEmail::where('ori_common_sms_email.sent_type',config('constant.CH_AUTODIAL'))
                            ->where('ori_common_sms_email.batch_id',$batch_id)
                            ->where('ori_common_sms_email.status',config('constant.CALLCENTRE_STATUS.ONQUEUE'))
                            ->count();
        $data['graph'] .= "{ name: 'On Queue', y: ". $onqueue_call."},";

        $abandoned_call   = CommonSmsEmail::where('ori_common_sms_email.sent_type',config('constant.CH_AUTODIAL'))
                            ->where('ori_common_sms_email.batch_id',$batch_id)
                            ->where('ori_common_sms_email.status',config('constant.CALLCENTRE_STATUS.ABANDONED'))
                            ->count();
        $data['graph'] .= "{ name: 'Abandoned', y: ". $abandoned_call."},";

        $success_call   = CommonSmsEmail::where('ori_common_sms_email.sent_type',config('constant.CH_AUTODIAL'))
                            ->where('ori_common_sms_email.batch_id',$batch_id)
                            ->where('ori_common_sms_email.status',config('constant.CALLCENTRE_STATUS.SUCCESS'))
                            ->count();
        $data['graph'] .= "{ name: 'Success', y: ". $success_call."},";

        $hungup_call   = CommonSmsEmail::where('ori_common_sms_email.sent_type',config('constant.CH_AUTODIAL'))
                            ->where('ori_common_sms_email.batch_id',$batch_id)
                            ->where('ori_common_sms_email.status',config('constant.CALLCENTRE_STATUS.HANGUP'))
                            ->count();
        $data['graph'] .= "{ name: 'Hung up', y: ". $hungup_call."},";

        $placed_call   = CommonSmsEmail::where('ori_common_sms_email.sent_type',config('constant.CH_AUTODIAL'))
                            ->where('ori_common_sms_email.batch_id',$batch_id)
                            ->where('ori_common_sms_email.status',config('constant.CALLCENTRE_STATUS.PLACING'))
                            ->count();
        $data['graph'] .= "{ name: 'Placed', y: ". $placed_call."},";

        $ringing_call   = CommonSmsEmail::where('ori_common_sms_email.sent_type',config('constant.CH_AUTODIAL'))
                            ->where('ori_common_sms_email.batch_id',$batch_id)
                            ->where('ori_common_sms_email.status',config('constant.CALLCENTRE_STATUS.RINGING'))
                            ->count();
        $data['graph'] .= "{ name: 'Ringing', y: ". $ringing_call."},";

        $failed_call   = CommonSmsEmail::where('ori_common_sms_email.sent_type',config('constant.CH_AUTODIAL'))
                            ->where('ori_common_sms_email.batch_id',$batch_id)
                            ->where('ori_common_sms_email.status',config('constant.CALLCENTRE_STATUS.FAILURE'))
                            ->count();
        $data['graph'] .= "{ name: 'Failed', y: ". $failed_call."}";

        echo view('campaigns.campaign_autodial_status_graph', compact('data','batch_id','batch_details'));
    }

    /*
    * Initiate Export Autodial Batch Report as Excel
    * @author Rahul Raveendran
    * @date 22/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return excel
    */
    public function autodial_batch_report(Request $request)
    {
        $batch_id   = $request->post('batch_id');
        $batch      = CampaignBatch::find($batch_id);
        $file_type  = $request->post('file_type');
        $report_types   = ['xlsx', 'xls', 'csv'];
        $user_id = Auth::user()->id;
        $cmpny_id = Auth::user()->cmpny_id;
        if (!in_array($file_type, $report_types))
        {
            return false;
        }

        $batch->load('campaign_det');
        $file_name  = "Autodial Batch Report - {$batch->campaign_det->name} - {$batch->title}.{$file_type}";
        $path='/autodial_batch_report/'.$file_name;

        $data = [
            'batch' => $batch,
            'user_id'   => $user_id,
            'cmpny_id'  => $cmpny_id,
            'file_name' => urlencode($file_name)
        ];

        (new AutodialBatchReport($data))->queue($path)->chain([
            new NotifyAutodialBatchReportCompletion($data),
        ]);
    }

    /*
    * Download exported Autodial Batch Report as Excel
    * @author Rahul Raveendran
    * @date 27/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return excel
    */
    public function download_autodial_batch_report($file_name)
    {
        $file_name  = urldecode($file_name);
        $path = storage_path('app/autodial_batch_report/'.$file_name);
        return response()->download($path);
    }

    /**
    * Manual Call Status Count
    * @author Rahul R.
    * @date 27/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return manualcall status count
   */ 

    public function manualcall_status_count(Request $request)
    {
        $batch_id = $request->post('batch_id');
        $data['graph_title'] = 'Manual Call Status';
        $data['graph'] = '';

        $batch_details = CampaignBatch::find($batch_id);

        $query_status   = QueryStatus::where('status', config('constant.ACTIVE'))
                            ->get();

        foreach ($query_status as $status)
        {
            $status_count = LeadFollowup::where('batch_id',$batch_id)
                            ->where('ori_lead_followups.status','1')
                            ->where('ori_lead_followups.query_status',$status->id)
                            ->where('ori_lead_followups.outbound_calls',config('constant.MANUAL_OUTBOUND_CALLS'))
                            ->count();

            $data['graph'] .= "{ name: '". $status->name ."', y: ". $status_count."},";
        }
        $data['graph']  = rtrim($data['graph'], ',');

        echo view('campaigns.campaign_manualcall_status_graph', compact('data','batch_id','batch_details'));
    }

    /**
    * Push Message Status Count
    * @author Rahul R.
    * @date 27/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return manualcall status count
   */

    /*
    * Initiate Export Manual Call Batch Report as Excel
    * @author Rahul Raveendran
    * @date 22/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return excel
    */
    public function manualcall_batch_report(Request $request)
    {
        $batch_id   = $request->post('batch_id');
        $batch      = CampaignBatch::find($batch_id);
        $file_type  = $request->post('file_type');
        $report_types   = ['xlsx', 'xls', 'csv'];
        $user_id = Auth::user()->id;
        $cmpny_id = Auth::user()->cmpny_id;
        if (!in_array($file_type, $report_types))
        {
            return false;
        }

        $batch->load('campaign_det');
        $file_name  = "Manual Call Batch Report - {$batch->campaign_det->name} - {$batch->title}.{$file_type}";
        $path='/manualcall_batch_report/'.$file_name;

        $data = [
            'batch' => $batch,
            'user_id'   => $user_id,
            'cmpny_id'  => $cmpny_id,
            'file_name' => urlencode($file_name)
        ];

        (new ManualCallBatchReport($data))->queue($path)->chain([
            new NotifyManualCallBatchReportCompletion($data),
        ]);
    }

    /*
    * Download exported Manual Call Batch Report as Excel
    * @author Rahul Raveendran
    * @date 27/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return excel
    */
    public function download_manualcall_batch_report($file_name)
    {
        $file_name  = urldecode($file_name);
        $path = storage_path('app/manualcall_batch_report/'.$file_name);
        return response()->download($path);
    }

    /*
    * REASSIGN VIEW PAGE
    * @author RAHUL R.
    * @date 08/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return reassign view page
    */
    public function reassign_index(Campaign $campaign)
    {
        $campaign->load('batches.channel');
        $campaign_batches = $campaign->batches;
        $channels = array();
        foreach ($campaign_batches as $batch)
        {
            $channels[$batch->channel->id] = $batch->channel->name;
        }
        $batches = $campaign->batches->pluck('title', 'id')->all();
        $batches = array('' => 'Select Batch') + $batches;

        // $autoprocess_parent_stages  = AutomatedProcess::where('parent_id', 0)->pluck('process_name', 'id')->all();
        // $autoprocess_parent_stages = ['' => 'Select Customer Stage'] + $autoprocess_parent_stages;

        $campaign_channels  = array('' => 'Select Campaign Channel');
        $campaign_channels  = $campaign_channels + $channels;

        return view('campaigns.reassign_index', compact('campaign', 'batches','campaign_channels'));
    }

    /*
    * CAMPAIGN CONTACT REASSIGN LIST VIEW
    * @author RAHUL R.
    * @date 07/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return campaign contact reassign list view
    */
    public function contact_list_search(Request $request, Campaign $campaign)
    {
        $batch_id               = $request->post('batch');
        $group_id               = (int)$request->post('group');
        $customer_stage         = $request->post('customer_stage');
        $campaign_channel       = $request->post('campaign_channel');
        $communication_status   = $request->post('communication_status');
        $search_keywords        = $request->post('search_keywords');
        $group_ids              = array();
        $contacts               = collect([]);

        if (isset($group_id) && !empty($group_id))
        {
            $group_ids = [$group_id];
        }
        else if (isset($batch_id) && !empty($batch_id))
        {
            $batch = CampaignBatch::find($batch_id);
            if ($batch)
            {
                $group_ids = $batch->groups->pluck('id')->all();
            }
        }
        else
        {
            $group_ids = $campaign->groups->pluck('id')->all();
        }

        do {
            if (empty($group_ids))
            {
                break;
            }

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
                         ->where('status',config('constant.ACTIVE'))
                         ->where('report_field',1)
                         ->get();

            $contacts = CmpContact::select('ori_cmp_contacts.*')
                            ->join('ori_group_contacts', 'ori_group_contacts.contact_id', '=', 'ori_cmp_contacts.id')
                            ->leftJoin('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_cmp_contacts.user_id')
                            ->whereIn('ori_group_contacts.group_id', $group_ids)
                            ->where('ori_cmp_contacts.status', config('constant.ACTIVE'))
                            ->with('contact_details');

            if (isset($customer_stage) && !empty($customer_stage))
            {
                $customer_stage_children    = AutomatedProcess::select('id')->where('parent_id', $customer_stage)
                                                ->pluck('id')->all();
                $contacts->leftJoin('ori_automated_process_relations', 'ori_automated_process_relations.customer_id', '=', 'ori_customer_profiles.id')
                                ->whereIn('ori_automated_process_relations.auto_process_id', $customer_stage_children)
                                ->whereNotNull('ori_customer_profiles.id');
            }
            if (isset($campaign_channel) && !empty($campaign_channel) && isset($communication_status) && !empty($communication_status))
            {
                $contacts->leftJoin('ori_common_sms_email', 'ori_common_sms_email.contact_id', '=', 'ori_group_contacts.contact_id');
                if (isset($batch_id) && !empty($batch_id))
                {
                    $contacts->where('ori_common_sms_email.batch_id', '=', DB::raw($batch_id));
                }
               $contacts->where('ori_common_sms_email.sent_type', '=', DB::raw($campaign_channel));

                if ($campaign_channel == config('constant.CH_SMS'))
                {
                    $success_sms_status = config('constant.sms_success_status');
                    $success_sms_status = array_keys($success_sms_status);
                    $failure_sms_status = config('constant.sms_failure_status');
                    $failure_sms_status = array_keys($failure_sms_status);
                    $sms_status_array   = array();
                    if ($communication_status == 1)
                    {
                      $sms_status_array  = $success_sms_status;
                    }
                    else if ($communication_status == 2)
                    {
                      $sms_status_array  = $failure_sms_status;
                    }
                    if (!empty($sms_status_array))
                    {
                        $contacts->whereIn('ori_common_sms_email.status', $sms_status_array);
                    }
                }
                else if ($campaign_channel == config('constant.CH_EMAIL'))
                {
                    $success_mail_status   = config('constant.email_success_status');
                    $success_mail_status   = array_keys($success_mail_status);
                    $failure_mail_status = config('constant.email_failure_status');
                    $failure_mail_status = array_keys($failure_mail_status);
                    $mail_status_array   = array();
                    if ($communication_status == 1)
                    {
                      $mail_status_array  = $success_mail_status;
                    }
                    else if ($communication_status == 2)
                    {
                      $mail_status_array  = $failure_mail_status;
                    }
                    if (!empty($mail_status_array))
                    {
                        $contacts->whereIn('ori_common_sms_email.status', $mail_status_array);
                    }
                }
                else if ($campaign_channel == config('constant.CH_AUTODIAL'))
                {
                    $success_call_status  = config('constant.call_success_status');
                    $success_call_status  = array_keys($success_call_status);
                    $failure_call_status  = config('constant.call_failure_status');
                    $failure_call_status  = array_keys($failure_call_status);
                    $call_status_array    = array();
                    if ($communication_status == 1)
                    {
                        $call_status_array  = $success_call_status;
                    }
                    else if ($communication_status == 2)
                    {
                        $call_status_array = $failure_call_status;
                    }
                    if (!empty($call_status_array))
                    {
                        $contacts->whereIn('ori_common_sms_email.status', $call_status_array);
                    }
                }
            }
            if(isset($search_keywords) && !empty($search_keywords))
             {
                $contacts->where(function ($q2) use ($search_keywords,$deflt_fields) {

            
                    $q2->where(function ($q3) use ($search_keywords,$deflt_fields) {
                        foreach($deflt_fields as $fields)
                        {
                            $fname = $fields->field_name;
                            $q3->orWhere('ori_cmp_contacts.' . $fname, 'like', '%' . $search_keywords . '%');
                        }
                    }); 
                    $q2->orWhereHas('contact_details', function($q4) use($search_keywords) 
                    {
                        $q4->where('value', 'like', '%' . $search_keywords . '%');
                    });
                }); 
                            
             }
             $contacts = $contacts->groupBy('ori_cmp_contacts.id');
             $contact_count = $contacts->count();
            $contacts = $contacts->paginate(config('constant.pagination_constant'));

            $html   = view('campaigns.reassign_listview')->with(compact('contacts', 'fields', 'cust_fields','deflt_fields','contact_count'))->render();
            $result_arr=array('success' => true,'html' => $html);
            return json_encode($result_arr);
        }
        while(false);
    }

    /*
    * GET CHANNEL DROPDOWN DATA AS ARRAY
    * @author RAHUL R.
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return channel dropdown data json 
    */
    public function batch_channels(Request $request)
    {
        $batch_id       = $request->post('batch_id');
        $campaign_id    = $request->post('campaign_id');
        $batch_channels   = array();
        if ($batch_id)
        {
            $batch = CampaignBatch::find($batch_id);
            if ($batch)
            {
                $batch->load('channel');
                $batch_channel = $batch->channel;
                if ($batch_channel)
                {
                    $batch_channels += [$batch_channel->id => $batch_channel->name];
                }
            }
        }
        else
        {
            if ($campaign_id)
            {
                $channel_type_ids   = CampaignBatch::select(DB::raw('DISTINCT(ori_campaign_batches.channel_type)'))
                                        ->where('ori_campaign_batches.campaign_id', $campaign_id)
                                        ->pluck('channel_type')
                                        ->all();

                $campaign_channels  = Channel::whereIn('ori_channels.id', $channel_type_ids)
                                        ->pluck('name', 'id')->all();
                $batch_channels += $campaign_channels;
            }
        }

        return json_encode($batch_channels);

    }

    /*
    * GET CHANNEL COMMUNICATION STATUS DROPDOWN DATA AS ARRAY
    * @author RAHUL R.
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return channel communication status dropdown data json 
    */
    public function channel_communication_status(Request $request)
    {
        $channel_type       = $request->post('channel_type');
        $communication_status   = array();
        $channel_types = array(
            config('constant.CH_SMS'),
            config('constant.CH_EMAIL'),
            config('constant.CH_AUTODIAL')
        );

        if (in_array($channel_type, $channel_types))
        {
            $communication_status   = [
                1   => 'Success',
                2   => 'Failure'
            ];
        }

        return json_encode($communication_status);

    }

    public function reassign_contacts(SaveGroupRequest $request, Campaign $campaign)
    {
        $group_name = $request->post('name');
    }

    public function pause_batch(Request $request)
    {
        $batch_id   = (int)$request->post('batch_id');
        $now = Carbon::now()->toDateTimeString();
        $success = config('constant.INACTIVE');
        do
        {
            $batch      = CampaignBatch::find($batch_id);
            if (!$batch)
            {
                break;
            }
            $batch_type = $batch->channel_type;
            if ($batch->status == config('constant.PAUSED'))
            {
                $message = 'Campaign Batch Already Paused';
                break;
            }
            else if ($batch->status == config('constant.INACTIVE'))
            {
                $batch->status = config('constant.PAUSED');
                $batch->save();
            }
            else
            {
                $message = 'Campaign Batch cannot be paused';
                break;
            }

            if (in_array($batch_type, [config('constant.CH_SMS'),config('constant.CH_EMAIL'),config('constant.CH_PUSH_MESSAGES')]))
            {
                $update_array   = array('status' => config('constant.PAUSED'));
                CommonSmsEmail::where('batch_id',$batch->id)
                                ->where('status', config('constant.INACTIVE'))
                                ->update($update_array);
            }
            else if (in_array($batch_type, [config('constant.CH_MANUAL_CALL'),config('constant.CH_AUTODIAL')]))
            {
                $open_status = Helpers::get_company_meta('open_status',$batch->cmpny_id);
                $update_array   = array(
                    'ori_common_sms_email.status'   => config('constant.PAUSED'),
                    'ori_common_sms_email.updated_at'   => $now,
                    'ori_lead_followups.updated_at'     => $now,
                    'ori_lead_followups.deleted_at'     => $now
                );
                $results = DB::table('ori_common_sms_email')->join('ori_lead_followups','ori_lead_followups.id','=','ori_common_sms_email.follow_id')
                            ->where('ori_common_sms_email.batch_id',$batch->id)
                            ->where('ori_lead_followups.batch_id', $batch->id)
                            ->where('ori_lead_followups.query_status',$open_status);

                $results->where(function($results)
                {
                    $results->orWhere('ori_common_sms_email.status',config('constant.INACTIVE'))
                            ->orWhere('ori_common_sms_email.status',config('constant.ACTIVE'));
                });
                $updated_count = $results->update($update_array);
            }
            $success = config('constant.ACTIVE');
            $message = 'Campaign Paused Successfully';
        }
        while(FALSE);

        if ($success == config('constant.INACTIVE'))
        {
            $message = $message ?? 'Campaign Batch cannot be paused. Please try again';
        }

        return (json_encode(array('status' => $success, 'message' => $message)));
    }

    public function resume_batch(Request $request)
    {
        $batch_id   = (int)$request->post('batch_id');
        $now = Carbon::now()->toDateTimeString();
        $success = config('constant.INACTIVE');
        do
        {
            $batch      = CampaignBatch::find($batch_id);
            if (!$batch)
            {
                break;
            }
            $batch_type = $batch->channel_type;

            if ($batch->status == config('constant.INACTIVE'))
            {
                $message = 'Campaign Batch Already Resumed';
                break;
            }
            elseif ($batch->status == config('constant.PAUSED'))
            {
                if (in_array($batch_type, [config('constant.CH_SMS'),config('constant.CH_EMAIL'),config('constant.CH_PUSH_MESSAGES')]))
                {
                    $update_array   = array('status' => config('constant.INACTIVE'));
                    CommonSmsEmail::where('batch_id',$batch->id)
                                    ->where('status', config('constant.PAUSED'))
                                    ->update($update_array);
                }
                else if (in_array($batch_type, [config('constant.CH_MANUAL_CALL'),config('constant.CH_AUTODIAL')]))
                {
                    $open_status = Helpers::get_company_meta('open_status',$batch->cmpny_id);
                    $update_array   = array(
                        'ori_common_sms_email.status'       => config('constant.INACTIVE'),
                        'ori_common_sms_email.updated_at'   => $now,
                        'ori_lead_followups.updated_at'     => $now,
                        'ori_lead_followups.deleted_at'     => $now
                    );
                    $results = DB::table('ori_common_sms_email')->join('ori_lead_followups','ori_lead_followups.id','=','ori_common_sms_email.follow_id')
                            ->where('ori_common_sms_email.batch_id', $batch->id)
                            ->where('ori_lead_followups.batch_id', $batch->id)
                            ->where('ori_lead_followups.query_status',$open_status)
                            ->where('ori_common_sms_email.status', config('constant.PAUSED'));
                    $updated_count  = $results->update($update_array);
                }
                $batch->status = config('constant.INACTIVE');
                $batch->save();
                $success = config('constant.ACTIVE');
                $message = "Campaign Batch resumed successfully";
            }
            else
            {
                $message = 'Campaign Batch cannot be resumed';
                break;
            }

        }
        while(FALSE);

        if ($success == config('constant.INACTIVE'))
        {
            $message = $message ?? 'Campaign Batch cannot be resumed. Please try again';
        }

        return (json_encode(array('status' => $success, 'message' => $message)));

    }
}
