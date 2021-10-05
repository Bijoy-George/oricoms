@extends('layouts.app')
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-md-8 text-right"><a href="{{url('userDetails')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-md-8 mt-3">
      <div class="widget">
        <h2 class="m-0">{{ __('Add New User') }}</h2>
        <div class="widget-content pt-3"> 
          <!--   <form method="POST" action="{{ route('register') }}">--> 
          @if($flash = session('success'))
          <div id="flash-msg" class="alert alert-success">{{$flash}}</div>
          @endif
          @if($flash_err = session('error'))
          <div id="flash-msg_err" class="alert alert-danger">{{$flash_err}}</div>
          @endif
          <form action="{{ url('register') }}" method="post" class="form-common" id="frm_register" name="frm-register">
            @csrf
			<div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
            <div class="row m-0">
              <div class="col-md-6 form-group">
                <label for="name" class="mb-1">{{ __('Name') }}<span class="red_star">*</span></label>
                <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>
                <span id ="name_err" class="error"></span> </div>
              <div class="col-md-6 form-group">
                <label for="username" class="mb-1">{{ __('User Name') }}<span class="red_star">*</span></label>
                <input id="username" type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" autofocus>
                <span id ="username_err" class="error"></span> </div>
              <div class="col-md-6 form-group">
                <label for="email" class="mb-1">{{ __('E-Mail Address') }}<span class="red_star">*</span></label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                <span id ="email_err" class="error"></span> </div>               
              <div class="col-md-6 form-group">
                <label for="phone" class="mb-1">{{ __('Phone Number') }}<span class="red_star">*</span></label>
                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" autofocus>
                <span id ="phone_err" class="error"></span> </div>
                 <div class="col-md-6 form-group">
                <label for="cc_emails" class="mb-1">{{ __('CC E-Mails') }}</label>
                <textarea rows="4"  id="cc_emails" type="text" class="form-control{{ $errors->has('cc_emails') ? ' is-invalid' : '' }}" name="cc_emails" value="{{ old('cc_emails') }}" autofocus>  </textarea>
                <span id ="cc_emails_err" class="error"></span> </div>
              <div class="col-md-6 form-group">
                <label for="address" class="mb-1">{{ __('Address') }}<span class="red_star">*</span></label>
                <textarea rows="4"  id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" autofocus>  </textarea>
                <span id ="address_err" class="error"></span> </div>
              <div class="col-md-6 form-group">
                <label for="role" class="mb-1">{{ __('Role') }}<span class="red_star">*</span></label>
                <select id="role" name="role[]" class="form-control" multiple>
                  <option value="" >Select</option>
                    @foreach($roles as $role)
                  <option value="{{$role->id}}" >{{$role->role}}</option>
                    @endforeach
                </select>
                <span id ="role_err" class="error"></span> </div>

                <div class="col-md-6 form-group">
                <label for="agent_number" class="mb-1">{{ __('Agent Number') }}</label>
                <input id="agent_number" type="text" class="form-control {{ $errors->has('agent_number') ? ' is-invalid' : '' }}" name="agent_number" value="{{ old('agent_number') }}" autofocus>
                <span id ="agent_number_err" class="error"></span> </div>

                <div class="col-md-6 form-group">
                <label for="department" class="mb-1">{{ __('Department') }}<span class="red_star">*</span></label>
                <select id="department" name="department[]" class="form-control" multiple>
                  <option value="" >Select</option>
                  @if($category_name)
                    @foreach($category_name as $cat)
                      @if(isset($cat->id))
                  <option value="{{$cat->id}}" >{{$cat->category_name}}</option>
                   @endif
                    @endforeach
                  @endif
                </select>
                <span id ="role_err" class="error"></span> </div>
              <div class="col-md-6 form-group">
                <label for="password" class="mb-1">{{ __('Password') }}<span class="red_star">*</span></label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                <span id ="password_err" class="error"></span> </div>
              <div class="col-md-6 form-group">
                <label for="password-confirm" class="mb-1">{{ __('Confirm Password') }}<span class="red_star">*</span></label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
              </div>

			 
			  <div class="col-md-6 form-group">
                <label for="password-confirm" class="mb-1">{{ __('Designation') }}</label>
               {{ Form::select('designation', $designation, null, ['id' => 'designation', 'class' => 'form-control']) }} 
				<span id ="designation_err" class="error"></span>				   
			  </div>
			  <div class="col-md-6 form-group">
                <label for="password-confirm" class="mb-1">{{ __('Country') }}<span class="red_star">*</span></label>
                <select name="country_id"  class="form-control country_id" id="country_id">
					  <option value="">Select </option>
					  @foreach ($country_arr as $con)
					  <option value="{{ $con->id }}">{{ $con->name }}</option>
					  @endforeach
					</select>
					<span id ="country_id_err" class="error"></span>				   
			  </div>
			  <div class="col-md-6 form-group">
                <label for="password-confirm" class="mb-1">{{ __('State') }}<span class="red_star">*</span></label>
                <select name="state_id" class="form-control state_id" id="state_id" >
				  </select>
				  <span id ="state_id_err" class="error"></span>			   
			  </div>
			  <div class="col-md-6 form-group">
                <label for="password-confirm" class="mb-1">{{ __('District') }}<span class="red_star">*</span></label>
                 <select name="district_id" class="form-control district_id" id="district_id">
				  </select>
				  <span id ="district_id_err" class="error"></span>			   
			  </div>
			  <div class="col-md-6 form-group">
                <label for="password-confirm" class="mb-1">{{ __('Taluk Id') }}</label>
                 <select name="taluk_id" class="form-control taluk_id" id="taluk_id">
				  </select>
				  <span id ="taluk_id_err" class="error"></span>		   
			  </div>
			  <div class="col-md-6 form-group">
                <label for="password-confirm" class="mb-1">{{ __('Village Id') }}</label>
                 <select name="village_id" class="form-control village_id" id="village_id">
				  </select>
				  <span id ="village_id_err" class="error"></span>  
			  </div>
			  <div class="col-md-6 form-group">
                <label for="password-confirm" class="mb-1">{{ __('Local Body Type') }}</label>
                 <select name="local_body_type" class="form-control local_body_type" id="local_body_type">
				  <option value="">Select </option>
					  @foreach ($localbodytype_arr as $localbody)
					  <option value="{{ $localbody->id }}">{{ $localbody->type }}</option>
					  @endforeach
				  </select>
				  <span id ="local_body_type_err" class="error"></span>		   
			  </div>
			  <div class="col-md-6 form-group">
                <label for="password-confirm" class="mb-1">{{ __('Muncipality Id') }}</label>
                 <select name="muncipality_id" class="form-control muncipality_id" id="muncipality_id" >
				  </select>
				  <span id ="muncipality_id_err" class="error"></span>	   
			  </div>
			  <div class="col-md-6 form-group">
                <label for="password-confirm" class="mb-1">{{ __('Corporation Id') }}</label>
                 <select name="corporation_id" class="form-control corporation_id"  id="corporation_id">
				  </select>
				  <span id ="corporation_id_err" class="error"></span>   
			  </div>
			  <div class="col-md-6 form-group">
                <label for="password-confirm" class="mb-1">{{ __('Panchayath Type') }}</label>
                 <select name="panchayath_type" class="form-control panchayath_type" id="panchayath_type">
				  </select>
				  <span id ="panchayath_type_err" class="error"></span>   
			  </div>
			  <div class="col-md-6 form-group">
                <label for="password-confirm" class="mb-1">{{ __('Grama Panchayath Type') }}</label>
                  <select name="grama_panchayath_id" class="form-control grama_panchayath_id" id="grama_panchayath_id">
				  </select>
				  <span id ="grama_panchayath_id_err" class="error"></span> 
			  </div>
			  <div class="col-md-6 form-group">
                <label for="password-confirm" class="mb-1">{{ __('Block Panchayath Type') }}</label>
                  <select name="block_panchayath_id" class="form-control block_panchayath_id" id="block_panchayath_id">
				  </select>
				  <span id ="block_panchayath_id_err" class="error"></span> 
			  </div>
			  <div class="col-md-6 form-group">
                <label for="password-confirm" class="mb-1">{{ __('District Panchayath Type') }}</label>
                  <select name="district_panchayath_id" class="form-control district_panchayath_id" id="district_panchayath_id">
				  </select>
				  <span id ="district_panchayath_id_err" class="error"></span>
			  </div>
			   <div class="col-md-6 form-group">
				  <label for="password-confirm" class="mb-1">{{ __('Panchayath Id') }}</label>
				  <select name="panchayath_id" class="form-control panchayath_id" id="panchayath_id">
				  </select>
				  <span id ="panchayath_id_err" class="error"></span>
				</div>
			  
			  
			  
			  
              <div class="col-md-12 form-group text-right">
                <button type="reset" class="btn btn-outline-danger px-4">Reset</button>
                <button type="submit" class="btn btn-primary px-4"> {{ __('Register') }} </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 
@section('footer-custom-css-js') 
<script src="{{ asset('js/location.js') }}"></script>
<script type="text/javascript">
	$('.country_id').trigger('change');
</script>
@endsection