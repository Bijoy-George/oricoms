<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget" >
      <table width="100%" id="querytype_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>	
					<th>{{__('Name')}}</th>	
					<th>{{__('ProjectName')}}</th>			
					<th>{{__('Task')}}</th>
					<th>{{__('From')}}</th>
					<th>{{__('To')}}</th>
					<th>{{__('Hours')}}</th>

				</tr>
                </thead>
                <tbody>
					
					@if(count($results)>0)
					@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
					@foreach ($results as $res)
					@php $pname = Helpers::get_project_details($res->task->project_id)->prjt_name ;@endphp
					
					<tr>
					<td class="text-center">{{$i++}}</td>
					<td>{{Helpers::get_user($res->user_id)->name}}</td>
					<td>{{$pname}}</td>
					<td><strong>{{Helpers::get_task_details($res->task_id)->title}}</strong></td>
					<td>{{Helpers::common_date_conversion($res->from_time,3)}}</td>
					<td>{{Helpers::common_date_conversion($res->to_time,3)}}</td>
					<?php  
						$t1 = \Carbon\Carbon::parse($res->from_time);
						$t2 = \Carbon\Carbon::parse($res->to_time);
						$diff = $t1->diffInMinutes($t2);  
						$diff = $diff/60;  
						$diff = round($diff,1);
					?>
					<td>{{$diff}}</td>
	
					
					</tr>
					@endforeach
					@else
						<tr>
						<td colspan="6">No Data Found</td>
						</tr>
					@endif
				</tbody>
      </table>
    </div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>

