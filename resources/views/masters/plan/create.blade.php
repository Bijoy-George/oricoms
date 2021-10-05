@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add Plan
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('plan')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
			
                <h2>{{__('Plan & Coupon')}}</h2>
				<h2>{{__('Manage plan')}} &amp; {{__('discount coupons detials')}}</h2> 
                <div class="widget-content pt-3"> 	
	
				@if(isset($res))
				  {!! Form::model($res, ['method' => 'POST', 'name' => 'frm-plan-discount', 'class' => 'form-common form-offer', 'route' => ['plan.store']]) !!}
				  @else
				  {!! Form::open(array('route' => 'plan.store', 'class' => 'form-common form-offer', 'method'=>'POST')) !!}
				@endif
				
				{{ csrf_field() }}
				<div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
					
				
				<div class="col-md-6 form-group">
				{{ Form::label('plan', 'Plan Name') }}
						{{ Form::text('plan', null, array('class' => 'form-control','id' => 'plan')) }}	
				<span id ="plan_err" class="error"></span>						
				</div>
				
				<div class="col-md-6 form-group">
				{{ Form::label('discount', 'Discount on first subscription(in percent)') }}
						{{ Form::text('discount', null, array('class' => 'form-control','id' => 'discount')) }}	
				<span id ="discount_err" class="error"></span>						
				</div>
				
				
				
				<div class="col-md-12 form-group">
				{{ Form::label('plan_des', 'Plan Description') }}
						{{ Form::textarea('plan_des', null, array('class' => 'form-control','id' => 'plan_des','required' => true,'rows'=>'5')) }} 
				<span id ="plan_des_err" class="error"></span>						
				</div>
				
				<div class="col-md-6 form-group">
				<label for="sort_order" class="control-label mb-1">{{__('Sort Order')}}</label>
					@if(isset($cust_nature)) 	
					{{ Form::number('sort_order', null, array('class' => 'form-control' ,'id' => 'sort_order','max' =>'99','min' =>'0')) }}
						@else
					{{ Form::number('sort_order', 0, array('class' => 'form-control' ,'id' => 'sort_order','max' =>'99','min' =>'0')) }}	
					@endif
				<span id ="sort_order_err"></span>						
				</div>
					
						
				<div class="col-md-6 form-group">
				<label for="status" class="control-label mb-1">{{__('Status')}}</label>
					{{ Form::select('status', array(config('constant.ACTIVE')=> 'Active', config('constant.INACTIVE')=>'Inactive'), null, ['id' => 'status', 'class' => 'form-control']) }}		
					<span id ="status_err"></span>
				</div>
				
				
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
		<div class="col-md-7">
      <div class="widget">
        <h2>{{__('Coupons')}}</h2>
        <div class="widget-content pt-0 px-0">
          <form action="{{url('addpromo')}}" method="POST" name="frm-coupon" id="frm-coupon" class="">
            @if(isset($res['id']))
            <input type="hidden" value="{{$res['id']}}" name="plan_id" id="plan_id" class="plan_id">
            @else
            <input type="hidden" name="plan_id" id="plan_id" class="plan_id">
            @endif
            <input type="hidden" name="_token"  value="{{ csrf_token() }}">
            <div class="coupon_details"></div>
            <div class="col-md-12 text-right p-3">
              <button type="submit" class="btn btn-primary"> {{__('Add Coupon')}} </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>
</div>

<!-- Model popup Starts -->
<div class="modal" id="coupon_info"  role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="offerContainer" id="offerContainer" ></div>
      </div>
    </div>
  </div>
</div>
<!-- Model popup Ends   --> 
@endsection

