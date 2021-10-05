<?php

namespace App\Http\Controllers;

use Auth;
use App\UserRole;
use App\PackagePermission;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
        return view('masters.permission.index');
    }
		/**
     * Search keyword in role list.
     * @author AKHIL MURUKAN
     * @date 10/09/2019
     * @since version 1.0.0
     * @return \Illuminate\Http\Response
     */
	 
	 public function search_list(Request $request)
    {	
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords'];
		$results = array();	
        $results = Permission::orderBy('name', 'asc');

        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('name', 'like', '%' . $search_keywords . '%');
                   
                });
            }
        $results   =   $results->paginate();
		$html = view('masters.permission.listview')->with(compact('results'))->render();
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
	    $permission  =  Permission::all();
		$permission_id ='';
		return view('masters.permission.create', compact('permission_id','permission'));
    }
	 /**
     * Display the specified role.
     * @author Chinnu L
     * @date 01/08/2017
     * @since version 1.0.0
     * @param  \App\UserRole  $UserRole
     * @return \Illuminate\Http\Response
     */
    public function edit($permission_id=null)
    {
		$permission        =  Permission::find($permission_id);
        return view('masters.permission.create',compact('permission_id','permission'));
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
        $name               =   $response['name'];     
        $user               =   Auth::User()->id;  
        $perm_id            =   $response['permission_id'];
        
		$this->validate($request,[
            'name' => 'required|string|max:50|unique:ori_permissions,name,'.$name,
			]);
			
        $check = ['id' => $perm_id];
        $update = [
                'name' => $name,
                'updated_by' => $user,
            ];
        $create = $update;
        $create['created_by'] = $user;
        
        $record = Permission::where($check)->first();

        if (is_null($record)) {
            Permission::create($create);
        } else {
             $record->update($update);
           //  return $perm_id;
        }
		$result_arr=array('success' => true,'message' => 'Successfuly updated');
		echo json_encode($result_arr);
    }
   
    /**
     * Remove the specified role.
     * @author AKHIL MURUKAN
     * @date 10/12/2018
     * @since version 1.0.0
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {   
	    $success =true;
		$message ='';
        if($id!=null)
        {
                $permission = Permission::find($id);
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
