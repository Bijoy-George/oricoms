<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget" >
      <table width="100%" id="priority_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Priority')}}</th>
					<th>{{__('Sort Order')}}</th>
					<th>{{__('Status')}}</th>
					<th class="text-center">{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					
				@if(count($results)>0)
				@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp
				@foreach ($results as $priority)
				<tr>
					<td class="text-center">{{$i++}}</td>
					<td><strong>{{$priority->name}}</strong></td>
					<td>{{$priority->sort_order}}</td>
					<td>
					@if($priority->status == 1){{__('Active')}}
					@else{{__('Inactive')}}
					@endif</td>
					<td class="text-center"> 
					<!--@if( Helpers::checkPermission('customer priority delete'))
						<a href="javascript:void(0)" onclick="deletePop('priority/' + {{ $priority->id }},{{ $priority->id }})" class="btn btn-default">
					<i class="fa fa-trash" aria-hidden="true"></i></a>
					@endif-->
						
					@if( Helpers::checkPermission('customer priority edit'))
						<a href="{{route('priority.edit', $priority->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
					@endif
					</td>
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




