
<div class=" subscription-plan text-center">
<div class="card p-3">
	@if(isset($cmp_id) && isset($first_sub_flag) && ($first_sub_flag != 1))
		<form action="{{url('upgraded_subscription')}}" method="POST" name="checkout-frm">
		@else
		<form action="{{url('add_to_cart')}}" method="POST" name="checkout-frm">
		@endif
		<input type="hidden" name="_token"  value="{{ csrf_token() }}">
		<div class="message"></div>


	<div class="card-heading">
		<h3>{{$plan}}</h3>
		<h4>{{$amount}} Rs/Month<input type="hidden" value="{{$amount}}" name="amt" id="amt"/></h4>
	</div>
	<div class="card-body">
		<input type="hidden" class="form-control coupon_code" id="coupon_code" name="coupon_code" value="{{$coupon_code}}">	
		<input type="hidden" class="form-control plan" id="plan" name="plan" value="{{$plan}}">	
		<input type="hidden" value="{{$discount_amount}}" name="disc_amt" id="disc_amt" class="disc_amt">
		<input type="hidden" class="form-control" id="off_amt" name="off_amt" value="{{$disc_off_amt}}">	
		<input type="hidden" value="{{$discount_off}}" name="discount_off" id="discount_off">
		<input type="hidden" id="country_code" class="country_code" name="country_code" value="">
	@php $term_length=config('constant.TERM_LENGTH');@endphp

	<div class="form-group">
	<h6>Choose term length</h6>
	@foreach($term_length as $key => $val)
	<div class="checkbox-wrapper">
	<input type="radio" value="{{$key}}" class="term_length" name="term_length">
	<span></span>
	{{$val}}
	</div>
	@endforeach
	<span id="term_length_err" class="error" ></span>
	<span id="message" class="message" name="message">@if(isset($message)){{$message}}@endif</span>
				
	@if(isset($amount))
	<input type="hidden" class="form-control" id="amt" name="amt" value="{{$amount}}">	
	<input type="hidden" class="form-control valid_promo" id="valid_promo" name="valid_promo" value="0">	
	@endif
	</div>
	<div class="col-sm-12 form-group">
	@if(isset($coupon_code))
	<div class="col-sm-12 form-group">
	{{ __('Coupon Code') }}
	<input type="text" class="form-control promocode" id="promocode" name="promocode">	
	<span class="error promocode_err" id="promocode_err" style="color:red;"></span><input type="button" class="btn btn-success col-sm-12 submit-promo" id="submit-promo" value="Apply" style="display:none;">
	</div>
	@endif
	</div>

		
		<h5 style="border: 1px solid #dedede;padding: 24px 0;">{{__('Amount to Pay')}} <span id="tot_amt" value=""> 0</span>.00 Rs
			
						<span class="success promo_success" id="promo_success" style="color:green;"></span>
		</h5>	




		<h6>@if(isset($disc_off_amt) && ($disc_off_amt != 0))Saved {{$disc_off_amt}} on discount @endif
		<input type="hidden" value="{{$planid}}" name="id_plan" id="id_plan" class="id_plan"/>
		<input type="hidden" value="@if(isset($cmp_id)){{$cmp_id}} @endif" name="cmp_id" id="cmp_id" class="cmp_id"/></h6>
	<button type="submit" class="btn btn-primary" id="checkout">{{__('CheckOut')}}</button>
	</div>
</div>

</div>




