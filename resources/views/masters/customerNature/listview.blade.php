<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget" >
      <table width="100%" id="querytype_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Customer Nature')}}</th>
					<th>{{__('Sort Order')}}</th>
					<th>{{__('Status')}}</th>
					<th class="text-center">{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					
					@if(count($results)>0)
					@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
					@foreach ($results as $custnature)
					<tr>
					<td class="text-center">{{$i++}}</td>
					<td><strong>{{$custnature->customer_nature}}</strong></td>
					<td>{{$custnature->sort_order}}</td>
					<td>
					@if($custnature->status == 1){{__('Active')}}
					@else{{__('Inactive')}}
					@endif</td>
					<td class="text-center" >
					<!--@if( Helpers::checkPermission('customer nature delete'))
					<a href="javascript:void(0)" onclick="deletePop('customer_nature/' + {{ $custnature->id }},{{ $custnature->id }})" class="btn btn-default">
					<i class="fa fa-trash" aria-hidden="true"></i></a>
					@endif-->
					
					@if( Helpers::checkPermission('customer nature edit'))
					<a href="{{route('customer_nature.edit', $custnature->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
					@endif</td>
					
					</tr>
					@endforeach
					@else
						<tr>
						<td>No Data Found</td>
						</tr>
					@endif
				</tbody>

        </tbody>
      </table>
    </div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>

