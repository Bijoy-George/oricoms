<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget" >
      <table width="100%" id="faqcategory_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('Id')}}</th>					
					<th>{{__('Institution Name')}}</th>
					<th>{{__('Short Code')}}</th>
					<th>{{__('Slug')}}</th>
					
					<th>{{__('Sort Order')}}</th>
					<th>{{__('Status')}}</th>
					<th class="text-center">{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					@if(count($results)>0)
					@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp
					@foreach ($results as $institution)
					<tr>
						<td class="text-center">{{$i++}}</td>
						<td><strong>{{$institution->institution_name}}</strong></td>
						<td><strong>{{$institution->short_code}}</strong></td>
						<td><strong>{{$institution->slug}}</strong></td>
						
						
						<td>{{$institution->sort_order}}</td>
						<td>
						@if($institution->status == 1){{__('Active')}}
						@else{{__('Inactive')}}
						@endif</td>
						<td class="text-center">
						
						<!--<a href="{{route('institution.edit', $institution->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>--></td>
						

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

	  
    


