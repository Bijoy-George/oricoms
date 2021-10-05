@extends('layouts.app')

@section('header-custom-css-js')

@endsection

@section('content')

@if(Helpers::current_page('campaigns') === TRUE||Helpers::current_page('groups') === TRUE||str_is('groups/*/edit', request()->path()))

<aside class="sidebar">
  <div class="search-box text-right">

    

@php
      $form_data = ['class' => 'listing form-common', 'method'=>'POST', 'name' => 'form-common'];
      if (Helpers::current_page('campaigns') === TRUE||Helpers::current_page('groups') === TRUE)
      {
      $form_data['route'] = request()->path().'/search';
      }
      else
      {
      $form_data['url'] = '/groups/'.$group->id.'/contacts_search';
      }
      @endphp
{!! Form::open($form_data) !!}

      <div class="row align-items-center justify-content-md-center ">
        <div class="col-1">
          <h2 class="m-0">Search</h2>
        </div>
       <div class="col-4">
        {{ Form::search('search_keywords', null, array('id' => 'search_keywords', 'class' => 'form-control input-rounded', 'placeholder' => 'Keyword' )) }}
       </div>
      <div class="col-1">
        {{ Form::submit('Find', array('class' => 'btn btn-primary btn-block reset-pageno')) }}
      </div>
      <div class="col-1">
        <button type="reset " class="btn btn-outline-danger btn-block reset-pageno" onclick="ressetListForm();">{{ __('Reset') }}</button>
      </div>
        </div>
     {{ Form::hidden('pageno', '1', ['id' => 'pageno']) }}
      {!! Form::close() !!} 

  </div>
</aside>



      
     
<div class="content-area campaigns-list">
  <header class="row align-items-center">
    <div class="col-sm-5 text-sm-left mb-3 mb-sm-0">
      @if(Helpers::current_page('campaigns') === TRUE)
      <h2 class="m-0">Campaigns</h2>
      <small>List of campaigns created</small>
      @endif
      @if(Helpers::current_page('groups') === TRUE)
      <h2 class="m-0">Groups</h2>
      <small>List of groups created</small>
      @endif
    </div>
   <div class="col-sm-7 text-sm-right">
      <a title="Create Campaign"  href="{{ url('/campaigns/create') }}" class="btn btn-success ml-2"><i class="fas fa-user-plus"></i> Create Campaign</a>
      <a title="Create Group"  href="{{ url('/groups/create') }}"  class="btn btn-success ml-2"><i class="fas fa-user-plus"></i> Create Group</a>
      <a title="Go Back" href="javascript:history.go(-1)" class="btn btn-outline-info ml-1"><i class="fas fa-chevron-left"></i></a>
    </div>
    </header>
</div>


      <div class="col-sm-7 text-sm-left mb-2">
     @if(Helpers::checkPermission('campaign management'))
      <a id="camp_id" class="btn btn-outline-info ml-1 @if(Helpers::current_page('campaigns') === TRUE) active @endif" href="{{ url('/campaigns') }}">Campaigns <span class="badge badge-light">{{ $total_campaigns_count }}</span></a>
      @endif
      @if(Helpers::checkPermission('group management'))
       <a id="grp_id" class="btn btn-outline-info ml-1 @if(Helpers::current_page('groups') === TRUE) active @endif" href="{{ url('/groups') }}">Groups <span class="badge badge-light">{{ $total_groups_count }}</span></a>
       @endif
    </div>


@endif
@yield('tab-content')
<!-- Deletion modal end --> 
<!-- Autodial pop up starts -->
<div id="autodial_template" class="modal modal-wide fade ">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">AUTODIAL</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" class="" name="" id ="enquiry_form">
        <div class="row">
            <div id="msg_auto"></div>
            <div class="col-md-6 form-group">
              <label>Title</label>
              <input type="text" class="form-control"  name="cmp_title_auto" id="cmp_title_auto" placeholder="Batch Title">
            </div>
            <div class="col-md-6 form-group">
            <label>Subject</label>
            <input type="text" class="form-control"  name="new_subject_auto" id="new_subject_auto" placeholder="Subject">
            </div>
            <div class="col-md-12 form-group">
            <label>Content</label>
            <textarea class="form-control"  name="new_content_auto" id="new_content_auto" placeholder="Content"></textarea>
            </div>
            <div class="col-md-6 form-group">
            <label>Schedule</label>
            <select class="form-control"  name="schedule" id="schedule">
            <option value="">Please choose a schedule</option>
		{{Helpers::get_autodial_schedule() }}
		</select>
        </div>
            <div class="col-md-6 form-group">
            <label>Query Type</label>
            <select class="get_query_cat get_query_status form-control"  name="query_type" id="query_type" >
            <option value="">Please choose a query type</option>
		{{Helpers::get_query_type() }}
		</select>
        </div>
            <div class="col-md-6 form-group">
            <label>Department</label>
            {{ Form::select('faq_cat_id', ['' => 'Select'], null, ['class' => 'faq_cat_id form-control get_sub_category', 'id' => 'faq_cat_id']) }}
            </div>
            <div class="col-md-6 form-group">
            <label>Query Sub Category</label>
            {{ Form::select('query_subcategory', ['' => 'Select'], null, ['class' => 'sub_cat_id form-control', 'id' => 'query_category']) }}
            </div>
            <div class="col-md-6 form-group">
            <label>Query Status</label>
            {{--{{ Form::select('query_status[]', ['' => 'Select'], null, ['class' => 'query_status form-control', 'id' => 'query_status', 'multiple' => 'multiple']) }}--}}
            <select class="form-control"  name="query_status[]" id="query_status" multiple>
            <option value="">Please choose a query status</option>
		{{Helpers::get_query_status() }}
		</select>
        </div>
        <div class="col-md-6">
          <label class="m-0">Add New Query Status</label>
           <input type="text" class="form-control mt-2"  name="new_query_status" id="new_query_status" placeholder="New Query Status For Campaign">
            <input type="button" class="btn btn-success mt-2" name="add_status_button" value="Add Status" onclick="add_new_querystatus(4)">
          </div>
          

        </div>
        </form>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="compose_mail(4)"> <i class="fa fa-envelope" aria-hidden="true"></i> Schedule Call</button>
<div id="msg_mail"></div>
      </div>
    </div>
  </div>
</div>
<!-- Autodial pop up ends -->
<!-- Manual call pop up starts -->
<div id="manualcall_template" class="modal modal-wide fade ">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title">Manual Call</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body"> 
	  <form action="" method="POST" class="" name="" id ="call_form">
	  <div class="row">
      	<div class="col-md-12" id="msg_manual"></div>
        <div class="col-md-6 form-group">
		<label>Title</label>
		<input type="text" class="form-control"  name="cmp_title_manual" id="cmp_title_manual" placeholder="Batch Title">
        </div>
        <div class="col-md-12 form-group">
		<label>Content</label>
		<textarea class="form-control"  name="new_content_manual" id="new_content_manual" placeholder="Content"></textarea>
        </div>
        <div class="col-md-6 form-group">
          <label>Query Type</label>
          <select class="get_query_cat get_query_status form-control"  name="query_type" id="query_type" >
            <option value="">Please choose a query type</option>
            {{Helpers::get_query_type(config('constant.FOLLOWUPS')) }}
          </select>
        </div>
        <!-- <div class="col-md-6 form-group">
		<label>Department</label>
		<select class="form-control"  name="query_category" id="query_category" >
		<option value="">Please choose a department</option>
		{{Helpers::get_query_category() }}
		</select>
        </div> -->
        <div class="col-md-6 form-group">
          <label>Department</label>
          {{ Form::select('faq_cat_id', ['' => 'Select'], null, ['class' => 'faq_cat_id form-control get_sub_category', 'id' => 'faq_cat_id']) }}
        </div>
        <div class="col-md-6 form-group">
          <label>Query Sub Category</label>
          {{ Form::select('query_subcategory', ['' => 'Select'], null, ['class' => 'sub_cat_id form-control', 'id' => 'query_category']) }}
        </div>
        <div class="col-md-6 form-group">		
		<label>Priority</label>
		<select class="form-control"  name="priority" id="priority">
		<option value="">Please choose priority</option>
		{{Helpers::get_priority() }}
		</select>
        </div>
        <div class="col-md-6 form-group">
		<label>Query Status</label>
		<select class="form-control"  name="query_status_manual[]" id="query_status_manual" multiple>
		<option value="">Please choose a query status</option>
		{{Helpers::get_query_status() }}
		</select>
        </div>

        <div class="col-md-6">
          <label class="m-0">Add New Query Status</label>
          <input type="text" class="form-control mt-2"  name="new_query_status_manual" id="new_query_status_manual" placeholder="New Query Status For Campaign">
          <input type="button" class="btn btn-success mt-2" name="add_status_button" value="Add Status" onclick="add_new_querystatus(3)"/>
        </div>

        </div>
		</form>
        <div class="row align-items-center">
		
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="compose_mail(3)"> <i class="fa fa-envelope" aria-hidden="true"></i> Schedule Call</button>
<div id="msg_mail"></div>
      </div>
    </div>
  </div>
</div>
<!-- Manual call pop up ends -->
<!-- Campaign Batch Action pop up action starts -->
<div class="modal fade" id="batchActionModal" tabindex="-1" role="dialog" aria-labelledby="batchActionModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="batchActionModalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="pauseBtn" style="display: none;">Pause Batch</button>
        <button type="button" class="btn btn-primary" id="resumeBtn" style="display: none;">Resume Batch</button>
      </div>
    </div>
  </div>
</div>
<!-- Campaign Batch Action pop up ends -->
@endsection

@section('footer-custom-css-js')

@endsection