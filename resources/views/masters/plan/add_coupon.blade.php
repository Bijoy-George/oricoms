@extends('layouts.listpage')
<div class="widget">
	<div class="row">
		<div class="col-sm-12">
		<h4></h4>
		</div>
		<form action="{{url('save_coupon')}}" method="POST" name="frm-coupon" id="frm-coupon" class="form-common">
		<input type="hidden" name="_token"  value="{{ csrf_token() }}">
		<div class="message"></div>
		
			<div class="card p-3">
			<div class="card-body">
			<div class="col-sm-12"> 
			<h4 align="center">Add Coupon</h4>
			<div class="row">
			<div class="col-md-6 form-group">
				<input type="hidden" value="{{$plan}}" name="plan_id" id="plan_id" class="plan_id"/>
				<label>{{__('Coupon Name')}}</label>
				<input type="text" name="coupon_name" id="coupon_name" class="form-control coupon_name"/>
				<span id ="coupon_name_err" class="error"></span>	
				</div>	
				
				<div class="col-md-6 form-group">
				<label>{{__('Coupon Code')}}</label>
				<input type="text" name="coupon_code" id="coupon_code" class="form-control"/>
				<span id ="coupon_code_err" class="error"></span>
				</div>	
			</div>
			<div class="row">
				<div class="col-md-6 form-group">
				<label>{{__('Disount')}}</label>
				<input type="text" name="discount" id="discount" class="form-control discount"/>
				<span id ="discount_err" class="error"></span>
				</div>	
				<div class="col-md-6 form-group">
				<label>{{__('Percent/Rupee')}}</label>
				<select  name="disc_type" id="disc_type" class="form-control disc_type">
				<option value="0">Select</option>
				<option value="{{config('constant.DISC_IN_PERCENT')}}">Percent</option>
				<option value="{{config('constant.DISC_IN_RUPEE')}}">Amount</option>
				</select>
				</div>	
			</div>
			<div class="row">
				<div class="col-md-12 form-group">
				<label>{{__('Duration')}}</label>
				<input type="text" name="duration" id="duration" class="form-control duration"/>
				<span id ="duration_err" class="error"></span>
				</div>	
			</div>
			<div class="row">
				<div class="col-md-12 form-group">
				<label>{{__('Valid From')}}</label>
				<input class="date_picker form-control hasDatepicker" id="valid_from" name="valid_from" type="text" placeholder="valid from">
				<span id ="valid_from_err" class="error"></span>
				</div>	
			</div>
			<div class="row">
				<div class="col-md-12 form-group">
				<label>{{__('Valid To')}}</label>
				<input type="text" name="valid_to" id="valid_to" placeholder="valid to" class="date_picker form-control" autocomplete="off">
				<span id ="valid_to_err" class="error"></span>
				</div>	
			</div>
			<div class="row">
			<div class="col-md-12 form-group">
				<label for="status" class="col-md-6 control-label">{{__('Status')}}</label>
				<select  name="status" id="status" class="form-control status">
				<option value="{{config('constant.ACTIVE')}}">Active</option>
				<option value="{{config('constant.INACTIVE')}}">Inactive</option>
				</select>
					
					<span id ="status_err"></span>							
				</div>
			</div>
		</div>
		</div>
		</div>
			
			<div class="col-md-8 col-md-offset-4 form-group">
					<button type="submit" class="btn btn-primary">
                                    {{__('Save')}}
                                </button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
		</form>
	</div>
</div>
