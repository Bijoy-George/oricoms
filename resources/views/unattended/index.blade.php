@extends('layouts.listpage')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Unattended Calls
@endsection
@section('content')

<aside class="sidebar">
  <div class="search-box">
    <form action="{{url('/list_unattended_calls')}}" method="POST" class="listing form-common" name="form-common" id ="enquiry_form">
      <div class="row align-items-center">
        <div class="col-1">
          <h2 class="m-0">{{__('Search')}}</h2>
        </div>
        <input type="hidden" name="_token"  value="{{ csrf_token() }}">
        <div class="col form-group">
          <input type="text" class="form-control" placeholder="Keyword" id="search_keywords" name="search_keywords" >
        </div>
      	<div class="col form-group">
		  <select class="form-control" id="type_list" name="type_list">
			<option value="abandoned">Abandoned Call</option>
			<option value="after hour">After Hour Call</option>
			<option value="holiday">Holiday</option>
		  </select>
		</div>
		<div class="col-sm-1">
		  <input name="start_date" id="start_date"  type="text" placeholder="Start Date"  class="date_picker form-control" autocomplete="off" >
		</div>
		<div class="col-sm-1">
		  <input name="end_date" id="end_date" type="text" placeholder="End Date"  class="date_picker form-control" autocomplete="off" >
		</div>
		<div class="col form-group">
			<select class="form-control hideerror" id="agent_id" name="agent_id">
				<option value="0">Select Agent</option>
					@foreach($agent_list as $ag)
						<option value="{{$ag->id}}" >{{$ag->name}}</option>
					@endforeach
			</select>   
		<span id="category_error"></span>         
		</div> 
		<div class="col form-group">
			<select class="form-control hideerror" id="call_status" name="call_status">
                <option value="0">Call Status</option>
                <option value="1" selected>Not Assigned</option>
                <option value="2">Assigned</option>
            </select>   
		<span id="category_error"></span>         
		</div> 
        
        <div class="col-1">
          <input type="hidden" name="pageno" id="pageno" value="1">
		  <input type="hidden" name="query_status_hide_val" id="query_status_hide_val" value="">
          <button type="submit " class="btn btn-primary btn-block" id="">{{__('Find')}}</button>
        </div>
        <div class="col-1">
          <button  class="btn btn-outline-danger btn-block" id="s2" onclick="ressetListForm_withCountBox(this);">{{__('Reset')}}</button>
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
			<h2 class="m-0">{{__('Unattended Calls')}} <span id="totalcount"></span></h2>
		<small>{{__('List of Unattended Calls')}}</small> </div>
   </header>

  <?php if($process_count >0)
  {
$cls='color:red';
$msg_div='Please Wait...Processing call list';
  }else{
$cls='display:none';
$msg_div='';
}?>
  <div id="msg" class="col-md-12" style="<?php echo $cls;?>"><?php echo $msg_div;?></div>
    <div class="content-widget">
		<div class="panel-body no_data" id="no_data"></div>
		<div id="list"></div>
    </div>
</div>

<input type="hidden" id="agents" name="agents" value="@isset($agents){{$agents}}@endisset">
<!-- Modal pop up for deleting start -->
 <div class="modal fade" id="assigned_lead" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Unattended Calls</h4>
      </div>
      <div class="modal-body">
	    <div class="col form-group">
			<?php $agent = Helpers::get_company_meta('agent');?>
			@if(empty($agent)) 
					 {{'You must add a agent.'}} <a  href="company_meta">Please go to setting</a>  
			@else
			<div class="col-sm-5 form-group">
					   <!-- <label for="search" class="control-label">Lead Source</label>-->
						<select class="form-control" id="selected_agent" name="selected_agent" >
						  <option value="">Select Agent</option>
						  @foreach($agent_list as $ag)
						  <option value="{{$ag->id}}" >{{$ag->name}}</option>
						  @endforeach
						</select>
			</div> 
			<br> {{'If you want change the agent from.'}} <a  href="company_meta">Please go to setting</a>
			@endif
		</div> 
		<div class="col form-group">
		    		
            <br>
		           <?php //$set_unattended_call_source = 5 ?>
		    <?php $set_unattended_call_source = Helpers::get_company_meta('set_unattended_call_source'); ?>
		    {{ Form::hidden('set_unattended_call_source', $set_unattended_call_source, ['id' => 'set_unattended_call_source']) }}
		    @php $set_unattended_call_source = (isset($set_unattended_call_source))?$set_unattended_call_source:''; @endphp
				@foreach ($lead_sources as $key => $value)           
					@if($key == $set_unattended_call_source) {{'Unattended Call Source is '}} <b> {{$value}} </b>{{'.'}} <br> {{'If you want change.'}} <a  href="company_meta">Please go to setting</a>
					@endif
		    	@endforeach 
			@if(empty($set_unattended_call_source)) 
				{{'You must add Unattended Call Source .'}} <a  href="company_meta">Please go to setting</a>  
			@endif
			<br>
			<?php $set_abandoned_category = Helpers::get_company_meta('set_abandoned_category'); ?>
			{{ Form::hidden('set_abandoned_category', $set_abandoned_category, ['id' => 'set_abandoned_category']) }}
			@php $set_abandoned_category = (isset($set_abandoned_category))?$set_abandoned_category:''; @endphp
				@foreach ($query_category as $key => $value)           
					@if($key == $set_abandoned_category) {{'Abandoned Call Query Category is '}} <b> {{$value}} </b>{{'.'}} <br> {{'If you want change.'}} <a  href="company_meta">Please go to setting</a>
					@endif
		    	@endforeach 
			@if(empty($set_abandoned_category)) 
					{{'You must add Abandoned Call Query Category .'}} <a  href="company_meta">Please go to setting</a>  
			@endif
			<br>
			<?php $open_status = Helpers::get_company_meta('open_status'); ?>
			{{ Form::hidden('open_status', $open_status, ['id' => 'open_status']) }}
			@php $open_status = (isset($open_status))?$open_status:''; @endphp
				@foreach ($query_status as $key => $value)           
					@if($key == $open_status) {{'open status is '}} <b> {{$value}} </b>{{'.'}} <br> {{'If you want change.'}} <a  href="company_meta">Please go to setting</a>
					@endif
		    	@endforeach 
			@if(empty($open_status)) 
					{{'You must add open status .'}} <a  href="company_meta">Please go to setting</a>  
			@endif
			<br>
			<?php $set_after_hour_category = Helpers::get_company_meta('set_after_hour_category'); ?>
			{{ Form::hidden('set_after_hour_category', $set_after_hour_category, ['id' => 'set_after_hour_category']) }}
			@php $set_after_hour_category = (isset($set_after_hour_category))?$set_after_hour_category:''; @endphp
				@foreach ($query_category as $key => $value)           
					@if($key == $set_after_hour_category) {{'After hour Call Query Category is '}} <b> {{$value}} </b>{{'.'}} <br> {{'If you want change.'}} <a  href="company_meta">Please go to setting</a>
					@endif
		    	@endforeach 
			@if(empty($set_after_hour_category)) 
					{{'You must add After hour Call Query Category .'}} <a  href="company_meta">Please go to setting</a>  
			@endif
			<br>
			<?php $set_holiday_category = Helpers::get_company_meta('set_holiday_category'); ?>
			{{ Form::hidden('set_holiday_category', $set_holiday_category, ['id' => 'set_holiday_category']) }}
			@php $set_holiday_category = (isset($set_holiday_category))?$set_holiday_category:''; @endphp
				@foreach ($query_category as $key => $value)           
					@if($key == $set_holiday_category) {{'Holiday Call Query Category is '}} <b> {{$value}} </b>{{'.'}} <br> {{'If you want change.'}} <a  href="company_meta">Please go to setting</a>
					@endif
		    	@endforeach 
			@if(empty($set_holiday_category)) 
					{{'You must add Holiday Call Query Category .'}} <a  href="company_meta">Please go to setting</a>  
			@endif
				
        </div>

     <br><br><br><br>
     <p id="pop_msg"></p>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button id="AssignAgent" process-type="{{ config('constant.UNATTENDED_CALL_TYPE') }}" type="button" class="btn btn-primary" onclick="assigned_agent()">Yes</button>

      </div>
    </div>
  </div>
</div>
</div>
@endsection
@section('footer-custom-css-js')
<script src="{{ asset('js/unattended_call/unattended.js') }}"></script>
@endsection
