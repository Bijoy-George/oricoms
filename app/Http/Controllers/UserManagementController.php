<?php

namespace App\Http\Controllers;

use App\User;
use App\UserRole;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\PasswordHistory;
use App\PasswordSecurity;
use App\Permission;
use App\CompanyProfile;
use App\PackagePermission;
use Carbon\Carbon;
use App\LocationSettings;
use App\LocalBodyType;
use App\FaqCategories;
use App\Designations;
use App\QueryTypes;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 /**
     * customer list
     * @author AKHIL MURUKAN
     * @date 03/07/2017
     * @since version 1.0.0
     * @param NULL
     * @return customer.index blade
    */	
    public function index()
    {  
	    $company_id = auth()->user()->cmpny_id;
        $roles = UserRole::where('cmpny_id',$company_id)->get();
        return view('customer.index', compact('roles'));
    } 
	/**
     * search customer list
     * @author AKHIL MURUKAN
     * @date 03/07/2017
     * @since version 1.0.0
     * @param NULL
     * @return customer.index blade
    */
    public function search_cus(Request $request)
    {
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords']; 
        $role               =   $response['role']; 
        $company_id = auth()->user()->cmpny_id;
        $results = User::where('cmpny_id',$company_id)->orderBy('id', 'desc');
        if(isset($search_keywords) && !empty($search_keywords)) 
			{
				$results->where(function($results) use ($search_keywords)
				{
					$results->orWhere('name', 'like', '%' . $search_keywords . '%');
					$results->orWhere('email', 'like', '%' . $search_keywords . '%');  
				});				
			}
        if(isset($role) && !empty($role)) 
			{
				$results->where(function($results) use ($role)
				{
				  //$results->orWhere('role_id',$role);
				  $results->where('role_id','like','%:"' . $role . '";%');
                });	
			} 

        $results   =   $results->paginate(config('constant.pagination_constant'));
		$roles = UserRole::where('cmpny_id',$company_id)->get();
		$category_name 	 	= FaqCategories::orderBy('category_name')
									->where('cmpny_id',$company_id)
									->where('parent_category_id',NULL)
									->where('status',config('constant.ACTIVE'))
									->get();
		$html = view('customer.listview')->with(compact('results','roles','category_name'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return json_encode($result_arr);
    
    }
	
   
    public function edit($userid = null)
    {  
		
		$company_id = auth()->user()->cmpny_id;
		$roles = UserRole::where('cmpny_id',$company_id)->pluck('role', 'id')->all();
		if($userid!=null)
        {
            $userDetail = User::where('id', $userid)->where('cmpny_id', $company_id)->first();
						
            $country_arr    	= LocationSettings::select('id','name')->where('parent',0)->get();
		
			$localbodytype_arr  = LocalBodyType::where('parent_id',0)
									->where('status',config('constant.ACTIVE'))->get();
			$category_name 	 	= 	['' => 'Select'] + FaqCategories::orderBy('category_name')
									->where('cmpny_id',$company_id)
									->where('parent_category_id',NULL)
									->where('status',config('constant.ACTIVE'))
									->pluck('category_name', 'id')->all();
			$designation 	 	= 	['' => 'Select'] + Designations::orderBy('designation')
									->where('cmpny_id',$company_id)
									->where('status',config('constant.ACTIVE'))
									->pluck('designation', 'id')->all();
			
            if(empty($userDetail)) 
            {
                return redirect('userDetails');
            }
                
        }
        return view('customer.edit', compact('userDetail','roles','country_arr','localbodytype_arr','category_name','designation'));
    } 
	
	public function store(Request $request)
    { 
		$access_permission_array=array();
		$user_id = request('userid');
        $usr_id = auth()->user()->id;
        $company_id = auth()->user()->cmpny_id;
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:ori_users,email,'.$user_id,
			//'phone' => 'required|numeric|digits_between:10,13',
			//'address' => 'string|max:255',
			//'category_name' => 'required',
			//'designation' => 'required',
            'role' => 'required',
			]);
		if(request('userid')!=null)
        {
			$country_id = $state_id = $zone_id = $district_id = $city_id = $local_body_type = $corporation_id = $muncipality_id = $panchayath_type = $district_panchayath_id = $block_panchayath_id = $grama_panchayath_id = $panchayath_id = $taluk_id = $village_id = $department = $designation = $cc_emails = Null;
			
			  if (!empty(request('country_id')))
			  {
				$country_id  = request('country_id');
			  }
			  if (!empty(request('state_id')))
			  {
				$state_id  = request('state_id');
			  }if (!empty(request('district_id')))
			  {
				$district_id  = request('district_id');
			  }if (!empty(request('local_body_type')))
			  {
				$local_body_type  = request('local_body_type');
			  }if (!empty(request('corporation_id')))
			  {
				$corporation_id  = request('corporation_id');
			  }if (!empty(request('panchayath_type')))
			  {
				$panchayath_type  = request('panchayath_type');
			  }if (!empty(request('muncipality_id')))
			  {
				$muncipality_id  = request('muncipality_id');
			  }if (!empty(request('district_panchayath_id')))
			  {
				$district_panchayath_id  = request('district_panchayath_id');
			  }if (!empty(request('block_panchayath_id')))
			  {
				$block_panchayath_id  = request('block_panchayath_id');
			  }if (!empty(request('grama_panchayath_id')))
			  {
				$grama_panchayath_id  = request('grama_panchayath_id');
			  }
			  if (!empty(request('panchayath_id')))
			  {
				$panchayath_id  = request('panchayath_id');
			  }
			  if (!empty(request('taluk_id')))
			  {
				$taluk_id  = request('taluk_id');
			  }
			  if (!empty(request('village_id')))
			  {
				$village_id  = request('village_id');
			  }
			  if (!empty(request('department')))
			  {
				$department  = request('department');
			  }else{
			  	$department  = array();
			  }
			  if (!empty(request('designation')))
			  {
				$designation  = request('designation');
			  }if (!empty(request('cc_emails')))
			  {
				$cc_emails  = request('cc_emails');
			  }
			  $agent_number	= (int)$request->post('agent_number');
			$chat_name = NULL;
			$success    = false;
			$message    = 'Something went wrong';
			$modify_role = request('role');
			$access_permission = '';
		    $user_det = User::find($user_id);
			if(isset($user_det->role_id) && !empty($user_det->role_id) && ($user_det->cmpny_id == $company_id))
			{
				 $using_role = $user_det->role_id;
				 $modify_role = serialize($modify_role);
				
				 $using_access_permission = $user_det->access_permission;
				 if(isset($modify_role) && !empty($modify_role))
					{
						foreach(request('role') as $role_id_arr)
						{
							$role_det = UserRole::where('id',$role_id_arr)->where('cmpny_id',$company_id)->first();
							$access_permission = $role_det->access_permission;
							$access_permission = unserialize($access_permission);
										foreach ($access_permission as $row)
										{
												$access_perm[]=$row['permission_id'];
										}	
						}
						$access_perm_array = array_unique($access_perm);
						foreach($access_perm_array as $selected)
									{
										$det=Permission::where('id',$selected)->first();	
										if($det){
										$access_permission_array[]=Array ( 'permission_id' => $selected,'permission_name' => $det->name); 
										}
									}

					$permission_under_role = serialize($access_permission_array);
					}
			$status = User::updateOrCreate(
				[
					
					'id' => request('userid')
				],
				[
					'name' => request('name'),
					'username' => request('username'),
					'email' => request('email'),
					'phone' => request('phone'),
					'address' => request('address'),
					'cc_emails' 			=> $cc_emails,
					'country_id' 			=> $country_id,
					'state_id' 				=> $state_id,
					'district_id' 			=> $district_id,
					'local_body_type' 		=> $local_body_type,
					'corporation_id'	 	=> $corporation_id,
					'muncipality_id' 		=> $muncipality_id,
					'panchayath_type' 		=> $panchayath_type,
					'district_panchayath_id'  => $district_panchayath_id,
					'block_panchayath_id' 	=> $block_panchayath_id,
					'grama_panchayath_id' 	=> $grama_panchayath_id,
					'panchayath_id' 		=> $panchayath_id,
					'department' 		    => serialize($department),
					'designation' 			=> $designation,
					'role_id' => $modify_role,
					'updated_by' => $usr_id,
					'access_permission' => $permission_under_role,
					'status' => config('constant.ACTIVE'),
					'chat_name'=>request('username'),
					'agent_number'	=> $agent_number
				]);
			 $success    = true;
			 $message    = 'Successfuly updated';
			}
			
			
         

        }
                    
       $result_arr=array('success' => $success, 'message' => $message);
		echo json_encode($result_arr);
    }
   /**
    * remove user (soft delete)
    * @author AKHIL MURUKAN
    * @date 12/07/2017
    * @since version 1.0.0
   */ 
	public function destroy($id = null)
    {   
	    $userid = auth()->user()->id;
	    $company_id = auth()->user()->cmpny_id;
		$success =false;
		$message ='';
        if($id!=null)
        {
            $usr = User::where('id',$id)->where('cmpny_id',$company_id)->first();
            
			if($usr['id'] == $userid)
				{
				 $message ='You are not authorized to delete our own profile';
				}
			else
			{
				if ($usr)
					{
						$dd = $usr->delete();
						$success =true;
						$message ='Deleted Successfully';
					}
				else{
					 $message ='You are not authorized to delete the customer';
					}
            }
        }
        $result_arr = array('success' => $success, 'message' => $message, 'refresh' => true);

        echo json_encode($result_arr);
    }
		/*
	 * customer change password
     * @author AKHIL MURUKAN
     * @date 24/02/2018
     * @since version 1.0.0
     * @param NULL
    */	
    public function userchangepswd($userid =null)
    {  
	    $company_id = auth()->user()->cmpny_id;
		if($userid!=null)
        {
            $usr = User::where('id',$userid)->where('cmpny_id',$company_id)->first();
            if(empty($usr)) 
            {
                return redirect('userDetails');
            }
                
        }
        return view('customer.userchangepswd', compact('usr','userid'));
    } 
	public function savepassword(Request $request)
    {
      
		$user_id = Auth::User()->id;
		$message ='Something Went Worng';
		$suceess = false;
        $this->validate($request,[
            'password' => 'required|string|min:8|confirmed',
           
			
			]);
		if(request('userid')!=null)
        {
         $status = User::updateOrCreate(
            [
                'id' => request('userid'),
                'cmpny_id' => auth()->user()->cmpny_id
            ],
            [
				'password' => Hash::make(request('password')),
				'updated_by' => $user_id,
				'status' => config('constant.ACTIVE')
            ]);
		$passwordHistory = PasswordHistory::create([
			'user_id' => $user_id,
			'password' => Hash::make(request('password'))
		]);
		$passwordSecurity = passwordSecurity::updateOrCreate(
			[
				'user_id' => request('userid')
			],
			[
			    'password_expiry_days' => config('constant.password_expiry_days'),
				'password_updated_at' => Carbon::now()
			]);
		$message ='Successfuly updated';
		$suceess = true;
        }
        $result_arr = array('success' => $suceess, 'message' => $message);
        echo json_encode($result_arr);
    }
	
	/**
     * Display the specified role.
     * @author AKHIL MURUKAN
     * @date 09/24/2018
     * @since version 1.0.0
     * @param  \App\cc_role  $cc_role
     * @return \Illuminate\Http\Response
     */

   public function editCustomerRole($customerid = null)
    {
        $cmpny_id           =   Auth::User()->cmpny_id;  
		$usr = User::where('id',$customerid)->where('cmpny_id',$cmpny_id)->first();
        $permission =array();
		$plan_id = CompanyProfile::select('ori_cmp_org_plan')->where('id',$cmpny_id)->first();
		if(isset($plan_id->ori_cmp_org_plan) && !empty($plan_id->ori_cmp_org_plan))
		{
			$ori_cmp_org_plan = $plan_id->ori_cmp_org_plan;
			$record = PackagePermission::where('package_type',$ori_cmp_org_plan)->where('status',config('constant.ACTIVE'))->get();
			if(count($record) > 0)
			{
				foreach($record as $pack_per)
				{
					$access_permission = unserialize($pack_per->permission_under_package);
						foreach ($access_permission as $row)
						{
								$access_perm[]=$row['permission_id'];
						}				
				}
				$access_perm_array = array_unique($access_perm);
				foreach($access_perm_array as $selected)
					{
						$det=Permission::where('id',$selected)->first();	
						$permission[]=Array ( 'name' => $det->name,'id' => $selected); 
					}
			}
		}
        return view('customer.customer_roleedit',compact('usr','permission'));
    }
	/**
     * Update existing role or Store a newly created role in storage.
     * @author AKHIL MURUKAN
     * @date 09/24/2018
     * @since version 1.0.0
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	
	public function customerRoleStore(Request $request)
    {
        $response           =   $request->all();
        $name               =   $response['name'];     
        $user               =   Auth::User()->id;  
        $customer_id        =   $response['customer_id'];
		$permissions		=   $request->post('check_list');
        $success = false;
		$message = 'Something Went Worng';
			 
	    if(empty($name))
		{
			$result_arr=array('success' => false, 'message' => 'Please enter the name');
		    echo json_encode($result_arr); return;
		}
		else if(empty($permissions))
		{
			$result_arr=array('success' => false, 'message' => 'Please select the permission');
		    echo json_encode($result_arr); return;
		}
		
        foreach($permissions as $selected)
        {
            if($selected !='')
            {
                $pieces = explode("-", $selected);
                $permission_name= $pieces[0]; 
                $permission_id=  $pieces[1];
                $permission_array[]=Array ( 'permission_id' => $permission_id ,'permission_name' => $permission_name); 
            }

        }
        $permission_array = serialize($permission_array);	
        $check = ['id' => $customer_id,
		          'cmpny_id' => auth()->user()->cmpny_id
				 ];
        $update = [
                'name' => $name,
                'access_permission' => $permission_array,
                'updated_by' => $user,
            ];
        $create = $update;
        $create['created_by'] = $user;
        
        $record = User::where($check)->first();

        if (is_null($record)) {
             $success = false;
		     $message = 'Something Went Worng';
        } else {
             $record->update($update);
			 
             $success = true;
		     $message = 'Successfuly Updated';
        }
		
		$result_arr=array('success' => $success, 'message' => $message);
		echo json_encode($result_arr);
    }


   
}
