@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Customer Response
@endsection
@section('content')

 <form action="{{url('/search_customer_response')}}" method="POST" class="listing form-common" name="form-common">
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
      <h2 class="m-0">{{__('Customer Response')}} <span id="totalcount"></span></h2>
      <small>Available customer response</small>
    </div>
    <div class="col-sm-7 text-right"><a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}" alt=""></a> @if( Helpers::checkPermission('customer response create')) 
	   <a href="{{route('customer_response.create')}}" class="btn btn-success ml-2"><img src="{{ asset('img/ic_add.svg') }}"  alt=""/> Add Customer Response</a>
		   @endif
    </div>
  </header>

    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
</div>
</div>
</form>


@endsection 
