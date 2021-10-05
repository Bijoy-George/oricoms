<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Helpers;
use Hash;
use Validator;
use App\PasswordHistory;
use App\PasswordSecurity;
use Carbon\Carbon;
use App\CustomerProfile;
use DB;
use App\DefaultProfileField;
use App\CustomerProfileField;
use App\Tab;
use App\FieldType;
use App\FieldOptions;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('check-permission:profile customization',['only' => ['profile_custom_index','profile_custom_list']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.dashboard');
    }
	 public function logout(Request $request)
    {
//        Auth::guard('admin')->logout();
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'login' ));
    }
	public function settings()
    {
        return view('settings.settings');
    }
	 /**
     * change password
     * @author AKHIL MURUKAN
     * @date 10/07/2017
     * @since version 1.0.0
     * @return settings.changepassword blade
    */
	public function changepassword()
    {
        return view('settings.changepassword');
    }
	/**
     * change password
     * @author AKHIL MURUKAN
     * @date 10/07/2017
     * @since version 1.0.0
    */
	public function postCredentials(Request $request)
		{

			$request_data = $request->All();
			$this->validate($request, [
               'current-password' => 'required',
				'password' => 'required|min:8|same:password',
				'password_confirmation' => 'required|same:password',
            ]);

		      $user = Auth::user();
		      $passwordHistories = $user->passwordHistories()->take(config('constant.passwordHistories_count'))->orderBy('id', 'desc')->get();
					foreach($passwordHistories as $passwordHistory)
					{
						if (Hash::check($request_data['password'], $passwordHistory->password)) 
						{
							$result_arr = array('success' => false, 'message' => 'Your new password can not be same as any of your recent passwords. Please choose a new password');
                            echo json_encode($result_arr);	return;
						}
					}
			  $current_password = Auth::User()->password;
			  if(Hash::check($request_data['current-password'], $current_password))
			  {
				$user_id = Auth::User()->id;
				$obj_user = User::find($user_id);
				$obj_user->password = Hash::make($request_data['password']);
				$obj_user->save();

				$passwordHistory = PasswordHistory::create([
					'user_id' => $obj_user->id,
					'password' => Hash::make($request_data['password'])
				]);
                $passwordSecurity = PasswordSecurity::updateOrCreate(
				[
					'user_id' => $obj_user->id,
			    ],
				[
					'password_expiry_days' => config('constant.password_expiry_days'),
					'password_updated_at' => Carbon::now()
				]);

                $result_arr = array('success' => true, 'message' => 'Successfuly updated','refresh' =>true);
                echo json_encode($result_arr);	
			  }
			  else
			  {
				$result_arr = array('success' => false, 'message' => 'Please enter correct current password');
                echo json_encode($result_arr);	
			  }

		}

     /**
     * Profile fields Customization
     * @author Reshma Rajan
     * @date 14/11/2018
     * @since version 1.0.0
     * @return profile_customization.blade
    */
    public function profile_custom_index()
    {
        return view('settings.ProfileFields.index');
    }
    /**
     * Profile fields Customization
     * @author Reshma Rajan
     * @date 14/11/2018
     * @since version 1.0.0
     * @return profile_customization.blade
    */
    public function profile_custom_list(Request $request) 
    {
        $results=DefaultProfileField::with('def_profile_fields')->orderBy('sort_order','asc')->orderBy('id','asc')->get();
        $results_custom=CustomerProfileField::where(['type'=>config('constant.CUSTOM_FIELD')])->get();
        $html = view('settings.ProfileFields.profile_customization')->with(compact('results','results_custom'))->render();
        $result_arr=array('success' => true,'html' => $html);
        return json_encode($result_arr); 
    }
    /**
     * Profile fields Customization
     * @author Reshma Rajan
     * @date 14/11/2018
     * @since version 1.0.0
     * @return profile_customization.blade
    */
     public function show_fields(Request $request) 
    {
      
        $field_type=request('field_type');
        $result=array();
        $id='';
        $tab_arr=array();
        $fields = NULL;
        if(request('field_id') && request('field_type') == config('constant.DEFAULT_FEILD') || request('field_type') == config('constant.UPLOAD_FEILD') )
        {
            $tab_det=Tab::where('status',config('constant.ACTIVE'))->where('type',3)->get();
            $field_types_arr=FieldType::where('status',config('constant.ACTIVE'))->get();
            $option_arr=FieldOptions::select('options')->where('field_id',request('field_id'))->where('status',config('constant.ACTIVE'))->get();
            $option_arr=FieldOptions::where('field_id',request('field_id'))->where('status',config('constant.ACTIVE'))->pluck('options');
            $option_val=array();
            foreach ($option_arr as $key => $res) {
              $option_val[]=$res;
            }
            $option_tag=implode(',',$option_val);
            foreach ($tab_det as $key => $value) {
                $tab_arr[$value->id]=$value->type;
            }
            $field_id=request('field_id');
            $result=CustomerProfileField::where(['cmpny_id'=>Auth::User()->cmpny_id,'field_id'=>request('field_id')]);
            
            if(request('id'))
            {
                $id=request('id');
                $result=$result->where('id',request('id'));
            }
            $fields=$result->first();
            //$tab_det=Tab::where('status',config('constant.ACTIVE'))->get();
            
            foreach ($tab_det as $key => $value) {
                $tab_arr[$value->id]=$value->type;
            }
          return view('settings.ProfileFields.feild_details',compact('option_tag','field_types_arr','fields','field_id','id','field_type','tab_det','tab_arr'));
        }else if(request('field_type') == config('constant.CUSTOM_FIELD')){
            $tab_det=Tab::where('status',config('constant.ACTIVE'))->get();
            $field_types_arr=FieldType::where('status',config('constant.ACTIVE'))->get();
            $option_arr=FieldOptions::where('field_id',request('id'))->where('status',config('constant.ACTIVE'))->pluck('options');
            $option_val=array();
            foreach ($option_arr as $key => $res) {
              $option_val[]=$res;
            }
            $option_tag=implode(',',$option_val);
            foreach ($tab_det as $key => $value) {
                $tab_arr[$value->id]=$value->type;
            }
            $field_id='';
            if(request('id'))
            {
                $id=request('id');
                $fields=CustomerProfileField::where(['cmpny_id'=>Auth::User()->cmpny_id,'id'=>request('id')])->first();
                
            }
           
            return view('settings.ProfileFields.feild_details',compact('option_tag','field_types_arr','field_id','id','field_type','fields','tab_det','tab_arr'));
        }

    }

    /**
     * Profile fields Customization
     * @author Reshma Rajan
     * @date 14/11/2018
     * @since version 1.0.0
     * @return profile_customization.blade
    */
      public function update_default_fields(Request $request) 
    {
        if(request('field_id'))
        {
            
            $this->validate($request,[
                'field_label' => 'required',
                'tab_id' => 'required',
                ],[
                'field_label.required' => 'Label field is required.',
                'tab_id.required' => 'Tab Fields is required.',
                ]);
            $cond_arr=array('cmpny_id'=>Auth::User()->cmpny_id,'field_id'=>request('field_id'));
            if(request('id'))
            {   
                $cond_arr['id']=request('id');
            }
            
            $def_det=DefaultProfileField::where('id',request('field_id'))->first();
            
            $result=CustomerProfileField::updateOrCreate($cond_arr,[
                'cmpny_id'=>Auth::User()->cmpny_id,
                'field_id'=>request('field_id'),
                'field_name'=>$def_det->field_name,
              //  'field_type'=>$def_det->field_type_val,
                'type'=>config('constant.DEFAULT_FEILD'),
                'label'=>request('field_label'),
                'sort_order'=>request('sort_order'),
                'required'=>request('is_required'),
                'is_unique'=>request('is_unique'),
                'tab_id'=>request('tab_id'),
                'status'=>config('constant.ACTIVE'),
                'report_field'=>request('report_field'),
            ]);

            if(request('field_options'))
            {
              $option_arr=explode(',', request('field_options'));

              foreach ($option_arr as $key => $value) {
                FieldOptions::updateOrCreate([
                    'cmpny_id'=>Auth::User()->cmpny_id,
                    'field_id'=>request('field_id'),
                    'options'=>$value,
                ],[
                    'cmpny_id'=>Auth::User()->cmpny_id,
                    'field_id'=>request('field_id'),
                    'options'=>$value,
                    'status'=>config('constant.ACTIVE'),
                    
                ]);
              }
            }
            if(request('field_id') == 11)
            {
              $field_det=CustomerProfileField::where('field_id',request('field_id'))->first();
              $up_arr=array('muncipality_id'=>'Muncipality','corporation_id'=>'Corporation','panchayath_type'=>'Panchayath Type','district_panchayath_id'=>'District Panchayath','block_panchayath_id'=>'Block Panchayath','grama_panchayath_id'=>'Grama Panchayath','panchayath_id'=>'Panchayath','taluk_id'=>'Taluk','village_id'=>'Village');
              foreach ($up_arr as $key => $value) {
                CustomerProfileField::updateOrCreate([
                'cmpny_id'=>Auth::User()->cmpny_id,
                'field_name'=>$key,
                ],[
                  
                  'type'=>3,
                  'label'=>$value,
                  'sort_order'=>$field_det->sort_order ?? NULL,
                  'tab_id'=>$field_det->tab_id,
                  'status'=>config('constant.ACTIVE')
                ]);
              }
             
              
            }
            
            $result_arr = array('success' => true, 'message' => 'Field Updated Successfuly');
                echo json_encode($result_arr);
        }

    }
     public function remove_profile_fields(Request $request) 
    {
        if(request('id'))
        {
            CustomerProfileField::where('id',request('id'))->update(['status'=>config('constant.INACTIVE')]);
            $field_det=CustomerProfileField::find(request('id'));
            if($field_det->field_id == 11)
            {
              $up_arr=array('muncipality_id'=>'Muncipality','corporation_id'=>'Corporation','panchayath_type'=>'Panchayath Type','district_panchayath_id'=>'District Panchayath','block_panchayath_id'=>'Block Panchayath','grama_panchayath_id'=>'Grama Panchayath','panchayath_id'=>'Panchayath','taluk_id'=>'Taluk','village_id'=>'Village');
              foreach ($up_arr as $key => $value) {
                CustomerProfileField::updateOrCreate([
                'cmpny_id'=>Auth::User()->cmpny_id,
                'field_name'=>$key,
                ],[
                  
                  'type'=>3,
                  'label'=>$value,
                  'status'=>config('constant.INACTIVE')
                ]);
              }
              
            }
            return $result_arr=array('success' => true,'message' => 'Successfuly deleted', 'refresh' => true);
        }

    }
      public function activate_profile_fields(Request $request) 
    {   
        if(request('categoryid') && request('type'))
        {
            $user_tab=Tab::where('status',config('constant.ACTIVE'))->where('type',3)->first();
            if(request('type') == 1 || request('type') == 4){
                  $check_exist=CustomerProfileField::where('field_id',request('categoryid'))->count();
                  if($check_exist > 0){
                    CustomerProfileField::where('field_id',request('categoryid'))->update(['status'=>config('constant.ACTIVE'),'type'=>request('type')]);
                  }else{

                      $fields=DefaultProfileField::find(request('categoryid'));
                      CustomerProfileField::updateOrCreate([
                        'field_id'=>request('categoryid'),
                        'cmpny_id'=>Auth::User()->cmpny_id
                      ],[
                        'field_name'=>$fields->field_name,
                        'type'  =>request('type'),
                        'label'=>$fields->field_label,
                        'sort_order'=>$fields->sort_order,
                        'tab_id'=>$user_tab->id,
                        'status'=>config('constant.ACTIVE')
                      ]);
                    
                  }
            }else{
              $check_exist=CustomerProfileField::where('id',request('categoryid'))->count();
                if($check_exist > 0){
                    CustomerProfileField::where('id',request('categoryid'))->update(['status'=>config('constant.ACTIVE')]);
                  }else{

                    CustomerProfileField::updateOrCreate([
                        'id'=>request('categoryid'),
                        'cmpny_id'=>Auth::User()->cmpny_id
                      ],[
                        'type'  =>request('type'),
                        'status'=>config('constant.ACTIVE')
                      ]);
                    
                  }
            
            
            }
            if(request('categoryid') == 11)
            {
              $fields=DefaultProfileField::find(request('categoryid'));
              $field_det=CustomerProfileField::where('field_id',request('categoryid'))->first();
              
              if($field_det->tab_id)
              {
                $tab_value=$field_det->tab_id;
                
              }else{
                $tab_value=$user_tab->id;
                
              }
              $up_arr=array('muncipality_id'=>'Muncipality','corporation_id'=>'Corporation','panchayath_type'=>'Panchayath Type','district_panchayath_id'=>'District Panchayath','block_panchayath_id'=>'Block Panchayath','grama_panchayath_id'=>'Grama Panchayath','panchayath_id'=>'Panchayath','taluk_id'=>'Taluk','village_id'=>'Village');
              foreach ($up_arr as $key => $value) {
                CustomerProfileField::updateOrCreate([
                'cmpny_id'=>Auth::User()->cmpny_id,
                'field_name'=>$key,
                ],[
                  
                  'type'=>3,
                  'label'=>$value,
                  'tab_id'=>$tab_value,
                  'sort_order'=>$fields->sort_order,
                  'status'=>config('constant.ACTIVE')
                ]);
              }
              
            }

            return $result_arr=array('success' => true,'message' => 'Successfuly activated', 'refresh' => true);
        }

    }
    
        /**
     * Profile fields Customization
     * @author Reshma Rajan
     * @date 15/11/2018
     * @since version 1.0.0
     * @return profile_customization.blade
    */
     public function update_custom_fields(Request $request) 
    {
        $fieldname=str_replace(' ', '_', strtolower(request('field_label')));
        $this->validate($request,[
            'field_label' => 'required',
            'tab_id' => 'required',
            
            ],[
            'field_label.required' => 'Label field is required.',
            'tab_id.required' => 'Tab Fields is required.',
            
            ]);
        $exist_count=CustomerProfileField::where('field_name',$fieldname);
        if(request('id'))
        {
            $exist_count->where('field_name',request('id'));
        }
        $exist_count=$exist_count->count();
        if($exist_count != 0){
            $result_arr = array('success' => false, 'message' => 'Field Already Exist');
            echo json_encode($result_arr);die;
        }
        $cond_arr=array('cmpny_id'=>Auth::User()->cmpny_id,'id'=>request('id'));
        
        $result=CustomerProfileField::updateOrCreate($cond_arr,[
            'cmpny_id'=>Auth::User()->cmpny_id,
            'id'=>request('id'),
            'field_name'=>$fieldname,
            'type'=>config('constant.CUSTOM_FIELD'),
            'label'=>request('field_label'),
            'sort_order'=>request('sort_order'),
            'required'=>request('is_required'),
            'is_unique'=>request('is_unique'),
            'tab_id'=>request('tab_id'),
            'field_type'=>request('field_type_val'),
            'status'=>config('constant.ACTIVE'),
            'report_field'=>request('report_field'),
        ]);
         if(request('field_options'))
            {
              $option_arr=explode(',', request('field_options'));

              foreach ($option_arr as $key => $value) {

                FieldOptions::updateOrCreate([
                    'cmpny_id'=>Auth::User()->cmpny_id,
                    'field_id'=>request('id'),
                    'options'=>$value,
                ],[
                    'cmpny_id'=>Auth::User()->cmpny_id,
                    'field_id'=>request('id'),
                    'options'=>$value,
                    'status'=>config('constant.ACTIVE'),
                    
                ]);
              }
            }
        $result_arr = array('success' => true, 'message' => 'Field Updated Successfuly');
            echo json_encode($result_arr);
       

    }
    function check_report_fields(Request $request)
    {
        if(request('tid')){
        $check_repeatable=Tab::where('id',request('tid'))->wherein('type',[1,3])->count();
        return $check_repeatable;
        }
    }

    /**
    * Function to reset the current_chat_count and chat_flag of the logged-in agent
    * @author Loraine Varghese
    * @date 19/12/2018
    * @since version 1.0.0
    */
    public function reset_chat_count(Request $request)
    {
      $user_id = Auth::user()->id;
      $update_current_chat_count=User::where('id',$user_id)
                                      ->update(['current_chat_count'=>'0','chat_flag'=>'1']);
      echo $update_current_chat_count;
    }
    
    /**
     * Set soft phone extension
     * @author PRANEESHA KP
     * @date 11/01/2019
     * @since version 1.0.0
     * @return settings.setextention  blade
	 
    */
	public function setextension()
    {
        return view('settings.setextention');
    }
	/**
     * Set soft phone extension
     * @author PRANEESHA KP
     * @date 11/01/2019
     * @since version 1.0.0
     * @return settings.setextention  blade
    */
	public function addextension(Request $request)
    {

            $user = Auth::user();
            $user->extension = request('extension');
            $user->save();
            $flash=session()->flash('success','Successfuly updated');
            return redirect()->back()->withErrors($flash)->withInput();
        //return view('settings.setextention');
    }
      /**
     * Profile fields Customization
     * @author Reshma Rajan
     * @date 7/2/2019
     * @since version 1.0.0
     * @return profile_customization.blade
    */
    public function add_field_options()
    {
        $field_name_arr=CustomerProfileField::select('id','field_name')->wherein('field_type',[2,9,10,11])->get();
        return view('settings.ProfileFields.option_create',compact('field_name_arr'));
    }
     /**
     * View all options
     * @author Reshma Rajan
     * @date 7/2/2019
     * @since version 1.0.0
     * @return profile_customization.blade
    */
    public function get_all_options(Request $request)
    {
      if(request('field_id'))
      {
         $opt_arr=FieldOptions::select('id','options','class')->where('field_id',request('field_id'))->where('status',config('constant.ACTIVE'))->get();
        return view('settings.ProfileFields.more_options',compact('opt_arr'));
      }
       
    }
      /**
     * Save options
     * @author Reshma Rajan
     * @date 7/2/2019
     * @since version 1.0.0
     * @return profile_customization.blade
    */
    public function save_options(Request $request)
    {
      
          $cmpny_id=Auth::User()->cmpny_id;
          $option_arr=request('new_option');
          $class = request('class');
          $flag=0;
          $this->validate($request,[
                'field_id' => 'required',
               
                ],[
                'field_id.required' => ' The field_id field is required.',
              
                ]);
          $i=0;
          foreach ($option_arr as $key => $value) {
           if(!empty($value)){

            
            $op_count=FieldOptions::where('id','!=',$key)->where('field_id',request('field_id'))->where('status',config('constant.ACTIVE'))->where('options',$value)->count();
            if($op_count == 0){
               FieldOptions::updateOrCreate([
                        
                        'cmpny_id'=>Auth::User()->cmpny_id,
                        'field_id'=>request('field_id'),
			 'options'=>$value,
                    ],[
                        'cmpny_id'=>Auth::User()->cmpny_id,
                        'field_id'=>request('field_id'),
                        'options'=>$value,
                        'class' => (isset($class[$i])?$class[$i]:$class[$key]),
                        'status'=>config('constant.ACTIVE')
                        
                    ]);
             }else{
              $flag=1;
                
              }
             }
             $i++;
          
          }
          if($flag == 1)  
          {
             $result_arr = array('success' => false, 'message' => 'Options Already Exist');
            echo json_encode($result_arr);

          }else{
           $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
           
            echo json_encode($result_arr);
          }
       
        
      
       
    }
      /**
     * Remove options
     * @author Reshma Rajan
     * @date 8/2/2019
     * @since version 1.0.0
     * @return profile_customization.blade
    */
    function remove_field_options()
    {
        if(request('id'))
        {
          FieldOptions::where('id',request('id'))->update(['status'=>config('constant.INACTIVE')]);
          $result_arr = array('success' => true, 'message' => 'Removed Successfuly');
          echo json_encode($result_arr);
        }

    }

}
