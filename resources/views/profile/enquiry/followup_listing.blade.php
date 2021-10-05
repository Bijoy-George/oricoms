<div class="widget">
  <div class="widget-heading">
    <div class="row">
      <div class="col-12 col-sm-6">
        <h2>{{__('Followups')}}</h2>
      </div>
      <div class="col-12 col-sm-6 pr-4">
        <select name="query_type" id="query_type" class="sort_followup form-control">
        @foreach ($query_types as $key => $value)           
        <option @if($key == $query_type) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
        @endforeach 
        </select>
      </div>
    </div>
  </div>
  <?php //var_dump($query_type); exit;?>
  
  <div class="table-widget table-responsive mt-0 pt-0">
    <table width="100%" id="faq_lists" class="table height-small history-table m-0">
      <thead>
        <tr>
          <th>#</th>
          <th>Docket NO</th>
          <th>Enquiry</th>
          <th>Status</th>
          <th>Type</th>
          <th>Enquired on</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      
      @php  $i = 10000; 	@endphp 
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
   $href_status=''; 
  if(isset($res->GetQueryStatus->is_close))
	if($res->GetQueryStatus->is_close === 1) {
        $href_status=''; 
        $toggle='';
        $target='';
        $action='fa-eye';
        $click="get_followup('".$res->docket_number."',1)";

    }else {
      if( Helpers::checkPermission('followup history edit')){
          $href_status='#followup_collapse'.$i;
          $toggle='collapse';
          $target='';
          $action='fa fa-pencil-alt';
          $click='#';
        
      }else{

        if($res->escalate == Auth::User()->id && $res->escalation_status  ==config('constant.ESCALATED') ){
          $href_status='#collapse'.$i;
          $toggle='collapse';
          $target='';
          $action='fa fa-pencil-alt';
           $click='#';
        }else{
          $href_status=''; 
          $toggle='modal';
          $target='#h_details';
          $action='fa-eye';
          $click='get_followup('.$res->id.')';
        }       
      }
    }
	?>
      <tr class="anchor-wrap">
        <td>{{$i}} </td>
        <td>{{$res->docket_number}}</td>
        <td>{{$res->req_title}}</td>
        <td>{{$res->GetQueryStatus->name ?? ''}}</td>
        <td>{{$res->GetQueryType->query_type}}</td>
        <td>{{$res->created_at}}</td>
        <td class="text-right"><a href="{{$href_status}}"  class="btn toggle-tabs"><i class="fas fa-chevron-right"></i></a></td>
      </tr>
      <tr>
        <td colspan="7" class="p-0"><div class="acco-content p-3">
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
            <div class="row ques_answer">
              <div class="col-sm-12">
                <p class="">Followup Date:<b>&nbsp;@if($res->remainder_date !='' || $res->remainder_date !="0000-00-00 00:00:00")
              {{Helpers::common_date_conversion($res->remainder_date,3) }} </b>
              @endif</p>
              </div>
            </div>
            <div class="row ques_answer">
              <div class="col-sm-12">
                <div class="text height q{{$i}} px-2"> <b>Question: </b>{{strip_tags($res->question)}} </div>
                <div>
                  <p>
                    <?php if(isset($q_rm) AND $q_rm == 1){ ?>
                    <a class="readmore rq{{$i}}" onclick="change_height('q{{$i}}')">Read more</a>
                    <?php } ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="row ques_answer">
              <div class="col-sm-12">
                <div class="text height a{{$i}}  px-2"> <b>answer: </b> <?php echo "$res->answer"; ?></div>
                <div>
                  <p>
                    <?php if(isset($answer_rm) AND $answer_rm == 1){ ?>
                    <a class="readmore ra{{$i}}" onclick="change_height('a{{$i}}')">Read more</a>
                    <?php } ?>
                  </p>
                </div>
              </div>
            </div>
            
            {!! Form::open(array('url' => 'update_followup', 'id' =>"enquiry_form$i", 'class' => 'tinymce form-common', 'method'=>'POST')) !!}
            <div class="row">
              <div class="col-sm-12">
                <label for="question" class="control-label">New Followup</label>
                {{ Form::textarea('answer', null, array('id' => "answer$i", 'class' => 'f_tinymce form-control', 'rows' => '3' )) }} <span class="error" id="answer_err"></span> </div>
              <div class="col-sm-12 mt-2 form-group"> 
                <label for="question" class="control-label">New Followup</label>
                {{ Form::textarea('short_message', null, array('rows' => '3', 'id' => "short_message$i", 'class' => 'form-control' )) }} </div>
            </div>
            <div class="row">
              <div class="col-sm-6 form-group">
                <label for="question" class="control-label">Category</label>
                <select class="form-control" name="query_category">
                  <option value="">Select</option>
                  @foreach ($res['f_status_category'] as $category)
                            
                           
                  <option value="{{$category->category_id}}" @isset($res->query_category) {{  $res->query_category == $category->category_id ? 'selected="selected"' : '' }} @endisset >{{$category->category_name}}</option>
                  
                  @endforeach 
                
                </select>
              </div>
             @if(Helpers::get_company_meta('sub_category_show') != 2)
              <div class="col-sm-6 form-group">
                <label for="question" class="control-label">Sub Category</label>
                <select class="form-control" name="sub_query_category">
                  <option value="">Select</option>
                  @foreach ($res['f_sub_category'] as $category)
                            
                           
                  <option value="{{$category->id}}" @isset($res->sub_query_category) {{  $res->sub_query_category == $category->id ? 'selected="selected"' : '' }} @endisset >{{$category->category_name}}</option>
                  
                  @endforeach 
                </select>
              </div>
              @endif
              @if(Helpers::get_company_meta('customer_priority_show') != 2)
              <div class="col-sm-6 form-group">
                <label for="question" class="control-label">Priority</label>
                <select class="form-control" name="priority">
                         			 @foreach ($priorities as $key => $value)
                             
                      				
                
                  
                  <option value="{{$key}}" @isset($res->priority) {{  $res->priority == $key ? 'selected="selected"' : '' }} @endisset>{{$value}}</option>
                  
                  
                
						     		@endforeach 
                       			 
              
                
                </select>
              </div>
              @endif
              <div class="col-sm-6 form-group">
                <label for="question" class="control-label">Status</label>
                <select class="form-control" name="query_status">
                  <option value="">Select</option>
                  
                  
                 
							@if(isset($res->batch_id) && !empty($res->batch_id))
								
                
                  
                  <?php if(count($res['c_status'])>0) {   ?>
                  
                  
                	
								@foreach ($res['c_status'] as $status)
								
                
                  
                  <option value="{{$status->query_status}}" @isset($res->query_status) {{  $res->query_status == $status->query_status ? 'selected="selected"' : '' }} @endisset>{{$status->GetStatus->name}}</option>
                  
                  
                
								@endforeach
								
								
                
                  
                  <?php } else {  ?>
                  
                  
                 
								@foreach ($res['f_status'] as $status)
                     			 
                
                  
                  <option value="{{$status->query_status_id}}" @isset($res->query_status) {{  $res->query_status == $status->query_status_id ? 'selected="selected"' : '' }} @endisset >{{$status->GetStatus->name}}</option>
                  
                  
                
						    	@endforeach 
								
                
                  
                  <?php  } ?>
                  
                  
                
							@else
                          		@foreach ($res['f_status'] as $status)
                     			 
                
                  
                  <option value="{{$status->query_status_id}}" @isset($res->query_status) {{  $res->query_status == $status->query_status_id ? 'selected="selected"' : '' }} @endisset >{{$status->GetStatus->name}}</option>
                  
                  
                
						    	@endforeach 
							@endif
                        		
              
                
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 form-group"> {{ Form::text('remainder_date', null, array('id' => "remainder_date$i", 'class' => 'form-control date_picker', 'placeholder' => 'Next Followup Date', 'autocomplete' => 'off')) }} <span class="error" id="remainder_date_err"></span> </div>
            </div>
            <div class=" text-right">
              <input type="hidden" value="{{$res->customer_id}}" name="customer_id">
              <input type="hidden" value="{{$res->id}}" name="id" id="fid{{$i}}">
              <input type="hidden" class="callback" value="show_followup_listing" name="callback">
              <input type="hidden" class="arg" value="0" name="arg">
              <div class="message"></div>
              <button type="reset" class="btn btn-outline-danger btn-sm px-4" > {{__('Reset')}} </button>
              <button type="submit" id="update_followup" class="btn btn-primary btn-sm px-4"> {{__('Save')}} </button>
              <a href="javascript:void(0)" onclick="get_followup_history('{{$res->docket_number}}',{{$res->GetQueryStatus->is_close ?? ''}})" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Helpdesk History"><i class="fa fa-info-circle" aria-hidden="true"></i> History</a> </div>
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
      <p><span class="view_more" onclick="show_followup_listing(null,null,'all')">view more</span></p>
        @endif
  </div>
</div>

<!-- Model popup Starts -->

<div class="modal" id="f_details1"  role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">History Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body" >
        <div id="follo_popup" class="follo_popup"></div>
      </div>
      <div class="modal-footer">
        <div id="msg_err" style=""></div>
        <!--<div class="re_open_sec">
				<textarea rows="3" cols="50" placeholder="Reason for Re-open" id="reason_reopen" name="reason_reopen" rows="2"></textarea>
				<span id="reason_error"></span>
			</div>
			<button type="button" id="h_reopen_btn" class="re_open_sec btn btn-primary">Re-Open</button>-->
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body" id="popupContainer"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
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
<!-- <script src="{{ asset('js/tiny_mce/tiny_mce.js') }}"></script>
<script src="{{ asset('js/tinymce.js') }}"></script> --> 
<script>
$(document).ready(function () {
	tinyMCE.init({
		// General options
		mode : "textareas",
		editor_selector:"f_tinymce",
                elements : "ajaxfilemanager",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,table,advhr,advimage,save,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
                height : "250",
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
  $(".toggle-tabs").unbind('click');
  $('.toggle-tabs').click(function(e) {
    $(this).children('i').toggleClass('fa-chevron-up')
    $(this).closest('tr').next('tr').children('td').children('div').slideToggle();
    return false;
  });
});
</script> 