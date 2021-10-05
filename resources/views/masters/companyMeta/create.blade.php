@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Metadetails
@endsection
@section('content')

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-10 mt-3">
      <div class="widget">
        <h2>{{__('CompanyMeta')}}</h2>
        <div class="widget-content pt-3">  

	
				{!! Form::open(array('route' => 'company_meta.store', 'class' => 'form-common', 'method'=>'POST')) !!}
			
				@if(count($res))		
				@foreach($res as $meta)
					@php $value = $meta->meta_name; @endphp
					@php $$value = $meta->meta_value; @endphp
				@endforeach
				@endif
				@php 
					$doc_separator = $doc_separator ?? "/"; 
					$doc_number_format = $doc_number_format ?? "numeric_order"; 
					$doc_no_of_digits = $doc_no_of_digits ?? 8; 
				@endphp
				{{ csrf_field() }}
				<div class="row m-0 align-items-center">
				<div class="col-md-12"> <span class="response"></span>
				<div class="message"></div>
				</div>
				<div id="copy_user" class="profile-center">
				<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">      
						<a class="nav-item nav-link active show" id="nav-profile-tab" data-toggle="tab" href="#basic_details" role="tab" aria-controls="basic-prof" aria-selected="false">Basic Settings</a>
						@if(Helpers::checkPermission('chat settings'))     
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#communication" role="tab" aria-controls="basic-prof" aria-selected="true">Chat Settings</a> 
						@endif
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#mail_server" role="tab" aria-controls="basic-prof" aria-selected="true">Mail Server Settings</a> 
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#communication_channel" role="tab" aria-controls="basic-prof" aria-selected="true">Channel Settings</a> 
						@if(Helpers::checkPermission('escalation settings'))     
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#escalation" role="tab" aria-controls="basic-prof" aria-selected="true">Escalation Settings</a> 
						@endif
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#sales_automation" role="tab" aria-controls="basic-prof" aria-selected="true">Sales Automation Settings</a> 
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#others" role="tab" aria-controls="basic-prof" aria-selected="true">Other Settings</a>
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#docket_num_settings" role="tab" aria-controls="basic-prof" aria-selected="true">Docket Number</a>
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#enquiry_form" role="tab" aria-controls="basic-prof" aria-selected="true">Enquiry Form</a>
						
					</div>
				</nav>


				<div class="tab-content mb-3" id="nav-tabContent">             		
					<div class="tab-pane fade box-shadow active show" id="basic_details" role="tabpanel" aria-labelledby="nav-profile-tab">       
						<div class="row row-eq-height">                 
							<div class="col-sm-4 form-group">
								{{ Form::label('open', 'Open Status') }} 
								<select name="open_status" id="open_status" class="form-control">
								@php $open_status = (isset($open_status))?$open_status:''; @endphp
								@foreach ($query_status as $key => $value)           
								<option @if(isset($res) && $key == $open_status) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div> 
							<div class="col-sm-4 form-group">
								{{ Form::label('re_open', 'ReOpen Status') }} 
								<select name="re_open_status" id="re_open_status" class="form-control">
								@php $re_open_status = (isset($re_open_status))?$re_open_status:''; @endphp
								@foreach ($query_status as $key => $value)           
								<option @if(isset($res) && $key == $re_open_status) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div> 
							<div class="col-sm-4 form-group">	
								{{ Form::label('after_re_open', 'After ReOpen') }}
								<select name="after_re_open" id="after_re_open" class="form-control">
								@php $after_re_open = (isset($after_re_open))?$after_re_open:''; @endphp
								@foreach ($query_status as $key => $value)           
								<option @if(isset($res) && $key == $after_re_open) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							<div class="col-sm-4 form-group">
								{{ Form::label('agent', 'Callcenter Agent Role') }}
								<select name="agent" id="agent" class="form-control">
								@php $agent = (isset($agent))?$agent:''; @endphp
								@foreach ($roles as $key => $value)           
								<option @if(isset($res) && $key == $agent) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							<div class="col-sm-4 form-group">
								{{ Form::label('set_crm_source', 'CRM Lead Source') }}
								<select name="set_crm_source" id="set_crm_source" class="form-control">
								@php $set_crm_source = (isset($set_crm_source))?$set_crm_source:''; @endphp
						     	@foreach ($lead_sources as $key => $value)           
								<option @if(isset($res) && $key == $set_crm_source) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							<div class="form-group col-sm-4">
							{{ Form::label('email_header', 'Email Header Template') }}
								<select name="email_header" id="email_header" class="form-control">
								@php $email_header = (isset($email_header))?$email_header:''; @endphp
								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $email_header) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							<div class="form-group col-sm-4">
							{{ Form::label('email_footer', 'Email Footer Template') }}
								<select name="email_footer" id="email_footer" class="form-control">
								@php $email_footer = (isset($email_footer))?$email_footer:''; @endphp
								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $email_footer) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							<div class="col-sm-4 form-group">
								{{ Form::label('enquiry_email', 'Enquiry Email Template') }}
								<select name="enquiry_email" id="enquiry_email" class="form-control">
								@php $enquiry_email = (isset($enquiry_email))?$enquiry_email:''; @endphp
								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $enquiry_email) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							<div class="col-sm-4 form-group">
								{{ Form::label('enquiry_sms', 'Enquiry SMS Template') }}
								<select name="enquiry_sms" id="enquiry_sms" class="form-control">
								@php $enquiry_sms = (isset($enquiry_sms))?$enquiry_sms:''; @endphp
								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $enquiry_sms) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
								{{ Form::label('feedback_mail', 'Feedback Mail') }}
								<select name="feedback_mail" id="feedback_mail" class="form-control">
								@php $feedback_mail = (isset($feedback_mail))?$feedback_mail:''; @endphp
								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $feedback_mail) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
								{{ Form::label('feedback_sms', 'Feedback SMS') }}
								<select name="feedback_sms" id="feedback_sms" class="form-control">
								@php $feedback_sms = (isset($feedback_sms))?$feedback_sms:''; @endphp
								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $feedback_sms) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>

							<div class="form-group col-sm-4">
							{{ Form::label('content_missing_mail', 'Content Missing Mail') }}
								<select name="content_missing_mail" id="content_missing_mail" class="form-control">
									@php $content_missing_mail = (isset($content_missing_mail))?$content_missing_mail:''; @endphp
									@foreach ($templates as $key => $value)           
									<option @if(isset($res) && $key == $content_missing_mail) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
									@endforeach 
								</select> 
							</div>

							<div class="form-group col-sm-4">
							{{ Form::label('auto_mail_response', 'Auto Mail Response') }}
								<select name="auto_mail_response" id="auto_mail_response" class="form-control">
									@php $auto_mail_response = (isset($auto_mail_response))?$auto_mail_response:''; @endphp
									@foreach ($templates as $key => $value)           
									<option @if(isset($res) && $key == $auto_mail_response) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
									@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
							{{ Form::label('push_key', 'PUSH KEY') }}
								<input type="text" name="push_key" id="push_key" class="form-control" value="{{isset($push_key)?$push_key:''}}">
							</div>

							<div class="form-group col-sm-4">
							{{ Form::label('customer_label', 'Customer Label') }}
								<input type="text" name="customer_label" id="customer_label" class="form-control" value="{{isset($customer_label)?$customer_label:''}}">
							</div>
							
							<div class="form-group col-sm-4">
					            <label for="side_menu_set_extension">Side Menu Set Extension</label>
					          	<select name="side_menu_set_extension" class="form-control">
									<option value="0">Select an option</option>
					          		<option @if(isset($side_menu_set_extension) AND $side_menu_set_extension == '1'){{"selected"}}@endif value="1">Show in side menu</option>	
					          	</select>
				          	</div>

							<div class="col-md-12 text-right">
								<p>&nbsp;</p>
							</div>
						</div>
					</div>

					<div class="tab-pane fade box-shadow" id="communication" role="tabpanel" aria-labelledby="nav-profile-tab">       
						<div class="row row-eq-height">               
							<div class="col-sm-4 form-group">
								{{ Form::label('chat_ticket', 'Chat Ticket QueryType') }}
								<select name="chat_ticket" id="chat_ticket" class="form-control">
								@php $chat_ticket = (isset($chat_ticket))?$chat_ticket:''; @endphp
								@foreach ($query_types as $key => $value)           
								<option @if(isset($res) && $key == $chat_ticket) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach
								</select> 
							</div>
							<div class="col-sm-4 form-group">
								{{ Form::label('chat_agent', 'Chat Agent Role') }}
								<select name="chat_agent" id="chat_agent" class="form-control">
								@php $chat_agent = (isset($chat_agent))?$chat_agent:''; @endphp
								@foreach ($roles as $key => $value)           
								<option @if(isset($res) && $key == $chat_agent) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
								{{ Form::label('chat_transcript_mail', 'Chat Transcript Mail') }}
								<select name="chat_transcript_mail" id="chat_transcript_mail" class="form-control">
								@php $chat_transcript_mail = (isset($chat_transcript_mail))?$chat_transcript_mail:''; @endphp
								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $chat_transcript_mail) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
								{{ Form::label('chat_ticket_open_mail', 'Chat Ticket Open Mail') }}
								<select name="chat_ticket_open_mail" id="chat_ticket_open_mail" class="form-control">
								@php $chat_ticket_open_mail = (isset($chat_ticket_open_mail))?$chat_ticket_open_mail:''; @endphp
								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $chat_ticket_open_mail) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
								{{ Form::label('chat_ticket_closed_mail', 'Chat Ticket Closed Mail') }}
								<select name="chat_ticket_closed_mail" id="chat_ticket_closed_mail" class="form-control">
								@php $chat_ticket_closed_mail = (isset($chat_ticket_closed_mail))?$chat_ticket_closed_mail:''; @endphp
								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $chat_ticket_closed_mail) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
							{{ Form::label('lead_src_type_chat', 'Lead Source Type for Chat Application') }}
								<select name="lead_src_type_chat" id="lead_src_type_chat" class="form-control">
								@php $lead_src_type_chat = (isset($lead_src_type_chat))?$lead_src_type_chat:''; @endphp
								@foreach ($lead_source_types as $key => $value)           
								<option @if(isset($res) && $key == $lead_src_type_chat) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
						</div>
					</div>
					
				
				<div class="tab-pane fade box-shadow" id="mail_server" role="tabpanel" aria-labelledby="nav-profile-tab">  
					<div class="field_wrapper_companymeta">
					<div>
						<div class="row row-eq-height">               
							<div class="col-sm-4 form-group">
								{{ Form::label('mail_server_host_1', 'Mail Server Host') }}
								<input type="text" name="mail_server_host_1" id="mail_server_host_1" class="form-control" value="{{isset($mail_server_host_1)?$mail_server_host_1:''}}">
							</div>
							<div class="col-sm-4 form-group">
								{{ Form::label('mail_server_username_1', 'Mail Server Username') }}
								<input type="text" name="mail_server_username_1" id="mail_server_username_1" class="form-control" value="{{isset($mail_server_username_1)?$mail_server_username_1:''}}">
							</div>
							<div class="col-sm-4 form-group">
								{{ Form::label('mail_server_password_1', 'Mail Server Password') }}
								<input type="password" name="mail_server_password_1" id="mail_server_password_1" class="form-control" value="{{isset($mail_server_password_1)?$mail_server_password_1:''}}">
							</div>
						</div>
						<a href="javascript:void(0);" class="add_button_companymeta" title="Add field"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/add.png"/></a>
						<?php  if($host_count>1) { for($i=2;$i<=$host_count;$i++) { 
						$host = 'mail_server_host_'.$i; 
						$uname = 'mail_server_username_'.$i; 
						$password = 'mail_server_password_'.$i; 
						
						?>
						<div>
						<div class="row row-eq-height">               
							<div class="col-sm-4 form-group">
								<input type="text" name="mail_server_host_<?php echo $i; ?>" id="mail_server_host_<?php echo $i; ?>" class="form-control" value="{{isset($$host)?$$host:''}}">
							</div>
							<div class="col-sm-4 form-group">
								<input type="text" name="mail_server_username_<?php echo $i; ?>" id="mail_server_username_<?php echo $i; ?>" class="form-control" value="{{isset($$uname)?$$uname:''}}">
							</div>
							<div class="col-sm-4 form-group">
								<input type="password" name="mail_server_password_<?php echo $i; ?>" id="mail_server_password_<?php echo $i; ?>" class="form-control" value="{{isset($$password)?$$password:''}}">
							</div>
						</div>	
					<a href="javascript:void(0);" class="remove_button" id="remove_<?php echo $i; ?>"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/remove.png"/></a>
						</div>   	
						<?php  }  }  ?>
					</div>
					</div>
				</div>
					
		
					<div class="tab-pane fade box-shadow" id="communication_channel" role="tabpanel" aria-labelledby="nav-profile-tab">       
						<div class="row row-eq-height">               
							<div class="col-sm-12 form-group">
							
							{{ Form::label('communication_channel', 'Communication channel') }}
							</div><div class="col-sm-12 form-group">
							@if(isset($communication_channels))
							@foreach ($communication_channels as $key => $value)
								@php $sel=''; @endphp
								@if(isset($active_channels))
								@foreach($active_channels as $type_key => $val)
									@if($key == $type_key) 
										@php $sel='selected'; @endphp 
									@endif 
								@endforeach
								@endif 
								<input type="checkbox" name="check_list[]" class=" check_list" id="check_list" @if($sel != '')  checked="true" @endif value="{{ $key }}"  >  &nbsp;<label>{{ $value }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						   
							@endforeach
							@endif
						</div>
					</div>
					</div>

					<div class="tab-pane fade box-shadow" id="escalation" role="tabpanel" aria-labelledby="nav-profile-tab">       
						<div class="row row-eq-height">

							<div class="form-group col-sm-4">
					            <label for="escalation_required">Escalation Required</label>
					          	<select name="escalation_required" class="form-control">
					          		<option @if(isset($escalation_required) AND $escalation_required == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($escalation_required) AND $escalation_required == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>

				          	<div class="form-group col-sm-3">
								{{ Form::label('default_escalation_role', 'Default Escalation Role') }} 
								<select name="default_escalation_role" id="default_escalation_role" class="form-control">
								@php $default_escalation_role = (isset($default_escalation_role))?$default_escalation_role:''; @endphp
								@foreach ($roles as $key => $value)           
								<option @if(isset($res) && $key == $default_escalation_role) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>

							<div class="form-group col-sm-4">
					            <label for="escalation_due">Escalation Due</label>
					          	<select name="escalation_due" class="form-control">
					          		<option @if(isset($escalation_due) AND $escalation_due == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($escalation_due) AND $escalation_due == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>             
							
							<div class="form-group col-sm-4">
							{{ Form::label('esc_intimations_mail', 'Escalation Intimation Mail') }}
								<select name="esc_intimations_mail" id="esc_intimations_mail" class="form-control">
								@php $esc_intimations_mail = (isset($esc_intimations_mail))?$esc_intimations_mail:''; @endphp

								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $esc_intimations_mail) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
							{{ Form::label('esc_intimations_sms', 'Escalation Intimation SMS') }}
							<select name="esc_intimations_sms" id="esc_intimations_sms" class="form-control">
									 
								@php $esc_intimations_sms = (isset($esc_intimations_sms))?$esc_intimations_sms:''; @endphp

								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $esc_intimations_sms) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
							{{ Form::label('esc_summary_mail', 'Escalation Summary Report Mail') }}
								<select name="esc_summary_mail" id="esc_summary_mail" class="form-control">
								@php $esc_summary_mail = (isset($esc_summary_mail))?$esc_summary_mail:''; @endphp

								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $esc_summary_mail) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
							{{ Form::label('esc_summary_sms', 'Escalation Summary Report SMS') }}
							<select name="esc_summary_sms" id="esc_summary_sms" class="form-control">
									 
								@php $esc_summary_sms = (isset($esc_summary_sms))?$esc_summary_sms:''; @endphp

								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $esc_summary_sms) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
							{{ Form::label('esc_going_to_expire_mail', 'Escalation Going To Expire Mail') }}
								<select name="esc_going_to_expire_mail" id="esc_going_to_expire_mail" class="form-control">
								@php $esc_going_to_expire_mail = (isset($esc_going_to_expire_mail))?$esc_going_to_expire_mail:''; @endphp

								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $esc_going_to_expire_mail) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
								{{ Form::label('esc_going_to_expire_sms', 'Escalation Going To Expire SMS') }}
								<select name="esc_going_to_expire_sms" id="esc_going_to_expire_sms" class="form-control">
								@php $esc_going_to_expire_sms = (isset($esc_going_to_expire_sms))?$esc_going_to_expire_sms:''; @endphp
								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $esc_going_to_expire_sms) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
								{{ Form::label('esc_expired_mail', 'Escalation Expired Mail') }}
								<select name="esc_expired_mail" id="esc_expired_mail" class="form-control">
								@php $esc_expired_mail = (isset($esc_expired_mail))?$esc_expired_mail:''; @endphp
								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $esc_expired_mail) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
								{{ Form::label('esc_expired_sms', 'Escalation Expired SMS') }}
								<select name="esc_expired_sms" id="esc_expired_sms" class="form-control">
								@php $esc_expired_sms = (isset($esc_expired_sms))?$esc_expired_sms:''; @endphp
								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $esc_expired_sms) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
								{{ Form::label('esc_close_mail', 'Escalation Close Mail') }}
								<select name="esc_close_mail" id="esc_close_mail" class="form-control">
								@php $esc_close_mail = (isset($esc_close_mail))?$esc_close_mail:''; @endphp
								@foreach ($templates as $key => $value)           
								<option @if(isset($res) && $key == $esc_close_mail) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
						</div>
					</div>
		
					<div class="tab-pane fade box-shadow" id="sales_automation" role="tabpanel" aria-labelledby="nav-profile-tab">       
						<div class="row row-eq-height">               
							
							<div class="form-group col-sm-4">
								{{ Form::label('sales_automation_lead_stage', 'Sales Automation Lead') }}
								<select name="sales_automation_lead_stage" id="sales_automation_lead_stage" class="form-control">
								@php $sales_automation_lead_stage = (isset($sales_automation_lead_stage))?$sales_automation_lead_stage:''; @endphp
								@foreach ($auto_process_stages as $key => $value)           
								<option @if(isset($res) && $key == $sales_automation_lead_stage) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							
							<div class="form-group col-sm-4">
								{{ Form::label('auto_stage_activation', 'Escalation Automation Activation') }}
								<select name="auto_stage_activation" id="auto_stage_activation" class="form-control">
								@php $auto_stage_activation = (isset($auto_stage_activation))?$auto_stage_activation:''; @endphp
								<option value="">Please Select Option</option>
								<option value="{{config('constant.ACTIVE')}}" @if(isset($res) && ($auto_stage_activation == config('constant.ACTIVE'))) {{'selected'}}   @endif>Activate</option> 
								<option value="{{config('constant.INACTIVE')}}" @if(isset($res) && ($auto_stage_activation == config('constant.INACTIVE'))) {{'selected'}}   @endif>Deactivate</option>
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
								{{ Form::label('auto_stage_activation_customer', 'Sales Automation Activation') }}
								<select name="auto_stage_activation_customer" id="auto_stage_activation_customer" class="form-control">
								@php $auto_stage_activation_customer = (isset($auto_stage_activation_customer))?$auto_stage_activation_customer:''; @endphp
								<option value="">Please Select Option</option>
								<option value="{{config('constant.ACTIVE')}}" @if(isset($res) && ($auto_stage_activation_customer == config('constant.ACTIVE'))) {{'selected'}}   @endif>Activate</option> 
								<option value="{{config('constant.INACTIVE')}}" @if(isset($res) && ($auto_stage_activation_customer == config('constant.INACTIVE'))) {{'selected'}}   @endif>Deactivate</option>
								</select> 
							</div>
				
							<div class="form-group col-sm-4">
								{{ Form::label('sales_automation_failure_mailid', 'Sales Automation Failure Mailid') }}
								<input type="text" name="sales_automation_failure_mailid" id="sales_automation_failure_mailid" class="form-control" value="{{isset($sales_automation_failure_mailid)?$sales_automation_failure_mailid:''}}">
							</div>
				
							<div class="form-group col-sm-4">
								{{ Form::label('set_crm_automation_source', 'CRM Automation Source') }}
								<select name="set_crm_automation_source" id="set_crm_automation_source" class="form-control">
								@php $set_crm_automation_source = (isset($set_crm_automation_source))?$set_crm_automation_source:''; @endphp
								@foreach ($lead_sources as $key => $value)           
								<option @if(isset($res) && $key == $set_crm_automation_source) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
				
						</div>
					</div>
					<div class="tab-pane fade box-shadow" id="others" role="tabpanel" aria-labelledby="nav-profile-tab">       
						<div class="row row-eq-height">               
							
							<div class="form-group col-sm-4">
							{{ Form::label('set_unattended_call_source', 'Unattended Call Source') }}
								<select name="set_unattended_call_source" id="set_unattended_call_source" class="form-control">
								@php $set_unattended_call_source = (isset($set_unattended_call_source))?$set_unattended_call_source:''; @endphp
								@foreach ($lead_sources as $key => $value)           
								<option @if(isset($res) && $key == $set_unattended_call_source) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
							{{ Form::label('outbound_caller_id', 'Caller ID for Outbound Calls') }}
								<input type="text" name="outbound_caller_id" id="outbound_caller_id" class="form-control" value="{{isset($outbound_caller_id)?$outbound_caller_id:''}}">
							</div>
							<div class="form-group col-sm-4">
							{{ Form::label('set_manual_call_query_type', 'Set Campaign Manual Call Query Type') }}
								<select name="set_manual_call_query_type" id="set_manual_call_query_type" class="form-control">
								@php $set_manual_call_query_type = (isset($set_manual_call_query_type))?$set_manual_call_query_type:''; @endphp
								@foreach ($query_types as $key => $value)           
								<option @if(isset($res) && $key == $set_manual_call_query_type) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
							</select> 
							</div>
							<div class="form-group col-sm-4">
							{{ Form::label('set_abandoned_category', 'Set Abandoned Query Category') }}
								<select name="set_abandoned_category" id="set_abandoned_category" class="form-control">
								@php $set_abandoned_category = (isset($set_abandoned_category))?$set_abandoned_category:''; @endphp
								@foreach ($query_category as $key => $value)           
								<option @if(isset($res) && $key == $set_abandoned_category) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
							@endforeach 
							</select> 
							</div>
				
							<div class="form-group col-sm-4">
							{{ Form::label('set_after_hour_category', 'Set After Hour Query Category') }}
								<select name="set_after_hour_category" id="set_after_hour_category" class="form-control">
								@php $set_after_hour_category = (isset($set_after_hour_category))?$set_after_hour_category:''; @endphp
								@foreach ($query_category as $key => $value)           
								<option @if(isset($res) && $key == $set_after_hour_category) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
							
							<div class="form-group col-sm-4">
								{{ Form::label('set_holiday_category', 'Set Holiday Query Category') }}
								<select name="set_holiday_category" id="set_holiday_category" class="form-control">
								@php $set_holiday_category = (isset($set_holiday_category))?$set_holiday_category:''; @endphp
								@foreach ($query_category as $key => $value)           
								<option @if(isset($res) && $key == $set_holiday_category) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							
							</div>
						</div>
					</div>
					
					<div class="tab-pane fade box-shadow" id="docket_num_settings" role="tabpanel" aria-labelledby="nav-profile-tab">
						<div class="row row-eq-height">               
							
							<div class="form-group col-sm-3">
								<div class="row">
									<div class="col-sm-10">
							{{ Form::label('doc_cmpny_name', 'Company Short Name') }}
								<input maxlength=5 type="text" name="doc_cmpny_name" id="doc_cmpny_name" class="form-control" value="{{isset($doc_cmpny_name)?$doc_cmpny_name:''}}">
									</div>
									<div class="col-sm-2"><p>&nbsp;</p>
										<span class="slash">{{$doc_separator}}</span>
									</div>
								</div>		
							</div>
							<div class="form-group col-sm-3">
								<div class="row">
									<div class="col-sm-10">
							{{ Form::label('doc_short_code', 'Short Code of') }}
								<select name="doc_short_code" id="doc_short_code" class="form-control">
								<option value=''>Select</option>
								<option @if(isset($doc_short_code) AND $doc_short_code == 'query_type'){{"selected"}}@endif value='query_type'>Query Type</option>
								<option @if(isset($doc_short_code) AND $doc_short_code == 'category'){{"selected"}}@endif value='category'>Category</option>
								</select> 
									</div>
									<div class="col-sm-2"><p>&nbsp;</p>
										<span class="slash">{{$doc_separator}}</span>
									</div>
								</div>		
							</div>
							<div class="form-group col-sm-3">
								<div class="row">
									<div class="col-sm-10">
							{{ Form::label('doc_date_format', 'Date Format') }}
								<select name="doc_date_format" id="doc_date_format" class="form-control">
								<option value=''>Select</option>
								<option @if(isset($doc_date_format) AND $doc_date_format == 'dmY'){{"selected"}}@endif value='dmY'>dmY</option>
								<option @if(isset($doc_date_format) AND $doc_date_format == 'mdY'){{"selected"}}@endif value='mdY'>mdY</option>
								<option @if(isset($doc_date_format) AND $doc_date_format == 'Ymd'){{"selected"}}@endif value='Ymd'>Ymd</option>
								</select> 
									</div>
									<div class="col-sm-2"><p>&nbsp;</p>
										<span class="slash">{{$doc_separator}}</span>
									</div>
								</div>		
							</div>
							<div class="form-group col-sm-3">
								<div class="row">
									<div class="col-sm-10">
							{{ Form::label('doc_number_format', 'Number Format') }}
								<select name="doc_number_format" id="doc_number_format" class="form-control">
								<option @if(isset($doc_number_format) AND $doc_number_format == 'numeric_order'){{"selected"}}@endif value='numeric_order'>Numeric Order</option>
								<option @if(isset($doc_number_format) AND $doc_number_format == 'rand'){{"selected"}}@endif value='rand'>Random Number</option>
								</select> 
									</div>
									<div class="col-sm-2"><p>&nbsp;</p>
										<span class="slash"></span>
									</div>
								</div>		
							</div>
						</div>
						<div class="row row-eq-height">              
							<div class="form-group col-sm-1">
								{{ Form::label('doc_separator', 'Separator') }}
								<select name="doc_separator" id="doc_separator" class="form-control">
								<option @if(isset($doc_separator) AND $doc_separator == '/'){{"selected"}}@endif value='/'>/</option>
								<option @if(isset($doc_separator) AND $doc_separator == '-'){{"selected"}}@endif value='-'>-</option>
								<option @if(isset($doc_separator) AND $doc_separator == '#'){{"selected"}}@endif value='#'>#</option>
								<option @if(isset($doc_separator) AND $doc_separator == '_'){{"selected"}}@endif value='_'>_</option>
								</select> 
							</div>

							<div class="col-md-3 col-sm-3 form-group">
			                {{ Form::label('doc_no_of_digits', 'No.of Digits for Numeric Order') }}
                            {{ Form::number('doc_no_of_digits', $doc_no_of_digits, array('class' => 'form-control' ,'id' => 'doc_no_of_digits','max' =>'10','min'=>'6')) }}
			               
			                <span class="error" id ="sort_order_err"></span>						
			            </div>

						</div>
					</div>
					<div class="tab-pane fade box-shadow" id="enquiry_form" role="tabpanel" aria-labelledby="nav-profile-tab">
						<div class="row row-eq-height">               
							<div class="form-group col-sm-3">
					            <label for="status_show">Status</label>
					          	<select name="status_show" class="form-control">
					          		<option @if(isset($status_show) AND $status_show == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($status_show) AND $status_show == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>
				          	<div class="form-group col-sm-3">
								{{ Form::label('default_status', 'Default Status') }} 
								<select name="default_status" id="default_status" class="form-control">
								@php $default_status = (isset($default_status))?$default_status:''; @endphp
								@foreach ($query_status as $key => $value)           
								<option @if(isset($res) && $key == $default_status) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>

							<div class="form-group col-sm-3">
					            <label for="sub_category_show">Sub Category</label>
					          	<select name="sub_category_show" class="form-control">
					          		<option @if(isset($sub_category_show) AND $sub_category_show == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($sub_category_show) AND $sub_category_show == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>
								<div class="col-sm-3 form-group"> 
					            <label for="customer_nature_show">Customer Nature</label>
					          	<select name="customer_nature_show" class="form-control">
					          		<option @if(isset($customer_nature_show) AND $customer_nature_show == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($customer_nature_show) AND $customer_nature_show == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>
				          	<div class="col-sm-3 form-group"> 
					            <label for="action_taken_show">Action Taken</label>
					          	<select name="action_taken_show" class="form-control">
					          		<option @if(isset($action_taken_show) AND $action_taken_show == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($action_taken_show) AND $action_taken_show == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>
							<div class="form-group col-sm-3">
					            <label for="customer_priority_show">Customer Priority</label>
					          	<select name="customer_priority_show" class="form-control">
					          		<option @if(isset($customer_priority_show) AND $customer_priority_show == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($customer_priority_show) AND $customer_priority_show == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>
							<div class="form-group col-sm-3">
					            <label for="location_show">Location</label>
					          	<select name="location_show" class="form-control">
					          		<option @if(isset($location_show) AND $location_show == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($location_show) AND $location_show == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>

				          	<div class="form-group col-sm-3">
					            <label for="enquiry_location_show">Show Country, State, District</label>
					          	<select name="enquiry_location_show" class="form-control">
					          		<option @if(isset($enquiry_location_show) AND $enquiry_location_show == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($enquiry_location_show) AND $enquiry_location_show == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>

				          	<div class="form-group col-sm-3">
					            <label for="question_show">Question</label>
					          	<select name="question_show" class="form-control">
					          		<option @if(isset($question_show) AND $question_show == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($question_show) AND $question_show == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>
                                                <div class="form-group col-sm-3">
					            <label for="customer_response_type_show">Response Type</label>
					          	<select name="customer_response_type_show" class="form-control">
                                                                 <option value="">Select</option>
					          		<option @if(isset($customer_response_type_show) AND $customer_response_type_show == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($customer_response_type_show) AND $customer_response_type_show == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>
                                                <div class="form-group col-sm-3">
					            <label for="demo_show">Demo</label>
					          	<select name="demo_show" class="form-control">
                                                                <option value="">Select</option>
					          		<option @if(isset($demo_show) AND $demo_show == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($demo_show) AND $demo_show == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>
                             <div class="form-group col-sm-3">
					            <label for="eHealth_show">eHealth</label>
					          	<select name="eHealth_show" class="form-control">
                                                                <option value="">Select</option>
					          		<option @if(isset($eHealth_show) AND $eHealth_show == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($eHealth_show) AND $eHealth_show == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>
				          	<div class="form-group col-sm-3">
					            <label for="question_required">Question Required</label>
					          	<select name="question_required" class="form-control">
                                                               
					          		<option @if(isset($question_required) AND $question_required == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($question_required) AND $question_required == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>
                                                
				          	<div class="form-group col-sm-3">
					            <label for="attachments_required">Attachments Required</label>
					          	<select name="attachments_required" class="form-control">
					          		<option @if(isset($attachments_required) AND $attachments_required == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($attachments_required) AND $attachments_required == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>

				          	<div class="form-group col-sm-3">
					            <label for="title_required">Title Required</label>
					          	<select name="title_required" class="form-control">
					          		<option @if(isset($title_required) AND $title_required == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($title_required) AND $title_required == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>

				          	<div class="form-group col-sm-3">
					            <label for="answer_required">Answer Required</label>
					          	<select name="answer_required" class="form-control">
					          		<option @if(isset($answer_required) AND $answer_required == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($answer_required) AND $answer_required == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>

				          	<div class="form-group col-sm-3">
					            <label for="escalated_to_required">Escalated To Required</label>
					          	<select name="escalated_to_required" class="form-control">
					          		<option @if(isset($escalated_to_required) AND $escalated_to_required == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($escalated_to_required) AND $escalated_to_required == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>
							
							<div class="form-group col-sm-3">
					            <label for="officer_detail_show">Show Officer Details</label>
					          	<select name="officer_detail_show" class="form-control">
								<option @if(isset($officer_detail_show) AND $officer_detail_show == '2'){{"selected"}}@endif value="2">No</option>
					          		<option @if(isset($officer_detail_show) AND $officer_detail_show == '1'){{"selected"}}@endif value="1">Yes</option>	
					          			
					          	</select>
				          	</div>

				          	<div class="form-group col-sm-4">
							{{ Form::label('title_label', 'Title Label') }}
								<input type="text" name="title_label" id="title_label" class="form-control" value="{{isset($title_label)?$title_label:''}}">
							</div>

							<div class="form-group col-sm-4">
							{{ Form::label('answer_label', 'Answer Label') }}
								<input type="text" name="answer_label" id="answer_label" class="form-control" value="{{isset($answer_label)?$answer_label:''}}">
							</div>

							<div class="form-group col-sm-4">
							{{ Form::label('escalated_to_label', 'Escalated To Label') }}
								<input type="text" name="escalated_to_label" id="escalated_to_label" class="form-control" value="{{isset($escalated_to_label)?$escalated_to_label:''}}">
							</div>

				          	<div class="form-group col-sm-3">
					            <label for="answer_short_show">Answer Short</label>
					          	<select name="answer_short_show" class="form-control">
					          		<option @if(isset($answer_short_show) AND $answer_short_show == '1'){{"selected"}}@endif value="1">Yes</option>	
					          		<option @if(isset($answer_short_show) AND $answer_short_show == '2'){{"selected"}}@endif value="2">No</option>	
					          	</select>
				          	</div>

				          	<div class="form-group col-sm-3">
								{{ Form::label('default_query_type', 'Default Query Type') }} 
								<select name="default_query_type" id="default_query_type" class="form-control">
								@php $default_query_type = (isset($default_query_type))?$default_query_type:''; @endphp
								@foreach ($query_types as $key => $value)           
								<option @if(isset($res) && $key == $default_query_type) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>

							<div class="form-group col-sm-3">
								{{ Form::label('default_category', 'Default Category') }} 
								<select name="default_category" id="default_category" class="form-control">
								@php $default_category = (isset($default_category))?$default_category:''; @endphp
								@foreach ($query_category as $key => $value)           
								<option @if(isset($res) && $key == $default_category) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>

							<div class="form-group col-sm-3">
								{{ Form::label('default_query_status', 'Default Query Status') }} 
								<select name="default_query_status" id="default_query_status" class="form-control">
								@php $default_query_status = (isset($default_query_status))?$default_query_status:''; @endphp
								@foreach ($query_status as $key => $value)           
								<option @if(isset($res) && $key == $default_query_status) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>

							<div class="form-group col-sm-3">
								{{ Form::label('default_country', 'Default Country') }} 
								<select name="default_country" id="default_country" class="form-control">
								@php $default_country = (isset($default_country))?$default_country:''; @endphp
								@foreach ($countries as $key => $value)           
								<option @if(isset($res) && $key == $default_country) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>

							<div class="form-group col-sm-3">
								{{ Form::label('default_state', 'Default State') }} 
								<select name="default_state" id="default_state" class="form-control">
								@php $default_state = (isset($default_state))?$default_state:''; @endphp
								@foreach ($states as $key => $value)           
								<option @if(isset($res) && $key == $default_state) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
								@endforeach 
								</select> 
							</div>
								<div class="form-group col-sm-4">
							{{ Form::label('investigation_label', 'Investigation Label') }}
								<input type="text" name="investigation_label" id="investigation_label" class="form-control" value="{{isset($investigation_label)?$investigation_label:''}}">
							</div>
								<div class="form-group col-sm-4">
							{{ Form::label('prescription_label', 'prescription Label') }}
								<input type="text" name="prescription_label" id="prescription_label" class="form-control" value="{{isset($prescription_label)?$prescription_label:''}}">
							</div>
								</div>		
							</div>
<input  type="hidden" name="tabid" id="tabid"  value="{{$tabid ?? ''}}">	
					<div style="margin-top: -2px;padding:15px; background:#fff;" class="box-shadow col-md-12 text-right">
						<button type="reset" class="btn btn-outline-danger btn-sm px-4">Reset</button>
						<button type="submit" class="btn btn-primary btn-sm px-4"> Save </button>
					</div>
				</div>
			</div>
						
					{!! Form::close() !!}
					
					
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	
	$(document).ready(function () {
		var tabid=$('#tabid').val();
		
		if(tabid == 'communication')
		{
			$('.nav-tabs a[href="#communication"]').tab('show');
		}else if(tabid == 'mail_server')
		{
			$('.nav-tabs a[href="#mail_server"]').tab('show');
		}else if(tabid == 'communication_channel')
		{
			$('.nav-tabs a[href="#communication_channel"]').tab('show');
		}else if(tabid == 'escalation')
		{
			$('.nav-tabs a[href="#escalation"]').tab('show');
		}else if(tabid == 'sales_automation')
		{
			$('.nav-tabs a[href="#sales_automation"]').tab('show');
		}else if(tabid == 'others')
		{
			$('.nav-tabs a[href="#others"]').tab('show');
		}else if(tabid == 'docket_num_settings')
		{
			$('.nav-tabs a[href="#docket_num_settings"]').tab('show');
		}
		else if(tabid == 'enquiry_form')
		{
			$('.nav-tabs a[href="#enquiry_form"]').tab('show');
		}else{
			$('.nav-tabs a[href="#basic_details"]').tab('show');
		}
		
    });
</script>
@endsection
