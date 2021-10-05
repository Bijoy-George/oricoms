	<div class="widget">
	<h2>{{__('Enquiry Form')}}</h2>
    <div class="col-md-12 py-2">
		<div class="w100 clearfix">
			
			<div class="panel-body">
				<script>
					$( document ).ready(function() {
        $("#query_type").change(function(){
        	
		$.ajax({
        type: "POST",
        url:"{{ url('/check_query_type') }}",
        data:{
        	'query_type':$('#query_type').val(),
        	 "_token": "{{ csrf_token() }}",
        },			
		dataType: "json",
		 success: function (data) {

		 	if(data.success)
		 	{
		 		$("#title_lb").text(data.title_lb);
		 		$("#answer_short_lb").text(data.answer_short_lb);
		 				 	
		 }
		 else{
		 	$("#title_lb").text("Title");
		 	$("#answer_short_lb").text("Answer Short");
		 }
		 },
		    error: function (data) {  

		    }
        });
    });
    });
				</script>

			<!--<div class="message"></div>-->
			{!! Form::open(array('route' => 'enquiry.store', 'id' => 'enquiry_form', 'class' => 'enquiry_form form-common1 form-upload jo', 'method'=>'POST')) !!}
				{{ csrf_field() }}
			<input type="hidden" id="default_category" value="{{ !empty(Helpers::get_company_meta('default_category')) ? Helpers::get_company_meta('default_category') : 0 }}">
			<div class="row">
			<!-- <div class="col-sm-6 form-group"> -->
				@if(Auth::user()->cmpny_id != 32)
				<div class="col-sm-6 form-group">
				<label for="title" class="control-label">{{{__('Query Type')}}}<span class="red_star">*</span></label>

				<select name="query_type" class="get_query_cat form-control get_query_status" id="query_type">
					<option value="">Select</option> 
         			 @foreach ($query_types as $query_type)             
      				<option data-short-code="{{$query_type->short_code}}" data-type="{{$query_type->type}}" value="{{$query_type->id}}" @if(Helpers::get_company_meta('default_query_type') == $query_type->id) selected @endif >{{$query_type->query_type}}</option>
		     		@endforeach 
       			 </select> 				
				<span class="error" id="query_type_err"></span>
			</div>
			@endif
			@if(Auth::user()->cmpny_id == 32)
			<div class="col-sm-6 form-group"  style="display:none;">
				<select name="query_type" class="get_query_cat form-control get_query_status" id="query_type">
					<option value="">Select</option> 
         			 @foreach ($query_types as $query_type)             
      				<option data-short-code="{{$query_type->short_code}}" data-type="{{$query_type->type}}" value="{{$query_type->id}}" @if(Helpers::get_company_meta('default_query_type') == $query_type->id) selected @endif >{{$query_type->query_type}}</option>
		     		@endforeach 
       			 </select> 
       			</div>
       			 @endif
	<!-- 		</div> -->
						
			@if(Helpers::get_company_meta('status_show') != 2)
			@if(Helpers::get_company_meta('eHealth_show') != 1)
			<div class="col-sm-6 form-group">
				<label for="query_status" class="control-label">{{__('Status')}}<span class="red_star">*</span></label>
				{{ Form::select('query_status', ['' => 'Select'], null, ['class' => 'query_status form-control', 'id' => 'query_status']) }}					
				<span class="error" id="query_status_err"></span>
			</div> 
			@endif
			@else
			@if(Helpers::get_company_meta('eHealth_show') != 1)
				<input type="hidden" name="query_status" class="query_status" value="{{Helpers::get_company_meta('default_status')}}">
			@endif
			@endif
                       @if(Helpers::get_company_meta('customer_response_type_show') == 1)
			<div class="col-sm-6 form-group">
				<label for="customer_response_type" class="control-label">{{__('Customer Response Type')}}</label>
				{{ Form::select('customer_response_type', $customer_response_types, null, ['class' => 'form-control get_cust_response', 'id' => 'customer_response_type']) }}					
				<span class="error" id="customer_response_type_err"></span>
			</div>

			<div class="col-sm-6 form-group">
				<label for="customer_response" class="control-label">{{__('Customer Response')}}</label>
				{{ Form::select('customer_response', ['' => 'Select Customer Response'], null, ['class' => 'form-control customer_response get_other_customer_response', 'id' => 'customer_response']) }}					
				<span class="error" id="customer_response_err"></span>
			</div>
			@endif			<div class="col-sm-6 form-group">
				<label for="query_category" class="control-label">@if(Auth::user()->cmpny_id == 32){{{__('Designation')}}}@else{{{__('Category')}}}@endif<span class="red_star">*</span></label>
				{{ Form::select('query_category', ['' => 'Select'], null, ['class' => 'form-control faq_cat_id get_sub_category', 'id' => 'query_category']) }}					
				<span class="error" id="query_category_err"></span>
			</div>
			@if(Helpers::get_company_meta('sub_category_show') != 2)
			<div class="col-sm-6 form-group">
				<label for="sub_query_category" class="control-label">{{__('Sub Category')}}<span class=""></span></label>
				{{ Form::select('sub_query_category', ['' => 'Select'], null, ['class' => 'form-control sub_cat_id get_other_sub_category', 'id' => 'sub_query_category']) }}					
				<span class="error" id="sub_query_category_err"></span>
			</div>
			@endif
                        @if(Helpers::get_company_meta('demo_show') == 1)
			<div class="col-sm-6 form-group">
				<label for="demo" class="control-label">{{__('Show Demo')}}<span class=""></span></label>
				{{ Form::select('demo', $demo,null, ['class' => 'form-control demo', 'id' => 'demo']) }}					
				<span class="error" id="demo_err"></span>
			</div>
			@endif
			<div class="col-sm-6 form-group other-category" style="display:none;">
				<label for="other_category" class="control-label">{{__('Other Category')}}</label>
				{{ Form::text('other_category', null, array('id' => 'other_category','class' => 'form-control','autocomplete'=>'off')) }}
				<span class="error" id="other_category_err"></span>
			</div>
			<div class="col-sm-6 form-group other-sub-category" style="display:none;">
				<label for="other_subcategory" class="control-label">{{__('Other Sub Category')}}</label>
				{{ Form::text('other_subcategory', null, array('id' => 'other_subcategory','class' => 'form-control','autocomplete'=>'off')) }}
				<span class="error" id="other_category_err"></span>
			</div>
			@if(Helpers::get_company_meta('customer_nature_show') != 2)
			<div class="col-sm-6 form-group">
				<label for="customer_nature" class="control-label">{{__('Customer Nature')}}</label>
				{{ Form::select('customer_nature', $customer_natures, null, ['class' => 'form-control']) }}					
				<span class="error" id="customer_nature_err"></span>
			</div>
			@endif
			@if(Helpers::get_company_meta('action_taken_show') == 1)
			<div class="col-sm-6 form-group">
				<label for="action_taken" class="control-label">{{__('Action Taken')}}</label>
				{{ Form::select('action_taken', $query_actions, null, ['class' => 'form-control']) }}					
				<span class="error" id="action_taken_err"></span>
			</div>
			@endif
			@if(Helpers::get_company_meta('customer_priority_show') != 2)
			<div class="col-sm-6 form-group">
				<label for="priority" class="control-label">{{__('Priority')}}</label>
				{{ Form::select('priority', $priorities, null, ['class' => 'form-control']) }}					
				<span class="error" id="priority_err"></span>
			</div>
			@endif
			@if(Helpers::get_company_meta('enquiry_location_show') != 2)
				<div class="col-sm-6 form-group"> 
					<label for="country_id">Country</label>
					<select name="country_id" class="form-control country_id">
						<option value="">Select Country</option>
						@foreach ($country_arr as $country)
							<option value="{{ $country->id }}" data-other="{{ $country->is_other }}" @if($customer && $customer->country_id == $country->id)selected 
							@elseif(Helpers::get_company_meta('default_country') == $country->id)
							selected
							@endif >{{ $country->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-6 form-group other_country" @if(!$is_other_country) style="display: none;" @endif >
              		<label for="other_country">Other Country </label>
              		<input type="text" class="form-control" name="other_country" id="other_country" value="@if($customer && isset($customer->other_country)) {{$customer->other_country}} @endif">
            </div>
				<div class="col-sm-6 form-group"> 
		          <label for="state_id">State</label>
		          	<select name="state_id" class="form-control state_id">
		          		<option value="">Select State</option>	
		          	</select>
	          	</div>
	          	<div class="col-sm-6 form-group"> 
		         	 <label for="district_id">District<span class="red_star">*</span></label>
					@if(Helpers::get_company_meta('eHealth_show') == 1)
						 <select name="district_id" class="form-control district_id get_institution" id="district_ide">
							<span class="error" id="district_err"></span>
					 @else
		         	<select name="district_id" class="form-control district_id officer_details ">
				<span class="error" id="district_err"></span>

				     @endif
		         		<option value="">Select District</option>
		          	</select>
	          	</div>
				@if(Helpers::get_company_meta('eHealth_show') == 1)
				<div class="col-sm-6 form-group">
				<label for="query_status" class="control-label">{{__('Institution')}}<span class="red_star" id="insti_man" style= "display:none;">*</span></label>
				{{ Form::select('institution', ['' => 'Select'], null, ['class' => 'institution form-control', 'id' => 'institution','required']) }}					
				<span class="error" id="institution_err"></span>
			   </div>
               <div class="col-sm-6 form-group">
				<label for="title" class="control-label">{{__('Issue')}}<span class="red_star">*</span></label>
				<select name="issue" class="get_nature_of_call form-control" id="issue" required = "true">
					<option value="">Select</option> 
         			 @foreach ($issues as $issue)             
      				<option data-short-code="{{$issue->short_code}}" data-type="{{$issue->type}}" value="{{$issue->id}}" @if(Helpers::get_company_meta('default_query_type') == $issue->id) selected @endif >{{$issue->query_type}}</option>
		     		@endforeach 
       			 </select> 				
				<span class="error" id="issue_err"></span>
			   </div>
              <div class="col-sm-6 form-group">
				<label for="nature_of_call" class="control-label">{{__('Nature of Call')}}<span class="red_star">*</span></label>
				{{ Form::select('nature_of_call', ['' => 'Select'], null, ['class' => 'nature_of_call form-control', 'id' => 'nature_of_call']) }}					
				<span class="error" id="nature_of_call_err"></span>
			   </div>
			   <div class="col-sm-6 form-group fwc_bs" style="display:none;">
                
					<label for="fwc_bs" class="control-label">{{__('FWC/BS')}}</label>
					{{ Form::text('fwc_bs', null, array('id' => 'fwc_bs','class' => 'form-control','autocomplete'=>'off')) }}
					<span class="error" id="fwc_bs_err"></span>
				</div>
                <div class="col-sm-6 form-group pen_nor" style="display:none;">
					<label for="pen_no" class="control-label">{{__('Pen No')}}<span class="red_star" id="pen_man" style= "display:none;">*</span></label>
					{{ Form::text('pen_no', null, array('id' => 'pen_norr','class' => 'form-control','autocomplete'=>'off')) }}
					<span class="error" id="pen_no_err"></span>
				</div>
                <div class="col-sm-6 form-group utid" style="display:none;">
					<label for="utid" class="control-label">{{__('UTID of Tab')}}</label>
					{{ Form::text('utid', null, array('id' => 'utid','class' => 'form-control','autocomplete'=>'off')) }}
					<span class="error" id="utid_err"></span>
				</div>
				 <div class="col-sm-6 form-group">
				<label for="complaint_resolve" class="control-label">{{__('Complaint Resolved at Call Centre')}}<span class="red_star">*</span></label>
				<select name="complaint_resolve" class="form-control get_measure_taken" id="complaint_resolve">
		         		<option value="">Select</option>
		         		<option value="1">Yes</option>
		         		<option value="0">NO</option>
		        </select>
				<span class="error" id="complaint_resolve_err"></span>
				</div>
				@if(Helpers::get_company_meta('eHealth_show') == 1)
			<div class="col-sm-6 form-group">
				<label for="query_status" class="control-label">{{__('Status')}}<span class="red_star">*</span></label>
				{{ Form::select('query_status', ['' => 'Select'], null, ['class' => 'query_status form-control', 'id' => 'query_status']) }}					
				<span class="error" id="query_status_err"></span>
			</div> 
			@endif

				
				
				<div class="col-sm-6 form-group measure_taken" style="display:none;">
				<label for="measure_taken" class="control-label">{{__('Measure Taken')}}<span class="red_star">*</span></label>
				<select name="measure_taken" class="form-control" id="measure_taken">
					<option value="">Select Measure</option> 
         			 @foreach ($measure_taken as $measure)             
      				<option data-short-code="{{$measure->short_code}}" data-type="{{$measure->type}}" value="{{$measure->id}}" @if(Helpers::get_company_meta('default_query_type') == $measure->id) selected @endif >{{$measure->query_type}}</option>
		     		@endforeach 
       			 </select> 				
				<span class="error" id="measure_taken_err"></span>
			   </div>
			   @endif
			   
				 
	          	@endif
				{{--@if(Helpers::get_company_meta('officer_detail_show') == 1)
					<!--<div class="col-sm-6 form-group" id="call_div">
					</div>-->
					<div class="col-sm-6 form-group" style="display:none;" id="officer_div"> 
					<label for="district_id">Officer Details</label>
					<select name="officer_dets" class="form-control officer_dets" id="officer_dets" style="display:none;">
		         		<option value="">Select Officer</option>
		          	</select>
					</div>
					<div class="col-sm-6 form-group" id="call_redirect"></div>
				@endif--}}
			<!--</div>
			<div class="row opt_field_con">-->
				
				
				<?php// dd($query_status); ?>
				<div class="col-sm-6 opt_field CSD SCHL form-group">
					<label for="district_supply_office" class="control-label">{{__('District Supply Office')}}</label>
					{{ Form::select('district_supply_office', $district_supply_office, null, ['class' => 'district_supply_office form-control get_taluk_supply_office', 'id' => 'district_supply_office']) }}					
					<span class="error" id="district_supply_office_err"></span>
				</div>
				<div class="col-sm-6 opt_field CSD SCHL form-group">
					<label for="taluk_supply_office" class="control-label">{{__('Taluk Supply Office')}}<span class=""></span></label>
					{{ Form::select('taluk_supply_office', ['' => 'Select'], null, ['class' => 'form-control taluk_supply_office']) }}					
					<span class="error" id="taluk_supply_office_err"></span>
				</div>
				<div class="col-sm-6 opt_field CSD SCHL form-group">
					<label for="supply_cards" class="control-label">{{__('Card Category')}}</label>
					{{ Form::select('supply_cards', $supply_cards, null, ['class' => 'form-control supply_cards', 'id' => 'supply_cards']) }}					
					<span class="error" id="supply_cards_err"></span>
				</div>
				<div id="card_no" class="col-sm-6 opt_field CSD SCHL form-group">
					<label for="card_no" class="control-label">{{__('Card / Consumer No.')}}</label>
					{{ Form::text('card_no', null, array('id' => 'card_no','class' => 'form-control','autocomplete'=>'off')) }}
					<span class="error" id="card_no_err"></span>
				</div>
				<div class="col-sm-6 opt_field CSD SCHL form-group">
					<label for="ard_no" class="control-label">{{__('ARD No / Gas Agency')}}</label>
					{{ Form::text('ard_no', null, array('id' => 'ard_no','class' => 'form-control','autocomplete'=>'off')) }}
					<span class="error" id="ard_no_err"></span>
				</div>
				@if(Helpers::get_company_meta('location_show') == 1)
				<div id="location1" class="col-sm-6  form-group">
					<label for="location" class="control-label">{{__('Location')}}</label>
					{{ Form::text('location', null, array('id' => 'location','class' => 'form-control','autocomplete'=>'off')) }}
					<span class="error" id="location_err"></span>
				</div>
				@endif
			</div>
			<div class="row">
				
				@if(count($local_body_type) > 0)
	          	<div class="col-sm-6 form-group"> 
					<label for="taluk_id">Taluk</label>
					<select name="taluk_id" class="form-control taluk_id">
						<option value="">Select Taluk</option>
					</select>
				</div>
				<div class="col-sm-6 form-group"> 
					<label for="village_id">Village</label>
					<select name="village_id" class="form-control village_id"><option value="">Select Village</option></select>
				</div>
				<div class="col-sm-6 form-group"> 
					<label for="local_body_type">Local Body Type</label>
					<select name="local_body_type" class="form-control local_body_type">
						<option value="">Select </option>
						<option value="1">Panchayath</option>
						<option value="2">Municipality</option>
						<option value="3">Municipal Corporation</option>
					</select>
				</div>
				<div style="display: none" class="col-sm-6 form-group pan_type_div">
					<label for="panchayath_type">Panchayath Type</label>
					<select name="panchayath_type" class="form-control panchayath_type">
					</select>
				</div>
				<div style="display: none" class="col-sm-6 form-group muncipality_div">
					<label for="muncipality_id">Muncipality</label>
					<select name="muncipality_id" class="form-control muncipality_id">
					</select>
				</div>
				<div style="display: none" class="col-sm-6 form-group corporation_div">
					<label for="corporation_id">Corporation</label>
					<select name="corporation_id" class="form-control corporation_id">
					</select>
				</div>
				<div style="display: none;" class="col-sm-6 form-group blk_pan_div">
					<label for="block_panchayath_id">Block Panchayath</label>
					<select name="block_panchayath_id" class="form-control block_panchayath_id">
						<option value="">Select Panchayath Type</option>
					</select>
				</div>
				<div style="display: none" class="col-sm-6 form-group gra_pan_div">
					<label for="grama_panchayath_id">Grama Panchayath</label>
					<select name="grama_panchayath_id" class="form-control grama_panchayath_id">
					</select>
				</div>
				<div style="display: none" class="col-sm-6 form-group dis_pan_div">
					<label for="district_panchayath_id">District Panchayath</label>
					<select name="district_panchayath_id" class="form-control district_panchayath_id">
						<option value="">Select Panchayath Type</option>
					</select>
				</div>
			@endif	
			</div>

			<div class="row">

			@if (Auth::user()->cmpny_id == config('constant.EHEALTH_CMPNY'))
			<div class="col-sm-12 form-group">
			
				<label for="req_title" class="control-label">{{ ('Remarks') }} 
			@if(Helpers::get_company_meta('title_required') != 2)<span class="red_star">*</span>@endif</label>
				{{ Form::text('req_title', null, array('id' => 'req_title','class' => 'form-control','autocomplete'=>'off')) }}
				<span class="error" id="req_title_err"></span>
				
			</div>
			@else
                       <div class="col-sm-12 form-group">
			
				<label for="req_title" id="title_lb" class="control-label">{{ !empty(Helpers::get_company_meta('title_label')) ? Helpers::get_company_meta('title_label') : 'Title' }} 
			@if(Helpers::get_company_meta('title_required') != 2)<span class="red_star">*</span>@endif</label>
				{{ Form::text('req_title', null, array('id' => 'req_title','class' => 'form-control','autocomplete'=>'off')) }}
				<span class="error" id="req_title_err"></span>
				
			</div>				
                        @endif   							
			@if(Helpers::get_company_meta('question_show') != 2)					
			<div class="col-sm-12 form-group">
				<label for="question" class="control-label">{{__('Question')}}
					@if(Helpers::get_company_meta('question_required') != 2)<span class="red_star">*</span>@endif</label>
				{{ Form::textarea('question', null, array('id' => 'question', 'class' => 'form-control' )) }}
				<span class="error" id="question_err"></span>
			</div>
			@else
				<div style="display: none;" class="col-sm-12 form-group">
					{{ Form::textarea('question', 'Sabarimala helpline', array('id' => 'question', 'class' => 'form-control' )) }}
				</div>
			@endif
			<div class="col-sm-12 form-group">
                                
				<label for="answer" class="control-label">
{{ !empty(Helpers::get_company_meta('answer_label')) ? Helpers::get_company_meta('answer_label') : 'Answer' }}</label>			
				{{ Form::textarea('answer', null, array('id' => 'answer', 'class' => 'form-control' )) }}
				<span class="error" id="answer_err"></span>
			</div>
			@if(Helpers::get_company_meta('answer_short_show') != 2)
			<div class="col-sm-12 form-group">
				<label for="short_message" id="answer_short_lb" class="control-label">{{__('Answer Short')}}</label>		@php $maxlength = config('constant.sms_max_length'); @endphp									
				{{ Form::textarea('short_message', null, array('maxlength' => "$maxlength",'rows' => '2', 'id' => 'short_message', 'class' => 'sms_content form-control'  )) }}
				<span class="error" id="short_message_err"></span>
				<span id="remain" class="pull-right"></span>
			</div>
			@endif
			<div class="col-sm-12">
			<div class="row align-items-center">
				<div class="col-sm-6 form-group col-mail-12">
					<div class="datetime-outer">
					{{ Form::text('remainder_date', null, array('id' => 'remainder_date', 'class' => 'form-control datetimepicker11', 'autocomplete' => 'off','placeholder' => 'Next Followup Date' )) }}
					</div>
					<span class="error" id="remainder_date_err"></span>
				</div>
				<div class="col-sm-2 form-group col-mail-4">
					{{ Form::checkbox('need_followup', null, false ,array('class' => 'custom-checkbox','id' => 'need_followup')) }}
                    <label for="need_followup" class="custom-checkbox-label">{{__('Followup')}}</label>	
					<span class="error" id="need_followup_err"></span>
				</div>
				<div class="col-sm-2 form-group col-mail-4">
					{{ Form::checkbox('chk_email', null, false ,array('class' => 'custom-checkbox','id' => 'chk_email')) }}
                    <label for="chk_email" class="custom-checkbox-label">{{__('Email')}}</label>
					<span class="error" id="chk_email_err"></span>
				</div>
				<div class="col-sm-2 form-group col-mail-4">
					{{ Form::checkbox('chk_sms', null, false ,array('class' => 'custom-checkbox','id' => 'chk_sms')) }}
                    <label for="chk_sms" class="custom-checkbox-label">{{__('SMS')}}</label>
					<span class="error" id="chk_sms_err"></span>
				</div>
			</div>
			</div>
			<div class="col-sm-12">
			<div class="row escalate_box" style="display:none;">
				@if(Helpers::checkPermission(config('constant.ESCALATE')))
				@if(empty(Helpers::get_company_meta('default_escalation_role')))
				<div class="col-sm-6 form-group">
					<label for="role_type" class="control-label">{{__('Role Type')}}</label>
					
					{{ Form::select('role_type', $role_types, null, ['class' => 'get_users form-control']) }}
					
					
					<span class="error" id="role_type_err"></span>
				</div>
				@else
				<input type="hidden" name="role_type" value="{{ Helpers::get_company_meta('default_escalation_role') }}" class="get_users">
				@endif
				<div class="col-sm-6 form-group">
					<label for="escalate_to" class="control-label">{{ !empty(Helpers::get_company_meta('escalated_to_label')) ? Helpers::get_company_meta('escalated_to_label') : 'Escalate To' }} @if(Helpers::get_company_meta('escalated_to_required') == 1)<span class="red_star">*</span>@endif</label>											
					{{ Form::select('escalate_to', ['' => 'Select'], null, ['class' => 'escalate_to form-control', 'id' => 'escalate_to']) }}
					<span class="error" id="escalate_to_err"></span>
				</div>
				@if(Helpers::get_company_meta('escalation_due') != 2)
				<div class="col-sm-6 form-group">
					<label for="" class="control-label">{{__('Resolve within')}}</label>
					{{ Form::radio('action', 2, false ,array('class' => 'action','id' => 'action')) }}
					<label for="" class="control-label">{{__('Minute ')}}</label>
					
					{{ Form::radio('action', 1, false ,array('class' => 'action','id' => 'action')) }}
					<label for="" class="control-label">{{__('Hour ')}}</label>
					
					{{ Form::radio('action', 3, false ,array('class' => 'action','id' => 'action')) }}
					<label for="" class="control-label">{{__('Day ')}}</label>
				</div>
				<div class="col-sm-2 form-group">
					<select class="form-control hideerror" id="est_time" name="est_time">
					   <option value="1">1</option>
					   <option value="2">2</option>
					   <option value="3">3</option>
					   <option value="4">4</option>
					   <option value="5">5</option>
					   <option value="6">6</option>
					   <option value="7">7</option>
					   <option value="8">8</option>
					   <option value="9">9</option>
					 <?php for($k=10;$k<=1000;$k) { ?>
							<option value="{{$k}}">{{$k}}</option>
						<?php $k= $k+10;} ?>
					</select>
				</div>
				@endif
				@endif

				@if(Helpers::get_company_meta('attachments_required') != 2)
				<div class="col-sm-12 form-group">
		          	<div class="advancedUpload">Upload</div>
					<!-- <input type="hidden" value="" id="batchId" /> -->
					<!-- <input type="hidden" value="" id="emailId" /> -->
					<!-- <input type="hidden" value="" id="emailType"> -->
					<input type="hidden" value="" name="attachments" id="attach">
					<input type="hidden" value="" id="callbackFunc">
					<!-- <input type="hidden" value="" id="campaignId"> -->
		        </div>
		        @endif	
			</div>
			</div>
			<div class="col-sm-12">	   
			<div class="text-right">
				 <!--<div id="msg" role="alert" class="alert"></div>
				 <div class="message alert" role="alert"></div>-->
				<!--<input type="hidden" class="" id="attachments" name="attachments" value=""/>-->
				<input type="hidden" class="add_to_faq" id="add_to_faq" name="add_to_faq" value=""/>
				<input type="hidden" class="callback" value="show_listing"/>
				<button type="reset" class="btn btn-outline-danger btn-sm px-4" >
						 {{__('Reset')}}
				</button>
                <button type="button" onclick="cmn_attachment_upload('123')" id="save_profile_enquiry" class="btn btn-primary btn-sm px-4">
               <!--  <button type="button" id="save_profile_enquiry" class="btn btn-primary btn-sm px-4"> -->
					{{__('Save')}}
				</button>
				<span class="faqadd" onclick="save_faq_from_enquiry()" class="btn btn-success btn-sm" id="1save_profile_enquiry">Add to FAQ</span>  
				
			</div>
			</div>
			</div>
				{{ Form::hidden('customer_id', $customer_id, array('id' => 'customer_id', 'class' => 'form-control' )) }}
				{{ Form::hidden('id', null, array('class' => 'form-control' )) }}
			{!! Form::close() !!}


			{{--{!! Form::open(array('route' => 'enquiry.store', 'id' => 'enquiry_form', 'class' => 'form-common1 form-upload ela', 'method'=>'POST')) !!}
				{{ csrf_field() }}--}}


				<!--<div class="form-group">

              <div class="advancedUpload2">Upload.....</div>

             
              <input type="text" value="" id="attach">
              <input type="hidden" value="" id="callbackFunc">
            </div>


				 <button type="button" onclick="attachmentUpload1()" id="save_profile_enquiry" class="btn btn-primary btn-sm px-4">-->

			{{--{!! Form::close() !!}--}}


			</div>
		</div>
	</div>
	</div>

<style>

</style>
	
	<script type="text/javascript">
            $(function () {
                $('#remainder_date').datepicker(
                	{
                		minDate:new Date()
                	});
            });
        </script>


	<script type="text/javascript">
		/*$('.date_picker').datepicker({
			dateformat: 'YYYY/MM/DD'
		});*/
		
	</script>

<script>
function save_faq_from_enquiry(){
	/*var req_title = $("#req_title").val();
	if(req_title == ''){
		$('.add_to_faq').val('0');
	}*/
	$('.add_to_faq').val('1');
	$(".enquiry_form").submit();
}
$(document).ready(function () {
	tinyMCE.init({
		// General options
		mode : "textareas",
		editor_selector:"e_tinymce",
                elements : "ajaxfilemanager",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,table,advhr,advimage,save,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
                height : "150",
                relative_urls : false,
                width: "100%",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",

                file_browser_callback : "ajaxfilemanager",
                valid_elements: '*[*]',
                extended_valid_elements : '*[*]',
                element_format : 'html',
		// Example content CSS (should be your site CSS)

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},

			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});

	
	getQueryCategory.call($('.enquiry_form .get_query_cat'), {{ Helpers::get_company_meta('default_category') }});
	getQueryStatus.call($('.enquiry_form .get_query_status'), {{ Helpers::get_company_meta('default_query_status') }});
	getSubCategory.call($('.enquiry_form .get_sub_category'), {{ Helpers::get_company_meta('default_category') }});
	getState.call($('.enquiry_form .country_id'), 1, {{ Helpers::get_company_meta('default_state') }});
	getDistrict.call($('.enquiry_form .state_id'), {{ Helpers::get_company_meta('default_state') ?? 0 }}, {{ App\CustomerProfile::find($customer_id)->district_id ?? 0 }});
	@if(!empty(Helpers::get_company_meta('default_escalation_role')))
		getUsersByRole.call($('.enquiry_form .get_users'), {{ Helpers::get_company_meta('default_escalation_role') }}, {{ Auth::user()->cmpny_id }});
	@endif
});
</script>
<script>
$(document).ready(function () {
	$('.faqadd').hide();
	$(function() {

		$("#req_title").autocomplete({ 
			source: function(request, response) {
                var cat_id = $("#query_category").val();
				var req_title = $('#req_title').val();
				var query_type = $('#query_type').val();
                var token = '{{csrf_token()}}';
                var current_lang = $('#current_lang').val();
                var details;
				if(req_title == ''){$('.faqadd').hide();}
                details = {
                        "_token": token,
                        "req_title": req_title,
                        "cat_id": cat_id,
                        "query_type": query_type,
                        "current_lang": current_lang
                    	};
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: "{{ url('/faqAutocomplete') }}",
                    data: details,
                    success: function(msg) {
						//r	esponse(msg);
						if($.isEmptyObject(msg)){
							$('.faqadd').show();
						}
						else{
							response(msg);
						}
					}
                });
            },
            minLength: 3,
            select: function(event, ui) {
                tinymce.get('answer').setContent('');
                tinymce.get('question').setContent('');
                tinymce.get("question").execCommand('mceInsertContent', false, ui.item.ques);
                tinymce.get("answer").execCommand('mceInsertContent', false, ui.item.desc);
                $('#short_message').val(ui.item.short_sms);
				$('.faqadd').hide();
            }
        });
	})
        var query_type_id = $('#query_type_id').val();
        if(query_type_id !='' && query_type_id !='0')
        {	
            //$('#enquiry_form #query_type').val(query_type_id);
            //$('#enquiry_form #query_type').trigger('change');
        }

        var show_cus_details = $('#show_cus_details').val();
        if(show_cus_details != 1)
        {	
            $('#enquiry_form #save_profile_enquiry').remove();
        }
});
</script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/uploadfile.min.css') }}">
<script src="{{ asset('js/jquery.uploadfile.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/tiny_mce/tiny_mce.js') }}"></script>
<script> 
	var vars = {};
  var successFiles  = [];
var errorFiles    = [];
 var uploadObj = $(".advancedUpload").uploadFile({
  url:"/mail_attachment_upload",
  multiple:true,
  autoSubmit:false,
  fileName:"file",
  allowedTypes:"jpg,png,jpeg,pdf",
  maxFileSize:1024*1024*2,
  maxFileCount:20,
  returnType:'json',
  multiple:true,
  dragDrop:true,
  showStatusAfterSuccess:true,
  showDelete:false,
  showDone:false,
  onSelect:function(files) {
    console.log('Submitted:');
    console.log('Submitted Files:');
    console.log(files);
    // uploadObj.reset();
    setTimeout(function() {
      $("div.ajax-file-upload-error").remove();
    }, 5000);
  },
  onSuccess:function(files,data,xhr)
  {
    console.log(123);
    console.log('Files:');
    console.log(files);
    console.log('Data:');
    console.log(data);
    console.log('XHR:');
    console.log(xhr);
    successFiles.push({
      originalName: data.original_name,
      mimeType: data.mime_type,
      savedName: data.saved_name
    });

     attachments = JSON.stringify(successFiles);

     //$("#attachments").val(attachments);
     $("#attach").val(attachments);
    return;

    //$("#mesg").addClass('alert');
    //$("#mesg").addClass('alert-success');
    //$("#mesg span").html('Query added successfully.');
  },
  onError: function(files, status, errMsg, pd)
  {
    console.log('Error');
    console.log('Files:');
    console.log(files);
    console.log('Status:');
    console.log(status);
    console.log('Error Message:');
    console.log(errMsg);
    console.log('pd:');
    console.log(pd);
    errorFiles.push(files[0]);
    return;
  },
  afterUploadAll: function(obj)
  {
    console.log('Upload finished');
    console.log('Obj');
    console.log(obj);
    console.log('Error Files');
    console.log(errorFiles);
    console.log('Successful Files');
    console.log(successFiles);
    setTimeout(function() {
      $(".ajax-file-upload-statusbar").has(".ajax-file-upload-error").remove();
    }, 5000);
    if (errorFiles.length !== 0)
    {
      console.log('Failure123');
    }
    else {
      console.log('Success123');
      var callbackFunc  = $("#callbackFunc").val();
      if (callbackFunc !== '' && typeof callbackFunc != "undefined")
      {
        window[callbackFunc](2);
      }
    }
   
    }

});


  /*var successFiles1  = [];
var errorFiles1    = [];
i = 2;
 vars['uploadObj'+i] = $(".advancedUpload"+i).uploadFile({
  url:"/mail_attachment_upload",
  multiple:true,
  autoSubmit:false,
  fileName:"file2",
  allowedTypes:"jpg,png,jpeg,pdf",
  maxFileSize:1024*1024*2,
  maxFileCount:5,
  returnType:'json',
  multiple:true,
  dragDrop:true,
  showStatusAfterSuccess:true,
  showDelete:false,
  showDone:false,
  onSelect:function(files) {
    console.log('Submitted:');
    console.log('Submitted Files:');
    console.log(files);
    // uploadObj.reset();
    setTimeout(function() {
      $("div.ajax-file-upload-error").remove();
    }, 5000);
  },
  onSuccess:function(files,data,xhr)
  {
    console.log(123);
    console.log('Files:');
    console.log(files);
    console.log('Data:');
    console.log(data);
    console.log('XHR:');
    console.log(xhr);
    successFiles1.push({
      originalName: data.original_name,
      mimeType: data.mime_type,
      savedName: data.saved_name
    });

     attachments = JSON.stringify(successFiles1);

     $("#attach1").val(attachments);
    return;

    //$("#mesg").addClass('alert');
    //$("#mesg").addClass('alert-success');
    //$("#mesg span").html('Query added successfully.');
  },
  onError: function(files, status, errMsg, pd)
  {
    console.log('Error');
    console.log('Files:');
    console.log(files);
    console.log('Status:');
    console.log(status);
    console.log('Error Message:');
    console.log(errMsg);
    console.log('pd:');
    console.log(pd);
    errorFiles.push(files[0]);
    return;
  },
  afterUploadAll: function(obj)
  {
    console.log('Upload finished');
    console.log('Obj');
    console.log(obj);
    console.log('Error Files');
    console.log(errorFiles1);
    console.log('Successful Files');
    console.log(successFiles1);
    setTimeout(function() {
      $(".ajax-file-upload-statusbar").has(".ajax-file-upload-error").remove();
    }, 5000);
    if (errorFiles.length !== 0)
    {
      console.log('Failure123');
    }
    else {
      console.log('Success123');
      var callbackFunc  = $("#callbackFunc").val();
      if (callbackFunc !== '' && typeof callbackFunc != "undefined")
      {
        window[callbackFunc](2);
      }
    }
   
    }

});*/
</script>
