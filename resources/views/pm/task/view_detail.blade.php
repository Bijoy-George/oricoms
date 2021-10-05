<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget" >
    <table width="100%" id="querytype_lists" class="table">
	{{--<thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Members')}}</th>
					<th>{{__('Spent Time')}}</th>		
					<th>{{__('Projects')}}</th>
				</tr>
        </thead>
        <tbody>
					
		@php $cur_date = date('Y-m-d') @endphp
		@if(count($results)>0)
		@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
		@foreach ($results as $res)

			
			@php $pid = Helpers::get_task_details($res->task_id)->project_id; @endphp
			@php $pname = Helpers::get_project_details($pid)->prjt_name; @endphp
		    
		    @php $uid = Helpers::get_members_by_project_id($pid); @endphp
		

		@foreach ($uid as $key =>$value)
			
		<tr>
			<td class="text-center">{{$i++}}</td>
			<td>{{$value}}</td>
					
		@php $from_time =  \Carbon\Carbon::parse($res->from_time) @endphp
		@php $to_time =  \Carbon\Carbon::parse($res->to_time) @endphp
		@php $time = 0; @endphp
        @php $mins = $to_time->diffInMinutes($from_time, true); @endphp
        @php $mins = $mins/60; @endphp
        @php $time = $time+$mins; @endphp		

			<td>{{$time}}</td>
			<td>{{$pname}}</td>	
		</tr>
		     @endforeach
		
		@endforeach
					
		@else
		<tr>
			<td colspan="10">No Data Found</td>
		</tr>
		@endif

	</tbody>--}}
      </table>
	    <table width="100%" id="querytype_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Members')}}</th>
					<th>{{__('Spent Time')}}</th>		
					<th>{{__('Projects')}}</th>
				</tr>
        </thead>
        <tbody>
	    @if(count($out_array)>0)
			@php  $i = 1 @endphp
			@foreach($out_array as $data)
				<tr>
				<td>{{$i}}</td>
				<td>{{Helpers::get_username_by_id($data['user_id'])}}</td>
				<td>{{$data['taken_time']}}</td>
				<td>{{Helpers::get_projectids_from_task_array($data['task_ids'])}}</td>
				</tr>
				@php  $i = $i+1 @endphp
			@endforeach
	    @else
		<tr>
			<td colspan="4">No Data Found</td>
		</tr>
	    @endif

	   </tbody>
      </table>
    </div>
<div class="d-flex justify-content-end first"> </div>
