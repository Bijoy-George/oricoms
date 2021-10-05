@extends('layouts.campaign')

@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Campaign
@endsection

@section('tab-content')


<div class="content-area">
  <header class="row align-items-center">
    <div class="col-sm-5 text-sm-left mb-3 mb-sm-0">
            <h2 class="m-0">
            	@if (isset($campaign))
				Edit Campaign
			@else
				Create Campaign
			@endif
            </h2>
      		<small><a href="{{ url('/campaigns') }}">Campaigns</a> / @if (isset($campaign)) Edit Campaign @else	Add Campaign @endif</small>
                </div>
		   <div class="col-sm-7 text-sm-right">
		      <a title="Go Back" href="javascript:history.go(-1)" class="btn btn-outline-info ml-1"><i class="fas fa-chevron-left"></i></a>
		    </div>
</header>
</div>


<div class="content-area pt-0">
	<div class="widget">
  <div class="widget-heading">
    <div class="row">
      <div class="col-12 col-md-6">
        <h2>@if (isset($campaign))Edit Campaign	@else Add Campaign @endif</h2>
      </div>
      <div class="col-12 col-md-6">
      	<div class="float-right">
			@if(isset($campaign) && count($campaign->batches))
			<a href="{{ url('/campaigns/' . $campaign->id . '/reassign') }}"><button type="button" class="btn btn-primary btn-sm mt-1 mr-1">Reassign Group</button></a>
			@endif
			@if(isset($campaign))
			<a href="{{ url('/campaigns/' . $campaign->id) }}"><button type="button" class="btn btn-success btn-sm mt-1 mr-1">Go To Reports</button></a>
			@endif
		</div>
      </div>
    </div>
  </div>
  <div class="table-widget table-responsive mt-0 pt-0 p-3">
    
			@if(isset($campaign))
				{!! Form::model($campaign, ['method' => 'POST', 'id' => 'campaign-form', 'class' => 'tinymce', 'route' => ['campaigns.store']]) !!}
			@else
				{!! Form::open(array('route' => 'campaigns.store',  'id' => 'campaign-form','class' => 'tinymce', 'method'=>'POST')) !!}
			@endif
			<div class="message"></div>
				<div class="row">
						{{ Form::hidden('id', $campaign->id ?? '', array('id' => 'campaign_id')) }}
					<div class="form-group col-md-4">
						{{ Form::label('name', __('Campaign Name'))}}
						{{ Form::text('name', null, array('class' => 'form-control', 'id' => 'name')) }}
						<span class="error" id ="name_err"></span>
					</div>

					<div class="form-group col-md-4">
						{{ Form::label('groups', __('Groups'))}}
						<div id="groupDropdown"></div>
					</div>
					@if (!empty($sales_automation_activated) && $sales_automation_activated == 1)
					<div class="form-group col-md-4">
						{{ Form::label('goal_stage', __('Goal Stage'))}}
						{{ Form::select('goal_stage', $autoprocess_parent_stages, NULL, ['id' => 'goal_stage','class' => 'form-control']) }}
					</div>
					@endif
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						{{ Form::label('campaign_type', __('Campaign Type'))}}<br/>
						{{ Form::radio('campaign_type', 1) }} Notificational&nbsp;
						{{ Form::radio('campaign_type', 2) }} Promotional&nbsp;
						{{ Form::radio('campaign_type', 3) }} Transactional&nbsp;
						<span class="error" id ="type_err"></span>
					</div>
				</div>

				<br>
				<h6>Campaign Channels</h6>
					<div class="row">
						<div class="form-group col-md-3">
						{{ Form::label('lead_source_type', __('Source Info'))}}
						{{ Form::select('lead_source_type', $lead_source_types, $campaign->meta_data->source_type ?? null, ['class' => 'form-control', 'id' => 'lead_source_type', 'onchange' => 'leadSourceDropDownList(this.value)']) }}
						<span class="error" id ="lead_source_type_err"></span>
						<br/>
						{{ Form::select('lead_source', ['' => 'Select Lead Source'], '', ['class' => 'form-control', 'id' => 'lead_source']) }}
						{{ Form::hidden('selected_lead_source', $campaign->meta_data->source_id ?? null, array('id' => 'selected_lead_source')) }}
						<span class="error" id ="lead_source_err"></span>
						<br/>
						{{ Form::text('budget', $campaign->meta_data->budget ?? '', array('class' => 'form-control', 'id' => 'budget', 'placeholder' => 'Budget')) }}
						<span class="error" id ="budget_err"></span>
					</div>

					<div class="form-group col-md-3">
						{{ Form::label('field_1', __('Field 1'))}}
						{{ Form::text('field_1_title', $campaign->meta_data->field1 ?? '', array('class' => 'form-control', 'id' => 'field_1_title', 'placeholder' => 'Title')) }}
						<span class="error" id ="field_1_title_err"></span>
						<br/>
						{{ Form::textarea('field_1_content', $campaign->meta_data->field1_description ?? '', ['class' => 'form-control', 'id' => 'field_1_content', 'placeholder' => 'Content', 'rows' => 3]) }}
						<span class="error" id ="field_1_content_err"></span>
					</div>

					<div class="form-group col-md-3">
						{{ Form::label('field_2', __('Field 2'))}}
						{{ Form::text('field_2_title', $campaign->meta_data->field2 ?? '', array('class' => 'form-control', 'id' => 'field_2_title', 'placeholder' => 'Title')) }}
						<span class="error" id ="field_2_title_err"></span>
						<br/>
						{{ Form::textarea('field_2_content', $campaign->meta_data->field2_description ?? '', ['class' => 'form-control', 'id' => 'field_2_content', 'placeholder' => 'Content', 'rows' => 3]) }}
						<span class="error" id ="field_2_content_err"></span>
					</div>

					<div class="form-group col-md-3">
						{{ Form::label('field_3', __('Field 3'))}}
						{{ Form::text('field_3_title', $campaign->meta_data->field3 ?? '', array('class' => 'form-control', 'id' => 'field_3_title', 'placeholder' => 'Title')) }}
						<span class="error" id ="field_3_title_err"></span>
						<br/>
						{{ Form::textarea('field_3_content', $campaign->meta_data->field3_description ?? '', ['class' => 'form-control', 'id' => 'field_3_content', 'placeholder' => 'Content', 'rows' => 3]) }}
						<span class="error" id ="field_3_content_err"></span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-1">
						
					</div>
					
					<div class="col-md-1">
						
					</div>
					
					<div class="col-md-12 text-right">
						@if (!isset($campaign))
						<input type="button" name="" id="reset_btn" class="btn btn-outline-danger btn-sm px-4" value="Reset" onclick="resetCampaign()">
						@endif
			          <input type="button" name="" id="add_btn" class="btn btn-sm px-4 btn-primary" value="Submit" onclick="addCampaign()">
			        </div>
				</div>
			{!! Form::close() !!}
  </div>
</div>
@if (isset($campaign))
<div class="widget">
  <div class="widget-heading">
    <div class="row">
      <div class="col-12">
        <h2>Communication Channels</h2>
      </div>
    </div>
  </div>
  <div class="table-widget table-responsive mt-0 pt-0 p-3">
  	<div class="form-group">
        <label class="radio-inline">
          <input type="radio" class="form-group" name="camp_or_survey"  checked="checked" id="camp_or_survey" value="1" >
          Campaign </label>
        <label class="radio-inline">
          <input type="radio" class="form-group" name="camp_or_survey" id="camp_or_survey" value="2" >
          Survey </label>
        <br/>
    </div>
    <div id="survey_div" class="form-group" style="display: none;">
        <div class="col-sm-3 form-group">
          <label>Choose Survey</label>
          <select class="form-control" id="survey_id" name="survey_id" >
            <option value="">Survey</option>
            
              @foreach($survey_details as $det)
              @if(!empty($det['survey_questions']['id']) )  
                <option value="{{$det['survey_questions']['id']}}" >
           		@if(!empty($det['survey_questions']['survey_name_lang1'])){{ $det['survey_questions']['survey_name_lang1'] }} @else{{ $det['survey_questions']['survey_name_lang2'] }} @endif </option>
            	@endif
              @endforeach
            
          </select>
        </div>
    </div>
	<div class="communication-btns">

		<button type="button" id="email" class="btn btn-secondary btn-sm" onclick="get_mail_template()" data-toggle="modal" data-target="#mailtemplate"><i class="fas fa-envelope"></i> Email</button>
		<button type="button" class="btn btn-dark btn-sm" onclick="get_sms_template()" data-toggle="modal" data-target="#smstemplate"><i class="fas fa-comment-alt"></i> SMS</button>

		<button type="button" class="btn btn-success btn-sm" id="with_survey_auto" style="display: none;" onclick="" data-toggle="modal" data-target="#autodial_template_survey"><i class="fas fa-phone"></i> Autodial Survey</button>

		<button type="button" class="btn btn-success btn-sm" id="without_survey_auto" onclick="" data-toggle="modal" data-target="#autodial_template"><i class="fas fa-phone"></i> Autodial</button>
		<button type="button" class="btn btn-success btn-sm" id="with_survey_man"  style="display: none;" onclick="" data-toggle="modal" data-target="#manualcall_template_survey"><i class="fas fa-phone"></i> Manual Call survey</button>
		<button type="button" class="btn btn-success btn-sm" id="without_survey_man" onclick="" data-toggle="modal" data-target="#manualcall_template"><i class="fas fa-phone"></i> Manual Call</button>
		<button type="button" id="push_messages" class="btn btn-dark btn-sm" onclick="get_push_template()" data-toggle="modal" data-target="#push_template"><i class="fas fa-comment-alt"></i> Push Message</button>
	</div>
  </div>
</div>
@endif





</div>
<!-- survey manual call popup start -->	
<div id="manualcall_template_survey" class="modal modal-wide fade ">
  <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title">Manual Call</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body"> 
	  <form action="" method="POST" class="" name="" id ="call_form">
	  <div class="row">
      	<div class="col-md-12" id="msg_survey_manual"></div>
        <div class="col-md-6 form-group">
		<label>Title</label>
		<input type="text" class="form-control"  name="cmp_title_manual_survey" id="cmp_title_manual_survey" placeholder="Batch Title">
        </div>
        <div class="col-md-12 form-group">
		<label>Content</label>
		<textarea class="form-control"  name="new_content_manual_survey" id="new_content_manual_survey" placeholder="Content"></textarea>
        </div>
        <div class="col-md-6 form-group">
          <label>Query Type</label>
          <select class="get_query_cat get_query_status form-control"  name="query_type" id="query_type" >
            <option value="">Please choose a query type</option>
            {{Helpers::get_query_type(config('constant.FOLLOWUPS')) }}
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
<!-- survey manual call popup end -->
<!-- survey autocall popup start -->
<div id="autodial_template_survey" class="modal modal-wide fade ">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content col-md-11">
      <div class="modal-header">
        <h5 class="modal-title">AUTODIAL</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body"> 
	  <form action="" method="POST" class="" name="" id ="survey_enquiry_form">
	  <div id="msg_survey_auto"></div><br>
		<label>Title</label>
		<input type="text" class="form-control"  name="cmp_title_auto_survey" id="cmp_title_auto_survey" placeholder="Batch Title">
		
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
<!-- survey autocall poup end -->
@endsection

@section('footer-custom-css-js')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dropdown.css') }}">
	<script src="{{ asset('js/campaigns/add_campaign.js') }}"></script>
	<script src="{{ asset('js/jquery.dropdown.js') }}"></script>
@endsection