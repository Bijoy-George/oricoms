@extends('layouts.campaign')

@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Groups
@endsection

@section('tab-content')
	<div class="content-area pt-0">
		<div class="panel-body no_data" id="no_data"></div>
    	<div id="list"></div>
	</div>
@endsection