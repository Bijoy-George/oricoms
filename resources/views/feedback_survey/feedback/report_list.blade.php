    <div class="table-widget">
      <table width="100%" id="feedback_lists" class="table">
        <thead>
        <tr>
		    <th width="30" class="text-center">#</th>
		    <th scope="col">Customer Name</th>
	        <th scope="col">Reference Number</th>
	        <th scope="col">Comment</th>
	        <th scope="col">Rating</th>
	        <th scope="col">Channel</th>
			<th scope="col">Agent</th>
	        <th scope="col">Submitted On</th>
		    <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
			@php  $i = ($results->currentpage()-1) * $results->perpage() +  1; 	@endphp
			@if(count($results)>0)
				@foreach ($results as $val)
				<tr>
				<td class="text-center">{{$i++}}</td>
				<td ><strong>{{ $val->feedback_profile->first_name ?? '' }} 
					{{ $val->feedback_profile->middle_name ?? '' }}
					{{ $val->feedback_profile->last_name ?? '' }}  </strong></td>
	        	<td >@if(!empty($val->reference_id)){{$val->reference_id}}@elseif(!empty($val->thread_id)){{$val->thread_id}}@else {{''}}@endif</td>
	        	<td >{{$val->comments}}</td>
	        	<td >
	        		@php $rating_arr=config('constant.FB_RATING');
	        		     $rating_arr[0]='--';
	        		 @endphp
			       {{ $rating_arr[$val->rating] }}     
	        		<!--<div class="rating-stars">
			            <ul id='stars' class="stars">
			          	@php
			            $rating_arr=config('constant.FB_RATING'); @endphp
			            @foreach ($rating_arr as $key =>$type)
			                            @php if($key <= $val->rating){ 
			                            $c_class = 'star checked'; }
			                            else { $c_class = 'star'; }
			            				@endphp

			            <li  class="<?php echo $c_class;?>" title='{{$type}}' data-value='{{$key}}'><i class='fa fa-star fa-fw'></i></li>
			                     
			            @endforeach
			              </ul>
			          </div>-->
	        	</td>
	        	<td>{{ $val['channels']['name'] ?? '' }}</td>
			    <td>@if(isset($val['feedback_reference'][0]['name']) && !empty($val['feedback_reference'][0]['name'])) {{ $val['feedback_reference'][0]['name'] }} @elseif(isset($val['chat_reference'][0]['name']) && !empty($val['chat_reference'][0]['name'])){{ $val['chat_reference'][0]['name'] }} @endif</td>
		        <td >@if(!empty($val->created_at))
			        {{ $val->created_at->format('d-m-Y H:i:s A') }}
			        @endif</td>
		        <td class="text-center" ><a href="javascript:void(0)" onclick="more_feedback_det({{$val->id}},{{$val->fb_type}})" class="btn btn-outline-secondary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
				</tr>
				@endforeach
			@else
				<tr>
				<td>No Data Found</td>
				</tr>
			@endif
		</tbody>
				
				
				
      </table>
    </div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
