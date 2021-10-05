	@extends('layouts.login')
	@section('title')
	{{config('constant.site_title')}} - Company Registration
	@endsection
	@section('content')
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-0"> <a class="navbar-brand" href="/"> <img width="125px" src="{{url('/')}}/img/logo-white.png" alt=""/> </a>
</nav>
	
	<div class="container">
		<div class="row mt-5 justify-content-md-center">
			<div class="col-md-9 mt-5">
			<input type="hidden" name="util_class" id="util_class" value="{{ asset('tel/utils.js') }}">
			<input type="hidden" name="flag" id="flag"  value="0">
			
			<div class="panel panel-default"">
					<div class="panel-heading"><h3>{{__('Company Registration')}}</h3>
					</div>
					<div class="panel-body">
					
					<p class="response"></p>	
			@if(isset($company))
				{!! Form::model($company, ['method' => 'POST', 'class' => 'form-common', 'route' => 'registration.store']) !!}
        	@else
				{!! Form::open(array('route' => 'registration.store', 'class' => 'form-common frmcoutycode','name' => 'form-register','id' => 'form-register', 'method'=>'POST')) !!}
		    @endif
	
				{{ csrf_field() }}
				<div class="message" id="msg"></div>
				<input type="hidden" class="coupon_code form-control" id="coupon_code" name="coupon_code" value="{{$coupon_code}}">	
				<input type="hidden" value="{{$discount_amount}}" name="disc_amt" id="disc_amt">
				<input type="hidden" class="form-control" id="off_amt" name="off_amt" value="{{$disc_off_amt}}">	
				<input type="hidden" value="{{$discount_off}}" name="discount_off" id="discount_off">

				<input type="hidden" id="country_code" class="country_code" name="country_code" value="">
				<div class="row">
				<div class="col-md-6 form-group">
					<label for="name" class="control-label">{{__('Company Name')}}</label>						
							{{ Form::text('name', null, array('class' => 'form-control','id' => 'name')) }}	
							<span class="error" id="name_err"></span>
				</div>
				<div class="col-md-6 form-group">
					<label for="email" class="control-label">{{__('Email')}}</label>						
							{{ Form::email('email', null, array('class' => 'form-control','id' => 'email')) }}	
							<span class="error" id="email_err"></span>
				</div>
				
				
				
				
				
				
				<div class="col-md-6 form-group">
					<label for="phone" class="control-label">{{__('Office No')}}</label>						
							{{ Form::text('phone', null, array('class' => 'form-control','id' => 'phone','maxlength'=>'15')) }}	
							<span class="error" id="phone_err"></span>
				</div>
				<div class="col-md-6 form-group">
					<label for="mobile" class="control-label">{{__('Mobile No')}}</label>		<input type="tel" name="mobile" maxlength="15" value="" id="mobile" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="            ">
				
								
							<span class="error" id="mobile_err"></span>
				</div>
				<div class="col-md-12 form-group">
					<label for="address" class="control-label">{{__('Address')}}</label>						
							{{ Form::textarea('address', null, array('class' => 'form-control','id' => 'address', 'rows' => '3')) }}	
							<span class="error" id="address_err"></span>	
				</div>
				
				<div class="col-md-6 form-group">
					<label for="city" class="control-label">{{__('City')}}</label>						
							{{ Form::text('city', null, array('class' => 'form-control','id' => 'city')) }}	
							<span class="error" id="city_err"></span>
				</div>
				<div class="col-md-6 form-group">
					<label for="state" class="control-label">{{__('State')}}</label>						
							{{ Form::text('state', null, array('class' => 'form-control','id' => 'state')) }}	
							<span class="error" id="state_err"></span>
				</div>
				<div class="col-md-4 form-group">
					<label for="pincode" class="control-label">{{__('PIN code')}}</label>						
							{{ Form::text('pincode', null, array('class' => 'form-control','id' => 'pincode')) }}	
							<span class="error" id="pincode_err"></span>
				</div>
				<div class="col-md-4 form-group">
					<label for="country" class="control-label">{{__('Country')}}</label>						
							{{ Form::text('country', null, array('class' => 'form-control','id' => 'country')) }}	
							<span class="error" id="country_err"></span>
				</div>
				
				
				<div class="col-sm-4 form-group">
					<label for="username" class="control-label">{{ __('User Name') }}</label>
						{{ Form::text('username', null, array('class' => 'form-control','id' => 'username')) }}	
				        	<span id ="username_err"></span>
							
                </div>
				
                <div class="col-sm-6 form-group">
					<label for="password" class="control-label">{{ __('Password') }}</label>
						<input id="password" type="password" class="cmp_pswd form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autocomplete="off">
						 <span class="mr-2 fa fa-fw fa-eye field-icon toggle-password">
						 </span>
						<span id ="password_err"></span>
                </div>

                <div class="col-sm-6 form-group">
                            <label for="password-confirm" class="control-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="cmp_confrm_pswd form-control" name="password_confirmation" autocomplete="off">
								<span class="mr-2 fa fa-fw fa-eye field-icon toggle-confrm_password">
						 </span>
                </div>
				
				</div>
				<input type="hidden" name="package_type" id="package_type"  value="{{$planid}}" class="package_type">
				<input type="hidden" name="callback" id="" value="form_basic_redirect" class="callback">
				<input type="hidden" name="callback" id="" value="{{url('/checkout')}}" class="callback-path">
				<input type="hidden" name="term_length" id="term_length" value="{{$mnths}}" >
				<input type="hidden" name="valid_promo" id="valid_promo" value="{{$valid_promo}}">
				<input type="hidden" name="amt" id="amt" value="{{$amount}}">
				

				{{ Form::hidden('id', null, array('class' => 'form-control' )) }}
                       <div class="form-group">
                            <div class="col-md-12 text-center mt-3 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" class="register" id="register">

                                    {{__('Save')}}
                                </button>
                                 <button type="reset" class="btn btn-danger" >
                                     {{__('Reset')}}
                                 </button>
								 
                            </div>
                        </div>
						
					{!! Form::close() !!}
				
					
                </div>
            </div>
			
      </div>
    </div>
</div>
@endsection