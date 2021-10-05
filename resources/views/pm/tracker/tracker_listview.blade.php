<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget" >
      <table width="100%" id="querytype_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Task')}}</th>
					<th>{{__('From')}}</th>
					<th>{{__('To')}}</th>
					<th>{{__('Hours')}}</th>
					<th>{{__('Status')}}</th>
						{{--<th class="text-center">{{__('Action')}}</th>--}}
				</tr>
                </thead>
                <tbody>
					
					@if(count($results)>0)
					@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
					@foreach ($results as $res)
					<tr>
					<td class="text-center">{{$i++}}</td>
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
					<td>
					@php
					$mast_val = Helpers::get_master_values($res->status)
					@endphp
					<input type="button" name="" value="@if($mast_val=='Closed') 
						{{'C'}}
					@elseif($mast_val=='Open')
						{{'O'}}
					@else
						{{'P'}}
					@endif" class="btn @if($mast_val=='Closed') 
						{{'btn-success'}}
					@elseif($mast_val=='Open')
						{{'btn-default'}}
					@else
						{{'btn-warning'}}
					@endif">
					</td>
					{{--<td class="text-center" >
					
					
					@if( Helpers::checkPermission('tracker edit'))
					<a href="{{url('tracker_data/edit',$res->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
					@endif
					@if( Helpers::checkPermission('tracker edit'))
					<a href="{{route('tracker.edit', $res->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="fa fa-plus"></i></a>
					@endif
					</td>--}}
					
					</tr>
					@endforeach
					@else
						<tr>
						<td colspan="6">No Data Found</td>
						</tr>
					@endif
				</tbody>

        </tbody>
      </table>
    </div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>

