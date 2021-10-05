<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget">
      <table width="100%" id="querytype_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Name')}}</th>
					<th>{{__('Color')}}</th>
					<th>{{__('is_close')}}</th>
					<th>{{__('Sort Order')}}</th>
					<th>{{__('Status')}}</th>
					<th class="text-center">{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					
				@if(count($results)>0)
				@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
				@foreach ($results as $querystatus)
				<tr>
					<td class="text-center">{{$i++}}</td>
					<!--<td>
					@if($querystatus->query_type != NULL) 					{{$querystatus->GetQueryType->query_type}} 
					@endif
					</td>-->
					<td><strong>{{$querystatus->name}}</strong></td>
					<td>{{$querystatus->color}}</td>
					<td>{{$querystatus->is_close}}</td>
					<td>{{$querystatus->sort_order}}</td>
					<td>
					@if($querystatus->status == 1){{__('Active')}}
					@else{{__('Inactive')}}
					@endif</td>
					<td class="text-center" >
					
					<!--@if( Helpers::checkPermission('query status delete'))
					<a href="javascript:void(0)" onclick="deletePop('query_status/' + {{ $querystatus->id }},{{ $querystatus->id }})" class="btn btn-default">
					<i class="fa fa-trash" aria-hidden="true"></i></a>
					@endif-->
						
					@if( Helpers::checkPermission('query status edit'))
					<a href="{{route('query_status.edit', $querystatus->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a></td>
					@endif
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


