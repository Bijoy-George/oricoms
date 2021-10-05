@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Leadlist
@endsection
@section('content')


<aside class="sidebar">
  <div class="search-box"> {!! Form::open(array('route' => 'search_leadlist', 'class' => 'listing form-common', 'method'=>'POST', 'name' => 'form-common')) !!}
    <div class="row align-items-center">
      <div class="col-sm-1 text-center text-sm-left">
        <h2 class="m-0">Search</h2>
      </div>
      <div class="col-sm mb-2 mb-sm-0"> {{ Form::text('search_keywords', null, array('id' => 'search_keywords','class' => 'form-control','placeholder' => 'Keyword')) }} </div>
      <div class="col-sm mb-2 mb-sm-0">
        {{ Form::select('country', $countries, null, ['id' => 'country', 'class' => 'form-control']) }}
      </div>
      <div class="col-sm mb-2 mb-sm-0">
		{{ Form::text('startdate', null, array('id' => 'startdate','class' => 'date_picker form-control','placeholder' => 'Start date','autocomplete' => 'off')) }}
        <!--<input name="startdate" id="startdate"  type="text" placeholder="Start date" class="date_picker form-control" autocomplete="off">-->
      </div>
      <div class="col-sm mb-2 mb-sm-0">
	  {{ Form::text('enddate', null, array('id' => 'enddate','class' => 'date_picker form-control','placeholder' => 'End date','autocomplete' => 'off')) }}
       <!-- <input name="enddate" id="enddate"  type="text" placeholder="End date" class="date_picker form-control" autocomplete="off">-->
      </div>
      <!--<div class="col form-group">
        <input type="text" class="form-control">
      </div>-->
      <div class="col-sm-1 mb-2 mb-sm-0"> {{ Form::submit('Find', array('class' => 'btn btn-primary btn-block reset-pageno')) }}
        {{ Form::hidden('pageno', 1, array('id' => 'pageno')) }} </div>
        <div class="col-sm-1"> {{ Form::button('Reset', array('class' => 'btn btn-outline-danger btn-block reset-pageno', 'onclick' => 'ressetListForm(this);', 'id' => 's2', 'type' => '')) }} </div>
    </div>
    {!! Form::close() !!} </div>
</aside>
<div class="content-area">
  <header class="row align-items-center text-center">
    <div class="col-sm-5 text-sm-left mb-3 mb-sm-0">
      <h2 class="m-0">{{ !empty(Helpers::get_company_meta('customer_label')) ? Helpers::get_company_meta('customer_label') : 'Customer Profiles' }}<span id="totalcount"></span></h2>
      <small>List of {{ !empty(Helpers::get_company_meta('customer_label')) ? Helpers::get_company_meta('customer_label') : 'Customer Profiles' }}</small>
    </div>
    <div class="col-sm-7 text-sm-right">
      <a title="Add Customer" href="{{url('profile')}}" class="btn btn-success ml-2"><i class="fas fa-user-plus"></i></a>
      @if( Helpers::checkPermission('customer export'))
      @if (Auth::user()->cmpny_id == config('constant.DISHA_CMPNY'))
        <a title="Disha Export" href="javascript:void(0)" onclick="exportDishaLeads()" class="btn btn-outline-info ml-1"><i class="fas fa-file-export"></i></a>
      @endif
      @if (Auth::user()->cmpny_id == config('constant.SECRETRIAT_CMPNY'))
        <a title="Customer Export with Helpdesk" href="javascript:void(0)" onclick="customerWithHelpdeskExport()" class="btn btn-outline-info ml-1"><i class="fas fa-file-export"></i></a>
      @endif
      <a title="File Export" href="#" class="btn btn-outline-info ml-1"  onclick="exportleads();"><i class="fas fa-file-import"></i></a>
      @endif
      <a title="File Import" href="{{url('/import_customers')}}" class="btn btn-outline-info ml-1"><i class="fas fa-file-export"></i></a>
      <a title="Go Back" href="{{url('dashboard')}}" class="btn btn-outline-info ml-1"><i class="fas fa-chevron-left"></i></a>
    </div>
  </header>
   <div class="message"></div>
    <div class="no_data" id="no_data"></div>
    <div id="list"></div>
</div>
@endsection 
