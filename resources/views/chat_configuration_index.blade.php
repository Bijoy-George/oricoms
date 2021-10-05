@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Plans
@endsection
@section('content')
<aside class="sidebar">
 <div class="row justify-content-center">
    <div class="col-sm-7 mt-3">
	  <div class="widget">
        <h2 class="text-center">{{__('Chat Configuration')}}</h2>
        <div style="padding: 15px;" class="widget-content">
			<span>Please download the package by clicking on the link given below:</span><br>
			<a href="{{asset('chatwidgetPackage.zip')}}">Download Package</a><br>
			<span>Kindly generate a unique key. Please ignore if already created.<br>
			Place the generated key mentioned in the screenshot in the below line of code of liv_live_chat.js file available in the downloaded package .
			</span>
			<div style="width:500px;height:250px;">
			<img src="{{asset('img/chat_configuration_screenshot.png')}}" alt="screenshot" style="width:100%;height:100%;">
			</div>
        </div>
      </div>
	</div>
      </div>
</aside>
<form action="{{url('/search_leadsource_chat')}}" method="POST" class="listing form-common" name="form-common">
  <aside class="sidebar">
  <div class="search-box">
    <div class="row align-items-center justify-content-center">
      <input type="hidden" name="_token"  value="{{ csrf_token() }}">
      <div class="col-sm-1">
        <h2 class="m-0">Search</h2>
      </div>
      <div class="col-sm-3 form-group">
        <input type="text" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords">
      </div>
      <div class="col-sm-1 form-group">
        <input type="hidden" name="pageno" id="pageno" value="1">
        <button type="submit " class="btn btn-primary btn-block" id="">{{__('Find ')}}</button>
      </div>
      <div class="col-sm-1 form-group">
        <button  class="btn btn-outline-danger btn-block" id="s2" onclick="ressetListForm(this);">{{__('Reset ')}}</button>
      </div>
    </div>
    </aside>
    <div class="content-area">
      <header class="row align-items-center">
        <div class="col-sm-5">
          <h2 class="m-0">{{__('Lead Sources')}} <span id="totalcount"></span></h2>
				  <small>Available Lead Sources</small> </div>
				<div class="col-sm-7 text-right"><a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}" alt=""></a><a href="{{url('/lead_sources/'.$leadSourceTypeId.'/create')}}" class="btn btn-success ml-2"><img src="{{ asset('img/ic_add.svg') }}"  alt=""/> Add New Lead Sources</a>
				</div>
			  </header>
      <div class="panel-body no_data" id="no_data"></div>
      <div id="list"></div>
    </div>
  </div>
</form>
@endsection 