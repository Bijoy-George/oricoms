<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget" >
      <table width="100%" id="querytype_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Designation')}}</th>
					<th>{{__('Sort Order')}}</th>
					<th>{{__('Status')}}</th>
					<th class="text-center">{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					
					@if(count($results)>0)
					@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
					@foreach ($results as $designation)
					<tr>
					<td class="text-center">{{$i++}}</td>
					<td><strong>{{$designation->designation}}</strong></td>
					<td>{{$designation->sort_order}}</td>
					<td>
					@if($designation->status == 1){{__('Active')}}
					@else{{__('Inactive')}}
					@endif</td>
					<td class="text-center" >
					
					@if( Helpers::checkPermission('designation edit'))
					<a href="{{route('designations.edit', $designation->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
					@endif</td>
					
					</tr>
					@endforeach
					@else
						<tr>
						<td colspan="5" align="center">No Data Found</td>
						</tr>
					@endif
				</tbody>

        </tbody>
      </table>
    </div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>

