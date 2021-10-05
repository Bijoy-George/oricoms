@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Project
@endsection

@section('content')
  <form action="#" class="form-common" method="POST">
@csrf
  <div class="message"></div>
	  <div class="row align-items-center justify-content-center">
        <!-- <input type="hidden" name="_token"  value="{{ csrf_token() }}"> -->
        <h>Daily Report</h>
        <!-- <button id="weekly">Weekly Report</button> -->
<div class="col-sm-4 form-group">
  <div class="row"> 
<!-- <div id="weekly_report">
        <div class="col-sm mb-2 ">
    {{ Form::text('startdate', null, array('id' => 'startdate','class' => 'date_picker form-control','placeholder' => 'Start date','autocomplete' => 'off')) }}
      </div>
      <div class="col-sm mb-2 ">
    {{ Form::text('enddate', null, array('id' => 'enddate','class' => 'date_picker form-control','placeholder' => 'End date','autocomplete' => 'off')) }}
      <a title="File Export" href="#" class="btn btn-outline-info ml-1"  onclick="exportserverreport();"><i class="fas fa-file-import"></i></a>   
      </div>
        
    </div> 
 -->
    
    </div>   
  </div>
		<a href="/test_export">test</a>
    </div>
    <div id="daily_report">
        <label for="status" class="control-label mb-1">{{__('Select Server Stage')}}</label>
            {{ Form::select('status', ['' => 'Select Stage'] + config('constant.server_stages'),null,['id' => 'status', 'class' => 'form-control']) }} 
             

        <div class="col-sm mb-2 ">
    {{ Form::text('startdate', null, array('id' => 'startdate','class' => 'date_picker form-control','placeholder' => 'Start date','autocomplete' => 'off')) }}
     <a title="File Export" href="#" class="btn btn-outline-info ml-1"  onclick="exportserverreport();"><i class="fas fa-file-import"></i></a> 
      </div>        
    </div> 
</form>
@endsection
