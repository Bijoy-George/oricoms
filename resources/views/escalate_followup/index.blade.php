@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Tasks
@endsection
@section('content')
<aside class="sidebar">
  <div class="search-box">
  	<form action="{{url('/taskslist_search')}}" method="POST" class="listing form-common" name="form-common" id ="task_list_con">
    <input type="hidden" name="_token"  value="{{ csrf_token() }}">
    	<div class="row align-items-center">
        <div class="col-1">
          <h2 class="m-0">{{__('Search')}}</h2>
        </div>
        <div class="col-2">
				<input type="text" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords" >
			</div>
			<div class="col-2">
				{{ Form::select('query_types', $query_types, null, ['id' => 'query_types', 'class' => 'get_query_status form-control']) }} 
			</div>
			<div class="col-2"> 
			{{ Form::select('query_status', ['' => 'Select'], null, ['class' => 'query_status form-control', 'id' => 'query_status']) }}
			
			</div>
			<div class="col-2">
				<input name="req_nxt_follow" id="req_nxt_follow"  type="text" placeholder="Next Follow Up Date" class="date_picker form-control" autocomplete="off">
			</div>
			<div class="col">
			   <select class="form-control" id="esc_status" name="esc_status">
				  <option value="0">{{__('All')}}</option>
				  <option value='{{config('constant.ESCALATED')}}'>{{__('Escalated')}}</option>
				  <option value='{{config('constant.REPLIED')}}'>{{__('Replied')}}</option>
				</select> 
			 </div>
			<div class="col">
				<input type="hidden" name="pageno" id="pageno" value="1">
				<button type="submit " class="btn btn-primary btn-block reset-pageno" id="">{{__('Find')}}</button>
			</div>
			<div class="col">
				<button  class="btn btn-outline-danger btn-block reset-pageno" id="s2" onclick="ressetListForm_withCountBox(this);">{{__('Reset')}}</button>
			</div>
        </div>
    </form>
  </div>
</aside>
<div class="content-area">
<header class="row align-items-center">
    <div class="col-sm-6">
    	<h2 class="m-0 text-center text-sm-left">{{__('Tasks')}}<span id="totalcount"></span></h2>
        <small>List of tasks, that assigned to you</small>
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
    </div>
    <div class="col-sm-6 text-center text-sm-right">
    	 <a title="Go Back" href="javascript:history.go(-1)" class="btn btn-outline-info ml-1"><i class="fas fa-chevron-left"></i></a>
    </div>
</header>
<div class="no_data" id="no_data"></div>
<div id="list"></div>
</div>

@endsection 

