@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Project
@endsection
@section('content')
 <form action="{{url('/employees_work')}}" method="POST" class="listing form-common" name="form-common">
  @csrf
<aside class="sidebar">
  <div class="search-box">
    <div class="row align-items-center justify-content-center">
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
        <div class="col-sm-1"><h2 class="m-0">Search</h2></div>
<div class="col-sm-4 form-group">
  <div class="row"> 

        <div class="col-sm mb-2 ">
    {{ Form::text('startdate', null, array('id' => 'startdate','class' => 'date_picker form-control','placeholder' => 'Start date','autocomplete' => 'off')) }}
        <!-- <input name="startdate" id="startdate"  type="text" placeholder="Start date" class="date_picker form-control" autocomplete="off"> -->
      </div>
      <div class="col-sm mb-2 ">
    {{ Form::text('enddate', null, array('id' => 'enddate','class' => 'date_picker form-control','placeholder' => 'End date','autocomplete' => 'off')) }}
        <!-- <input name="enddate" id="enddate"  type="text" placeholder="End date" class="date_picker form-control" autocomplete="off"> -->
      </div>
        

    </div>    
  </div>
    <div class="col-sm-2 form-group">
    <input type="hidden" name="pageno" id="pageno" value="1">
    <button type="submit " class="btn btn-primary btn-block" id="">{{__('Find ')}}</button>
        </div>
        <div class="col-sm-2 form-group">
        <button  class="btn btn-outline-danger btn-block" id="s2" onclick="ressetListForm(this);">{{__('Reset ')}}</button>
        </div>
      
    </div>
</aside>

<div class="content-area">
  <header class="row align-items-center">
    <div class="col-sm-5">
      <h2 class="m-0">{{__('Working Hours')}} </h2>
      <small></small>
    </div>
    <div class="col-sm-7 text-right">
    <a title="File Export" href="#" class="btn btn-outline-info ml-1"  
onclick="exportprojecthours();"><i class="fas fa-file-import"></i></a>       
    </div>
  </header>

    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
</div>
<div class="content-area">
  <header class="row align-items-center">
    
  </header>
    <div class="panel-body no_data" id="no_data"></div>
    <div id="list"></div>
</div>
</div>
</form>
@endsection