@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Followups
@endsection
@section('content')
<aside class="sidebar">
  <div class="search-box">
    <form action="{{url('/followup_search')}}" method="POST" class="listing form-common" name="form-common" id ="help_desk_con">
      <div class="row align-items-center">
        <div class="col-md-1">
          <h2 class="m-0">{{__('Search')}}</h2>
        </div>
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
		
		<input name="todayfollowup" id="todayfollowup"  type="hidden" value="<?php echo $today;?>">
	    
        <div class="col-md form-group">
          <input type="text" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords" >
        </div>
        <div class="col-md form-group"> 
		{{ Form::select('query_types', $query_types, null, ['id' => 'query_types', 'class' => 'get_query_cat get_query_status form-control']) }} </div>
		<div class="col form-group"> {{ Form::select('query_category', ['' => 'Select'], null, ['class' => 'faq_cat_id form-control', 'id' => 'query_category']) }} </div>
        <div class="col-md form-group"> {{ Form::select('query_status', ['' => 'Select'], null, ['class' => 'query_status form-control', 'id' => 'query_status']) }} </div>
        <div class="col-md form-group">
          <input name="startdate" id="startdate"  type="text" placeholder="Start date" class="date_picker form-control" autocomplete="off">
        </div>
        <div class="col-md form-group">
          <input name="enddate" id="enddate"  type="text" placeholder="End date" class="date_picker form-control" autocomplete="off">
        </div>
        
        <div class="col-md">
          <input type="hidden" name="pageno" id="pageno" value="1">
		  <input type="hidden" name="query_status_hide_val" id="query_status_hide_val" value="">
          <button type="submit " class="btn btn-primary btn-block reset-pageno" id="">{{__('Find')}}</button>
        </div>
        <div class="col-md">
          <button  class="btn btn-outline-danger btn-block reset-pageno" id="s2" onclick="ressetListForm_withCountBox(this);">{{__('Reset')}}</button>
        </div>
      </div>
    </form>
  </div>
</aside>
<div class="content-area">
  <header class="row align-items-center">
    <div class="col-sm-5">
      <h2 class="m-0">{{__('Followups')}} <span id="totalcount"></span></h2>
      <small>{{__('List of leads generated')}}</small> </div>
    <div class="col-sm-7 text-right">

      <a title="Add Customer" href="{{url('profile')}}" class="btn btn-success ml-2"><i class="fas fa-user-plus"></i></a>
      @if( Helpers::checkPermission('export in helpdesk'))
      <a title="File Export" href="javascript:void(0)" onclick="exportFollowups()" class="btn btn-outline-info ml-1"><i class="fas fa-file-export"></i></a>
       @endif 
      <a title="Go Back" href="javascript:history.go(-1)" class="btn btn-outline-info ml-1"><i class="fas fa-chevron-left"></i></a>


      
    </div>
  </header>
  <div class="message"></div>
    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
</div>
@endsection
