<div class="row">
  <div class="col-sm-12">
  	<span class="badge badge-secondary">Docket Number:{{$docket_number}}</span>
	<h4>{{strip_tags($details->req_title)}} 
	<!--<a onclick="download_history('{{$docket_number}}','{{$details->id}}')"><span class="download_history"><i class="fa fa-file-excel" aria-hidden="true"></i></a>-->
	</span>	
	</h4>
	@foreach($followup_log_det as $value)
	<div class="col-sm-12 followup-status-list"> 
		@php
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
			<p>status: {{$value->GetQueryStatus->name}}</p>
		@endif
		
		@if($value->priority != '')
			Priority: {{$value->GetPriority->name}}
		@endif
		
		<p>@if(!empty($value->updated_at) && $value->updated_at != '0000-00-00 00:00:00') <strong>Updated at:</strong> 
		{{Helpers::common_date_conversion($value->updated_at,3) }}
		@else Nil @endif</p>
			
		<p>
		<strong>Followup Date:</strong> 
		@if(!empty($value->remainder_date) && $value->remainder_date != '0000-00-00 00:00:00') 
		{{Helpers::common_date_conversion($value->remainder_date,3) }}
		@else Nil @endif</p>
		
		@if(!empty($value->ard_no))
        	 <div class="mb-1"><em><strong>ARD NO : </strong>{{$value->ard_no}}</em></div>
      	@endif 
      	@if(!empty($value->location))
	         <div class="mb-1"><em><strong>Location : </strong>{{$value->location}}</em></div>
     	@endif

		<div class="row ques_todo">
			<div class="col-sm-12">
				<div class="text height q{{$i}}">
					<b>Question: </b>{{strip_tags($value->question)}}
				</div>
				<p>@if(isset($q_rm) && ($q_rm == 1))
					<a class="readmore rq{{$i}}" onclick="change_height('q{{$i}}')">Read more</a>
				@endif
				</p>
			</div>
		</div>
		<div class="row ques_todo">
			<div class="col-sm-12">
				<div class="text height a{{$i}}">
					<b>Todo: </b>
					<?php echo "$value->answer"; ?>
				</div>
				<p>@if(isset($ans_rm) AND $ans_rm == 1)
					<a class="readmore ra{{$i}}" onclick="change_height('a{{$i}}')">Read more</a>
				@endif</p>
			</div>
		</div> 
		
		@if(strip_tags($value->short_message)!='')
		<p><small>{{strip_tags($value->short_message)}}</small></p>
		@endif 
		
		@php $i++; @endphp
	</div>	
	@endforeach
    
	
  </div>
</div>