@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} -  Edit Coupon
@endsection
@section('content')

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('plan')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Coupon codes')}}</h2>
        <div class="widget-content pt-3">  

	
				@if(isset($res))
					{!! Form::model($res, ['method' => 'POST', 'class' => 'form-common', 'url' => ['save_coupon']]) !!}
				@else
					{!! Form::open(array('url' => 'save_coupon', 'class' => 'form-common', 'method'=>'POST')) !!}
				@endif
				
				{{ csrf_field() }}
				<div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
				
						<div class="col-md-6 form-group">
						<label>{{__('Coupon Name')}}</label>
						{{ Form::text('coupon_name', null, array('class' => 'form-control','id' => 'coupon_name', 'required' => true)) }}
						<span id ="coupon_name_err" class="error"></span></div>
						
						
						<div class="col-md-6 form-group">	
						<label>{{__('Coupon Code')}}</label>
							{{ Form::text('coupon_code', null, array('class' => 'form-control','id' => 'coupon_code','required' => true)) }}
							<span id ="coupon_code_err" class="error"></span>							
						</div>
						
						<div class="col-md-6 form-group">	
						<label>{{__('Duration/month')}}</label>
							{{ Form::text('duration', null, array('class' => 'form-control','id' => 'duration','required' => true)) }}
							<span id ="duration_err" class="error"></span>
						</div>
						
						<div class="col-md-6 form-group">	
						<label>{{__('Disount')}}</label>
							{{ Form::text('discount', null, array('class' => 'form-control','id' => 'discount','required' => true)) }}	
							<span id ="discount_err" class="error"></span>
						</div>
						
						<div class="col-md-6 form-group">	
						<label>{{__('Percent/Rupee')}}</label>
						<select  name="disc_type" id="disc_type" class="form-control disc_type">
						<option value="0">Select</option>
						<option value="{{config('constant.DISC_IN_PERCENT')}}" @if(isset($res->disc_flag) && $res->disc_flag == config('constant.DISC_IN_PERCENT')) {{ 'selected' }} @endif>Percent</option>
						<option value="{{config('constant.DISC_IN_RUPEE')}}" @if(isset($res->disc_flag) &&$res->disc_flag == config('constant.DISC_IN_RUPEE')) {{ 'selected' }} @endif>Amount</option>
						</select>						
						</div>
					
						<div class="col-md-6 form-group">
						<label>{{__('Valid From')}}</label>
						   {{ Form::text('valid_from', null, array('class' => 'date_picker form-control','id' => 'valid_from','required' => true)) }}	
							<span id ="valid_from_err" class="error"></span>		
						</div>
						<div class="col-md-6 form-group">
						<label>{{__('Valid To')}}</label>
						   {{ Form::text('valid_to', null, array('class' => 'date_picker form-control','id' => 'valid_to','required' => true)) }}	
							<span id ="valid_to_err" class="error"></span>		
						</div>
			
				
						<div class="col-md-6 form-group">
						<label for="status" class="control-label mb-1">{{__('Status')}}</label>
						{{ Form::select('status', array(config('constant.ACTIVE')=> 'Active', config('constant.INACTIVE')=>'Inactive'), null, ['id' => 'status', 'class' => 'form-control']) }}		
						<span id ="status_err"></span>
						</div>
						
						@if(isset($plan_id))
						<input type="hidden" value="{{$plan_id}}" name="plan_id" id="plan_id" class="plan_id">
						@endif
						@if(isset($res->plan_id))
						<input type="hidden" value="{{$res->plan_id}}" name="plan_id" id="plan_id" class="plan_id">
						@endif
				
					{{ Form::hidden('id', null, array('class' => 'form-control' )) }}
				
				
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
@endsection
