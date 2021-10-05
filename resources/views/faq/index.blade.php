@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - FAQs
@endsection
@section('content')
<aside class="sidebar">
  <div class="search-box">
    <form name="form-common" action="{{url('/search_faqlist')}}" method="post" class="listing form-common">
      <input type="hidden" name="_token" class="search-token" value="{{ csrf_token() }}">
      <div class="row align-items-center justify-content-center">
        <div class="col-sm-1 text-center text-sm-left">
          <h2 class="m-0">Search</h2>
        </div>
        <div class="col-sm-4 mb-2 mb-sm-0">
          <input type="text" class="form-control"  placeholder="Keyword" id="search_keywords" name="search_keywords">
          <input type="hidden" class="form-control" value ="<?php if(isset($request_mob) && !empty($request_mob)){ echo $request_mob;} ?>" placeholder="Phone Number" id="phone" name="phone">
        </div>
        <div class="col-sm-1 mb-2 mb-sm-0">
          <input type="hidden" name="pageno" id="pageno" value="1">
          <button type="submit" class="reset-pageno btn btn-primary btn-block" id="">Find </button>
        </div>
        <div class="col-sm-1">
          <button type="reset" class="btn btn-outline-danger btn-block" id="s2" onclick="ressetListForm(this);">Reset</button>
        </div>
      </div>
    </form>
  </div>
</aside>
<div class="content-area">
  <header class="row align-items-center text-center">
    <div class="col-sm-5 text-sm-left mb-3 mb-sm-0">
      <h2 class="m-0">FAQs <span id="totalcount"></span></h2>
      <small>List of FAQs</small> </div>
    <div class="col-sm-7 text-sm-right"><a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a><a href="{{route('faqs.create')}}" class="btn btn-success ml-2"><img src="{{ asset('img/ic_add.svg') }}"  alt=""/> Add New FAQ</a></div>
  </header>
  <div class="panel-body no_data" id="no_data"></div>
  <div id="list"></div>
</div>

<!-- Modal pop up for deleting start -->

<div class="modal" id="deleteRecord" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <form role="form" method="post" class="form-common" name="faqform" action="{{url('delfaq')}}" >
    {{ csrf_field() }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <p>Are you sure want to delete ?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="id" value="">
          <!--<input type="hidden" name="" id="pageid" value="">-->
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary" id="s1">Yes</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection 