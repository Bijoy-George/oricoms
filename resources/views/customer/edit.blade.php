@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Edit User
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-md-8 text-right"><a href="{{url('userDetails')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-md-8 mt-3">
      <div class="widget">
        <h2 class="m-0">{{__('User Edit')}}</h2>
        <div class="widget-content pt-3"> @if(isset($userDetail))
          {!! Form::model($userDetail, ['method' => 'POST', 'class' => 'form-common', 'id' => 'frm_reg_edit','name' => 'frm_reg_edit','route' => ['userDetails.store']]) !!}
          @endif
          
          {{ csrf_field() }}
          @csrf
          <div class="row m-0">
            <div class="col-md-12"> <span class="response"></span> </div>
            {{ Form::hidden('userid', $userDetail->id, array('class' => 'form-control','id' => 'userid' )) }}
            <div class="col-md-6 form-group">
              <label for="name" class="mb-1">{{ __('Name') }}<span class="red_star">*</span></label>
              {{ Form::text('name', null, array('class' => 'form-control','id' => 'name', 'required' => true)) }} <span id ="name_err" class="error"></span> <span id ="name_err"></span> </div>
            <div class="col-md-6 form-group">
              <label for="username" class="mb-1">{{ __('User Name') }}<span class="red_star">*</span></label>
              {{ Form::text('username', null, array('class' => 'form-control','id' => 'username', 'required' => true)) }} <span id ="username_err" class="error"></span> </div>
            <div class="col-md-6 form-group">
              <label for="email" class="mb-1">{{ __('E-Mail Address') }}<span class="red_star">*</span></label>
              {{ Form::email('email', null, array('class' => 'form-control','id' => 'email', 'required' => true)) }} <span id ="email_err" class="error"></span> </div>
            <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('Phone Number') }}<span class="red_star">*</span></label>
              {{ Form::text('phone', null, array('class' => 'form-control','id' => 'phone')) }} <span id ="phone_err" class="error"></span> </div>
            
			<div class="col-md-6 form-group">
                <label for="cc_emails" class="mb-1">{{$userDetail->cc_emails}}{{ __('CC E-Mails') }}</label>
                {{ Form::textarea('cc_emails', null, array('class' => 'form-control','rows' => 4,'id' => 'cc_emails')) }}
                <span id ="cc_emails_err" class="error"></span> </div>


			<div class="col-md-6 form-group">
              <label for="address" class="mb-1">{{ __('Address') }}<span class="red_star">*</span></label>
              {{ Form::textarea('address', null, array('class' => 'form-control','rows' => 4,'id' => 'address')) }} <span id ="address_err" class="error"></span> </div>
            <div class="col-md-6 form-group">
			  <?php $sectionslst = unserialize($userDetail->role_id);?>
              <label for="role" class="mb-1">{{ __('Role') }}</label>
              {{ Form::select('role[]', $roles, $sectionslst, array('class' => 'form-control','id' => 'role','multiple' => 'multiple', 'required' => true)) }} <span id ="address_err"></span> </div>

              <div class="col-md-6 form-group">
              <label for="agent_number" class="mb-1">{{ __('Agent Number') }}<span class="red_star">*</span></label>
              {{ Form::text('agent_number', null, array('class' => 'form-control','id' => 'agent_number')) }} <span id ="agent_number_err" class="error"></span></div>
			  
			 <div class="col-md-6 form-group">
			  <?php $departmentlst = unserialize($userDetail->department);?>
              <label for="role" class="mb-1">{{ __('Department') }}</label>
              {{ Form::select('department[]', $category_name, $departmentlst, array('class' => 'form-control','id' => 'department','multiple' => 'multiple', 'required' => true)) }} <span id ="department_err"></span> </div>

			  
			  <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('Designation') }}</label>
               
               {{ Form::select('designation', $designation, null, ['id' => 'designation', 'class' => 'form-control']) }} 
				<span id ="designation_err" class="error"></span>	
			  </div>
			  
			  <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('Country') }}<span class="red_star">*</span></label>
              <select name="country_id"  class="form-control country_id" id="country_id">
					  <option value="">Select </option>
					  @foreach ($country_arr as $con)
					  <option value="{{ $con->id }}" @if(isset($userDetail->country_id) && $userDetail->country_id  == $con->id) {{'selected'}} @endif>{{ $con->name }}</option>
					  @endforeach
					</select>
					<span id ="country_id_err" class="error"></span> 
			  </div>
			  
			  <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('State') }}<span class="red_star">*</span></label>
              <select name="state_id" class="form-control state_id" id="state_id" >
				  </select>
				  <span id ="state_id_err" class="error"></span> 
			  </div>
			  
			  <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('District') }}<span class="red_star">*</span></label>
              <select name="district_id" class="form-control district_id" id="district_id">
				  </select>
				  <span id ="district_id_err" class="error"></span>
			  </div>
			  
			  <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('Taluk Id') }}</label>
              <select name="taluk_id" class="form-control taluk_id" id="taluk_id">
				  </select>
				  <span id ="taluk_id_err" class="error"></span>
			  </div>
			  
			  <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('Village Id') }}</label>
              <select name="village_id" class="form-control village_id" id="village_id">
				  </select>
				  <span id ="village_id_err" class="error"></span>
			  </div>
			  
			  <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('Local Body Type') }}</label>
              <select name="local_body_type" class="form-control local_body_type" id="local_body_type">
				  <option value="">Select </option>
					  @foreach ($localbodytype_arr as $localbody)
					  <option value="{{ $localbody->id }}" @if(isset($userDetail->local_body_type) && $userDetail->local_body_type  == $localbody->id) {{'selected'}} @endif >{{ $localbody->type }}</option>
					  @endforeach
				  </select>
				  <span id ="local_body_type_err" class="error"></span>
			  </div>
			  
			  <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('Panchayath Type') }}</label>
              <select name="panchayath_type" class="form-control panchayath_type" id="panchayath_type">
				  </select>
				  <span id ="panchayath_type_err" class="error"></span>
			  </div>
			  
			   <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('Grama Panchayath Type') }}</label>
              <select name="grama_panchayath_id" class="form-control grama_panchayath_id" id="grama_panchayath_id">
				  </select>
				  <span id ="grama_panchayath_id_err" class="error"></span>
			  </div>
			  
			  <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('Block Panchayath Type') }}</label>
               <select name="block_panchayath_id" class="form-control block_panchayath_id" id="block_panchayath_id">
				  </select>
				  <span id ="block_panchayath_id_err" class="error"></span>
			  </div>
			  
			  <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('Panchayath Id') }}</label>
               <select name="panchayath_id" class="form-control panchayath_id" id="panchayath_id">
				  </select>
				  <span id ="panchayath_id_err" class="error"></span>
			  </div>
			  
			  <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('District Panchayath Type') }}</label>
               <select name="district_panchayath_id" class="form-control district_panchayath_id" id="district_panchayath_id">
				  </select>
				  <span id ="district_panchayath_id_err" class="error"></span>
			  </div>
			  
			  <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('Muncipality Id') }}</label>
                <select name="muncipality_id" class="form-control muncipality_id" id="muncipality_id" >
				  </select>
				  <span id ="muncipality_id_err" class="error"></span>
			  </div>
			  
			  <div class="col-md-6 form-group">
              <label for="phone" class="mb-1">{{ __('Corporation Id') }}</label>
                <select name="corporation_id" class="form-control corporation_id"  id="corporation_id">
				  </select>
				  <span id ="corporation_id_err" class="error"></span>
			  </div>
			  
			  
			  
			  
			  
            {{ Form::hidden('id', null, array('class' => 'form-control' )) }}
            <div class="col-md-12 form-group text-right">
              <button type="reset" class="btn btn-outline-danger px-4">Reset</button>
              <button type="submit" class="btn btn-primary px-4"> {{ __('Save') }} </button>
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