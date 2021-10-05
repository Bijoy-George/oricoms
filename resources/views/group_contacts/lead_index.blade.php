@extends('layouts.campaign')

@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Groups
@endsection

@section('tab-content')
<div class="content-area"> {!! Form::open(array('route' => 'group_lead_search', 'class' => 'listing form-common', 'method'=>'POST', 'name' => 'form-common')) !!}
  <header class="row align-items-center">
    <div class="col-sm-3 text-sm-left mb-3 mb-sm-0">
      <h2 class="m-0">{{ __('Leads') }} <span id="totalcount"></span></h2>
      <small>Imported Leads</small> </div>
    <div class="col-md-9 ml-auto">
      <div class="row">
        <div class="col-md-4 form-group"> {{ Form::search('search_keywords', null, array('id' => 'search_keywords', 'class' => 'form-control', 'placeholder' => 'Keyword Search' )) }} </div>
        <div class="col-md-2 form-group"> {{ Form::text('startdate', null, array('id' => 'startdate','class' => 'date_picker form-control','placeholder' => 'Start date','autocomplete' => 'off')) }} 
          <!--<input name="startdate" id="startdate"  type="text" placeholder="Start date" class="date_picker form-control" autocomplete="off">--> 
        </div>
        <div class="col-md-2 form-group"> {{ Form::text('enddate', null, array('id' => 'enddate','class' => 'date_picker form-control','placeholder' => 'End date','autocomplete' => 'off')) }} 
          <!-- <input name="enddate" id="enddate"  type="text" placeholder="End date" class="date_picker form-control" autocomplete="off">--> 
        </div>
        <div class="col-md-2 form group">
          <button type="submit " class="btn btn-primary btn-block reset-pageno">{{ __('Find') }}</button>
        </div>
        <div class="col-md-2 form-group">
          <button type="reset " class="btn btn-outline-danger btn-block reset-pageno reset-contacts" id="s2" onclick="ressetListForm();">{{ __('Reset') }}</button>
        </div>
        {{ Form::hidden('pageno', '1', ['id' => 'pageno']) }}
        {{ Form::hidden('selectedAll', null, ['id' => 'selectedAll']) }}
        {{ Form::hidden('callback', 'updateContactSelections', ['class' => 'callback']) }} </div>
    </div>
  </header>
  {!! Form::close() !!}
  {{ Form::hidden('selectedContacts', null, ['id' => 'selectedContacts']) }}
  {{ Form::hidden('excludedContacts', null, ['id' => 'excludedContacts']) }}
  {{ Form::hidden('groupId', $group->id, ['id' => 'groupId']) }}
  <div class="message"></div>
  <div class="panel-body no_data" id="no_data"></div>
  <div id="list"></div>
  <div class="text-right"><button id="addToGroup" process-type="{{ config('constant.BP_GROUP_LEAD_IMPORT') }}" class="btn btn-warning btn-sm">Add to Group</button></div>
</div>
</div>
@endsection

@section('footer-custom-css-js') 
<script src="{{ asset('js/groups/group.js') }}"></script> 
@endsection