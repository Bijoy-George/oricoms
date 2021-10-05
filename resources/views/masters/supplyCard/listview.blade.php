<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget">
      <table width="100%" id="querytype_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Name')}}</th>
					<th>{{__('Sort Order')}}</th>
					<th>{{__('Status')}}</th>
					<th class="text-center">{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					
				@if(count($results)>0)
				@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
				@foreach ($results as $cards)
				<tr>
					<td class="text-center">{{$i++}}</td>
					
					<td><strong>{{$cards->name}}</strong></td>
					
					<td>{{$cards->sort_order}}</td>
					<td>
					@if($cards->status == 1){{__('Active')}}
					@else{{__('Inactive')}}
					@endif</td>
					<td class="text-center" >
					
					
						
					@if( Helpers::checkPermission('supply card edit'))
					<a href="{{route('supply_card.edit', $cards->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a></td>
					@endif
				</tr>
				@endforeach
				@else
					<tr >
					<td colspan="5" class="text-center">No Data Found</td>
					</tr>
				@endif
				</tbody>

      </table>
	</div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>


