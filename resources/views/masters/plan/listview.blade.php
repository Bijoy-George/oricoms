<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget" >
  <table width="100%" id="leadsourcetypes_lists" class="table">
    <thead>
      <tr>
        <th width="30" class="text-center">{{__('#')}}</th>
        <th>{{__('Plan')}}</th>
        <th>{{__('Plan Description')}}</th>
        <th>{{__('Discount on first subscription')}}</th>
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
        <td><strong>{{$plan->plan}}</strong></td>
        <td>{{$plan->plan_des}}</td>
        <td>{{$plan->discount}}</td>
        <td>{{$plan->sort_order}}</td>
		<td>
				@if($plan->status == config('constant.ACTIVE')){{__('Active')}}
				@else{{__('Inactive')}}
				@endif
		</td>
        <td class="text-center" >
        <a href="{{route('plan.edit', $plan->id)}}" title="Edit Details" class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
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
