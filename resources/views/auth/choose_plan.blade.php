@extends('layouts.outsidepage')
@section('title')
{{config('constant.site_title')}} - Company Registration
@endsection
@section('content')
<style type="text/css">
	body{
		background-image:url('{{url('/')}}/img/subscription-bg.jpg');}
	}
</style>
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-0"> <a class="navbar-brand" href="/"> <img width="125px" src="{{url('/')}}/img/logo-white.png" alt=""/> </a>
</nav>
			
<div class="container">
    	<div class="row subscription-plan">
    	  <div class="col-12 text-center">
    	  	<h2>{{__('Choose your plan')}}</h2>
    	  	<p>Plick a plan that best fits yours needs</p>
			<p class="response"></p>	
    	  </div>
    	</div>
    	 <div class="row subscription-plan plans-wrap">
    
				

				@if(count($plan_list)>0)
				@php $i = 1; @endphp
				@foreach ($plan_list as $plan)
				<div class="col-md-3 form-group text-center plans-list">
					<form action="" method="POST" class="form-common" name="form-common-pay">
					<input type="hidden" name="_token"  value="{{ csrf_token() }}">
						<div class="message"></div>
						
						<div class="card p-3">
							<div class="card-heading">
								<h3>{{ $plan->GetParentPlan->plan }}</h3>
								<h4>@if(isset($plan->GetParentPlan->discount)){{ $plan->GetParentPlan->discount }}&nbsp;%Off
							</div>
							<div class="card-body">
							
								<h6>{{ $plan->GetParentPlan->plan_des }}</h6>
								
								
								@endif</h4>As low as@php $amt='';$disc_amt='';@endphp
								@if(isset($plan->GetParentPlan->discount))
								@php
									$disc_amt = ($plan->GetParentPlan->discount / 100 * $plan->amount);
									$amt = ($plan->amount - $disc_amt);
								@endphp	
								@endif
								<input type="hidden" value="{{$disc_amt}}" name="disc_off_amt" class="disc_amt">
								@if(isset($amt))<h5>{{$amt}}&nbsp;&nbsp;Rs/Month
								</h5>@endif
								<h6>@if(isset($amt))<strike>@endif{{ $plan->amount }}&nbsp;&nbsp;Rs/Month
								@if(isset($amt))</strike>@endif</h6>
								<h6>@if(isset($plan->coupon_code))
								<input type="button" class="btn btn-success savemore" data-inc="{{$i}}" value="Get Coupon">
								<input type="text" name="coupon_code" id="coupon_code{{$i}}" class="coupon_code form-control col-md-6"  value="{{ $plan->coupon_code}}" readonly>
								<span class="success" id="apply_promo" class="coupon_code"></span>
								 </h6>@endif
								 
							<input type="hidden" name="promocode" id="promocode"  value="{{$plan->coupon_code}}">
							<input type="hidden" name="promo_discount" id="promo_discount"  value="{{$plan->discount}}">
							<input type="hidden" name="discount_off" id="discount_off"  value="{{$plan->GetParentPlan->discount}}">


							
							<input type="hidden" name="amount" id="amount"  value="{{$amt}}">
							<input type="hidden" name="plan" id="plan"  value="{{ $plan->GetParentPlan->plan}}">
							<input type="hidden" name="planid" id="planid"  value="{{ $plan->GetParentPlan->id}}">
							<a href="javascript:void(0)"  onclick="sub_pop_up({{$plan->amount}},{{ $plan->plan_id}},'{{ $plan->GetParentPlan->plan}}','{{ $plan->coupon_code}}','{{$plan->discount}}','{{$plan->GetParentPlan->discount}}','{{$disc_amt}}')" class="btn btn-primary">{{__('Subscribe')}}</a>
							</div>
						</div>
						@php $i=$i+1; @endphp
						</form>
				</div>
				@endforeach
				@endif
				
				
			

</div>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="order_detailsTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="order_detailsTitle">{{__('Your plan details')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="planContainer" id="planContainer" ></div>
      </div>
    </div>
  </div>
</div>


@endsection
















