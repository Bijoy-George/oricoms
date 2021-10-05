@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Users
@endsection
@section('content')
<aside class="sidebar">
  <div class="search-box">
    <form action="{{url('/search_cus')}}" method="post" class="listing form-common">
      <input type="hidden" name="_token"  value="{{ csrf_token() }}">
      <div class="row align-items-center justify-content-center">
        <div class="col-sm-1 text-center text-sm-left">
          <h2 class="m-0">Search</h2>
        </div>
        <div class="col-sm-3 mb-2 mb-sm-0">
          <input type="text" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords" >
        </div>
        <div class="col-sm-3 mb-2 mb-sm-0">
          <select id="role" name="role" class="form-control">
            <option value="" >Select</option>
				@foreach($roles as $role)
            <option value="{{$role->id}}" >{{$role->role}}</option>
				@endforeach
          </select>
        </div>
        <div class="col-sm-1 mb-2 mb-sm-0">
          <input type="hidden" name="pageno" id="pageno" value="1">
          <button type="submit " class="btn btn-primary btn-block" id="">Find</button>
        </div>
        <div class="col-sm-1">
          <button type="reset" class="btn btn-outline-danger btn-block">Reset</button>
        </div>
      </div>
    </form>
  </div>
</aside>
<div class="content-area">
  <header class="row align-items-center text-center">
    <div class="col-sm-5 text-sm-left mb-3 mb-sm-0">
      <h2 class="m-0">Company User Management</h2>
      <small>List of users under this account</small>
    </div>
    <div class="col-sm-7 text-sm-right"><a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a><a href="{{route('register')}}" class="btn btn-success ml-2"><img src="{{ asset('img/ic_person_add.svg') }}"  alt=""/></a>
      <!--<div class="dropdown ml-1 d-inline-block"> <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Filter </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">By Name</a> <a class="dropdown-item" href="#">By Number</a> <a class="dropdown-item" href="#">By Status</a> </div>
      </div>-->
      <a href="#" class="btn btn-outline-info ml-1"><i class="material-icons">import_export</i> Export</a>
      <a href="#" class="btn btn-outline-info ml-1"><i class="material-icons">import_export</i> Import</a>
    </div>
  </header>
	<div class="panel-body no_data" id="no_data"></div>
  <div id="list"></div>
</div>
@endsection 