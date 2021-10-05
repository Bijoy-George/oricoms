<?php

namespace App\Http\Controllers\API;

use App\CampaignBatch;
use App\Channel;
use App\CustomerProfile;
use App\CustomerResponse;
use App\FaqCategories;
use App\FeedbackDetail;
use App\Helpdesk;
use App\Helpers;
use App\Http\Controllers\Controller;
use App\LeadFollowup;
use App\LeadSources;
use App\QueryStatusRelation;
use App\QueryTypes;
use App\User;
use App\TrendingQuery;
use App\LocationSettings;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardApiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | API Controller
    |--------------------------------------------------------------------------
    */


    public function __construct()
    {
    }
    
    /**
    * Lead line chart API
    * @author Chinnu L
    * @date 31/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    function leads_line_chart(Request $request)
    {
            $response           =   $request->all();
            // $response['ann_start_date'] = '01/12/2017';
            // $response['ann_end_date'] = '31/12/2018';
            // $response['cmpny_id'] = 2;
                    
            $ann_start_dt = str_replace("/","-",$response['ann_start_date']);
            $ann_end_dt = str_replace("/","-",$response['ann_end_date']);
            $ann_start_dt = date("Y-m-d", strtotime($ann_start_dt)).' 00:00:00';;
            $ann_end_dt = date('Y-m-d',strtotime($ann_end_dt)).' 23:59:59';
            $ann_start_dt1          =   date("d-m-Y", strtotime($ann_start_dt)).' 00:00:00';;
	    $ann_end_dt1          =   date("d-m-Y", strtotime($ann_end_dt)).' 23:59:59';
            $ann_end_dt2 = Carbon::parse($ann_end_dt)->addDays(1)->format('Y-m-d');
            
            $cmpny_id = $response['cmpny_id'];
            // Lead line graph data
            $results1 = CustomerProfile::select('id',DB::raw('count(`id`) as total'),DB::raw('DATE(`created_at`) as cdate'))
                        ->where('cmpny_id',$cmpny_id)
			->whereBetween('created_at', array($ann_start_dt, $ann_end_dt))
                        ->groupBy(DB::raw('DATE(`created_at`)'))
                        ->orderBy(DB::raw('DATE(`created_at`)'));
            $results1->where(function($results1) 
                        {
                             $results1->where('ori_customer_profiles.profile_status',1);
                             $results1->orWhereNull('ori_customer_profiles.profile_status');       

                        });
            $list_count1 = $results1->get();
//            echo '<pre>';
//            print_r($list_count);
//            echo '</pre>';die;

            $graph_data = array();
            $quries_date_line_chart_series = array();
            $graph_data['graph_title'] = 'Lead Date Wise Count'; 
            $graph_data['X_title'] = 'Date'; 
            $graph_data['Y_title'] = 'Lead Count'; 
            if($list_count1->count()>0)
            {  
                    $graph_data[1]['series_name'] = 'Leads'; 
                    $quries_date_line_chart_series = array();
                    foreach ($list_count1 as $val)
                    {
                            $cdate = strtotime($val->cdate);
                            $cdateyear = date('Y', $cdate);
                            $cdatemonth = date('m', $cdate)-1;
                            $cdatedate = date('d', $cdate);
                            $cdateUTC = $cdateyear.','.$cdatemonth.','.$cdatedate;
                            $total_count = $val->total;
                            $quries_date_line_chart_series[] = array($cdateUTC,$total_count);
                    }
                    $graph_data[1]['data'] = $quries_date_line_chart_series; 
            }
            
            // Customer line graph data
            $results2 = CustomerProfile::select('id',DB::raw('count(`id`) as total'),DB::raw('DATE(`created_at`) as cdate'))
                        ->where('cmpny_id',$cmpny_id)
			->whereBetween('created_at', array($ann_start_dt, $ann_end_dt))
                        ->where('ori_customer_profiles.profile_status',2)
                        ->groupBy(DB::raw('DATE(`created_at`)'))
                        ->orderBy(DB::raw('DATE(`created_at`)'));
            $list_count2 = $results2->get();
//            echo '<pre>';
//            print_r($list_count);
//            echo '</pre>';die;

            if($list_count2->count()>0)
            {  
                    $graph_data[2]['series_name'] = 'Customers'; 
                    $quries_date_line_chart_series = array();
                    foreach ($list_count2 as $val)
                    {
                            $cdate = strtotime($val->cdate);
                            $cdateyear = date('Y', $cdate);
                            $cdatemonth = date('m', $cdate)-1;
                            $cdatedate = date('d', $cdate);
                            $cdateUTC = $cdateyear.', '.$cdatemonth.', '.$cdatedate;
                            $total_count = $val->total;
                            $quries_date_line_chart_series[] = array($cdateUTC,$total_count);
                    }
                    $graph_data[2]['data'] = $quries_date_line_chart_series; 
            }

            // Customer line graph data
            $results3 = Helpdesk::select('id',DB::raw('count(`id`) as total'),DB::raw('DATE(`created_at`) as cdate'))
                        ->where('cmpny_id',$cmpny_id)
            ->whereBetween('created_at', array($ann_start_dt, $ann_end_dt))
                        ->whereHas('GetCustomer')
                        ->groupBy(DB::raw('DATE(`created_at`)'))
                        ->orderBy(DB::raw('DATE(`created_at`)'));
            $list_count3 = $results3->get();
//            echo '<pre>';
//            print_r($list_count);
//            echo '</pre>';die;

            if($list_count3->count()>0)
            {  
                    $graph_data[3]['series_name'] = 'Enquiries'; 
                    $quries_date_line_chart_series = array();
                    foreach ($list_count3 as $val)
                    {
                            $cdate = strtotime($val->cdate);
                            $cdateyear = date('Y', $cdate);
                            $cdatemonth = date('m', $cdate)-1;
                            $cdatedate = date('d', $cdate);
                            $cdateUTC = $cdateyear.', '.$cdatemonth.', '.$cdatedate;
                            $total_count = $val->total;
                            $quries_date_line_chart_series[] = array($cdateUTC,$total_count);
                    }
                    $graph_data[3]['data'] = $quries_date_line_chart_series; 
            }
            return $graph_data;
    } 

    /**
    * Lead line Heat Map API
    * @author Rajesh Balan
    * @date 31/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return
   */
	function lead_source_week(Request $request) {
		$response           =   $request->all();
        $ann_start_dt = str_replace("/","-",$response['ann_start_date']);
        $ann_end_dt = str_replace("/","-",$response['ann_end_date']);
        $ann_start_dt = date("Y-m-d", strtotime($ann_start_dt)).' 00:00:00';;
        $ann_end_dt = date('Y-m-d',strtotime($ann_end_dt)).' 23:59:59';
		$cmpny_id = $response['cmpny_id'];
		$week_source_lead =array();
		
		$week_days = array('0','1','2','3','4','5','6');
		$lead_source = LeadSources::select('id','name')->where('cmpny_id',$cmpny_id)->where('status',config('constant.ACTIVE'))->get();
		foreach($lead_source as $source) {
			$lead_source_array[$source->id] = $source->name;
			$week_source_lead['name'][] = $source->name;
		}
        $lead_source_array[0] = 'Not Specified';
        $week_source_lead['name'][] = 'Not Specified';

		$results3 = CustomerProfile::select('source','week',DB::raw("COUNT(created_at) AS 'lead_count'"))
		->rightjoin(DB::raw("( SELECT 0 AS week UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 ) AS AllWeek "), DB::raw("WEEKDAY(created_at)"), '=', DB::raw("week"));
		$results3->where('ori_customer_profiles.cmpny_id', $cmpny_id);
		$results3->whereBetween('ori_customer_profiles.created_at', [$ann_start_dt, $ann_end_dt]);
        $results3->groupBy('source');
        $results3->groupBy('week');
		$results3->orderBy('source');
        $results3->orderBy('week');
                        
		$lead_source_week   = $results3->get();
		foreach($lead_source_week as $value3) {
			$source = (int)$value3->source;
			$weekreg[$lead_source_array[$source]][$value3->week] = $value3->lead_count;
		}
		$i=0;
		$j=0;
		$week_source_lead_arr = array();
		
		foreach($lead_source_array as $key=>$sources) {
			$j = 0;
			foreach($week_days as $weeks) {
				if(isset($weekreg[$sources])) {
					if(isset($weekreg[$sources][$weeks])) {
						$lead_count = $weekreg[$sources][$weeks];
						$week_source_lead_arr[] = [$i,$j,$lead_count];
					} else {
						$week_source_lead_arr[] = [$i,$j,0];
					}
				} else {
					$week_source_lead_arr[] = [$i,$j,0];
				}
				$j++;
			}
			$i++;
		}
		$week_source_lead['value'] = $week_source_lead_arr;
		return json_encode($week_source_lead);
	}

    /**
    * Weekday Category Queries Heat Map API
    * @author Rahul Raveendran
    * @date 21/02/2019
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    function query_category_week(Request $request) {
        $response           =   $request->all();
        $ann_start_dt = str_replace("/","-",$response['ann_start_date']);
        $ann_end_dt = str_replace("/","-",$response['ann_end_date']);
        $ann_start_dt = date("Y-m-d", strtotime($ann_start_dt)).' 00:00:00';;
        $ann_end_dt = date('Y-m-d',strtotime($ann_end_dt)).' 23:59:59';
        $cmpny_id = $response['cmpny_id'];
        $week_category_query =array();
        
        $week_days = array('0','1','2','3','4','5','6');
        $categories =  FaqCategories::select('ori_mast_faq_categories.category_name', 'ori_mast_faq_categories.id')
        ->where('ori_mast_faq_categories.cmpny_id',$cmpny_id)
        ->where('ori_mast_faq_categories.status',config('constant.ACTIVE'))
        ->whereNull('ori_mast_faq_categories.parent_category_id')
        ->orderBy('ori_mast_faq_categories.sort_order')
        ->get();
        $category_ids = $categories->pluck('id')->all();

        foreach($categories as $category) {
            $category_array[$category->id]  = $category->category_name;
            $week_category_query['name'][]     = $category->category_name;
        }
        $week_category_query['name'][]  = 'Total';

        // $results3 = CustomerProfile::select('source','week',DB::raw("COUNT(created_at) AS 'lead_count'"))
        // ->rightjoin(DB::raw("( SELECT 0 AS week UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 ) AS AllWeek "), DB::raw("WEEKDAY(created_at)"), '=', DB::raw("week"));
        // $results3->where('ori_customer_profiles.cmpny_id', $cmpny_id);
        // $results3->whereBetween('ori_customer_profiles.created_at', [$ann_start_dt, $ann_end_dt]);
        // $results3->groupBy('source');
        // $results3->groupBy('week');
        // $results3->orderBy('source');
        // $results3->orderBy('week');

        $followup_weekly_count = LeadFollowup::select('ori_lead_followups.query_category', 'week', DB::raw("COUNT(created_at) AS 'query_count'"))
                                 ->rightjoin(DB::raw("( SELECT 0 AS week UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 ) AS AllWeek "), DB::raw("WEEKDAY(created_at)"), '=', DB::raw("week"))
                                 ->where('ori_lead_followups.cmpny_id', $cmpny_id)
                                 ->whereIn('ori_lead_followups.query_category',$category_ids)
                                 ->whereBetween('ori_lead_followups.created_at', [$ann_start_dt, $ann_end_dt])
                                 ->groupBy('ori_lead_followups.query_category')
                                 ->groupBy('week')
                                 ->orderBy('ori_lead_followups.query_category')
                                 ->orderBy('week');
                        
        $followup_weekly_count   = $followup_weekly_count->get();

        $helpdesk_weekly_count = Helpdesk::select('ori_helpdesk.query_category', 'week', DB::raw("COUNT(created_at) AS 'query_count'"))
                                 ->rightjoin(DB::raw("( SELECT 0 AS week UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 ) AS AllWeek "), DB::raw("WEEKDAY(created_at)"), '=', DB::raw("week"))
                                 ->where('ori_helpdesk.cmpny_id', $cmpny_id)
                                 ->whereIn('ori_helpdesk.query_category',$category_ids)
                                 ->whereBetween('ori_helpdesk.created_at', [$ann_start_dt, $ann_end_dt])
                                 ->groupBy('ori_helpdesk.query_category')
                                 ->groupBy('week')
                                 ->orderBy('ori_helpdesk.query_category')
                                 ->orderBy('week');
                        
        $helpdesk_weekly_count   = $helpdesk_weekly_count->get();

        foreach($followup_weekly_count as $query_count) {
            $category = (int)$query_count->query_category;
            $weekreg[$category_array[$category]][$query_count->week]['total_count'] = $query_count->query_count;
            $weekreg[$category_array[$category]][$query_count->week]['followup_count'] = $query_count->query_count;
        }
        foreach($helpdesk_weekly_count as $query_count) {
            $category = (int)$query_count->query_category;
            $followup_count = $weekreg[$category_array[$category]][$query_count->week]['total_count'] ?? 0;
            // $weekreg[$category_array[$category]][$query_count->week]['total_count'] = (isset($followup_count) && !empty($followup_count)) ? ($followup_count + $query_count->query_count) : $query_count->query_count;
            if ($followup_count)
            {
                $weekreg[$category_array[$category]][$query_count->week]['total_count'] = $followup_count + $query_count->query_count;
            }
            else
            {
                $weekreg[$category_array[$category]][$query_count->week]['total_count'] = $query_count->query_count;
            }
            $weekreg[$category_array[$category]][$query_count->week]['helpdesk_count'] = $query_count->query_count;
        }
        $i=0;
        $j=0;
        $week_category_query_arr = array();
        $week_seperate_query_type_count = array();
        
        foreach($category_array as $key=>$category) {
            $j = 0;
            foreach($week_days as $weeks) {
                if(isset($weekreg[$category])) {
                    if(isset($weekreg[$category][$weeks]['total_count'])) {
                        $qry_count = $weekreg[$category][$weeks]['total_count'];
                        $followup_count = $weekreg[$category][$weeks]['followup_count'] ?? 0;
                        $helpdesk_count = $weekreg[$category][$weeks]['helpdesk_count'] ?? 0;
                        $week_category_query_arr[] = [$i,$j,$qry_count];
                        $week_seperate_query_type_count[$i][$j] = [$helpdesk_count, $followup_count];
                    } else {
                        $week_category_query_arr[] = [$i,$j,0];
                        $week_seperate_query_type_count[$i][$j] = [0, 0];
                    }
                } else {
                    $week_category_query_arr[] = [$i,$j,0];
                    $week_seperate_query_type_count[$i][$j] = [0, 0];
                }
                $j++;
            }
            $i++;
        }
        $total_index = $i;
        $total_queries_count_arr = array();
        $helpdesk_queries_count_arr = array();
        $followup_queries_count_arr = array();
        foreach ($week_category_query_arr as $key => $count_arr)
        {
            $j = $count_arr[1];
            $count = $count_arr[2];
            $query_separate_count = $week_seperate_query_type_count[$count_arr[0]][$j];
            $total_queries_count_arr[$j] = (isset($total_queries_count_arr[$j]) && !empty($total_queries_count_arr[$j])) ? $total_queries_count_arr[$j] + $count : $count;
            $helpdesk_queries_count_arr[$j] = (isset($helpdesk_queries_count_arr[$j]) && !empty($helpdesk_queries_count_arr[$j])) ? $helpdesk_queries_count_arr[$j] + $query_separate_count[0] : $query_separate_count[0];
            $followup_queries_count_arr[$j] = (isset($followup_queries_count_arr[$j]) && !empty($followup_queries_count_arr[$j])) ? $followup_queries_count_arr[$j] + $query_separate_count[1] : $query_separate_count[1];

        }
        foreach ($total_queries_count_arr as $key => $count)
        {
            $week_category_query_arr[]  = [$total_index,$key,$count];
            $week_seperate_query_type_count[$total_index][$key] = [$helpdesk_queries_count_arr[$key],$followup_queries_count_arr[$key]];
        }
        $week_category_query['value'] = $week_category_query_arr;
        $week_category_query['separated_value'] = $week_seperate_query_type_count;
        return json_encode($week_category_query);
    }

	  /**

    * General enquiry oie chart API
    * @author AKHIL MURUKAN
    * @date 31/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    function general_enquiry_pie_chart(Request $request)
    {
            $response           =   $request->all();
            $ann_start_dt = str_replace("/","-",$response['ann_start_date']);
            $ann_end_dt = str_replace("/","-",$response['ann_end_date']);
            $start_date = date("Y-m-d", strtotime($ann_start_dt)).' 00:00:00';
            $end_date = date('Y-m-d',strtotime($ann_end_dt)).' 23:59:59';
			$key  = $response['category'];
			$cmpny_id = $response['cmpny_id'];
			$pie_one = array();
			$tolal_leads = array();
			
			$tolal_leads = QueryStatusRelation::select('ori_mast_query_status.color','ori_mast_query_type.type as TYPE','ori_mast_query_type.query_type as QUERY_NAME','ori_mast_query_status.id as IDS','ori_mast_query_status.name','ori_mast_query_status_relation.query_type_id as QUERY_TYPE_ID')
										  ->join('ori_mast_query_status','ori_mast_query_status.id','=','ori_mast_query_status_relation.query_status_id')
										  ->leftjoin('ori_mast_query_type','ori_mast_query_type.id','=','ori_mast_query_status_relation.query_type_id')
										  ->where('ori_mast_query_status.status', 1)
										  ->where('ori_mast_query_status_relation.query_type_id', $key)
										  ->where('ori_mast_query_status_relation.status',config('constant.ACTIVE'))
										  ->where('ori_mast_query_status_relation.cmpny_id',$cmpny_id)
										  ->get();
											//	  echo "<pre>";
											//	  print_r($tolal_leads);die;
					$cnt=$tolal_leads->count();  
                    $color_arr=array(); 
					if(isset($cnt) && $cnt !=0)
					{
					$datas = array();
					
						$enq_flag = 0;
						foreach ($tolal_leads as  $value_s)
						{   
							$lead_status_id = $value_s->IDS; 
							$query_type_id = $value_s->QUERY_TYPE_ID;
							//$key = $value_s->QUERY_NAME;
						    $query_type = $value_s->TYPE;
							$lead_status_name = $value_s->name;
							$color = $value_s->color;
							
							if($query_type == 2){

								$lead_cnt           =   LeadFollowup::where('query_status',$lead_status_id)->where('query_type',$query_type_id)
                                                        ->with('GetCustomer')
                                                        ->whereHas('GetCustomer')
								//->whereBetween('created_at', array($start_date, $end_date))
								->count();
							}else
							{
								
								$lead_cnt           =   Helpdesk::where('query_status',$lead_status_id)->where('query_type',$query_type_id)
                                                        ->with('GetCustomer')
                                                        ->whereHas('GetCustomer')
								//->whereBetween('created_at', array($start_date, $end_date))
								->count();
							}
							if($lead_cnt>0)
							{								$enq_flag++;
							//$datas[$key] .="{name:'".$lead_status_name."',color:'".$color."',y:".$lead_cnt."},";
                            $datas[] =array(
                                'name' => $lead_status_name,
                                //'color' => $color,
                                'y' => $lead_cnt
                            );
                            $color_arr[]='#'.$color;
  							}
						}
															if($enq_flag>0)
															{
																//echo 1;
																//$pie_one[$key] = rtrim($datas[$key],",");
                                                                $pie_one  = $datas;
															}
															else 
															{
																//echo 2;
																$pie_one = array();
															}
					}  	
					else 
					{
					//	$pie_one[$key] = '';
					}
				$arr1=array('color_arr'=>$color_arr,'pie_one'=>$pie_one);	
				//	print_r($pie_one);die;
            return json_encode($arr1);
	}

  /**
    * Api for getting survey details
    * @author Reshma Rajan
    * @date 31/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function survey_details(){  

        $ann_start_dt = str_replace("/","-",request('ann_start_date'));
        $ann_end_dt = str_replace("/","-",request('ann_end_date'));
        $ann_start_dt = date("Y-m-d", strtotime($ann_start_dt)).' 00:00:00';;
        $ann_end_dt = date('Y-m-d',strtotime($ann_end_dt)).' 23:59:59';
        $survey_arr=array();
        $survey_stat =array(); 
        $survey_result =array();
        $survey_count =array();
        $survey=CampaignBatch::select('survey_id','campaign_id','id','created_at','survey_id',DB::raw('SUM(processed_count) as target_count'))
         ->with('survey_mast')
         ->with(['survey_det' => function ($q){ $q->where('status',config('constant.ACTIVE'));
            }])
         ->where('status',config('constant.ACTIVE'))
         ->whereNotNull('survey_id')
         ->where('cmpny_id', request('cmpny_id'))
         ->groupBy('survey_id')
         ->whereBetween('created_at', [$ann_start_dt, $ann_end_dt])
         ->get();

       foreach ($survey as  $value)
        {
            if(!empty($value['survey_mast']['survey_name_lang2']))
            {
                $survey_arr[]=$value['survey_mast']['survey_name_lang2'];  
            }else{
                if(!empty($value['survey_mast']['survey_name_lang1']))
                {
                  $survey_arr[]=$value['survey_mast']['survey_name_lang1'];  
                }
            }
            $res_count=count($value['survey_det']);
            $total=$value->target_count;
            $survey_count['submitted'][]=$res_count;
            $survey_count['not_submitted'][]=$total-$res_count;
            
         }
         $survey_result['survey_det']=$survey_arr; 
         $survey_result['survey_count']=$survey_count;
        return json_encode($survey_result);       
                       
    } 
    
    /**
    * Api for getting helpdesk summary details
    * @author Elavarasi S
    * @date 31/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return
    */
    public function helpdesk_summary(Request $request) {
        $response           =   $request->all();
        $ann_start_dt       = request('ann_start_date');
        $ann_end_dt         = request('ann_end_date');
        
        $ann_start_dt = str_replace("/","-",$ann_start_dt);
        $ann_end_dt = str_replace("/","-",$ann_end_dt);
        $ann_start_dt = date("Y-m-d", strtotime($ann_start_dt)).' 00:00:00';;
        $ann_end_dt = date('Y-m-d',strtotime($ann_end_dt)).' 23:59:59';

        $cmpny_id = $response['cmpny_id'];
        $query_type_data = array();

        $query_types_array = QueryTypes::orderBy('query_type')->where('cmpny_id',$cmpny_id)->where('status',config('constant.ACTIVE'))->pluck('query_type', 'id')->all();
        $query_type_data['query_type_names'] = array_values($query_types_array);

        $query_type_ids = array_keys($query_types_array);

        // master status array
        $query_status = QueryStatusRelation::select('ori_mast_query_status.id','ori_mast_query_status.name')
                        ->leftjoin('ori_mast_query_status','ori_mast_query_status.id','=','ori_mast_query_status_relation.query_status_id')
                        ->where('ori_mast_query_status_relation.status',config('constant.ACTIVE'))
                        ->whereIn('ori_mast_query_status_relation.query_type_id', $query_type_ids)
                        ->where('ori_mast_query_status_relation.status',config('constant.ACTIVE'))
                        ->where('ori_mast_query_status_relation.cmpny_id',$cmpny_id)
                        ->where('ori_mast_query_status.cmpny_id',$cmpny_id)
                        ->groupBy('ori_mast_query_status.id')
                        ->groupBy('ori_mast_query_status.name')
                        ->where('ori_mast_query_status_relation.deleted_at', '=', Null)
                        ->get();
        $query_status_array = $query_status->pluck('name', 'id')->all();

        $query_type_data['query_status_names'] = array_values($query_status_array);
        $query_status_ids   = array_keys($query_status_array);

        $query_type_counts = Helpdesk::select(DB::raw('count(query_type) as counts'),'ori_helpdesk.query_status','query_type')
                                    ->join('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_helpdesk.customer_id')
                                    ->whereNull('ori_customer_profiles.deleted_at')
                                    ->where('ori_helpdesk.status',config('constant.ACTIVE'))
                                    ->whereIn('ori_helpdesk.query_type', $query_type_ids)
                                    ->whereIn('ori_helpdesk.query_status', $query_status_ids);

        // if (isset($ann_start_dt) && !empty($ann_start_dt) && isset($ann_end_dt) && !empty($ann_end_dt))
        // {
        //     $query_type_counts->whereBetween('ori_helpdesk.created_at', [$ann_start_dt, $ann_end_dt]);
        // }

        $query_type_counts = $query_type_counts->groupBy('ori_helpdesk.query_status')
                                    ->groupBy('query_type')
                                    ->orderBy('ori_helpdesk.query_status')
                                    ->orderBy('query_type')
                                    ->get();

        foreach ($query_type_counts as $query_type_status_count)
        {
            $query_type = $query_type_status_count->query_type;
            $query_status = $query_type_status_count->query_status;
            $query_type_counts_data[$query_types_array[$query_type]][$query_status_array[$query_status]]    = $query_type_status_count->counts;
        }

        $i = 0;
        $j = 0;

        $query_type_status_array    = array();

        foreach ($query_types_array as $query_type_id => $query_type_name)
        {
            $j = 0;
            foreach ($query_status_array as $query_status_id => $query_status_name)
            {
                if (isset($query_type_counts_data[$query_type_name]))
                {
                    if (isset($query_type_counts_data[$query_type_name][$query_status_name]))
                    {
                        $query_count = $query_type_counts_data[$query_type_name][$query_status_name];
                        $query_type_status_array[]  = [$i,$j,$query_count];
                    }
                    else
                    {
                        $query_type_status_array[]  = [$i,$j,0];
                    }
                }
                else
                {
                    $query_type_status_array[]  = [$i,$j,0];
                }
                $j++;
            }
            $i++;
        }
        $query_type_data['value']   = $query_type_status_array;
        return json_encode($query_type_data);       
    }

    /**
    * Api for getting helpdesk summary details
    * @author Rahul Raveendran
    * @date 31/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return
    */
    public function agentwise_helpdesk_summary(Request $request) {
        $response           =   $request->all();
        $ann_start_dt       = request('ann_start_date');
        $ann_end_dt         = request('ann_end_date');
        
        $ann_start_dt = str_replace("/","-",$ann_start_dt);
        $ann_end_dt = str_replace("/","-",$ann_end_dt);
        $ann_start_dt = date("Y-m-d", strtotime($ann_start_dt)).' 00:00:00';;
        $ann_end_dt = date('Y-m-d',strtotime($ann_end_dt)).' 23:59:59';

        $cmpny_id = $response['cmpny_id'];
        $agent_data = array();

        $query_types_array = QueryTypes::orderBy('query_type')->where('cmpny_id',$cmpny_id)->where('status',config('constant.ACTIVE'))->pluck('query_type', 'id')->all();
        // $agent_data['query_type_names'] = array_values($query_types_array);

        $query_type_ids = array_keys($query_types_array);

        // master status array
        $query_status = QueryStatusRelation::select('ori_mast_query_status.id','ori_mast_query_status.name')
                        ->leftjoin('ori_mast_query_status','ori_mast_query_status.id','=','ori_mast_query_status_relation.query_status_id')
                        ->where('ori_mast_query_status_relation.status',config('constant.ACTIVE'))
                        ->whereIn('ori_mast_query_status_relation.query_type_id', $query_type_ids)
                        ->where('ori_mast_query_status_relation.status',config('constant.ACTIVE'))
                        ->where('ori_mast_query_status_relation.cmpny_id',$cmpny_id)
                        ->where('ori_mast_query_status.cmpny_id',$cmpny_id)
                        ->groupBy('ori_mast_query_status.id')
                        ->groupBy('ori_mast_query_status.name')
                        ->where('ori_mast_query_status_relation.deleted_at', '=', Null)
                        ->get();
        $query_status_array = $query_status->pluck('name', 'id')->all();

        $agent_data['query_status_names'] = array_values($query_status_array);
        $query_status_ids   = array_keys($query_status_array);

        $agentwise_counts = Helpdesk::select(DB::raw('count(query_type) as counts'),'ori_helpdesk.query_status','ori_helpdesk.created_by')
                                    ->join('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_helpdesk.customer_id')
                                    ->whereNull('ori_customer_profiles.deleted_at')
                                    ->where('ori_helpdesk.status',config('constant.ACTIVE'))
                                    ->whereIn('ori_helpdesk.query_status', $query_status_ids);

        // if (isset($ann_start_dt) && !empty($ann_start_dt) && isset($ann_end_dt) && !empty($ann_end_dt))
        // {
        //     $query_type_counts->whereBetween('ori_helpdesk.created_at', [$ann_start_dt, $ann_end_dt]);
        // }

        $agentwise_counts = $agentwise_counts->groupBy('ori_helpdesk.query_status')
                                    ->groupBy('ori_helpdesk.created_by')
                                    ->orderBy('ori_helpdesk.query_status')
                                    ->orderBy('ori_helpdesk.created_by')
                                    ->get();

        $agent_list = $agentwise_counts->unique('created_by')->pluck('created_by')->all();
        $agents_array = User::find($agent_list)->pluck('name', 'id')->all();
        $agent_data['agent_names']  = array_values($agents_array);
        foreach ($agentwise_counts as $agentwise_status_count)
        {
            $agent_id = $agentwise_status_count->created_by;
            $query_status = $agentwise_status_count->query_status;
            $agent_counts_data[$agents_array[$agent_id]][$query_status_array[$query_status]]    = $agentwise_status_count->counts;
        }

        $i = 0;
        $j = 0;

        $agent_status_array    = array();

        foreach ($agents_array as $agent_id => $agent_name)
        {
            $j = 0;
            foreach ($query_status_array as $query_status_id => $query_status_name)
            {
                if (isset($agent_counts_data[$agent_name]))
                {
                    if (isset($agent_counts_data[$agent_name][$query_status_name]))
                    {
                        $query_count = $agent_counts_data[$agent_name][$query_status_name];
                        $agent_status_array[]  = [$i,$j,$query_count];
                    }
                    else
                    {
                        $agent_status_array[]  = [$i,$j,0];
                    }
                }
                else
                {
                    $agent_status_array[]  = [$i,$j,0];
                }
                $j++;
            }
            $i++;
        }
        $agent_data['value']   = $agent_status_array;
        return json_encode($agent_data);       
    }

    /**
    * Api for getting escalation summary details
    * @author Elavarasi S
    * @date 31/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return
    */
    public function escalation_summary(Request $request) {

        $response           = $request->all();
        $ann_start_dt       = request('ann_start_date');
        $ann_end_dt         = request('ann_end_date');

        $ann_start_dt = str_replace("/","-",$response['ann_start_date']);
        $ann_end_dt = str_replace("/","-",$response['ann_end_date']);
        $ann_start_dt = date("Y-m-d", strtotime($ann_start_dt)).' 00:00:00';;
        $ann_end_dt = date('Y-m-d',strtotime($ann_end_dt)).' 23:59:59';

        $cmpny_id = $response['cmpny_id'];
        $query_type_data = array();
        $query_types_array = QueryTypes::orderBy('query_type')->where('cmpny_id',$cmpny_id)->where('status',config('constant.ACTIVE'))->where('type',config('constant.TICKET'))->pluck('query_type', 'id')->all();
        $query_type_data['query_type_names'] = array_values($query_types_array);

        $query_type_ids = array_keys($query_types_array);

        // master status array
        $query_status = QueryStatusRelation::select('ori_mast_query_status.id','ori_mast_query_status.name')
                        ->leftjoin('ori_mast_query_status','ori_mast_query_status.id','=','ori_mast_query_status_relation.query_status_id')
                        ->where('ori_mast_query_status_relation.status',config('constant.ACTIVE'))
                        ->whereIn('ori_mast_query_status_relation.query_type_id', $query_type_ids)
                        ->where('ori_mast_query_status_relation.status',config('constant.ACTIVE'))
                        ->where('ori_mast_query_status_relation.cmpny_id',$cmpny_id)
                        ->where('ori_mast_query_status.cmpny_id',$cmpny_id)
                        ->groupBy('ori_mast_query_status.id')
                        ->groupBy('ori_mast_query_status.name')
                        ->where('ori_mast_query_status_relation.deleted_at', '=', Null)
                        ->get();
        $query_status_array = $query_status->pluck('name', 'id')->all();

        $query_type_data['query_status_names'] = array_values($query_status_array);
        $query_status_ids   = array_keys($query_status_array);

        $query_type_counts = Helpdesk::select(DB::raw('count(query_type) as counts'),'ori_helpdesk.query_status','query_type')
                                        ->join('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_helpdesk.customer_id')
                                        ->whereNull('ori_customer_profiles.deleted_at')
                                        ->where('ori_helpdesk.status',config('constant.ACTIVE'))
                                        ->whereIn('ori_helpdesk.query_type', $query_type_ids)
                                        ->whereIn('ori_helpdesk.query_status', $query_status_ids)
                                        ->where('ori_helpdesk.escalate','!=',0)
                                        ->where('ori_helpdesk.escalation_status',1)
                                        ->where('ori_helpdesk.cmpny_id', $cmpny_id);

        // if (isset($ann_start_dt) && !empty($ann_start_dt) && isset($ann_end_dt) && !empty($ann_end_dt))
        // {
        //     $query_type_counts->whereBetween('ori_helpdesk.created_at', [$ann_start_dt, $ann_end_dt]);
        // }

        $query_type_counts = $query_type_counts->groupBy('ori_helpdesk.query_status')
                                        ->groupBy('query_type')
                                        ->orderBy('ori_helpdesk.query_status')
                                        ->orderBy('query_type')
                                        ->get();

        foreach ($query_type_counts as $query_type_status_count)
        {
            $query_type = $query_type_status_count->query_type;
            $query_status = $query_type_status_count->query_status;
            $query_type_counts_data[$query_types_array[$query_type]][$query_status_array[$query_status]]    = $query_type_status_count->counts;
        }

        $i = 0;
        $j = 0;

        $query_type_status_array    = array();

        foreach ($query_types_array as $query_type_id => $query_type_name)
        {
            $j = 0;
            foreach ($query_status_array as $query_status_id => $query_status_name)
            {
                if (isset($query_type_counts_data[$query_type_name]))
                {
                    if (isset($query_type_counts_data[$query_type_name][$query_status_name]))
                    {
                        $query_count = $query_type_counts_data[$query_type_name][$query_status_name];
                        $query_type_status_array[]  = [$i,$j,$query_count];
                    }
                    else
                    {
                        $query_type_status_array[]  = [$i,$j,0];
                    }
                }
                else
                {
                    $query_type_status_array[]  = [$i,$j,0];
                }
                $j++;
            }
            $i++;
        }
        $query_type_data['value']   = $query_type_status_array;
        return json_encode($query_type_data);
        
        }

/**
    * Api for getting feedback details
    * @author Reshma Rajan
    * @date 31/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function  feedback_statistics(Request $request)
    {

        $ann_start_dt = str_replace("/","-",request('ann_start_date'));
        $ann_end_dt = str_replace("/","-",request('ann_end_date'));
        $ann_start_dt = date("Y-m-d ", strtotime($ann_start_dt)).' 00:00:00';
        $ann_end_dt = date('Y-m-d',strtotime($ann_end_dt)).' 23:59:59';

        $fb_graph=array();
        $fb_pie ='';
        $drill_feedback=array();
        $drill_feedback_arr=array();
        $fb_arr =Channel::select('name', 'id')->whereHas('channel_details', function($q) {
            $q->where('cmpny_id', request('cmpny_id'));
        })->get();
        
        $total_fb_count = 0;
        $fb_t=array();
        foreach ($fb_arr as $fbdet)
        {

            $fb_key=$fbdet->id;
            $fb_value=$fbdet->name;
            $count_type=0;
           
            $count_type           =   FeedbackDetail::where('fb_type', $fb_key)->where('status',config('constant.ACTIVE'))->where('cmpny_id', request('cmpny_id'))
            ->whereBetween('created_at', [$ann_start_dt, $ann_end_dt])
            ->count();
            
          
            $t=array('name'=>$fb_value,'y'=>$count_type,'drilldown'=>$fb_value);
            $fb_t[] =$t;               
            $rating_mast=config('constant.FB_RATING');
            $rating_mast[0]='No Rating';
           
            
           $drill_feedback_arr1=array('name'=>$fb_value,'id'=>$fb_value);
           $arr1=array();
           foreach ($rating_mast as $rating_key => $rating_val) {

             $fb_type_cnt           =   FeedbackDetail::where('fb_type',$fb_key)->where('rating',$rating_key)->where('status',config('constant.ACTIVE'))->where('cmpny_id', request('cmpny_id'))
                  ->whereBetween('created_at', [$ann_start_dt, $ann_end_dt])
                 ->count();
                 $arr1[]=array($rating_val,$fb_type_cnt);
                 $drill_feedback[]=$arr1;
                 $total_fb_count = $total_fb_count + $fb_type_cnt;
            
           }
           $drill_feedback_arr1['data']=$arr1;
           $drill_feedback_arr[]=$drill_feedback_arr1;
                         
                      
        }
                
        $fb_graph['fb_pie']= $fb_t;
        $fb_graph['fb_drilldown']= $drill_feedback_arr;
        $fb_graph['total_fb_count1']=$total_fb_count;
        return json_encode($fb_graph);
       
                
    }
    /**
    * Api for getting feedback details
    * @author Reshma Rajan
    * @date 31/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function feedback_rating()
    {
        $ann_start_dt = str_replace("/","-",request('ann_start_date'));
        $ann_end_dt = str_replace("/","-",request('ann_end_date'));
        $ann_start_dt = date("Y-m-d", strtotime($ann_start_dt)).' 00:00:00';;
        $ann_end_dt = date('Y-m-d',strtotime($ann_end_dt)).' 23:59:59';

        $fb_stat=array();
        $rating_arr=config('constant.FB_RATING');
        $rating_arr[0]='No Rating';
        $fbstatistic_count=0;
        $ind_count=0;
        $feedback_statistics=array();
        $fb_arr1 =Channel::whereHas('channel_details', function($q) {
            $q->where('cmpny_id', request('cmpny_id'));
        })->pluck('id');
        $avg=0;
        $fb_stat[]=0;
        foreach($rating_arr as $fb_key => $fb_val)
        {
            $fb_cnt           =   FeedbackDetail::where('rating',$fb_key)->where('status',config('constant.ACTIVE'))->whereIn('fb_type',$fb_arr1)->where('cmpny_id', request('cmpny_id'))
                ->whereBetween('created_at', [$ann_start_dt, $ann_end_dt])
                ->count();
             $feedback_rating[$fb_key]=$fb_cnt;
             $fbstatistic_count = $fbstatistic_count + $fb_cnt;
             $avg+=$fb_cnt * $fb_key;
             $fb_stat['feedback_statistics']=$feedback_rating;
             $fb_stat['avg']=$avg;
             
            $fb_stat[$fb_val]=$ind_count+$fb_cnt;
             
             
             //echo $fb_stat[$fb_val];
            
        }

        $fb_stat['total_fb_count']=$fbstatistic_count;

        return view('dashboard.feedback_rating',compact('fb_stat'));
        //return json_encode($fb_stat);            
                
    }
	/**
    * Api for trending_query
    * @author AKHIL MURUKAN
    * @date 31/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function trending_query()
    {

        $cnt_month     =   TrendingQuery::where('status',config('constant.ACTIVE'))
												->where('flag',config('constant.ACTIVE'))->get();

        $trending_query['cnt_month']=$cnt_month;

        return view('dashboard.trending_query',compact('trending_query'));
    }
	
	/**
    * Api for getting escalation summary details
    * @author Elavarasi S
    * @date 31/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return
    */
    public function reg_by_country_time(Request $request) {

        $response           = $request->all();
		
		$ann_start_dt = str_replace("/","-",$response['ann_start_date']);
        $ann_end_dt = str_replace("/","-",$response['ann_end_date']);
        $ann_start_dt = date("Y-m-d", strtotime($ann_start_dt));
        $ann_end_dt = date('Y-m-d',strtotime($ann_end_dt));

        $cmpny_id = $response['cmpny_id'];

		$reg_country_data = array();
		$results = CustomerProfile::select('country_id',DB::raw("CONCAT(Hour) AS `Hours`"), DB::raw("COUNT(created_at) AS `regcount`"))
					->rightjoin(DB::raw("( SELECT 0 AS Hour 
 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12 UNION ALL SELECT 13 UNION ALL SELECT 14 UNION ALL SELECT 15 UNION ALL SELECT 16 UNION ALL SELECT 17 UNION ALL SELECT 18 UNION ALL SELECT 19 UNION ALL SELECT 20 UNION ALL SELECT 21 UNION ALL SELECT 22 UNION ALL SELECT 23
) AS AllHours "), DB::raw("HOUR(created_at)"), '=', DB::raw("Hour"));
        $results->whereBetween('created_at', [$ann_start_dt, $ann_end_dt]);
		$results->where('cmpny_id', $cmpny_id);
        $results->groupBy('country_id');
        $results->groupBy('Hour');
		$results->orderBy('country_id');
        $results->orderBy('Hour');
                        
		$customer_count   = $results->get();
		$country_name = "";
		$country_status = LocationSettings::select('id','name')->where('status',config('constant.ACTIVE'))->where('type',config('constant.COUNTRY'))->get();
		foreach($country_status as $country) {
			$country_array[$country->id] = $country->name;
			$country_total[$country->id] = 0;
			$country_sub_total[$country->id] = 0;
			$country_name .= $country->name.",";
		}
		foreach($customer_count as $value) {
			$ccode = $value->country_id;
			if($ccode != "") {
				$ccut[$country_array[$ccode]][$value->Hours] = $value->regcount;
				$country_total[$ccode] += $value->regcount;
			}
		}

        $i=0;
		$j=0;
		//$time_wise_arr = "";
		//$time_reg_arr = "";
		$total_count_cus = 0;
		$time_wise_arr    = array();
		$time_reg_arr    = array();
		$time_slots = array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23');
		foreach($time_slots as $slots) {
			$j = 0;
			$total_count_cus = 0;
			foreach($country_array as $key=>$countrys) {
					if(isset($ccut[$countrys])) {
						if( $slots == 'total'){
							$dt_count = $country_total[$key];
							//$time_wise_arr .="[".$i.",".$j.",".$dt_count."],";
							$time_wise_arr[] =[$i,$j,$dt_count];
						}
						else{
							if(isset($ccut[$countrys][$slots])) {
								$dt_count = $ccut[$countrys][$slots];
								//$time_wise_arr .="[".$i.",".$j.",".$dt_count."],";
								$time_wise_arr[] =[$i,$j,$dt_count];
								$total_count_cus += $dt_count;
							} else {
								//$time_wise_arr .="[".$i.",".$j.",0],";
								$time_wise_arr[] =[$i,$j,0];
							}
						}
					} else {
						//$time_wise_arr .="[".$i.",".$j.",0],";
						$time_wise_arr[] =[$i,$j,0];
					}
					$j++;
				
			}
			if( $slots != 'total'){
				$time_reg_arr[] =[$slots.":00",$total_count_cus];
			}
			$i++;
		}
		$country_name = rtrim($country_name, ',');
		//$time_wise_arr = rtrim($time_wise_arr, ',');
		//$time_reg_arr = rtrim($time_reg_arr, ',');
		$country_name = explode(',', $country_name);
		$reg_country_data['country_names'] = array_values($country_name);
		$reg_country_data['time_wise_arr'] = array_values($time_wise_arr);
		$reg_country_data['time_reg_arr']  = array_values($time_reg_arr);
		return json_encode($reg_country_data);
        
    }

    /**
    * Daily Followup API
    * @author Rahul Raveendran
    * @date 06/11/2019
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function daily_followup(Request $request)
    {
        $user_id    = $request->post('user_id');
        $req_nxt_follow = date('d-m-Y', time());   
        $date_follow          =   date("Y-m-d", strtotime($req_nxt_follow));
        $results        = LeadFollowup::select('ori_lead_followups.id', 'ori_customer_profiles.first_name', 'ori_customer_profiles.last_name', 'ori_customer_profiles.mobile')
                            ->leftJoin('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_lead_followups.customer_id')
                            ->where('ori_lead_followups.remainder_date','like', '%' . $date_follow . '%')
                            ->where('ori_customer_profiles.status','1')
                            ->where('ori_customer_profiles.deleted_at', '=', Null)
                            ->where('ori_lead_followups.status','1')
                            ->where('ori_lead_followups.deleted_at', '=', Null);

        $followups = $results->get();

        return json_encode($followups);
    }

    /**
    * Lead Source Conversion API
    * @author Rahul Raveendran
    * @date 14/11/2019
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function lead_source_conversion(Request $request)
    {
        $response           =   $request->all();
        $ann_start_dt = str_replace("/","-",$response['ann_start_date']);
        $ann_end_dt = str_replace("/","-",$response['ann_end_date']);
        $ann_start_dt = date("Y-m-d", strtotime($ann_start_dt)).' 00:00:00';;
        $ann_end_dt = date('Y-m-d',strtotime($ann_end_dt)).' 23:59:59';
        $cmpny_id = $response['cmpny_id'];
        $lead_source_data = array();

        $lead_source_array = LeadSources::select('id','name')->where('cmpny_id',$cmpny_id)->where('status',config('constant.ACTIVE'))->pluck('name','id')->all();
        $lead_source_array = [0 => 'Not Specified'] + $lead_source_array;
        $lead_source_data['lead_source_names'] = array_values($lead_source_array);
        $lead_source_ids    = array_keys($lead_source_array);
        $profile_status_array    = config('constant.profile_status');
        $profile_status_array   = [0 => 'Not Specified'] + $profile_status_array;
        $lead_source_data['profile_status_names'] = array_values($profile_status_array);
        $query_status_ids   = array_keys($profile_status_array);

        $customer_counts = CustomerProfile::select('source', 'profile_status', DB::raw("COUNT(*) AS 'lead_count'"))
                        ->where('ori_customer_profiles.cmpny_id', $cmpny_id)
                        ->whereBetween('ori_customer_profiles.created_at', [$ann_start_dt, $ann_end_dt])
                        ->groupBy('source')
                        ->groupBy('profile_status')
                        ->orderBy('source')
                        ->orderBy('profile_status')
                        ->get();

        foreach ($customer_counts as $customer_count)
        {
            $source = (int)$customer_count->source;
            $profile_status = (int)$customer_count->profile_status;
            $lead_source_counts_data[$lead_source_array[$source]][$profile_status_array[$profile_status]]    = $customer_count->lead_count;
        }

        $i = 0;
        $j = 0;

        $lead_source_status_array    = array();

        foreach ($lead_source_array as $lead_source_id => $lead_source_name)
        {
            $j = 0;
            foreach ($profile_status_array as $profile_status_id => $profile_status_name)
            {
                if (isset($lead_source_counts_data[$lead_source_name]))
                {
                    if (isset($lead_source_counts_data[$lead_source_name][$profile_status_name]))
                    {
                        $query_count = $lead_source_counts_data[$lead_source_name][$profile_status_name];
                        $lead_source_status_array[]  = [$i,$j,$query_count];
                    }
                    else
                    {
                        $lead_source_status_array[]  = [$i,$j,0];
                    }
                }
                else
                {
                    $lead_source_status_array[]  = [$i,$j,0];
                }
                $j++;
            }
            $i++;
        }
        $lead_source_data['value']  = $lead_source_status_array;
        return json_encode($lead_source_data);

    }
  /**
    * Today's Performance API
    * @author Veena S Das
    * @date 08/05/2020
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function todays_performance(Request $request)
    {
        $cmpny_id   = $request->post('cmpny_id');
        $user_id    = (int)$request->post('user_id');
        $is_agent   = FALSE;
        if(!empty($user_id))
        {
            $user = User::where('cmpny_id', $cmpny_id)
			            ->where('id',$user_id)
                        ->where('status', config('constant.ACTIVE'))
                        ->first();
          
            if ($user && !empty($user->role_id))
            {
                $user_roles = unserialize($user->role_id);
			    $agent_role = Helpers::get_company_meta('agent', $cmpny_id);
				
                if (in_array($agent_role, $user_roles))
                {
                    $is_agent   = TRUE;
                }
            }
        }

        $valid_customers_count = 0;
        $valid_customer_status  = config('constant.profile_status_rev.valid_customer');
        $valid_customers_count  = CustomerProfile::where('cmpny_id',$cmpny_id)
                                   ->where('profile_status', $valid_customer_status);
        if ($is_agent)
        {
            $valid_customers_count->where('created_by', $user_id);
        }
        $valid_customers_count  = $valid_customers_count->count();
        $success_response       = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%Success%')
                                    ->first();

        $total_success_count   = 0;
        if ($success_response)
        {
            $total_success_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response_type', $success_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
		
            if ($is_agent)
            {
                $total_success_count->where('attended_by', $user_id);
            }
            $total_success_count = $total_success_count->count();
            $total_success_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $success_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $total_success_followup_count->where('attended_by', $user_id);
            }
            $total_success_followup_count  = $total_success_followup_count->count();
            $total_success_count += $total_success_followup_count;
        }
		
		
		
		$total_interested_count   = 0;
        $total_interested_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('demo', config('constant.INVDEMO.Interested'))
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
		if ($is_agent)
        {
            $total_interested_count->where('attended_by', $user_id);
        }
        $total_interested_count = $total_interested_count->count();
        $total_interested_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('demo',config('constant.INVDEMO.Interested'))
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
        if ($is_agent)
        {
            $total_interested_followup_count->where('attended_by', $user_id);
        }
        $total_interested_followup_count  = $total_interested_followup_count->count();
        $total_interested_count += $total_interested_followup_count;
        
		$total_notinterested_count   = 0;
        $total_notinterested_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('demo', config('constant.INVDEMO.Not Interested'))
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
		if ($is_agent)
        {
            $total_notinterested_count->where('attended_by', $user_id);
        }
        $total_notinterested_count = $total_notinterested_count->count();
        $total_notinterested_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('demo',config('constant.INVDEMO.Not Interested'))
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
        if ($is_agent)
        {
            $total_notinterested_followup_count->where('attended_by', $user_id);
        }
        $total_notinterested_followup_count  = $total_notinterested_followup_count->count();
        $total_notinterested_count += $total_notinterested_followup_count;
 
       

	   $call_later_response       = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%Call Later%')
                                    ->first();
        $call_later_count   = 0;
        if ($call_later_response)
        {
            $call_later_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $call_later_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $call_later_count->where('attended_by', $user_id);
            }
            $call_later_count = $call_later_count->count();
            $call_later_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $call_later_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $call_later_followup_count->where('attended_by', $user_id);
            }
            $call_later_followup_count  = $call_later_followup_count->count();
            $call_later_count += $call_later_followup_count;
        }

        $wrong_number_response  = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%Wrong Number%')
                                    ->first();
        $wrong_number_count = 0;
        if ($wrong_number_response)
        {
            $wrong_number_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $wrong_number_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $wrong_number_count->where('attended_by', $user_id);
            }
            $wrong_number_count = $wrong_number_count->count();
            $wrong_number_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $wrong_number_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $wrong_number_followup_count->where('attended_by', $user_id);
            }
            $wrong_number_followup_count    = $wrong_number_followup_count->count();
            $wrong_number_count += $wrong_number_followup_count;
        }

        $no_response  = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%No Response%')
                                    ->first();
        $no_response_count = 0;
        if ($no_response)
        {
            $no_response_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $no_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $no_response_count->where('attended_by', $user_id);
            }
            $no_response_count = $no_response_count->count();
            $no_response_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $no_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $no_response_followup_count->where('attended_by', $user_id);
            }
            $no_response_followup_count = $no_response_followup_count->count();
            $no_response_count += $no_response_followup_count;
        }

        $distant_location_response  = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%Distant Location%')
                                    ->first();
        $distant_location_count = 0;
        if ($no_response)
        {
            $distant_location_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $distant_location_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $distant_location_count->where('attended_by', $user_id);
            }
            $distant_location_count = $distant_location_count->count();

            $distant_location_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $distant_location_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $distant_location_followup_count->where('attended_by', $user_id);
            }
            $distant_location_followup_count    = $distant_location_followup_count->count();
            $distant_location_count += $distant_location_followup_count;
        }

        $dnd_response  = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%Do Not Disturb%')
                                    ->first();
        $dnd_response_count = 0;
        if ($dnd_response)
        {
            $dnd_response_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $dnd_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $dnd_response_count->where('attended_by', $user_id);
            }
            $dnd_response_count = $dnd_response_count->count();
            $dnd_response_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $dnd_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $dnd_response_followup_count->where('attended_by', $user_id);
            }
            $dnd_response_followup_count    = $dnd_response_followup_count->count();
        }

        $vehicles_sold_response  = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%Vehicle Sold%')
                                    ->first();
        $vehicles_sold_count = 0;
        if ($vehicles_sold_response)
        {
            $vehicles_sold_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $vehicles_sold_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $vehicles_sold_count->where('attended_by', $user_id);
            }
            $vehicles_sold_count = $vehicles_sold_count->count();
            $vehicles_sold_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $vehicles_sold_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $vehicles_sold_followup_count->where('attended_by', $user_id);
            }
            $vehicles_sold_followup_count   = $vehicles_sold_followup_count->count();
            $vehicles_sold_count += $vehicles_sold_followup_count;
        }

        $miscellaneous_response  = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%Other%')
                                    ->first();
        $miscellaneous_count = 0;
        if ($miscellaneous_response)
        {
            $miscellaneous_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $miscellaneous_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $miscellaneous_count->where('attended_by', $user_id);
            }
            $miscellaneous_count = $miscellaneous_count->count();
            $miscellaneous_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $miscellaneous_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            if ($is_agent)
            {
                $miscellaneous_followup_count->where('attended_by', $user_id);
            }
            $miscellaneous_followup_count   = $miscellaneous_followup_count->count();
            $miscellaneous_count += $miscellaneous_followup_count;
        }

        $performance_data   = [
            'valid_customers_count'     => $valid_customers_count,
            'total_success_count'      => $total_success_count,
            'call_later_count'          => $call_later_count,
            'wrong_number_count'        => $wrong_number_count,
            'no_response_count'         => $no_response_count,
            'distant_location_count'    => $distant_location_count,
            'dnd_response_count'        => $dnd_response_count,
            'vehicles_sold_count'       => $vehicles_sold_count,
            'miscellaneous_count'       => $miscellaneous_count,
            'interested_count'          => $total_interested_count,
            'notinterested_count'       => $total_notinterested_count
        ];

        return json_encode($performance_data);

    }
	  /**
    * Agent's Performance API
    * @author Veena S Das
    * @date 08/05/2020
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function agent_performance(Request $request)
    {
		
		$agents = array();
		$agent_name = array();
		$valid_customers_count_agent = array();
       $total_success_count_agent = array();
       $call_later_count_agent = array();
       $wrong_number_count_agent = array();
       $no_response_count_agent = array();
       $distant_location_count_agent = array();
       $dnd_response_count_agent = array();
       $vehicles_sold_count_agent = array();
       $miscellaneous_count_agent = array();
       $total_interested_count_agent = array();
       $total_notinterested_count_agent = array();
        $cmpny_id   = $request->post('cmpny_id');
       
            $users = User::where('cmpny_id', $cmpny_id)
			           
                        ->where('status', config('constant.ACTIVE'))
                        ->get();
            $agent_role = Helpers::get_company_meta('agent', $cmpny_id);
            foreach($users as $user){
				$user_roles = unserialize($user->role_id);
				if (in_array($agent_role, $user_roles))
                {
                    $agents[]   = $user->id;
                }
				
			}
		
       foreach($agents as $agent){

        $valid_customers_count = 0;
        $valid_customer_status  = config('constant.profile_status_rev.valid_customer');
        $valid_customers_count  = CustomerProfile::where('cmpny_id',$cmpny_id)
                                   ->where('profile_status', $valid_customer_status);
       
        $valid_customers_count->where('created_by',$agent);
        
        $valid_customers_count  = $valid_customers_count->count();
        $success_response       = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%Success%')
                                    ->first();

        $total_success_count   = 0;
        if ($success_response)
        {
            $total_success_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response_type', $success_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
		
             $total_success_count->where('attended_by', $agent);
            
            $total_success_count = $total_success_count->count();
            $total_success_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $success_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            
                $total_success_followup_count->where('attended_by', $agent);
            
            $total_success_followup_count  = $total_success_followup_count->count();
            $total_success_count += $total_success_followup_count;
        }
        
		
		
		
		$total_interested_count   = 0;
        $total_interested_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('demo', config('constant.INVDEMO.Interested'))
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
		
            $total_interested_count->where('attended_by', $agent);
        
        $total_interested_count = $total_interested_count->count();
        $total_interested_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('demo',config('constant.INVDEMO.Interested'))
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
         $total_interested_followup_count->where('attended_by', $agent);
        
        $total_interested_followup_count  = $total_interested_followup_count->count();
        $total_interested_count += $total_interested_followup_count;
        
		$total_notinterested_count   = 0;
        $total_notinterested_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('demo', config('constant.INVDEMO.Not Interested'))
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
		
            $total_notinterested_count->where('attended_by', $agent);
        
        $total_notinterested_count = $total_notinterested_count->count();
        $total_notinterested_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('demo',config('constant.INVDEMO.Not Interested'))
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
         $total_notinterested_followup_count->where('attended_by', $agent);
       
        $total_notinterested_followup_count  = $total_notinterested_followup_count->count();
        $total_notinterested_count += $total_notinterested_followup_count;
		
		
		
		
		
        $call_later_response       = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%Call Later%')
                                    ->first();
        $call_later_count   = 0;
        if ($call_later_response)
        {
            $call_later_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $call_later_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            
                $call_later_count->where('attended_by', $agent);
            
            $call_later_count = $call_later_count->count();
            $call_later_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $call_later_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
           
                $call_later_followup_count->where('attended_by', $agent);
            
            $call_later_followup_count  = $call_later_followup_count->count();
            $call_later_count += $call_later_followup_count;
        }

        $wrong_number_response  = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%Wrong Number%')
                                    ->first();
        $wrong_number_count = 0;
        if ($wrong_number_response)
        {
            $wrong_number_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $wrong_number_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
           
                $wrong_number_count->where('attended_by', $agent);
            
            $wrong_number_count = $wrong_number_count->count();
            $wrong_number_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $wrong_number_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
           
                $wrong_number_followup_count->where('attended_by', $agent);
            
            $wrong_number_followup_count    = $wrong_number_followup_count->count();
            $wrong_number_count += $wrong_number_followup_count;
        }

        $no_response  = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%No Response%')
                                    ->first();
        $no_response_count = 0;
        if ($no_response)
        {
            $no_response_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $no_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
           
                $no_response_count->where('attended_by', $agent);
            
            $no_response_count = $no_response_count->count();
            $no_response_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $no_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
           
                $no_response_followup_count->where('attended_by', $agent);
           
            $no_response_followup_count = $no_response_followup_count->count();
            $no_response_count += $no_response_followup_count;
        }

        $distant_location_response  = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%Distant Location%')
                                    ->first();
        $distant_location_count = 0;
        if ($no_response)
        {
            $distant_location_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $distant_location_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
          
                $distant_location_count->where('attended_by', $agent);
            
            $distant_location_count = $distant_location_count->count();

            $distant_location_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $distant_location_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
            
                $distant_location_followup_count->where('attended_by', $agent);
            
            $distant_location_followup_count    = $distant_location_followup_count->count();
            $distant_location_count += $distant_location_followup_count;
        }

        $dnd_response  = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%Do Not Disturb%')
                                    ->first();
        $dnd_response_count = 0;
        if ($dnd_response)
        {
            $dnd_response_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $dnd_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
           
                $dnd_response_count->where('attended_by', $agent);
          
            $dnd_response_count = $dnd_response_count->count();
            $dnd_response_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $dnd_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
           
                $dnd_response_followup_count->where('attended_by', $agent);
            
            $dnd_response_followup_count    = $dnd_response_followup_count->count();
        }

        $vehicles_sold_response  = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%Vehicle Sold%')
                                    ->first();
        $vehicles_sold_count = 0;
        if ($vehicles_sold_response)
        {
            $vehicles_sold_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $vehicles_sold_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
             $vehicles_sold_count->where('attended_by', $agent);
            
            $vehicles_sold_count = $vehicles_sold_count->count();
            $vehicles_sold_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $vehicles_sold_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
           
                $vehicles_sold_followup_count->where('attended_by', $agent);
            
            $vehicles_sold_followup_count   = $vehicles_sold_followup_count->count();
            $vehicles_sold_count += $vehicles_sold_followup_count;
        }

        $miscellaneous_response  = CustomerResponse::where('cmpny_id',$cmpny_id)
                                    ->where('customer_response', 'LIKE', '%Other%')
                                    ->first();
        $miscellaneous_count = 0;
        if ($miscellaneous_response)
        {
            $miscellaneous_count   = Helpdesk::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $miscellaneous_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
              $miscellaneous_count->where('attended_by', $agent);
            
            $miscellaneous_count = $miscellaneous_count->count();
            $miscellaneous_followup_count   = LeadFollowup::where('cmpny_id',$cmpny_id)
                                        ->where('customer_response', $miscellaneous_response->id)
                                        ->where('created_at','LIKE', '%'.date('Y-m-d').'%');
           
                $miscellaneous_followup_count->where('attended_by', $agent);
            
            $miscellaneous_followup_count   = $miscellaneous_followup_count->count();
            $miscellaneous_count += $miscellaneous_followup_count;
        }
		$users_name = User::where('id', $agent)
			           ->where('status', config('constant.ACTIVE'))
                        ->get();
		
       $agent_name[] = $users_name[0]['name'];
	  // print_r($valid_customers_count);
       $valid_customers_count_agent[] = $valid_customers_count;
	   $total_success_count_agent[] = $total_success_count;
       $call_later_count_agent[] = $call_later_count;
       $wrong_number_count_agent[] = $wrong_number_count;
       $no_response_count_agent[] = $no_response_count;
       $distant_location_count_agent[] = $distant_location_count;
       $dnd_response_count_agent[] = $dnd_response_count;
       $vehicles_sold_count_agent[] = $vehicles_sold_count;
       $miscellaneous_count_agent[] = $miscellaneous_count;
       $total_interested_count_agent[] = $total_interested_count;
       $total_notinterested_count_agent[] = $total_notinterested_count;
      
	   }
	  array_unshift($agent_name, 'Agent Nmae');
	  array_unshift($valid_customers_count_agent, 'Valid Customers');
	  array_unshift($total_success_count_agent, 'Success');
	  array_unshift($call_later_count_agent, 'Call Later');
	  array_unshift($wrong_number_count_agent, 'Wrong Number');
	  array_unshift($no_response_count_agent, 'No Response');
	  array_unshift($distant_location_count_agent, 'Distant Location');
	  array_unshift($dnd_response_count_agent, 'Do Not Disturb');
	  array_unshift($vehicles_sold_count_agent, 'Vehicles Sold');
	  array_unshift($miscellaneous_count_agent, 'Miscellaneous');
	  array_unshift($total_interested_count_agent, 'Demo Interested');
	  array_unshift($total_notinterested_count_agent, 'Demo Not Interested');
	   //print_r($agent_name);
	 $performance_data_agent  = [
            'agent_name'     => $agent_name,
            'valid_customers_count'     => $valid_customers_count_agent,
            'total_success_count'      => $total_success_count_agent,
            'call_later_count'          => $call_later_count_agent,
            'wrong_number_count'        => $wrong_number_count_agent,
            'no_response_count'         => $no_response_count_agent,
            'distant_location_count'    => $distant_location_count_agent,
            'dnd_response_count'        => $dnd_response_count,
            'vehicles_sold_count'       => $vehicles_sold_count_agent,
            'miscellaneous_count'       => $miscellaneous_count_agent,
            'total_interested_count'       => $total_interested_count_agent,
            'total_notinterested_count'       => $total_notinterested_count_agent
        ];

        return json_encode($performance_data_agent);
	}
}
