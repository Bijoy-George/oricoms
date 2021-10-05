@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Outbound Calls
@endsection
@section('content')
<aside class="sidebar">
  <div class="search-box">
    <form action="{{url('/outboundcall_followup_list')}}" method="POST" class="listing form-common" name="form-common" id ="enquiry_form">
      <div class="row align-items-center">
        <div class="col-1">
          <h2 class="m-0">{{__('Search')}}</h2>
        </div>
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
        <div class="col form-group">
          <input type="text" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords" >
        </div>
        <div class="col form-group"> {{ Form::select('query_types', $query_types, null, ['id' => 'query_types', 'class' => 'get_query_cat get_query_status form-control']) }} </div>
        <div class="col form-group"> {{ Form::select('query_category', ['' => 'Select'], null, ['class' => 'faq_cat_id form-control', 'id' => 'query_category']) }} </div>
        <div class="col form-group"> {{ Form::select('query_status', ['' => 'Select'], null, ['class' => 'query_status form-control', 'id' => 'query_status']) }} </div>
        <div class="colform-group"> {{ Form::select('priority_type', $priority_type, null, ['id' => 'priority_type', 'class' => 'form-control']) }} </div>
        <div class="col form-group">
          <select class="form-control hideerror" id="agent_id" name="agent_id">
            <option value="0">Select Agent</option>
            
					@foreach($agent_list as $ag)
						  
            <option value="{{$ag->id}}" >{{$ag->name}}</option>
            
						  @endforeach
				
          </select>
          <span id="category_error"></span> </div>
        <div class="col form-group">
          <select class="form-control hideerror" id="call_status" name="call_status">
            <option value="0">Call Status</option>
            <option value="1" selected>Not Assigned</option>
            <option value="2">Assigned</option>
          </select>
          <span id="category_error"></span> </div>
        <div class="col-1 ">
          <input type="hidden" name="pageno" id="pageno" value="1">
          <input type="hidden" name="query_status_hide_val" id="query_status_hide_val" value="">
          <button type="submit " class="btn btn-primary btn-block reset-pageno" id="">{{__('Find')}}</button>
        </div>
        <div class="col-1 ">
          <button  class="btn btn-outline-danger btn-block reset-pageno" id="s2" onclick="ressetListForm_withCountBox(this);">{{__('Reset')}}</button>
        </div>
      </div>
      {{ Form::hidden('callback', 'selected_check_box_pagination', ['class' => 'callback']) }}
      {{ Form::hidden('procees_count_hid', $process_count, ['id' => 'procees_count_hid']) }}
    </form>
  </div>
</aside>
<div class="content-area">
  <header class="row align-items-center">
    <div class="col-sm-5">
      <h2 class="m-0">{{__('Outbound Calls')}} <span id="totalcount"></span></h2>
      <small>{{__('List of Outbound Calls')}}</small> </div>
  </header>
  <?php if($process_count >0)
  {
$cls='color:red';
$msg_div='Please Wait...Processing call list';
  }else{
$cls='display:none';
$msg_div='';
}?>
  <div id="msg" class="col-md-12 col-md-offset-5" style="<?php echo $cls;?>"><?php echo $msg_div;?></div>
    <div class="no_data" id="no_data"></div>
    <div id="list"></div>
</div>
<input type="hidden" id="agents" name="agents" value="@isset($agents){{$agents}}@endisset">
<!-- Modal pop up for deleting start -->
<div class="modal fade" id="assigned_lead" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Outbound Calls</h4>
      </div>
      <div class="modal-body">
        <div class="col-sm-5 form-group"> 
          <!-- <label for="search" class="control-label">Lead Source</label>-->
          <select class="form-control" id="selected_agent" name="selected_agent" >
            <option value="">Select Agent</option>
            
                      @foreach($agent_list as $ag)
                      
            <option value="{{$ag->id}}" >{{$ag->name}}</option>
            
                      @endforeach
        
          </select>
        </div>
        <p id="pop_msg"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button id="AssignAgent" process-type="{{ config('constant.MANUAL_OUTBOUND_TYPE') }}" type="button" class="btn btn-primary" onclick="assigned_agent()">Yes</button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
@section('footer-custom-css-js') 
<script src="{{ asset('js/manual_call/manual.js') }}"></script> 
@endsection 