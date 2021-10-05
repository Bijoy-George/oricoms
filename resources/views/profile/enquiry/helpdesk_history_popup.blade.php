<div class="row">
  <div class="col-sm-12">
  	<h5><span class="badge badge-secondary mb-3">Docket Number: {{$docket_number}}</span></h5>
    @if(Helpers::checkPermission('export in helpdesk'))
      <h5>{{strip_tags($details->req_title)}} <a onclick="download_history('{{$docket_number}}','{{$details->id}}')" class="btn btn-outline-secondary btn-sm"><img src="{{ asset('img/ic_download.svg') }}" height="20" alt="Help"/></a></h5>
    @endif
  </div>
    @foreach($followup_log_det as $value)
    <div class="col-sm-12">
      <div class="followup-status-list mb-2">@php
      $i = 1;	
      $answer=strip_tags($value->answer);
      if (mb_strlen($answer) > 256) {
      $ans_det = mb_substr($answer, 0, 256);
      $answer = mb_substr($ans_det, 0, mb_strrpos($ans_det, ' '));  
      $answer.='...';
      $ans_rm = 1;
      }else{
      $ans_rm = 0;
      }
      $ques=strip_tags($value->question);
      if (mb_strlen($ques) > 256) {
      $ques_det = mb_substr($ques, 0, 256);
      $ques = mb_substr($ques_det, 0, mb_strrpos($ques_det, ' '));  
      $ques.='...';
      $q_rm = 1;
      }else{
      $q_rm = 0;
      }
      @endphp
      
      @if($value->query_status != '')
      <div class="mb-1"><strong>Status:</strong> <span class="badge badge-success">{{$value->GetQueryStatus->name}}</span></div>
      @endif
      
      @if($value->priority != '')
      <div class="mb-1"><strong>Priority:</strong> <span class="badge badge-secondary">{{$value->GetPriority->name}}</span></div>
      @endif
      <div class="mb-1">@if(!empty($value->updated_at) && $value->updated_at != '0000-00-00 00:00:00') <strong>Updated at:</strong> {{Helpers::common_date_conversion($value->updated_at,3) }}
        @else Nil @endif</div>
      <div class="mb-1"> <strong>Followup Date:</strong> @if(!empty($value->remainder_date) && $value->remainder_date != '0000-00-00 00:00:00') 
        {{Helpers::common_date_conversion($value->remainder_date,3) }}
        @else Nil @endif</div>
      @if($value->escalate!=NULL && $value->escalate!=0 && $value->GetEscalateUser->name != '' && $value->GetEscalateUser->name != NULL)
      <div class="mb-1"><em><strong>Escalated From :</strong> {{$value->GetEscalateFrom->name}}</em></div>
      <div class="mb-1"><em><strong>Escalated to :</strong> {{$value->GetEscalateUser->name}}</em></div>
      @else
        <div class="mb-1"><em><strong>Updated By :</strong> {{$value->GetEscalateFrom->name}}</em></div>
      @endif
      @if(!empty($value->ard_no))
         <div class="mb-1"><em><strong>ARD NO : </strong>{{$value->ard_no}}</em></div>
      @endif 
      @if(!empty($value->location))
         <div class="mb-1"><em><strong>Location : </strong>{{$value->location}}</em></div>
      @endif
      <div class="row ques_todo">
        <div class="col-sm-12">
          <div class="text height q{{$i}}"><strong>Question: {{strip_tags($value->question)}}</strong></div>
        </div>
      </div>
      <div class="row ques_todo">
        <div class="col-sm-12">
          <div class="text height a{{$i}}"> <b>Todo: </b> <?php echo "$value->answer"; ?> </div>
        </div>
      </div>
	  
		@if(count($value->GetAttachment))
			@foreach($value->GetAttachment as $attach)
			<a href="{{ url('download_fbreport/'.$attach->attachment_file_name.'/attachments') }}">{{$attach->attachment_original_name}}</a>,&nbsp;

			@endforeach
		@endif
		
      @if(strip_tags($value->short_message)!='')
      <div class="pt-2"><img src="{{ asset('img/ic_info_outline.svg') }}" width="15" > {{strip_tags($value->short_message)}}</div>
      @endif 
      
      @php $i++; @endphp</div>
    </div>
    @endforeach 
    
    <!--{{--@if(!empty($fb_details->rating) || !empty(strip_tags($fb_details->comments)) && !empty($fb_details->questions))
  <div class="col-sm-12" id="fb_div">
    @php 
        $fbtype='';
        $fb_cat=config('constant.FB_TYPE');
	@endphp
    @foreach($fb_cat as $key => $type)
		@if($fb_details->fb_type == $key)
			@php $fbtype=$type;@endphp
		@endif
    @endforeach
    <p style="color:#147bd4;"> <i><b>Followup Feedback - <span>Medium : {{$fbtype}}</span></b></i></p>
    <p id="comments_p">Comments : {{strip_tags($fb_details->comments)}}</p>
    <p id="rating_p">
    <div class="rating-stars">
		<ul id='stars' class="stars">
		Rating : 
		@php 
		$rating_arr=config('constant.chat_feedback_rating');?>
		@foreach ($rating_arr as $key =>$type)
            @php if($key <= $fb_details->rating){ $c_class = 'star checked'; }else{ $c_class = 'star';} @endphp
			<li  class="@php echo $c_class;@endphp" title='{{$type}}' data-value='{{$key}}'>
			<i class='fa fa-star fa-fw'></i>
			</li>
        @endforeach
        </ul>
    </div>
    </p>
    @php $question_det=$fb_details->questions;@endphp
    @if(!empty($question_det))
    <p><i><b>Questions</b></i></p>
    @foreach($question_det as $key => $row) <span><i>{{$key+1}}.  {{$row->questions}}<br>
    Answer : <b>{{strtoupper($row->answer)}}</b> </i></span><br>
    @endforeach
    @endif </div>
@endif
  --}} --> 
  </div>