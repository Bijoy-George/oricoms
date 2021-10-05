@extends('layouts.profile')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Profile
@endsection
@section('content') 
<!--<form class="get-profile" role="form" method="POST" action="{{ url('view_profile') }}" autocomplete="off">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" id="get_profile_det" class="btn btn-primary" value="SAVE" >
</form>-->
<input type="hidden" name="doc_no_id" class="doc_no_id" value="{{$doc_no}}">
<input type="hidden" name="_token" class="_token" value="{{ csrf_token() }}">
<input type="hidden" name="get_profile" id="get_profile" value="{{ url('view_profile') }}">
<input type="hidden" name="util_class" id="util_class" value="{{ asset('tel/utils.js') }}">
<input type="hidden" name="util_class" id="pro_status" value="@if(!empty($profile_status)){{ $profile_status }}@endif">
<aside class="sidebar">
  <div class="search-box">
    <form class="form-search" role="form" method="POST" action="{{ url('search_profile') }}" autocomplete="off">
      <input type="hidden" name="_token" class="search-token" value="{{ csrf_token() }}">
      <div class="row align-items-center justify-content-center">
        <div class="col-sm-1 text-center text-sm-left">
          <h2 class="m-0">Search</h2>
        </div>
        <div class="col-sm-4 mb-2 mb-sm-0">
          <input type="text" class="form-control"  placeholder="Keyword" id="search_keywords" name="search_keywords" value="{{$emailid ?? $emailid}}">
          <input type="hidden" class="form-control" value ="<?php if(isset($request_mob) && !empty($request_mob)){ echo $request_mob;} ?>" placeholder="Phone Number" id="phone" name="phone">
        </div>
        <div class="col-sm-1 mb-2 mb-sm-0">
          <button type="submit" class="btn btn-primary btn-block" id="s1" >Find</button>
        </div>
        <div class="col-sm-1">
          <button type="submit" class="btn btn-outline-danger btn-block" id="r1" onclick="resetResult();">Reset</button>
        </div>
      </div>
    </form>
  </div>
</aside>
<div class="container-fluid"><div class="widget mb-0 mt-3 p-3 no_data text-center" style="display:none" id="no_data"></div>
<div class="widget m-0 search-results mt-3">
  <table width="100%" id="user_list" class="table table-striped m-0">
    <thead>
      <tr> @foreach($deflt_fields as $fields)
        <th scope="col">{{ $fields->label ?? '' }}</th>
        @endforeach
        <th scope="col" width="50">Copy</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
<input  type="hidden" id="request_mob" name="request_mob" value="{{ $request_mob ?? '' }}">
<input type="hidden" name="profile_id" id="profile_id" value="{{ $profile_id ?? '' }}">
<input  type="hidden" id="country_cd" name="country_cd" value="">
<input type="hidden" name="p_survey_id" id="p_survey_id" value="{{ $p_survey_id ?? '' }}">
<input type="hidden" name="query_type_id" id="query_type_id" value="{{ $query_type_id ?? '' }}">
</div>
<div class="container-fluid content-area profile">
  <div id="msg" class="alert" role="alert"></div>
  <div class="row">
    <div class="col-sm-6 profile-center">
      <div class="row">
        <div id="profile_header" class="col-sm-12"></div>
        <div class="col-sm-12">
          <div id="copy_user"></div>
          <div id="enquiry_form_con" class="leads"></div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 profile-right pl-sm-0">
      <div id="helpdesk_listing"></div>
      <div id="followup_listing"></div>
      <div id="chathistory_listing"></div>
      <div id="survey_listing"></div>
      <div id="email_sms_listing"></div>
      <div id="officer_email_sms_listing"></div>
    </div>
    <div class="col-sm-6"> </div>
  </div>
</div>
<script src="{{ asset('js/tiny_mce/tiny_mce.js') }}"></script> 
@endsection 