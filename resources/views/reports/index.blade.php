@extends('layouts.profile')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Agent Chat Report
@section('content')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/heatmap.js"></script>
<aside class="sidebar">
  <div class="search-box">
  	<form action="{{url('/agentchatreportresult')}}" method="POST" class="listing form-common" name="form-common">
    <input type="hidden" name="_token"  value="{{ csrf_token() }}">
    	<div class="row align-items-center">
        <div class="col-1">
          <h2 class="m-0">{{__('Search')}}</h2>
        </div>
        <div class="col-2">
				<input type="text" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords" >
			</div>
			Start Date:
			<div class="col-2">
				
			<input type="text" class="date_picker form-control" placeholder="Start Date" id="start_date" name="start_date" autocomplete="off" value="<?php echo $start_date; ?>"/>
			</div>
			End Date:
			<div class="col-2">
			  <input type="text"  class="date_picker form-control" placeholder="End Date" id="end_date" name="end_date" autocomplete="off" value="<?php echo $end_date; ?>"/>
			</div>
			
			<div class="col p-sm-0">
				<input type="hidden" name="pageno" id="pageno" value="1">
				<button type="submit " class="btn btn-primary" id="">{{__('Find')}}</button>
                <button  class="btn btn-danger" id="s2" onclick="ressetListForm(this);">Reset</button>
			</div>
        </div>
    </form>
  </div>
</aside>
<div class="content-area">
<header class="row align-items-center">
    <div class="col-sm-6">
    	<h2 class="m-0 text-center text-sm-left">{{__('Agent Chat Count Report')}}<span id="totalcount"></span></h2>
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
    </div>
    <div class="col-sm-6 text-center text-sm-right"><a href="{{url('dashboard')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a></div>
</header>
<div class="no_data" id="no_data"></div>
<div id="list"></div>
</div>

@endsection 

