@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add customer nature
@endsection
@section('content')

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('company')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Company Details')}}</h2>
        <div class="widget-content pt-3">  

        @if(isset($res))
				  {!! Form::model($res, ['method' => 'POST', 'name' => 'frm-plan-discount', 'class' => 'form-common form-offer', 'route' => ['company.store']]) !!}
				  @else
				  {!! Form::open(array('route' => 'company.store', 'class' => 'form-common form-offer', 'method'=>'POST')) !!}
				@endif

        {{ csrf_field() }}
        <div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
            
			<div class="col-md-6 form-group">
				<label for="name" class="control-label">{{__('Company Name')}}</label>						
					{{ Form::text('ori_cmp_org_name', null, array('class' => 'form-control','id' => 'ori_cmp_org_name', 'required' => true)) }}	
					<span class="error" id="name_err"></span>
			</div>
			<div class="col-md-6 form-group">
				<label for="email" class="control-label">{{__('Email')}}</label>						
					{{ Form::email('ori_cmp_org_email', null, array('class' => 'form-control','id' => 'ori_cmp_org_email')) }}	
					<span class="error" id="email_err"></span>
			</div>
							<div class="col-md-6 form-group">
					<label for="phone" class="control-label">{{__('Office No')}}</label>						
							{{ Form::text('ori_cmp_org_phone', null, array('class' => 'form-control','id' => 'phone','maxlength'=>'15')) }}	
							<span class="error" id="phone_err"></span>
				</div>
				<div class="col-md-12 form-group">
					<label for="address" class="control-label">{{__('Address')}}</label>						
							{{ Form::textarea('ori_cmp_org_address', null, array('class' => 'form-control','id' => 'ori_cmp_org_address', 'rows' => '3')) }}	
							<span class="error" id="address_err"></span>	
				</div>
				
				<div class="col-md-6 form-group">
					<label for="city" class="control-label">{{__('City')}}</label>						
							{{ Form::text('ori_cmp_org_city', null, array('class' => 'form-control','id' => 'ori_cmp_org_city')) }}	
							<span class="error" id="city_err"></span>
				</div>
				<div class="col-md-6 form-group">
					<label for="state" class="control-label">{{__('State')}}</label>						
							{{ Form::text('ori_cmp_org_state', null, array('class' => 'form-control','id' => 'ori_cmp_org_state')) }}	
							<span class="error" id="state_err"></span>
				</div>
				<div class="col-md-4 form-group">
					<label for="pincode" class="control-label">{{__('PIN code')}}</label>						
							{{ Form::text('ori_cmp_org_pincode', null, array('class' => 'form-control','id' => 'ori_cmp_org_pincode')) }}	
							<span class="error" id="pincode_err"></span>
				</div>
				<div class="col-md-4 form-group">
					<label for="country" class="control-label">{{__('Country')}}</label>						
							{{ Form::text('ori_cmp_org_country', null, array('class' => 'form-control','id' => 'ori_cmp_org_country')) }}	
							<span class="error" id="country_err"></span>
				</div>
				@if(isset($res))
				<div class="col-sm-4 form-group">
					<label for="act" class="control-label">{{__('Plan')}}<span class="red_star">*</span></label>
					{{ Form::select('ori_cmp_org_plan',$plans,$res->plan, ['class' => 'escalate_to form-control', 'id' => "ori_cmp_org_plan"]) }}
				 	<span class="error" id="ori_cmp_org_plan_err"></span>
				</div>
				@else
				<div class="col-sm-4 form-group">
					<label for="act" class="control-label">{{__('Plan')}}<span class="red_star">*</span></label>
					{{ Form::select('ori_cmp_org_plan',$plans,null,['class' => 'escalate_to form-control', 'id' => "ori_cmp_org_plan"]) }}
				 	<span class="error" id="ori_cmp_org_plan_err"></span>
				</div>
			    @endif

        <div class="col-md-12 form-group text-right">
          <button type="reset" class="btn btn-outline-danger px-4" > {{__('Reset')}} </button>
          <button type="submit" class="btn btn-primary px-4"> {{__('Save')}} </button>
        </div>
          </div>
          {!! Form::close() !!}
          
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
