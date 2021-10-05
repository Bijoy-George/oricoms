@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}}
@endsection
@section('content')
<aside class="sidebar">
  <div class="search-box">
    <form name="form-common" action="{{url('/search_email_reports')}}" method="post" class="listing form-common" name="form-common">
      <input type="hidden" name="_token" class="search-token" value="{{ csrf_token() }}">
      <div class="row align-items-center justify-content-center">
        <div class="col-sm-2 mb-2 mb-sm-0">
          <input type="text" class="form-control"  placeholder="Keyword" id="search_keywords" name="search_keywords">  
        </div>
       <div class="col-sm mb-2 mb-sm-0">
          {{ Form::text('startdate', null, array('id' => 'startdate','class' => 'date_picker form-control','placeholder' => 'Start date','autocomplete' => 'off')) }}
      </div>
      <div class="col-sm mb-2 mb-sm-0">
            {{ Form::text('enddate', null, array('id' => 'enddate','class' => 'date_picker form-control','placeholder' => 'End date','autocomplete' => 'off')) }}
      </div>
      <!--   <div class="col-sm-2 mb-2 mb-sm-0">
                <select class="form-control text-capitalize" id="source_type" name="source_type">
                 <option value="">Source Type</option>
				@foreach($cus_lead_source as $type)
				<option value="{{$type->id}}" >{{$type->name}}</option>
				@endforeach
                </select>
        </div> -->
        <div class="col-sm-2 mb-2 mb-sm-0">
        	<?php $email_delivery_status_list = config('constant.EMAIL_DELIVERY_STATUS'); ?>

              <select class="form-control text-capitalize" id="email_status" name="email_status">
                 <option value="">Delivery Status</option>
				@foreach($email_delivery_status_list as $key => $val)
				<option value="{{$val}}" >{{ config('constant.EMAIL_DELIVERY_STATUS_REV')[$val]}}</option>
			@endforeach
                </select>
        </div>
      <!--   <div class="col-sm-2 mb-2 mb-sm-0">
              <select class="form-control text-capitalize" id="email_gateway" name="email_gateway">
                <option value="">Gate Way</option>
                <option value="" >Sendgrid</option>
                </select>
        </div> -->
        <div class="col-sm-1 mb-2 mb-sm-0">
          <input type="hidden" name="pageno" id="pageno" value="1">
          <button type="submit" class="reset-pageno btn btn-primary btn-block" id="">Find </button>
        </div>
        <div class="col-sm-1">
          <button type="reset" class="btn btn-outline-danger btn-block" id="s2" onclick="document.location.reload()">Reset</button>
          <input type="hidden" name="customerid" id="customerid" value="{{$customerid}}">
    <div class="clearfix"></div>
        </div>
      </div>
    </form>
  </div>
</aside>
<div class="content-area">
  <header class="row align-items-center text-center">
    <div class="col-sm-5 text-sm-left mb-3 mb-sm-0">
      <h2 class="m-0">Email Reports <span id="totalcount"></span></h2>
      <small>List Email Reports</small> </div>
   
  </header>
  <div class="panel-body no_data" id="no_data"></div>
  <div id="list"></div>
</div>
@endsection 






