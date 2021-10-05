@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Roles
@endsection
@section('content')
 <form action="{{url('/search_rolelist')}}" method="POST" class="listing form-common" name="form-common">
<aside class="sidebar">
  <div class="search-box">
   
	  <div class="row align-items-center justify-content-center">
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
        <div class="col-sm-1"><h2 class="m-0">Search</h2></div>
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
      <h2 class="m-0">{{__('Role Permissions')}} </h2>
      <small>Manage Role Permissions</small>
    </div>
    <div class="col-sm-7 text-right"><a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}" alt=""></a>
	   <a href="{{route('roles.create')}}" class="btn btn-success ml-2"><img src="{{ asset('img/ic_add.svg') }}"  alt=""/> Add New Role</a>
		  
    </div>
  </header>

    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
</div>
</div>
</form>


{{-- <aside class="sidebar">
  <div class="search-box">
      <form action="{{url('/search_rolelist')}}" method="post" class="listing form-common">
        <div class="row align-items-center justify-content-center">
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
        <div class="col-sm-3 form-group">
          <input type="text" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords" >
        </div>
        <div class="col-sm-1 form-group">
          <input type="hidden" name="pageno" id="pageno" value="1">
          <button type="submit " class="btn btn-primary btn-block" id="">Find</button>
        </div>
        </div>
      </form>
      </div>
</aside>
<div class="content-area">
  <div class="widget"> 
    <h2>MANAGE ROLE PERMISSIONS</h2>
    <a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a>
    <a href="{{route('roles.create')}}" class="btn btn-success"><img src="http://127.0.0.1:8000/img/ic_add.svg" alt=""> Add</a>  
    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
    
  </div>
</div>--}}
@endsection 
 