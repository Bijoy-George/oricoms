@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Customer Nature
@endsection
@section('content')

 <form action="{{url('/search_tracker_list')}}" method="POST" class="listing form-common" name="form-common">
<aside class="sidebar">
  <div class="search-box">
   
	  <div class="row align-items-center justify-content-center">
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
        <div class="col-sm-1"><h2 class="m-0">Search</h2></div>
		<!--<div class="col-sm-2 form-group">
        <input type="text" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords">
        </div>-->
        <div class="row">
        <div class="col-sm-2 form-group">
        {{ Form::select('prjt_id', [null=>'Project Name'] +$projects, null, ['id' => 'prjt_id', 'class' => 'form-control']) }}    
        </div>
         <div class="col-sm-2 form-group">
        {{ Form::select('task', ['' => 'Select'], null, ['class' => 'form-control task_list','id' =>'task']) }}      
        </div>
		<div class="col-sm-2 mb-2 mb-sm-0">
		{{ Form::text('from_time', null, array('id' => 'from_time','class' => 'date_picker form-control','placeholder' => 'Start Time','autocomplete' => 'off')) }}
        </div>
		<div class="col-sm-2 mb-2 mb-sm-0">
		{{ Form::text('to_time', null, array('id' => 'to_time','class' => 'date_picker form-control','placeholder' => 'End Time','autocomplete' => 'off')) }}
        </div>
		<div class="col-sm-2 form-group">
        {{ Form::select('status', [null=>'Project Status'] +$status_arr, null, ['id' => 'status', 'class' => 'form-control']) }}	
        </div>
		<div class="col-sm-1 form-group">
		<input type="hidden" name="pageno" id="pageno" value="1">
		<button type="submit " class="btn btn-primary btn-block" id="">{{__('Find ')}}</button>
        </div>
        <div class="col-sm-1 form-group">
        <button  class="btn btn-outline-danger btn-block" id="s2" onclick="ressetListForm(this);">{{__('Reset ')}}</button>
        </div>
	@if(Helpers::checkPermission('project create'))
        <div class="col-sm-1 form-group">
        <a href="{{url('/tracker_history_index')}}"  class="btn btn-primary btn-sm">View History</a>
        </div>
	@endif
    </div>
</aside>
<div class="message"></div>
<div class="content-area">
	<header class="row align-items-center">
    <div class="col-sm-5">
      <h2 class="m-0">{{__('TRACKER LOGS')}} <span id="totalcount"></span></h2>
      <small>Available Tracker Entries</small>
    </div>
    </header>

    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
</div>
</div>
</form>
@endsection 

