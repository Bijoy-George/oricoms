<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\QueryTypes;
use App\AutomatedProcess;
use App\Templates;
use App\CompanyChannel;
use App\Channel;
use App\QueryStatus;
use App\Designations;
use App\CustomerNature;
use App\Priority;
use App\LeadSources;
use App\FaqCategories;
use Auth;
use Illuminate\Http\Request;


class SalesAutomationController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:sales automation create', ['only' => ['create']]);
       $this->middleware('check-permission:sales automation edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:sales automation edit|sales automation create',   ['only' => ['store']]);
       $this->middleware('check-permission:sales automation list',   ['only' => ['index','search_list']]);
       $this->middleware('check-permission:sales automation delete',   ['only' => ['destroy']]);
    }
	/*
    * @author RINKU.E.B. 
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return AUTO PROCESS LIST 
    */
	public function index()
    {
        return view('masters.salesAutomation.index');
    }
	
	/*
    * AUTO PROCESS LIST
    * @author RINKU.E.B. 
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {	
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords'];
        $results = array();	
        $results = AutomatedProcess::orderBy('id', 'asc');
        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('process_name', 'like', '%' . $search_keywords . '%');
                   
                });
            }
		$list_count = $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
		$html = view('masters.salesAutomation.listview')->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;		
	}
	
	/*
    * Function for adding new auto process stages
    * @author RINKU.E.B.
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function create()
    { 
		$templates = Templates::pluck('subject','id')->all();
		$process = AutomatedProcess::pluck('process_name','id')->all();
		$results = CompanyChannel::with('GetTemplateType')->get();
		//$department = QueryTypes::pluck('query_type','id')->all();
		$department = FaqCategories::whereNull('parent_category_id')->pluck('category_name','id')->all();
		$designations = Designations::pluck('designation','id')->all();
		$query_status = QueryStatus::pluck('name','id')->all();
		$customer_nature = CustomerNature::pluck('customer_nature','id')->all();
		$priority = Priority::pluck('name','id')->all();
		$lead_sources = LeadSources::pluck('name','id')->all();
		return view('masters.salesAutomation.create', compact('templates','process','results','department','query_status','customer_nature','priority','lead_sources','designations'));
    }
	
	/*
    * Update function for auto process 
    * @author RINKU.E.B.
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editing auto process 
    */
	public function edit($id)
    {   
            $automated_process = AutomatedProcess::findOrFail($id);
			$templates = Templates::pluck('subject','id')->all();
			$process = AutomatedProcess::pluck('process_name','id')->all();
			$results = CompanyChannel::with('GetTemplateType')->get();
			//$department = QueryTypes::pluck('query_type','id')->all();
			$department = FaqCategories::whereNull('parent_category_id')->pluck('category_name','id')->all();
			$designations = Designations::pluck('designation','id')->all();
			$query_status = QueryStatus::pluck('name','id')->all();
			$customer_nature = CustomerNature::pluck('customer_nature','id')->all();
			$priority = Priority::pluck('name','id')->all();
			$lead_sources = LeadSources::pluck('name','id')->all();
			//echo "<pre>";print_r($results);die;
            return view('masters.salesAutomation.create', compact('automated_process','templates','process','results','department','query_status','customer_nature','priority','lead_sources','designations'));
    }


    /*
    * Save function for auto process Add&Update
    * @author RINKU.E.B. 
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {
		
	   //$user_id = Auth::User()->id;
        $this->validate($request,[
				'process_name' => 'required',
    			'action_time' => 'required',
    			'expiry_time' => 'required',
				'content' => 'required_with:action',
    			],[
				'process_name.required' => ' The Process name is required.',
    			'action_time.required' => ' The action time is required.',
    			'expiry_time.required' => ' The expiry time is required.',
				'content.required' => ' The Content is required.',
    		]);
		$district = request('district');
		$district_sel = request('district_sel');
		$deptmt = request('deptmt');
		$deptmt_sel = request('deptmt_sel');
		$designation = request('designation');
		$designation_sel = request('designation_sel');
		$taluk = request('taluk');
		$taluk_sel = request('taluk_sel');
		
		$str = '';
		for($i=0;$i<count($district);$i++)
		{
			$k1 = $district[$i];
			$v1 = $district_sel[$i];
			$k2 = $deptmt[$i];
			$v2 = $deptmt_sel[$i];
			$k3 = $designation[$i];
			$v3 = $designation_sel[$i];
			$k4 = $taluk[$i];
			$v4 = $taluk_sel[$i];
			$str .= $k1.'-'.$v1.','.$k2.'-'.$v2.','.$k3.'-'.$v3.','.$k4.'-'.$v4.'||';
		}
		$intimation_to = rtrim($str,"||");
		//echo $intimation_to.'<br>';
		$district_cc = request('district_cc');
		$district_sel_cc = request('district_sel_cc');
		$deptmt_cc = request('deptmt_cc');
		$deptmt_sel_cc = request('deptmt_sel_cc');
		$designation_cc = request('designation_cc');
		$designation_sel_cc = request('designation_sel_cc');
		$taluk_cc = request('taluk_cc');
		$taluk_sel_cc = request('taluk_sel_cc');
		$str_cc = '';
		for($i=0;$i<count($district_cc);$i++)
		{
			$k1 = $district_cc[$i];
			$v1 = $district_sel_cc[$i];
			$k2 = $deptmt_cc[$i];
			$v2 = $deptmt_sel_cc[$i];
			$k3 = $designation_cc[$i];
			$v3 = $designation_sel_cc[$i];
			$k4 = $taluk_cc[$i];
			$v4 = $taluk_sel_cc[$i];
			$str_cc .= $k1.'-'.$v1.','.$k2.'-'.$v2.','.$k3.'-'.$v3.','.$k4.'-'.$v4.'||';
		}
		$intimation_cc_to = rtrim($str_cc,"||");//echo $intimation_cc_to;
		$status = AutomatedProcess::updateOrCreate(
            [
                
                'id' => request('id'),
				'cmpny_id' => Auth::user()->cmpny_id,
            ],
            [
				'process_name' => request('process_name'),
                'response_pos' => request('response_pos'),
                'action' => request('action'),
                'response_neg' => request('response_neg'),
				'action_time' => request('action_time'),
                'expiry_time' => request('expiry_time'),
                'department' => request('department'),
				'content' => request('content'),
				'closed' => request('closed'),
				'is_first' => request('is_first'),
				'intimation_to' => $intimation_to,
				'intimation_cc_to' => $intimation_cc_to,
				'intimation_to_param' => request('intimation_to_param'),
				'expiry_flag' => request('expiry_flag'),
				'expiry_time_param' => request('expiry_time_param'),
				'action_time_param' => request('action_time_param'),
				'additional_cc_flag' => request('additional_cc_flag'),
            ]);
			$result_arr=array('success' => true,'message' => 'Successfuly updated','reset'=>true);
			return $result_arr;		
	}


    /*
    * Auto process deletion function
    * @author RINKU.E.B. 
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function destroy(Request $request)
    {
        $id = $request->id;
	   
        if($id)
        {
            $id = AutomatedProcess::find($id);
            $id->delete();
        }
		$result_arr=array('success' => true,'message' => 'Successfuly deleted', 'refresh' => true);
		return $result_arr;		
    
    }
	
	
	
	
}
