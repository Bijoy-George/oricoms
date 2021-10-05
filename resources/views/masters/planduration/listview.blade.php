<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget" >
  <table width="100%" id="leadsourcetypes_lists" class="table">
    <thead>
      <tr>
        <th width="30" class="text-center">{{__('#')}}</th>
        <th>{{__('Plan Name')}}</th>
		<th>{{__('Plan Amount')}}</th>
		<th>{{__('Duration')}}</th>
		<th>{{__('Valid from')}}</th>
		<th>{{__('Valid To')}}</th>
		<th>{{__('Sort Order')}}</th>
		<th>{{__('Status')}}</th>
		<th class="text-center">{{__('Action')}}</th>
      </tr>
    </thead>
    <tbody>
    
    @if(count($results)>0)
    @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
    @foreach ($results as $plan)
    <tr>
        <td class="text-center">{{$i++}}</td>
        <td><strong>{{$plan->GetParentPlan->plan}}</strong></td>
        <td>{{$plan->amount}}</td>
		<td>{{$plan->duration}}</td>
		<td>{{$plan->start_date}}</td>
		<td>{{$plan->end_date}}</td>
		<td>{{$plan->sort_order}}</td>
		<td>
			@if($plan->status == 1){{__('Active')}}
			@else{{__('Inactive')}}
			@endif</td>
		
        <td class="text-center" >
		
                @php 
					$status=config('constant.ACTIVE');
		         	$status_inactive=config('constant.INACTIVE');
		        @endphp
				
				@if($plan->status != $status_inactive) <a href="{{url('plan_duration_edit', $plan->id)}}" title="Edit Details" class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a> @endif 
				@if($plan->status == $status)
		           <a href="javascript:void(0)" onclick="deletePop('remove_plan_duration',{{$plan->id}})" class="btn btn-default"><i class="fa fa-trash" aria-hidden="true"></i></a>
		        @endif
		        @if($plan->status == $status_inactive)
		           <a href="javascript:void(0)" onclick="activatePop('activate_plan_duration',{{$plan->id}})" class="btn btn-default"><i class="fas fa-toggle-on"></i></a>
		        @endif
			</td>
				
       
		
      </tr>
    @endforeach
    @else
    <tr >
      <td colspan="7" align="center">No Data Found</td>
    </tr>
    @endif
      </tbody>
    
  </table>
</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
