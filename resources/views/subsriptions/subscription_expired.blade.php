@extends('layouts.outsidepage')
@section('title')
{{config('constant.site_title')}}
@endsection
@section('content')

<div class="container">
	<div class="row">
			<div class="col-md-12">
				<div class="card p-3">
					<div class="card-body">
						<h2 style="text-align:center;color:#d6242c;font-size:20px;">
						This portal is in Suspended state since the subscription has expired.
						You need another subscription to keep your product running!
						</h2>
					</div>
				</div>		
			</div>
	</div>	
	<h5 align="center">Please choose any of given plan to activate this. </h5>
    <div class="row">
        <div class="col-md-12">
		 <div class="panel panel-default">
            <div class="panel-heading"></div>
			<div class="panel-body">
				<p class="response"></p>	

				<div class="row">
				@if(count($plan_list)>0)
				@php $i = 1; @endphp
				@foreach ($plan_list as $plan)
				<div class="col-md-3 form-group">
					<form action="" method="POST" class="form-common" name="form-common-sbcr">
						<div class="message"></div>
						<input type="hidden" name="_token"  value="{{ csrf_token() }}">
						<div class="card p-3">
							<div class="card-body">
							<span id="message" class="message" name="message">@if(isset($message)){{$message}}@endif</span>
								<h6>{{ $plan->GetParentPlan->plan_des }}</h6>
								<h3>{{ $plan->GetParentPlan->plan }}</h3>
								<!--   {{--   
								<h4>@if(isset($plan->GetParentPlan->discount)){{ $plan->GetParentPlan->discount }}&nbsp;%Off
								@endif</h4>As low as --}} -->
								@php $amt=0;$disc_amt=0;@endphp
								@if(isset($plan->GetParentPlan
								->discount))
								<!--   {{--  @php
									$disc_amt = ($plan->GetParentPlan->discount / 100 * $plan->amount);
									$amt = ($plan->amount - $disc_amt);
								@endphp	--}} -->
								@endif
								<input type="hidden" value="{{$disc_amt}}" name="disc_off_amt" class="disc_amt">
								<!-- {{-- @if(isset($amt))<h5>{{$amt}}&nbsp;&nbsp;Rs/Month
								</h5>@endif--}} -->
								<h6>@if(isset($amt) && $amt !='0')<strike>@endif{{ $plan->amount }}&nbsp;&nbsp;Rs/Month
								@if(isset($amt) && $amt !='0')</strike>@endif</h6>
								
								
								<h6>@if(isset($plan->coupon_code))
								<input type="button" class="btn btn-success savemore" data-inc="{{$i}}" value="Get Coupon"></input>
								<input type="text" name="coupon_code" id="coupon_code{{$i}}" class="coupon_code btn"  value="{{ $plan->coupon_code}}" readonly>
								<span class="success" id="apply_promo" class="coupon_code"></span>
								 </h6>@endif
								 
							<input type="hidden" name="promocode" id="promocode"  value="{{$plan->coupon_code}}">
							<input type="hidden" name="promo_discount" id="promo_discount"  value="{{$plan->discount}}">
							<input type="hidden" name="discount_off" id="discount_off"  value="{{$plan->GetParentPlan->discount}}">
							<input type="hidden" name="amount" id="amount"  value="{{$amt}}">
							<input type="hidden" name="plan" id="plan"  value="{{ $plan->GetParentPlan->plan}}">
							<input type="hidden" name="planid" id="planid"  value="{{ $plan->GetParentPlan->id}}">
							<input type="hidden" class="form-control" id="valid_promo" name="valid_promo" value="">
							
							<a href="javascript:void(0)" onclick="new_subscription({{$plan->amount}},{{ $plan->plan_id}},'{{ $plan->GetParentPlan->plan}}',{{$cmp_id}},'{{ $plan->coupon_code}}','{{$plan->discount}}','{{$plan->GetParentPlan->discount}}','{{$disc_amt}}','{{$first_sub_flag}}')" class="btn btn-primary">{{__('Subscribe')}}</a>
							
							</div>
						</div>
						@php $i=$i+1; @endphp
						</form>
				</div>
				@endforeach
				@endif
				<input type="hidden" name="cmp_id" id="cmp_id"  value="{{$cmp_id}}">
				
			</div>	
		</div>
	</div>
</div>	
</div>
<!-- Model popup Starts -->
<div class="modal" id="order_details"  role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{__('Your plan details')}}</h4>
      </div>
      <div class="modal-body"><div class="planContainer" id="planContainer" ></div></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    
  </div>
</div>
</div>
<!-- Model popup Ends   -->
@endsection