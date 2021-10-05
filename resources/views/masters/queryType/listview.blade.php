<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget">
      <table width="100%" id="querytype_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('#')}}</th>					
					<th>{{__('Department')}}</th>
					<th>{{__('Type')}}</th>
					<th>{{__('Short Code')}}</th>
					<th>{{__('Status')}}</th>
					<th class="text-center">{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					@if(count($results)>0)
					@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp
					@foreach ($results as $querytype)
					<tr>
						<td class="text-center">{{$i++}}</td>
						<td><strong>{{$querytype->query_type}}</strong></td>
						<td>
						@if($querytype->type == 1)
						{{__('Ticket') }}@else{{__('Follow up') }}@endif</td>
						<td>{{$querytype->short_code}}</td>
						<td>@if($querytype->status == 1){{__('Active')}}@else{{__('Inactive')}}@endif</td>
						<td class="text-center">
						
                        <!--@if( Helpers::checkPermission('query type delete'))
						<a href="javascript:void(0)" onclick="deletePop('query_type/' + {{ $querytype->id }},{{ $querytype->id }})" class="btn btn-default">
						<i class="fa fa-trash" aria-hidden="true"></i></a>
                        @endif-->
                        
						@if( Helpers::checkPermission('query type edit'))
						<a href="{{route('query_type.edit', $querytype->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
						@endif
						</td>
                        
						
					</tr>
					@endforeach
					@else
						<tr >
						<td>No Data Found</td>
						</tr>
					@endif
				</tbody>

        </tbody>
      </table>
	  </div>
	  
	  <div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
	  
	  {{-- 
	  <div class="col-md-12 text-right first"> {{ $results->render() }}
	 </div>
	 @if( Helpers::checkPermission('query type create'))
	   <a href="{{route('query_type.create')}}" type="button" class="floating-btn btn-add">+</a>
	  @endif
    </div>
--}}

