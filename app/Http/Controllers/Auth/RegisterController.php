<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserRole;
use App\QueryTypes;
use App\PasswordHistory;
use App\LocationSettings;
use App\LocalBodyType;
use App\PasswordSecurity;
use App\Permission;
use App\FaqCategories;
use App\Designations;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register'; 
	
	/**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
		$company_id = auth()->user()->cmpny_id;
		$category_name 	 	= 	FaqCategories::orderBy('category_name')
									->where('cmpny_id',$company_id)
									->where('parent_category_id',NULL)
									->where('status',config('constant.ACTIVE'))
									//->pluck('category_name', 'id')
									->get();
		$designation 	 	= 	['' => 'Select'] + Designations::orderBy('designation')
									->where('cmpny_id',$company_id)
									->where('status',config('constant.ACTIVE'))
									->pluck('designation', 'id')->all();
		
		$country_arr    	= LocationSettings::select('id','name')->where('parent',0)->get();
		
		$localbodytype_arr  = LocalBodyType::where('parent_id',0)
									->where('status',config('constant.ACTIVE'))->get();
        $roles  =  UserRole::where('id','!=',config('constant.ACTIVE'))->where('cmpny_id',$company_id)->get();
        return view('customer.register',compact('roles','category_name','country_arr','localbodytype_arr','designation'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
			'name' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:ori_users,username,NULL,id,deleted_at,NULL',
            'email' => 'required|string|max:50|unique:ori_users,email,NULL,id,deleted_at,NULL',
			//'phone' => 'required|numeric|digits_between:10,13',
			'address' => 'max:100',
			//'cc_emails' => 'max:150',
			//'category_name' => 'required',
			//'designation' => 'required',
            'role' => 'required',
            'password' => 'required|string|min:8|confirmed',
			//'country_id' => 'required',
			//'state_id' => 'required',
			//'district_id' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
	  $company_id = auth()->user()->cmpny_id;
	  $chat_name = NULL;
	  $access_permission_array=array();
      if (isset($data['email']) && !empty($data['email']))
      {
        $agent_email  = $data['email'];

		$temp_agentusername = explode('@',$agent_email); // get agent user name from email
        $chat_name=$temp_agentusername[0];
      }
	  $country_id = $state_id = $district_id = $local_body_type = $corporation_id = $muncipality_id = $panchayath_type = $district_panchayath_id = $block_panchayath_id = $grama_panchayath_id = $panchayath_id = $taluk_id = $village_id  = $department = $designation = $cc_emails = Null;
	  
	  
	  if (isset($data['country_id']) && !empty($data['country_id']))
      {
        $country_id  = $data['country_id'];
	  }
	  if (isset($data['state_id']) && !empty($data['state_id']))
      {
        $state_id  = $data['state_id'];
	  }
	  if (isset($data['district_id']) && !empty($data['district_id']))
      {
        $district_id  = $data['district_id'];
	  }
	  if (isset($data['local_body_type']) && !empty($data['local_body_type']))
      {
        $local_body_type  = $data['local_body_type'];
	  }
	  if (isset($data['corporation_id']) && !empty($data['corporation_id']))
      {
        $corporation_id  = $data['corporation_id'];
	  }
	  if (isset($data['muncipality_id']) && !empty($data['muncipality_id']))
      {
        $muncipality_id  = $data['muncipality_id'];
	  }
	  if (isset($data['panchayath_type']) && !empty($data['panchayath_type']))
      {
        $panchayath_type  = $data['panchayath_type'];
	  }
	  if (isset($data['district_panchayath_id']) && !empty($data['district_panchayath_id']))
      {
        $district_panchayath_id  = $data['district_panchayath_id'];
	  }
	  if (isset($data['block_panchayath_id']) && !empty($data['block_panchayath_id']))
      {
        $block_panchayath_id  = $data['block_panchayath_id'];
	  }
	  if (isset($data['grama_panchayath_id']) && !empty($data['grama_panchayath_id']))
      {
        $grama_panchayath_id  = $data['grama_panchayath_id'];
	  }
	  if (isset($data['panchayath_id']) && !empty($data['panchayath_id']))
      {
        $panchayath_id  = $data['panchayath_id'];
	  }
	  if (isset($data['taluk_id']) && !empty($data['taluk_id']))
      {
        $taluk_id  = $data['taluk_id'];
	  }
	  if (isset($data['village_id']) && !empty($data['village_id']))
      {
        $village_id  = $data['village_id'];
	  }
	 
	  if (isset($data['designation']) && !empty($data['designation']))
      {
        $designation  = $data['designation'];
	  }
	  if (isset($data['cc_emails']) && !empty($data['cc_emails']))
      {
        $cc_emails  = $data['cc_emails'];
	  }
	  
	   if (isset($data['department']) && !empty($data['department']))
      {
        $department  = $data['department'];
	  }else{
	  	$department  =array();
	  }

	  $agent_number	= (int)$data['agent_number'] ?? NULL;
	 
	  
	  foreach($data['role'] as $role_id_arr)
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
	 /* $role_det = UserRole::where('id',$data['role'])->where('cmpny_id',$company_id)->first();
	  $access_permission = $role_det->access_permission;*/
	  
      $user_id = User::create([
          'name' => $data['name'],
          'cmpny_id' => $company_id,
          'username' => $data['username'],
          'email' => $data['email'],
          'phone' => $data['phone'],
          'address' => $data['address'],
		  'cc_emails' 				=> $cc_emails,
		  'country_id' 				=> $country_id,
		  'state_id' 				=> $state_id,
		  'district_id' 			=> $district_id,
		  'local_body_type' 		=> $local_body_type,
		  'corporation_id'	 		=> $corporation_id,
		  'muncipality_id' 			=> $muncipality_id,
		  'panchayath_type' 		=> $panchayath_type,
		  'district_panchayath_id'  => $district_panchayath_id,
		  'block_panchayath_id' 	=> $block_panchayath_id,
		  'grama_panchayath_id' 	=> $grama_panchayath_id,
		  'panchayath_id' 			=> $panchayath_id,
		  'department' 				=> serialize($department),
		  'designation' 			=> $designation,
          'access_permission' => $permission_under_role,
          'password' => Hash::make($data['password']),
          'role_id' => serialize($data['role']),
          'current_chat_count' => 0,
          'chat_flag' => config('constant.ACTIVE'),
          'status' => config('constant.ACTIVE'),
          'chat_name'=>$chat_name,
          'agent_number'=>$agent_number
      ]);
	    $passwordHistory = PasswordHistory::create([
			'user_id' => $user_id->id,
			'cmpny_id' => $user_id->cmpny_id,
			'password' => Hash::make($data['password'])
		]);
		$passwordSecurity = passwordSecurity::updateOrCreate(
			[
				'user_id' => $user_id->id,
				'cmpny_id' => $user_id->cmpny_id,
			],
			[
				'password_expiry_days' => config('constant.password_expiry_days'),
				'password_updated_at' => Carbon::now()
			]);
		return $user_id;	
		
    }
	
	public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

		//  $this->guard()->login($user);
        if($user){
			//session()->flash('success','Registered successfully');
		    $result_arr=array('success' => true,'message' => 'Registered successfully');
		    return json_encode($result_arr);
        }
        else {
            //session()->flash('error','Something went wrong');
		    $result_arr=array('success' => true,'message' => 'Something went wrong');
		    return json_encode($result_arr);
        }
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
	
}
