<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget" >
      <table width="100%" id="querytype_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Task')}}</th>
					<th>{{__('Project')}}</th>
					<th>{{__('Priority')}}</th>
					<th>{{__('Members')}}</th>
					<th>{{__('Created Date')}}</th>
					<th>{{__('Task Due Date')}}</th>
					<th>{{__('Allocated')}}</th>
					<th>{{__('Hour Status')}}</th>
					<th>{{__('Status')}}</th>
					<th class="text-center">{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					
					@php $cur_date = date('Y-m-d') @endphp
					@if(count($results)>0)
					@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
					@foreach ($results as $res)
					<tr>
					<td class="text-center">{{$i++}}</td>
					<td><strong>{{$res->title}}</strong></td>
					@php $pjct_dets = Helpers::get_project_details($res->project_id) @endphp
					@php $pstatus = $pjct_dets->status @endphp
					@php $pjct_due_date = $pjct_dets->due_date @endphp
					@php $pdue = \Carbon\Carbon::parse($pjct_due_date)->format('d/m/y') @endphp
					@php $project_name = strtoupper(Helpers::get_project_details($res->project_id)->prjt_name) @endphp
					@if($pstatus == config('constant.ACTIVE'))
					<td title="Due Date : {{$pdue}}">
						@if($pjct_due_date < $cur_date)
							<span style="color:#ec6a1e;">{{$project_name}}</span>
						@else
							<span>{{$project_name}}</span>
						@endif
					</td>	
					@else
					<td title="Deleted Project">
						<span style="color:#F40029;">{{$project_name}}</span>
					</td>
					@endif
					<td>
					<?php  $priority_name = Helpers::get_master_values($res->priority); $priority_name = strtolower($priority_name); ?>
					@if(isset($priority_name))
					<span class="{{$priority_name}}" aria-hidden="true" 
					data-toggle="tooltip" data-placement="top" title="Priority {{$priority_name}}">    
					  {{str_limit($priority_name, $limit = 1, $end = '')}}
					</span>
					@endif
					</td>
					<td>{{Helpers::get_unserialized_member_names($res->members)}}</td>
					<td>{{\Carbon\Carbon::parse($res->created_at)->format('d/m/Y')}}</td>
					@php $due_date = $res->due_date @endphp
					@php $due_date_format = Helpers::common_date_conversion($due_date) @endphp
					<?php
						$due = new DateTime($due_date);
						$current = new DateTime($cur_date);
						$diff = $current->diff($due)->format("%a");
						$task_status = Helpers::get_master_values($res->task_status);
					?>
					@if(($task_status == 'Closed')||($task_status == 'closed'))
						<td>{{$due_date_format}}</td>
					@else
						@if($due_date < $cur_date)
						<td><span style="color:#F40029;" title="<?php echo 'Exceeded '.$diff.' days'; ?>">{{$due_date_format}}</span></td>	
						@else
							<td title="<?php echo $diff.' Days left'; ?>">{{$due_date_format}}</td>
						@endif
					@endif	
					<td>{{$res->required_time.' Hours'}}</td>
					<td>{{Helpers::get_tasktime_left($res->id)}}</td>
					<td>{{$task_status}}
						{{--@if($res->status == 1){{__('Active')}}
					@else{{__('Inactive')}}
					@endif--}}</td>
					<td class="text-center" >
					<!--@if( Helpers::checkPermission('customer nature delete'))
					<a href="javascript:void(0)" onclick="deletePop('project_task_pm/' + {{ $res->id }},{{ $res->id }})" class="btn btn-default">
					<i class="fa fa-trash" aria-hidden="true"></i></a>
					@endif-->
					
					@if( Helpers::checkPermission('task edit'))
					<a href="{{route('project_task_pm.edit', $res->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
					@endif
					<a href="javascript:void(0)" title="Delete" onclick="deletePop('project_task_pm/' + {{ $res->id }})" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
					@if( Helpers::checkPermission('tracker create'))
					<a href="{{url('tracker/create', $res->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-clock"></i> Add Schedule</a>
					@endif
					</td>
					
					</tr>
					@endforeach
					@else
						<tr>
						<td colspan="10">No Data Found</td>
						</tr>
					@endif
				</tbody>

        </tbody>
      </table>
    </div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>

