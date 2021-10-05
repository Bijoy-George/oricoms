<?php

namespace App\Http\Controllers;

use Auth;
use App\UserRole;
use App\PackagePermission;
use App\Permission;
use App\CompanyProfile;
use App\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
   
   
 

    /**
     * Display a listing of the roles.
     * @author AKHIL MURUKAN
     * @date 10/08/2018
     * @since version 1.0.0
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.role.index');
    }
	 /**
     * Search keyword in role list.
     * @author Chinnu L
     * @date 01/08/2017
     * @since version 1.0.0
     * @param  \App\UserRole  $UserRole
     * @return \Illuminate\Http\Response
     */
	 
	 public function search_list(Request $request)
    {	
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords'];
		$results = array();	
		$company_id = auth()->user()->cmpny_id;
		$results = UserRole::where('cmpny_id',$company_id);

        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('role', 'like', '%' . $search_keywords . '%');
                   
                });
            }
        $results   =   $results->paginate();
		$html = view('masters.role.listview')->with(compact('results'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return json_encode($result_arr);
    }
	/**
     * Display a listing of the roles.
     * @author AKHIL MURUKAN
     * @date 10/08/2018
     * @since version 1.0.0
     * @return \Illuminate\Http\Response
     */
	 
	public function create()
    {   
	    $company_id = auth()->user()->cmpny_id;
		$permission =array();
		$plan_id = CompanyProfile::select('ori_cmp_org_plan')->where('id',$company_id)->first();
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
		$role_id ='';
		return view('masters.role.create', compact('role_id','permission'));
    }
	 /**
     * Display the specified role.
     * @author Chinnu L
     * @date 01/08/2017
     * @since version 1.0.0
     * @param  \App\UserRole  $UserRole
     * @return \Illuminate\Http\Response
     */
    public function edit($role_id=null)
    {
        $permission        =  array();
		
	    $company_id = auth()->user()->cmpny_id;
		$role = UserRole::where('id',$role_id)->where('cmpny_id',$company_id)->first();
		if(empty($role)) 
            {
                return redirect('roles');
            }
            $plan_id = CompanyProfile::select('ori_cmp_org_plan')->where('id',$company_id)->first();
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

        return view('masters.role.create',compact('role','permission'));
    }
    /**
     * Update existing role or Store a newly created role in storage.
     * @author AKHIL MURUKAN
     * @date 01/08/2017
     * @since version 1.0.0
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

	  public function store(Request $request)
    {
        $remove_flag = "";
		$perm_remove_list = array();
		$perm_list_new = array();
		$response           =   $request->all();
		$permissions		=   $request->post('check_list');
		if(isset($response['is_affect']) && $response['is_affect'] == 'on')
		{
			$is_affect   = config('constant.IS_DISPLAY');
		}else{
			$is_affect   = config('constant.NOT_DISPLAY');
		}
		
        $role               =   $response['role'];     
        $role_id            =   $response['id'];     
        $user               =   Auth::User()->id;  
        $cmpny_id           =   Auth::User()->cmpny_id;  
		$success = false;
	    $message = 'Something Went Worng';
		
	    if(empty($role))
		{
			$result_arr=array('success' => false, 'message' => 'Please enter the role name');
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
        $access_permission = serialize($permission_array);	
        $check = ['id' => $role_id
		          ];
//////////////////////////START UPDATION ON 03-04-2020///////////////////////////////////////////////////////////			
						
								$permission_array_count = count($permission_array);
								$permission_record = UserRole::where($check)->first();
								if($permission_record){
								$permission_record_exist = unserialize($permission_record['access_permission']);	
								$permission_record_exist_count = count($permission_record_exist);
								if($permission_record_exist_count>=$permission_array_count){$remove_flag = 1;}}		
								
//////////////////////////END UPDATION ON 03-04-2020///////////////////////////////////////////////////////////	
        $update = [
                'role' => $role,
                'access_permission' => $access_permission,
                'updated_by' => $user,
            ];
        $create = $update;
        $create['created_by'] = $user;
        $create['cmpny_id'] = auth()->user()->cmpny_id;
        
        $record = UserRole::where($check)->first();

        if (is_null($record)) {
			UserRole::create($create);
          
		     $success = true;
		     $message = 'Successfuly Created';
        } else {
              $record->update($update);
			  
			  if(isset($is_affect) && $is_affect == '1')
			  {
				$usr = User::where('cmpny_id',$cmpny_id)
				         ->where('role_id','like','%:"'.$role_id .'";%')->get();
				if(count($usr) > 0)
				{
					$access_permission_new = '';
					foreach($usr as $usr_per)
					{
						$using_role = $usr_per->role_id;
						$modify_role = unserialize($using_role);
						
						//$using_access_permission = $usr_per->access_permission;
						if(isset($using_role) && !empty($using_role))
						{
							foreach($modify_role as $role_id_arr)
							{
								
								$role_det = UserRole::where('id',$role_id_arr)->where('cmpny_id',$cmpny_id)->first();
								$access_permission_new = $role_det->access_permission;
								$access_permission_new = unserialize($access_permission_new);
											foreach ($access_permission_new as $row)
											{
													$access_perm[]=$row['permission_id'];
											}	
							}
							$access_perm_array = array_unique($access_perm);
							$access_permission_array = array();
							foreach($access_perm_array as $selected)
										{
											$det=Permission::where('id',$selected)->first();	
											if($det){
											$access_permission_array[]=Array ( 'permission_id' => $selected,'permission_name' => $det->name); 
											}
										}

						$permission_under_role = serialize($access_permission_array);
						
						
						
						
						
//////////////////////////START UPDATION ON 03-04-2020///////////////////////////////////////////////////////////			
					
						$user_update = User::where('id',$usr_per->id)->first();
						if($user_update){
						$permission_list = $user_update->access_permission;
						$permission_list_new = unserialize($permission_list);
						foreach ($permission_list_new as $row)
						{
								$permission[]=$row['permission_id'];
						}
						$user_perm_list = array_unique($permission);
						foreach ($permission_array as $row_perm)
						{
								$permission_array_new[]=$row_perm['permission_id'];
						}
						foreach ($permission_record_exist as $row_perm)
						{
								$permission_id_record_exist[]=$row_perm['permission_id'];
						}
						if($remove_flag == 1){
  					      	foreach ($permission_array as $row1)
							{
								$permission_array1[]=$row1['permission_id'];
							}
							foreach ($permission_record_exist as $row2)
							{
								$permission_array2[]=$row2['permission_id'];
							}
							$permission_diff=array_diff($permission_array2,$permission_array1);
							if(count($permission_diff)>0){
								$user_filter_permission = array_diff($user_perm_list,$permission_diff);}
							else{
								$user_filter_permission1 = array_diff($permission_id_record_exist,$permission_array_new);
								$user_filter_permission = array_diff($user_perm_list,$user_filter_permission1);
							}
						}		 
					    else{
						    $user_filter_permission = $user_perm_list;
						}
						$permission_array_merge = array_merge($permission_array_new,$user_filter_permission);
						$update_permission = array_unique($permission_array_merge);
						$update_permission_array= array();
							foreach($update_permission as $selected)
							{
								$det=Permission::where('id',$selected)->first();	
								if($det){
									$update_permission_array[]=Array ( 'permission_id' => $selected,'permission_name' => $det->name); 
								}
							}
                  		$new_permission_list = serialize($update_permission_array);}
						else{$new_permission_list = $permission_under_role;}
//////////////////////////END UPDATION ON 03-04-2020///////////////////////////////////////////////////////////						
						$user_update = User::where('id',$usr_per->id)->first();
					    $update_each_user = [
							'access_permission' => $new_permission_list,
							'updated_by' => $user,
						];
					    $user_update->update($update_each_user);
						}
					}	
				}
			}

             $success = true;
		     $message = 'Successfuly Updated';
        }
		$result_arr=array('success' => $success, 'message' => $message);
		echo json_encode($result_arr);
    }
   
    /**
     * Remove the specified role.
     * @author AKHIL MURUKAN
     * @date 10/12/2018
     * @since version 1.0.0
     * @param  \App\UserRole  $UserRole
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {   
        $success =true;
		$message ='';
        if($id!=null)
        {
                $permission = UserRole::find($id);
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
