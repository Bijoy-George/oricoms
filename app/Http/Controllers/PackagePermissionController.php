<?php

namespace App\Http\Controllers;

use Auth;
use App\UserRole;
use App\PackagePermission;
use App\Permission;
use App\Plan;
use Illuminate\Http\Request;

class PackagePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
   
   
 

    /**
     * Display a listing of the packagePermission.
     * @author AKHIL MURUKAN
     * @date 13/10/2018
     * @since version 1.0.0
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.packagePermission.index');
    }
	 /**
     * Search keyword in packagePermission list.
     * @author AKHIL MURUKAN
     * @date 13/10/2018
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
		$results = PackagePermission::where('status',1)->with('plans');
		


        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('package_name', 'like', '%' . $search_keywords . '%');
                   
                });
            }
        $results   =   $results->paginate();
		$html = view('masters.packagePermission.listview')->with(compact('results'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return json_encode($result_arr);
    }
	/**
     * creating packagePermission.
     * @author AKHIL MURUKAN
     * @date 13/10/2018
     * @since version 1.0.0
     * @return \Illuminate\Http\Response
     */
	 
	public function create()
    {   
	    $permission  =  Permission::all();
		$plans        =  Plan::where('status',config('constant.ACTIVE'))->pluck('plan', 'id')->all();
		$package_name ='';
		return view('masters.packagePermission.edit', compact('package_name','permission','plans'));
    }
	 /**
     * Edit packagePermission.
     * @author AKHIL MURUKAN
     * @date 10/08/2018
     * @since version 1.0.0
     * @return \Illuminate\Http\Response
     */
    public function edit($package_id=null)
    {
        $package        =  PackagePermission::find($package_id);
        $plans        =  Plan::where('status',config('constant.ACTIVE'))->pluck('plan', 'id')->all();
		if(empty($package)) 
            {
                return redirect('packages');
            }
        $permission  =  Permission::all();
        return view('masters.packagePermission.edit',compact('package','permission','plans'));
    }
    /**
     * Update existing role or Store a newly created role in storage.
     * @author Chinnu L
     * @date 01/08/2017
     * @since version 1.0.0
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response           =   $request->all();
		$permissions	   	=   $request->post('check_list');
        $package_name            =   $response['package_name'];     
        $plan_name            =   $response['package_type'];    
	
        $package_id         =   $response['id'];   
		
        $user               =   Auth::User()->id;   
		$success = false;
	    $message = 'Something Went Worng';
		
		if(isset($package_id) && !empty($package_id))
		{
			$this->validate($request,[
				'package_name' => 'required|string|max:100|unique:ori_mast_package,package_name,'.$package_id.',id,package_type,' . $plan_name,
				]);	  
		}
		else{
			$this->validate($request,[
				//'package_name' => 'required|string|max:100|unique:ori_mast_package,package_name,'.$package_name,
				'package_name' => 'required|string|max:100|unique:ori_mast_package,package_name,NULL,id,package_type,' . $plan_name,
				]); 
		}
	    if(empty($package_name))
		{
			$result_arr=array('success' => false, 'message' => 'Please enter the package name');
		    echo json_encode($result_arr); return;
		}
		else if(empty($plan_name))
		{
			$result_arr=array('success' => false, 'message' => 'Please enter the Plan name');
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
        $check = ['id' => $package_id
		          ];
        $update = [
                'package_name' => $package_name,
                'package_type' => $plan_name,
                'permission_under_package' => $permission_array,
                'status' => config('constant.ACTIVE'),
                'updated_by' => $user,
            ];
        $create = $update;
        $create['created_by'] = $user;
        
        $record = PackagePermission::where($check)->first();

        if (is_null($record)) {
			PackagePermission::create($create);
          
		     $success = true;
		     $message = 'Successfuly Created';
        } else {
             $record->update($update);
			 
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
                $permission = PackagePermission::find($id);
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
