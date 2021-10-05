@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Assigned Call List
@endsection
@section('content')

<aside class="sidebar">
  <div class="search-box">
    <form action="{{url('/agent_followups_list')}}" method="POST" class="listing form-common" name="form-common" id ="enquiry_form">
      <div class="row align-items-center">
        <div class="col-1">
          <h2 class="m-0">{{__('Search')}}</h2>
        </div>
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
        <div class="col form-group">
          <input type="text" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords" >
        </div>
        <div class="col form-group"> 
		{{ Form::select('query_types', $query_types, null, ['id' => 'query_types', 'class' => 'get_query_cat get_query_status form-control']) }} </div>
		<div class="col form-group"> {{ Form::select('query_category', ['' => 'Select'], null, ['class' => 'faq_cat_id form-control', 'id' => 'query_category']) }} </div>
        <div class="col form-group"> {{ Form::select('query_status', ['' => 'Select'], null, ['class' => 'query_status form-control', 'id' => 'query_status']) }} </div>
		<div class="colform-group">
				{{ Form::select('priority_type', $priority_type, null, ['id' => 'priority_type', 'class' => 'form-control']) }} 
		</div>
		<div class="col form-group">
          <input name="remainder_date" id="remainder_date"  type="text" placeholder="Follow Up Date" class="date_picker form-control" autocomplete="off">
        </div>
        
        <div class="col-1 ">
          <input type="hidden" name="pageno" id="pageno" value="1">
          <button type="submit " class="btn btn-primary btn-block" id="">{{__('Find')}}</button>
        </div>
        <div class="col-1 ">
          <button  class="btn btn-outline-danger btn-block" id="s2" onclick="ressetListForm_withCountBox(this);">{{__('Reset')}}</button>
        </div>
      </div>
    </form>
  </div>
</aside>
<div class="content-area">
    <header class="row align-items-center">
		<div class="col-sm-8">
			<h2 class="m-0">{{__('Outbound Calls')}} <span id="totalcount"></span></h2>
		<small>{{__('List of Outbound Calls')}}</small> </div>
    <div class="col-sm-4 text-center text-sm-right">
       <a title="Go Back" href="javascript:history.go(-1)" class="btn btn-outline-info ml-1"><i class="fas fa-chevron-left"></i></a>
    </div>
	</header>
		<div class="panel-body no_data" id="no_data"></div>
		<div id="list"></div>
</div>
</div>
@endsection
