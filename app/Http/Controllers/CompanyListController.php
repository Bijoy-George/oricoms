<?php

namespace App\Http\Controllers;

use Auth;
use App\CompanyProfile;
use App\Plan;
use Illuminate\Http\Request;
class CompanyListController extends Controller
{
    
	 public function __construct()
    {
        $this->middleware('auth');
    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.company.index');
    }
 /*
    * Company List 
    * @author veena S Das
    * @date 10/04/2020
    * @since version 1.0.0
    * @param NULL
    * @return company list
    */
    public function search_list(Request $request)
    {
        
        $response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $results            = array();
        	
        $results = CompanyProfile::select('ori_company_profiles.*','ori_mast_plans.plan as plan')
								->leftjoin('ori_mast_plans','ori_mast_plans.id','=','ori_company_profiles.ori_cmp_org_plan')
								->where('ori_company_profiles.status',config('constant.ACTIVE'));
	
        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('ori_cmp_org_name', 'like', '%' . $search_keywords . '%');
                });
            }
        $list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		
        $html       = view('masters.company.listview')->with(compact('results','list_count'))->render();
        $result_arr = array('success' => true,'html' => $html);
        
        return $result_arr; 

        
    }

    public function store1(Request $request)
    {
        
        $this->validate($request,[
            // 'name' => 'required|string|max:50',
            // 'email' => 'required|string|max:50|unique:ori_users,email|unique:ori_company_profiles,ori_cmp_org_email,'.request('email'),
            // 'mobile' => 'required|numeric|digits_between:10,15',
        ],[
            'phone.numeric' => 'Please enter valid phone number.',
            'phone.digits_between' => 'Please enter valid phone number.',
        ]);
            
        $response           =   $request->all();
        $name               =   $response['ori_cmp_org_name'];   
        $email              =   $response['ori_cmp_org_email'];   
        $phone              =   $response['ori_cmp_org_phone'];   
        $address            =   $response['ori_cmp_org_address'];   
        // $mobile             =   $response['mobile'];
        $city               =   $response['ori_cmp_org_city'];
        $state              =   $response['ori_cmp_org_state'];
        $pincode            =   $response['ori_cmp_org_pincode'];
        $country            =   $response['ori_cmp_org_country'];
        // $country_code       =   $response['country_code'];
        
        $date               =   date('Y-m-d H:i:s');
        
         $user_id = CompanyProfile::Update([
          'ori_cmp_org_name'    => $name,
          'ori_cmp_org_email'   => $email,
          'ori_cmp_org_phone'   => $phone,
          'ori_cmp_org_address' => $address,
          // 'ori_cmp_org_country_code' => $country_code,
          // 'ori_cmp_org_mobile'  => $mobile,
          'ori_cmp_org_city'    => $city,
          'ori_cmp_org_state'   => $state,
          'ori_cmp_org_pincode' => $pincode,
          'ori_cmp_org_country' => $country,
          // 'ori_cmp_org_plan'    => $package_type,
          'status' => config('constant.ACTIVE'),
        ]);

            
            $result_arr=array('status'=>'success','success' => true,'message' => 'success');
            return json_encode($result_arr);
    }

    
	public function edit($id)
    { 
		$res = CompanyProfile::findOrFail($id);
		$plans       = ['' => 'Select'] + Plan::where('status', config('constant.ACTIVE'))->pluck('plan', 'id')->all();
		return view('masters.company.create', compact('res','plans'));
    }
	/*
    * Company Store
    * @author veena S Das
    * @date 10/04/2020
    * @since version 1.0.0
    * @param NULL
    * @return company Store
    */
	public function store(Request $request)
    {  
			$this->validate($request,[
            'ori_cmp_org_name' => 'required|string|max:50',
            'ori_cmp_org_email' => 'required',
            'ori_cmp_org_plan' => 'required',
            'ori_cmp_org_phone' => 'required|numeric|digits_between:10,15',
        ],[
            'ori_cmp_org_name.required' => ' The Name field is required.',
            'ori_cmp_org_email.required' => ' The Email field is required.',
            'ori_cmp_org_plan.required' => ' The Plan field is required.',
            'ori_cmp_org_phone.required' => ' The Phone Number field is required.',
            'ori_cmp_org_phone.numeric' => 'Please enter valid phone number.',
            'ori_cmp_org_phone.digits_between' => 'Please enter valid phone number.',
        ]);
		
		
			$res = CompanyProfile::updateOrCreate(
            [
                'id'      	=> request('id')
            
            ],
			[	  'ori_cmp_org_name'    => (!empty(request('ori_cmp_org_name'))? request('ori_cmp_org_name'): NULL ),
				  'ori_cmp_org_email'   => (!empty(request('ori_cmp_org_email'))? request('ori_cmp_org_email'): NULL ),
				  'ori_cmp_org_phone'   => (!empty(request('ori_cmp_org_phone'))? request('ori_cmp_org_phone'): NULL ),
				  'ori_cmp_org_address' => (!empty(request('ori_cmp_org_address'))? request('ori_cmp_org_address'): NULL ),
				  'ori_cmp_org_city'    => (!empty(request('ori_cmp_org_city'))? request('ori_cmp_org_city'): NULL ),
				  'ori_cmp_org_state'   => (!empty(request('ori_cmp_org_state'))? request('ori_cmp_org_state'): NULL ),
				  'ori_cmp_org_pincode' => (!empty(request('ori_cmp_org_pincode'))? request('ori_cmp_org_pincode'): NULL ),
				  'ori_cmp_org_country' => (!empty(request('ori_cmp_org_country'))? request('ori_cmp_org_country'): NULL ),
				  'ori_cmp_org_plan' => (!empty(request('ori_cmp_org_plan'))? request('ori_cmp_org_plan'): NULL ),
				  'status' => config('constant.ACTIVE'),
			])->id;
			if(!empty(request('id'))){
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
                }else{
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly added');
                }
			return $result_arr;		
	}
	/*
    * Company Create 
    * @author veena S Das
    * @date 10/04/2020
    * @since version 1.0.0
    * @param NULL
    * @return company Craete
    */
	public function create()
    {  
	    
		$plans       = ['' => 'Select'] + Plan::where('status', config('constant.ACTIVE'))->pluck('plan', 'id')->all();
		return view('masters.company.create',compact('plans'));
    }
	/*
    * Company Destroy
    * @author veena S Das
    * @date 10/04/2020
    * @since version 1.0.0
    * @param NULL
    * @return Company Destroy
    */
	public function destroy($id = null)
    {   
	    $success =true;
		$message ='';
        if($id!=null)
        {
                $permission = CompanyProfile::find($id);
				if ($permission)
					{
						$permission->delete();
						$success =true;
						$message ='Deleted Successfully';
					}
				else{
					 $message ='You are not authorized to delete the customer';
					}
        }
        $result_arr = array('success' => $success, 'message' => $message, 'refresh' => true);
        echo json_encode($result_arr);
    }
}
