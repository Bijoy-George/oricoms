@extends('layouts.profile')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}}  - Escalation  Report
@endsection
@section('content')
<aside class="sidebar">
  <div class="search-box">
    <form action="{{url('/escalation_view_reports')}}" method="POST" class="listing form-common" name="form-common" id ="esc_con">
      <div class="row align-items-center">
        <div class="col-1">
          <h2 class="m-0">{{__('Search')}}</h2>
        </div>
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
        <div class="col form-group">
          <input type="text" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords" >
        </div>
        <div class="col form-group"> {{ Form::select('query_types', $query_types, null, ['id' => 'query_types', 'class' => 'get_query_cat get_query_status form-control']) }} </div>
		<div class="col form-group"> {{ Form::select('query_category', ['' => 'Select'], null, ['class' => 'faq_cat_id form-control', 'id' => 'query_category']) }} </div>
        <div class="col form-group"> {{ Form::select('query_status', ['' => 'Select'], null, ['class' => 'query_status form-control', 'id' => 'query_status']) }} </div>
		
        <div class="col form-group"> {{ Form::select('from_agent_id',$agent_list, null, ['class' => 'form-control', 'id' => 'from_agent_id']) }} </div>
        <div class="col form-group"> {{ Form::select('to_agent_id',$agent_list, null, ['class' => 'form-control', 'id' => 'to_agent_id']) }} </div>
       
		<div class="col form-group">
          <input name="startdate" id="startdate"  type="text" placeholder="Start date" class="date_picker form-control" autocomplete="off">
        </div>
        <div class="col form-group">
          <input name="enddate" id="enddate"  type="text" placeholder="End date" class="date_picker form-control" autocomplete="off">
        </div>
        
        <div class="col-1 form-group">
          <input type="hidden" name="pageno" id="pageno" value="1">
		  <input type="hidden" name="query_status_hide_val" id="query_status_hide_val" value="">
          <button type="submit " class="btn btn-primary btn-block" id="">{{__('Find')}}</button>
        </div>
        <div class="col-1 form-group">
          <button  class="btn btn-outline-danger btn-block" id="s2" onclick="ressetListForm_withCountBox(this);">{{__('Reset')}}</button>
        </div>
      </div>
    </form>
  </div>
</aside>
<div class="content-area">
<header class="row align-items-center">
    <div class="col-sm-6">
    	<h2 class="m-0 text-center text-sm-left">{{__('Escalation  Report ')}}<span id="totalcount"></span></h2>
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
    </div>
    <div class="col-sm-6 text-center text-sm-right"><a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a></div>
</header>
    <div class="message"></div>
    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
</div>

@endsection 
