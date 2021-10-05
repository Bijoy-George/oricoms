@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}}
@endsection
@section('content')
<aside class="sidebar">
  <div class="search-box">
    <form name="form-common" action="{{url('/search_sms_reports')}}" method="post" class="listing form-common">
      <input type="hidden" name="_token" class="search-token" value="{{ csrf_token() }}">
      <div class="row align-items-center justify-content-center">
        <div class="col form-group">
          <input type="text" class="form-control"  placeholder="Keyword" id="search_keywords" name="search_keywords">  
        </div>
         <div class="col form-group">
          {{ Form::text('startdate', null, array('id' => 'startdate','class' => 'date_picker form-control','placeholder' => 'Start date','autocomplete' => 'off')) }}
        </div>
      <div class="col form-group">
            {{ Form::text('enddate', null, array('id' => 'enddate','class' => 'date_picker form-control','placeholder' => 'End date','autocomplete' => 'off')) }}
      </div>
      <!--   <div class="col form-group">
                <select class="form-control text-capitalize" id="source_type" name="source_type">
                 <option value="">Source Type</option>
        @foreach($cus_lead_source as $type)
        <option value="{{$type->id}}" >{{$type->name}}</option>
        @endforeach
                </select>
        </div> -->
         <div class="col form-group">
        <select class="form-control" id="sms-type" name="sms-type" onchange="">
        <option value="">SMS Type</option>
    <option value="1">OTP</option>
        <option value="2">Transaction</option>
        <option value="3">Promotional</option>
        <option value="6">Resend</option>
        </select>
      </div>
        <div class="col form-group">
          <?php $email_delivery_status_list = config('constant.SMS_DELIVERY_STATUS'); ?>
              <select class="form-control text-capitalize" id="msg_status" name="msg_status">
                 <option value="">Delivery Status</option>
        @foreach($email_delivery_status_list as $key => $val)
        <option value="{{$val}}" >{{config('constant.SMS_DELIVERY_STATUS_REV')[$val] ?? ''}}</option>
      @endforeach
                </select>
        </div>
        <!-- <div class="col-sm-2 mb-2 mb-sm-0">
              <select class="form-control text-capitalize" id="sms_gateway" name="sms_gateway">
                <option value="">Gate Way</option>
            <option value="{{Config::get('constant.SMS_CHANNEL_GENERAL')}}" >Value First</option>
            <option value="{{Config::get('constant.SMS_CHANNEL_ELIT')}}" >Elit-UAE</option>
            <option value="{{Config::get('constant.SMS_CHANNEL_ELIT_OMAN')}}" >Elit-Oman</option>
            <option value="{{Config::get('constant.SMS_CHANNEL_ELIT_KUWAIT')}}" >Elit-Kuwait</option>
            <option value="{{Config::get('constant.SMS_CHANNEL_ELIT_SAUDI')}}" >Elit-Saudi</option>
            <option value="{{Config::get('constant.SMS_CHANNEL_ELIT_BAHARAIN')}}" >Elit-Baharain</option>
            <option value="{{Config::get('constant.SMS_CHANNEL_ELIT_QATAR')}}" >Elit-Qatar</option>
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
      <h2 class="m-0">Sms Reports <span id="totalcount"></span></h2>
      <small>List Sms Reports</small> </div>
   
  </header>
  <div class="panel-body no_data" id="no_data"></div>
  <div id="list"></div>
</div>
@endsection 



