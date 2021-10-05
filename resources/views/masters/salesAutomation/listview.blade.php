<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget">
      <table width="100%" id="process_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Stage')}}</th>
					<th>{{__('Department')}}</th>
					<th>{{__('Is First')}}</th>
					<th>{{__('Action')}}</th>
					<th>{{__('Positive Response')}}</th>
					<th>{{__('Negative Response')}}</th>
					<th>{{__('Action Time')}}</th>
					<th>{{__('Expiry Time')}}</th>
					<th>{{__('Content')}}</th> 
					<th>{{__('Helpdesk Due')}}</th> 
					<th>{{__('Helpdesk CC')}}</th>
					<th class="text-center">{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					@if(count($results)>0)
					@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp
					@foreach ($results as $process)
					<tr>
						<td class="text-center">{{$i++}}</td>
						<td><strong>{{$process->process_name}}</strong></td>
						<td>{{Helpers::get_auto_process_department($process->department) }}</td>
						<td>@if(isset($process->is_first) && ($process->is_first==1)) <img src="{{asset('img/tick.png')}}" style="width:15px;">  @endif</td>
						<td>{{Helpers::get_auto_process_action($process->action) }}</td>
						<td>{{$process->response_pos}}</td>
						<td>{{$process->response_neg}}</td>
						<td>@if(isset($process->action_time)){{$process->action_time}} @if(isset($process->action_time_param)) @if($process->action_time_param==1) Mins @elseif($process->action_time_param==2) Hrs @elseif($process->action_time_param==3) Days   @endif  @endif @endif</td>
						<td>@if(isset($process->expiry_time)) {{$process->expiry_time}} @if(isset($process->expiry_time_param)) @if($process->expiry_time_param==1) Mins @elseif($process->expiry_time_param==2) Hrs @elseif($process->expiry_time_param==3) Days   @endif  @endif @endif</td>
						<td>@isset($process->content){{Helpers::get_template_subject($process->content) }}@endisset </td>
						<td>@if(isset($process->expiry_flag) && ($process->expiry_flag==1)) <img src="{{asset('img/tick.png')}}" style="width:15px;">  @endif</td>
						<td>@if(isset($process->additional_cc_flag) && ($process->additional_cc_flag==1)) <img src="{{asset('img/tick.png')}}" style="width:15px;">  @endif</td>
						<td class="text-center">
						{{--@if( Helpers::checkPermission('sales automation edit'))--}}
						<a href="{{route('sales_automation.edit', $process->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
						<!--<a href="javascript:void(0)" onclick="deletePop('sales_automation/' + {{ $process->id }},{{ $process->id }})" class="btn btn-default">
						<i class="fa fa-trash" aria-hidden="true"></i></a>-->
							{{--@endif--}}
						</td>
						
					</tr>
					@endforeach
					@else
						<tr >
						<td>No Data Found</td>
						</tr>
					@endif
				</tbody>

     
      </table>

    </div>

	<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>


