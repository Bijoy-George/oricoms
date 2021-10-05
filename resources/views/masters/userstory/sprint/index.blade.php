@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Sprint
@endsection
@section('content')
<form action="{{url('/search_sprint')}}" method="POST" class="listing form-common" name="form-common">
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
	  <input type="hidden" name="project_id" id="project_id" value="{{$project_id}}">
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
          <h2 class="m-0">{{__('Sprint')}} <span id="totalcount"></span></h2>
          <small>Sprint</small> </div>

		<div class="col-sm-7 text-right"><a href="{{url('scrumboard')}}/{{$project_id}}" class="btn btn-primary ml-2"><img src=""  alt=""/> Scrum Board </a><a href="{{url('/projects')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}" alt=""></a><a href="{{url('sprintcreate')}}/{{$project_id}}" class="btn btn-success ml-2"><img src="{{ asset('img/ic_add.svg') }}"  alt=""/> Add Sprint</a>
      </header>
      <div class="panel-body no_data" id="no_data"></div>
      <div id="list"></div>
    </div>
  </div>
</form>
@endsection 