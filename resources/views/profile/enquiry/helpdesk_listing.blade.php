<div class="widget">
  <div class="widget-heading">
    <div class="row">
      <div class="col-12 col-sm-6">
        <h2>{{__('Helpdesk')}}</h2>
      </div>
	@if(Helpers::get_company_meta('eHealth_show') == 1)
	<div class="col-12 col-sm-6 pr-4">
        <select name="query_type" id="query_type" class="sort_helpdesk form-control">
        @foreach ($query_status as $key => $value)           
        <option @if($key == $query_status) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
        @endforeach 
        </select>
      </div>
	@else
      <div class="col-12 col-sm-6 pr-4">
        <select name="query_type" id="query_type" class="sort_helpdesk form-control">
        @foreach ($query_types as $key => $value)           
        <option @if($key == $query_type) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
        @endforeach 
        </select>
      </div>
	@endif
    </div>
  </div>
  
  <?php //var_dump($query_type); exit;?>
  
  <link rel="stylesheet" type="text/css" href="{{ asset('css/uploadfile.min.css') }}">
  <script src="{{ asset('js/jquery.uploadfile.min.js') }}" type="text/javascript"></script>
  <div class="table-widget table-responsive mt-0 pt-0">
    <table width="100%" id="faq_lists" class="table height-small history-table m-0">
      <thead>
        <tr>
          <th>#</th>
          <th>Docket NO</th>
          <th>Enquiry</th>
          <th>Taken By</th>
          @if(Auth::user()->cmpny_id == 14)<th>Project</th><th>Demo</th>@endif
          <th>Status</th>
          <th>Dept</th>
          <th>Enquired on</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @php  $i = 1; 	@endphp 
      @if(count($followup_history)>0)
      @foreach ($followup_history as $res)
      <?php
	$followupid = '';
	$new_class = '';
	if($followupid == $res->id){
		//$new_class="panel-collapse in";
    }else{
		//$new_class="panel-collapse collapse";
    }
	$answer = strip_tags($res->answer);
    if(mb_strlen($answer) > 256) {
        $answer_det = mb_substr($answer, 0, 256);
        $answer = mb_substr($answer_det, 0, mb_strrpos($answer_det, ' '));  
        $answer.='...';
		$answer_rm = 1;
	}else{
		$answer_rm = 0;
	}
	$ques = strip_tags($res->question);
    if (mb_strlen($ques) > 256) {
		$ques_det = mb_substr($ques, 0, 256);
        $ques = mb_substr($ques_det, 0, mb_strrpos($ques_det, ' '));  
        $ques.='...';
		$q_rm = 1;
	}else{
		$q_rm = 0;
	}
	if($res->GetQueryStatus->is_close === 1) {
        $href_status=''; 
        $toggle='';
        $target='';
        $action='fa-eye';
        $click="get_helpdesk_history('".$res->docket_number."',1)";

    }else {
      if( Helpers::checkPermission('followup history edit')){
          $href_status='#helpdesk_collapse'.$i;
          $toggle='collapse';
          $target='';
          $action='fa fa-pencil-alt';
          $click='';
        
      }else{

        if($res->escalate == Auth::User()->id && $res->escalation_status  ==config('constant.ESCALATED') ){
          $href_status='#collapse'.$i;
          $toggle='collapse';
          $target='';
          $action='fa fa-pencil-alt';
           $click='';
        }else{
          $href_status='';
          $toggle='modal';
          $target='#h_details';
          //$action='fa-eye';
          //$click='get_helpdesk('.$res->id.')';
          $action='fa fa-pencil-alt';
          $click='';
        }       
      }
    }
	?>
      <tr class="helpdesk_lis anchor-wrap">
        <td>{{$i}} </td>
        <td>{{$res->docket_number}} 
          @if(count($res->GetAttachment)) <a href="javascript:void(0)" onclick="get_helpdesk_history('{{$res->docket_number}}',{{$res->GetQueryStatus->is_close}})" class="ss btn" data-toggle="tooltip" data-placement="top" title="Helpdesk History"> <i class="fa fa-paperclip fa-2" aria-hidden="true"></i></a> @endif</td>
        <td>{{$res->req_title}}</td>
        <td>@if(!empty($res->GetEscalateUser->name)){{$res->GetEscalateUser->name}}@endif</td>
         @if(Auth::user()->cmpny_id == 14)
        <td>{{ $faq_category[$res->sub_query_category] ?? ''}}</td>
	<td>{{ config('constant.DEMO.'.$res->demo) }}</td>
	@endif       
        <td>{{$res->GetQueryStatus->name}}</td>
        <td>{{$res->GetQueryType->query_type}}</td>
        <td><?php  
    $orgDate = $res->created_at;  
    $newDate = date("d-m-Y", strtotime($orgDate));?>{{$newDate}}</td>
        <td class="{{$res->id}} text-right">
          <a href="{{$href_status}}"   class="btn toggle-tabs" onclick="{{$click}}"><i class="fas fa-chevron-right"></i></a>
        </td>
      </tr>
      <tr>
        <td colspan="8" class="p-0"><div id="{{$target}}" class="<?php echo $new_class;?> text-left acco-content p-3">
          <div class="row location_details">
            <div class="col-7">
              <?php
                            
              if(!empty($res->state_id)):
                echo " -> ".$res->GetState->name;
              endif;
              if(!empty($res->district_id)):
                echo " -> ".$res->GetDistrict->name;
              endif;
              if(!empty($res->taluk_id)):
                echo " -> ".$res->GetTaluk->name;
              endif;
              if(!empty($res->village_id)):
                echo " -> ".$res->GetVillage->name;
              endif;
              if(!empty($res->local_body_type)):
                echo " -> ".$res->GetLocalBodyType->type;
              endif;
              if(!empty($res->muncipality_id)):
                echo " -> ".$res->GetMuncipality->name;
              endif;
              if(!empty($res->corporation_id)):
                echo " -> ".$res->GetCorporation->name;
              endif;
              if(!empty($res->district_panchayath_id)):
                echo " -> ".$res->GetDistrictPanchayath->name;
              endif;
              if(!empty($res->block_panchayath_id)):
                echo " -> ".$res->GetBlockPanchayath->name;
              endif;
              if(!empty($res->grama_panchayath_id)):
                echo " -> ".$res->GetGramaPanchayath->name;
              endif;
              if(!empty($res->panchayath_id)):
                echo " -> ".$res->GetPanchayath->name;
              endif;              

            ?>
            </div>
          </div>
           <div class="row">
            <div class="col-7">
              <?php 
                if(!empty($res->ard_no)):
                  echo "ARD No : ".$res->ard_no;
                endif;
                if(!empty($res->location)):
                  echo " Location : ".$res->location;
                endif;
                if(!empty($res->other_category)):
                  echo " Other Category : ".$res->other_category;
                endif;
                if(!empty($res->other_subcategory)):
                  echo " Other Sub Category : ".$res->other_subcategory;
                endif;
              if(!empty($res->supply_card)):
                  echo " Supply Card : ".$res->GetSupplyCard->name;
                endif;
                if(!empty($res->card_no)):
                  echo " Card No. : ".$res->card_no;
                endif; 
              ?>
            </div>
          </div>
            <div class="row escalation_details"> @if(!empty($res->escalate))
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-7">Escalated From</div>
                  <div class="col-5">:&nbsp;<strong>{{$res->GetEscalateFrom->name}}</strong></div>
                </div>
              </div>
              @endif
              @if(!empty($res->GetEscalateUser->name))
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-7">Escalated To</div>
                  <div class="col-5">:&nbsp;<strong>{{$res->GetEscalateUser->name}}</strong></div>
                </div>
              </div>
              @endif
              @if(Helpers::get_company_meta('escalation_due') != 2)
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-7">Escalation Time</div>
                  <div class="col-5">:&nbsp;<strong>{{$res->escalation_deadline/60}}-Hour</strong></div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-7">Escalation Due Date &amp; Time</div>
                  <div class="col-5">:&nbsp;<strong>&nbsp;{{Helpers::common_date_conversion($res->escalation_due_date, 3)}}</strong></div>
                </div>
              </div>
              @endif
              @if(!empty($res->priority))
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-7">Escalation Priority</div>
                  <div class="col-5">: <strong>{{$res->GetPriority->name}}</strong></div>
                </div>
              </div>
              @endif

              <div class="col-sm-6">
                <div class="row">
                  <div class="col-7">Followup Date</div>
                  <div class="col-5">: <b>{{$res->remainder_date}}</b>&nbsp;@if($res->remainder_date !='' || $res->remainder_date !="0000-00-00 00:00:00")
              {{--{{Helpers::common_date_conversion($res->remainder_date,3) }}--}}
              @endif</div>
                </div>
              </div>

              @if(Helpers::get_company_meta('action_taken_show') == 1)
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-7">Action Taken</div>
                  <div class="col-5">: <strong>{{$res->GetQueryAction->action ?? ''}}</strong></div>
                </div>
              </div>
              @endif



              <div class="col-sm-12 mt-2">
                <div class="row text height q{{$i}}">
                 @if (Auth::user()->cmpny_id == config('constant.EHEALTH_CMPNY'))
                  <div class="col-sm-2">Remarks  :</div>
		@else
		 <div class="col-sm-2">Question :</div>
		@endif                 
                <div class="col-sm-10"><strong>{{strip_tags($res->question)}}</strong>
                    <?php if(isset($q_rm) AND $q_rm == 1){ ?>
                    <a class="readmore rq{{$i}}" onclick="change_height('q{{$i}}')">Read more</a>
                    <?php } ?>
                  </div>
                </div>
                <div class="row text height a{{$i}} mt-1">
                  @if (Auth::user()->cmpny_id == config('constant.EHEALTH_CMPNY'))
                  <div class="col-sm-2">Complaint Description  :</div>
		  @else
		    <div class="col-sm-2">Answer :</div>
		   @endif                  
                    <div class="col-sm-10"><?php echo "$res->answer"; ?>
                    <?php if(isset($answer_rm) AND $answer_rm == 1){ ?>
                    <a class="readmore ra{{$i}}" onclick="change_height('a{{$i}}')">Read more</a>
                    <?php } ?>
                  </div>
                </div>
                <div> </div>
              </div>
            </div>


            {!! Form::open(array('url' => 'update_helpdesk', 'id' =>"enquiry_form$i", 'class' => 'tinymce form-common1 form-upload jo', 'method'=>'POST')) !!}

            <div class="row">
              <div class="col-sm-12 mt-2"> 
                <label for="question" class="control-label">New Enquiry<span class="red_star">*</span></label>
                {{ Form::textarea('answer', null, array('id' => "answer$i", 'class' => 'h_tinymce form-control', 'rows' => '2' )) }} <span class="error" id="answer_err"></span> </div>
              <div class="col-sm-12 mt-2"> @php $maxlength = config('constant.sms_max_length'); @endphp
                <label for="question" class="control-label">Comments</label>
                {{ Form::textarea('short_message', null, array('maxlength' => "$maxlength",'rows' => '3', 'id' => "short_message$i", 'class' => 'form-control sms_content' )) }}
                <p id="remain" class="pull-right"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 form-group">
                <label for="title" class="control-label">Select Category</label>
                <select class="form-control get_sub_category" name="query_category">
                  <option value="">Select Category</option>
                  @foreach ($res['f_status_category'] as $category)
                  <option data-short-code="{{$category->short_code}}" data-other="{{$category->is_other ?? 'null'}}" value="{{$category->category_id}}" @isset($res->query_category) {{  $res->query_category == $category->category_id ? 'selected="selected"' : '' }} @endisset >{{$category->category_name}}</option>
						    	@endforeach 	
                </select>
              </div>
              @if(Helpers::get_company_meta('sub_category_show') != 2)
              <div class="col-sm-6 form-group">
                <label for="title" class="control-label">Sub Category</label>
                <select class="form-control sub_cat_id get_other_sub_category" name="sub_query_category">
                  <option value="">Select</option>
                          		@foreach ($res['f_sub_category'] as $category)
                  <option value="{{$category->id}}" @isset($res->sub_query_category) {{  $res->sub_query_category == $category->id ? 'selected="selected"' : '' }} @endisset >{{$category->category_name}}</option>
                  
						    	@endforeach 
                        		
                </select>
              </div>
              @endif
              <div class="col-sm-6 form-group other-category" @if(isset($res->GetQueryCategory) && $res->GetQueryCategory->is_other != 1) style="display:none;" @endif>

                <label for="other_category" class="control-label">{{__('Other Category')}}</label>
                {{ Form::text('other_category', $res->other_category, array('id' => 'other_category','class' => 'form-control','autocomplete'=>'off')) }}
                <span class="error" id="other_category_err"></span>
              </div>
              <div class="col-sm-6 form-group other-sub-category" @if(empty($res->sub_query_category) || (isset($res->GetSubQueryCategory) && $res->GetSubQueryCategory->is_other != 1)) style="display:none;" @endif >
                <label for="other_subcategory" class="control-label">{{__('Other Sub Category')}}</label>
                {{ Form::text('other_subcategory', $res->other_subcategory, array('id' => 'other_subcategory','class' => 'form-control','autocomplete'=>'off')) }}
                <span class="error" id="other_subcategory_err"></span>
              </div>
              @if(Helpers::get_company_meta('customer_priority_show') != 2)
              <div class="col-sm-6 form-group">
                <label for="title" class="control-label">Priority</label>
                <select class="form-control" name="priority">
                  
                         			 @foreach ($priorities as $key => $value)
                             
                      				
                  <option value="{{$key}}" @isset($res->priority) {{  $res->priority == $key ? 'selected="selected"' : '' }} @endisset>{{$value}}</option>
                  
						     		@endforeach 
                       			 
                </select>
              </div>
              @endif
              <div class="col-sm-6 form-group">
                <label for="title" class="control-label">Query Status</label>
                <select class="form-control" name="query_status">
                  <option value="">Select</option>
                                    
                          		@foreach ($res['f_status'] as $status)
                     			 
                  <option value="{{$status->query_status_id}}" @isset($res->query_status) {{  $res->query_status == $status->query_status_id ? 'selected="selected"' : '' }} @endisset >{{$status->GetStatus->name}}</option>
                  
						    	@endforeach 
                        		
                </select>
              </div>
              @if(Helpers::get_company_meta('action_taken_show') == 1)
                <div class="col-sm-6 form-group">
                  <label for="action_taken" class="control-label">{{__('Action Taken')}}</label>
                  {{ Form::select('action_taken', $query_actions, null, ['class' => 'form-control']) }}         
                  <span class="error" id="action_taken_err"></span>
                </div>
              @endif
            </div>
            <div class="row opt_field_con">
              <?php// dd($query_status); ?>
              <div class="col-sm-6 opt_field CSD SCHL form-group" @if (isset($res->GetQueryCategory->short_code) && in_array($res->GetQueryCategory->short_code, ['CSD','SCHL'])) style="display:block" @endif >
                <label for="district_supply_office" class="control-label">{{__('District Supply Office')}}</label>
                {{ Form::select('district_supply_office', $district_supply_offices, $res->district_supply_office, ['class' => 'district_supply_office form-control get_taluk_supply_office', 'id' => 'district_supply_office']) }}         
                <span class="error" id="district_supply_office_err"></span>
              </div>
              <div class="col-sm-6 opt_field CSD SCHL form-group" @if (isset($res->GetQueryCategory->short_code) && in_array($res->GetQueryCategory->short_code, ['CSD','SCHL'])) style="display:block" @endif >
                <label for="taluk_supply_office" class="control-label">{{__('Taluk Supply Office')}}<span class=""></span></label>
                {{ Form::select('taluk_supply_office', $res->f_taluk_supply_offices, $res->taluk_supply_office, ['class' => 'form-control taluk_supply_office']) }}          
                <span class="error" id="taluk_supply_office_err"></span>
              </div>
              <div class="col-sm-6 opt_field CSD SCHL form-group" @if (isset($res->GetQueryCategory->short_code) && in_array($res->GetQueryCategory->short_code, ['CSD','SCHL'])) style="display:block" @endif >
                <label for="supply_cards" class="control-label">{{__('Card Category')}}</label>
                {{ Form::select('supply_cards', $supply_cards, $res->supply_card, ['class' => 'form-control supply_cards', 'id' => 'supply_cards']) }}         
                <span class="error" id="supply_cards_err"></span>
              </div>
              <div id="card_no" class="col-sm-6 opt_field CSD SCHL form-group" @if (isset($res->GetQueryCategory->short_code) && in_array($res->GetQueryCategory->short_code, ['CSD','SCHL'])) style="display:block" @endif >
                <label for="card_no" class="control-label">{{__('Card / Consumer No.')}}</label>
                {{ Form::text('card_no', $res->card_no, array('id' => 'card_no','class' => 'form-control','autocomplete'=>'off')) }}
                <span class="error" id="card_no_err"></span>
              </div>
              <div class="col-sm-6 opt_field CSD SCHL form-group" @if (isset($res->GetQueryCategory->short_code) && in_array($res->GetQueryCategory->short_code, ['CSD','SCHL'])) style="display:block" @endif >
                <label for="ard_no" class="control-label">{{__('ARD No / Gas Agency')}}</label>
                {{ Form::text('ard_no', $res->ard_no, array('id' => 'ard_no','class' => 'form-control','autocomplete'=>'off')) }}
                <span class="error" id="ard_no_err"></span>
              </div>
              <div id="location1" class="col-sm-6 opt_field LMD SAB form-group" @if (isset($res->GetQueryCategory->short_code) && in_array($res->GetQueryCategory->short_code, ['LMD','SAB'])) style="display:block" @endif >
                <label for="location" class="control-label">{{__('Location')}}</label>
                {{ Form::text('location', $res->location, array('id' => 'location','class' => 'form-control','autocomplete'=>'off')) }}
                <span class="error" id="location_err"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6"> {{ Form::text('remainder_date', null, array('id' => "remainder_date$i", 'class' => 'form-control date_picker', 'placeholder' => 'Next Followup Date', 'autocomplete' => 'off' )) }} <span class="error" id="remainder_date_err"></span> </div>
              <?php if(Helpers::checkPermission(config('constant.ESCALATE'))){ ?>
              <div class="col-sm-12 form-group">
                <div class="row align-items-center">
                  @if(Helpers::get_company_meta('escalation_due') != 2)
                  <div class="col-sm-9 text-sm-right">
                    <label for="" class="control-label mr-3">{{__('Resolve within')}} &gt;</label>
                    {{ Form::radio('action', 1, false ,array('class' => 'custom-radio d-none','id' => 'action1')) }}
                    <label for="action1" class="control-label custom-checkbox-label pr-2">{{__('Hour')}}</label>
                    {{ Form::radio('action', 2, false ,array('class' => 'custom-radio d-none','id' => 'action2')) }}
                    <label for="action2" class="control-label custom-checkbox-label">{{__('Minute')}}</label>
                    {{ Form::radio('action', 3, false ,array('class' => 'custom-radio d-none','id' => 'action3')) }}
                    <label for="action3" class="control-label custom-checkbox-label">{{__('Day')}}</label>
                  </div>
                  <div class="col-sm-3">
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
                </div>
              </div>
            <?php } ?>
            </div>
            <?php if(Helpers::checkPermission(config('constant.ESCALATE'))){ ?>
            <div class="row">
              @if(empty(Helpers::get_company_meta('default_escalation_role')))
              <div class="col-sm-6 form-group"><label> </label> {{ Form::select('role_type', $role_types, null, ['class' => 'get_users form-control']) }} </div>
              @else
              <input type="hidden" name="role_type" value="{{ Helpers::get_company_meta('default_escalation_role') }}" class="get_users">
              @endif
              <div class="col-sm-6 form-group">
                <label for="escalate_to" class="control-label">{{ !empty(Helpers::get_company_meta('escalated_to_label')) ? Helpers::get_company_meta('escalated_to_label') : 'Escalate To' }}</label>
               {{ Form::select('escalate_to', ['' => 'Select'], null, ['class' => 'escalate_to form-control', 'id' => 'escalate_to']) }} </div>
            </div>
          <?php } ?>
          @if(Helpers::get_company_meta('attachments_required') != 2)
            <div class="row">
              <div class="col-sm-12 form-group">
                <div class="advancedUpload{{$i}}">Upload</div>
                <input type="hidden" value="" name="attachments{{$i}}" id="attach{{$i}}">
                <input type="hidden" value="" id="callbackFunc{{$i}}">
              </div>
              <script type="text/javascript">
								//var vars = {};
								var inc = '<?php echo $i;?>';
								vars['successFiles'+inc]  = [];
								vars['errorFiles'+inc]  = [];
								//var successFiles1    = [];
								//var errorFiles1    = [];
								
								 vars['uploadObj'+inc] = $(".advancedUpload"+inc).uploadFile({
								  url:"/mail_attachment_upload",
								  multiple:true,
								  autoSubmit:false,
								  fileName:"file"+inc,
								  allowedTypes:"jpg,png,jpeg,pdf",
								  maxFileSize:1024*1024*2,
								  maxFileCount:5,
								  returnType:'json',
								  multiple:true,
								  dragDrop:true,
								  showStatusAfterSuccess:true,
								  showDelete:false,
								  showDone:false,
								  dynamicFormData: function()
									{
									var data ={ id:'<?php echo $i;?>'}
									return data;
									},
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
								    console.log('123'+data);
								    console.log('Files:');
								    console.log(files);
								    console.log('Data:');
								    console.log(data);
								    console.log('XHR:');
								    console.log(xhr);
								    vars['successFiles'+data.inc].push({
								      originalName: data.original_name,
								      mimeType: data.mime_type,
								      savedName: data.saved_name
								    });

								     attachments = JSON.stringify(vars['successFiles'+data.inc]);

								     console.log(attachments);
								    $("#attach"+data.inc).val(attachments);
									
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
								    console.log(obj.responses);
								    console.log(obj.responses[0]);
								    console.log(obj.responses[0].inc);
								    console.log('Error Files');
								    console.log(vars['errorFiles'+inc]);
								    console.log('Successful Files');
								    console.log(vars['successFiles'+inc]);
								    setTimeout(function() {
								      $(".ajax-file-upload-statusbar").has(".ajax-file-upload-error").remove();
								    }, 5000);
								    if (errorFiles.length !== 0)
								    {
								      console.log('Failure123');
								    }
								    else {
								      console.log('Success123-'+inc); 
								       $("#enquiry_form"+obj.responses[0].inc).submit();
								      //return false;
								      /*var callbackFunc  = $("#callbackFunc").val();
								      if (callbackFunc !== '' && typeof callbackFunc != "undefined")
								      {
								        window[callbackFunc](2);
								      }*/
								    }
								   
								    }

								});
								</script> 
            </div>
            @endif


<!--<div class="row">
        <div class="col-sm-6 form-group"> 
          <label for="country_id">Country</label>
          <select name="country_id" class="form-control country_id">
            <option value="">Select Country</option>
            <option value="1">India</option>
          </select>
        </div>
        <div class="col-sm-6 form-group"> 
              <label for="state_id">State</label>
                <select name="state_id" class="form-control state_id">
                  <option value="">Select State</option>  
                </select>
              </div>
              <div class="col-sm-6 form-group"> 
               <label for="district_id">District</label>
              <select name="district_id" class="form-control district_id">
                <option value="">Select District</option>
                </select>
              </div>
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
      </div>-->



      

            <div class="text-right">
              <input type="hidden" value="{{$res->customer_id}}" name="customer_id">
              <input type="hidden" value="{{$res->id}}" name="id" id="fid{{$i}}">
              <input type="hidden" class="callback" value="show_helpdesk_listing" name="callback">
              <input type="hidden" class="arg" value="0" name="arg">
              <div class="message"></div>
              <button type="reset" class="btn btn-outline-danger btn-sm px-4" > {{__('Reset')}} </button>
              <input type="hidden" class="get_query_cat" value="{{$res->GetQueryType->id}}" name="">
              <input type="hidden" class="" value="{{$i}}" name="inc">
              <button type="button" onclick="dynamic_attachment_upload('{{$i}}')" id="update_helpdesk11"  class="btn btn-primary btn-sm px-4"> {{__('Save')}} </button>
              <a href="javascript:void(0)" onclick="get_helpdesk_history('{{$res->docket_number}}',{{$res->GetQueryStatus->is_close}})" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Helpdesk History"><i class="fa fa-info-circle" aria-hidden="true"></i> History</a> </div>
              <script type="text/javascript">
                @if(!empty(Helpers::get_company_meta('default_escalation_role')))
    getUsersByRole.call($('#enquiry_form'+{{$i}}+' .get_users'), {{ Helpers::get_company_meta('default_escalation_role') }});
  @endif
              </script>
            {!! Form::close() !!} </div></td>
      </tr>
      @php $i++ @endphp
      @endforeach
      @else
      <tr>
        <td colspan="8" class="text-center">No Data Found</td>
      </tr>
      @endif
      </tbody>
    </table>
     @if(count($followup_history) >= config('constant.pagination_constant') AND $limit != -1)
      <p><span class="view_more" onclick="show_helpdesk_listing(null,null,'all')">view more</span></p>
        @endif
  </div>
</div>

<!-- Model popup Starts -->

<div class="modal" id="f_details"  role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">History Details</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" >
        <div id="follo_popup" class="follo_popup"></div>
        <div class="col-md-12">
          <div id="msg_err" style=""></div>
        </div>
      </div>
      <div class="modal-footer">
        @if(Helpers::checkPermission('Followups Reopen'))
        <div class="row">
          {!! Form::open(array('url' => 'helpdesk_reopen', 'id' =>"helpdesk_reopen", 'class' => 'form-common hide_modal', 'method'=>'POST')) !!}
          <div class="col-sm-12">
                <div class="re_open_sec">
                      <input type="hidden" class="modal_name" name="modal_name" value="f_details">
                      <input type="hidden" id="doc_no" name="docket_number" value="">
                      <textarea rows="3" cols="70" placeholder="Reason for Re-open" id="reason_reopen" name="reason_reopen" rows="2" class="form-control"></textarea>
                      <span id="reason_error"></span>
                     
                      <div id="msg" class="alert" role="alert"></div>
                </div>
                <input type="hidden" class="callback" value="show_listing" name="callback">
          </div>
          <div class="col-sm-12"><br>
              <button type="submit" id="h_reopen_btn" class="re_open_sec btn btn-primary">Re-Open</button>
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          {!! Form::close() !!} 
        </div>
        @else
           <div class="col-sm-12"><br>
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        @endif
      </div>
  </div>
</div>
</div>
<!-- Model popup Ends   --> 
<!-- Model popup Starts -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Details</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="popupContainer"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Model popup Ends   --> 
<script type="text/javascript">
		$('.date_picker').datepicker({
			format: 'YYYY/MM/DD'
		});
	</script> 
<script>
$(document).ready(function () {
	tinyMCE.init({
		// General options
		mode : "textareas",
		editor_selector:"h_tinymce",
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
  @if(!empty(Helpers::get_company_meta('default_escalation_role')))
  console.log(123455);
    getUsersByRole.call($('.jo .get_users'), {{ Helpers::get_company_meta('default_escalation_role') }});
  @endif
});
$(document).ready(function(e) {
      $(".toggle-tabs").unbind('click');
      $('.toggle-tabs').click(function(e) {
  		  $(this).children('i').toggleClass(' fa-chevron-up')
  	    $(this).closest('tr').next('tr').children('td').children('div').slideToggle();
  	    return false;
      });
    doc_no_id = $('.doc_no_id').val();
    if(doc_no_id != '' && doc_no_id != '0'){
      $("tr.helpdesk_lis td."+doc_no_id+" .toggle-tabs").trigger('click');
    }
});
</script>