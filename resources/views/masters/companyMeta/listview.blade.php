<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div >
      <table width="100%" id="meta_listing" class="table table-responsive table-striped">
        <thead>
                <tr>
					<th>{{__('#')}}</th>					
					<th>{{__('Meta Name')}}</th>
					<th>{{__('Meta Value')}}</th>
					<th>{{__('Status')}}</th>
					<th>{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					
				@if(count($results)>0)
				@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
				@foreach ($results as $status)
				<tr>
					<td>{{$i++}}</td>
					<td>{{$status->meta_name}}</td>
					<td>{{$status->meta_value}}</td>
					<td>
					@if($status->status == 1){{__('Active')}}
					@else{{__('Inactive')}}
					@endif</td>
					<td >
					
					<!--<a href="javascript:void(0)" onclick="deletePop('company_meta/' + {{ $status->id }},{{ $status->id }})" class="btn btn-default">
					<i class="fa fa-trash" aria-hidden="true"></i></a>-->
					
					<a href="{{route('company_meta.edit', $status->id)}}"  class="btn btn-default"><i class="far fa-edit"></i></a></td>
					
				</tr>
				@endforeach
				@else
					<tr >
					<td>No Data Found</td>
					</tr>
				@endif
				</tbody>

      </table>
	 <div class="col-md-12 text-right first"> {{ $results->render() }}</div>
	  <a href="{{route('company_meta.create')}}" type="button" class="floating-btn btn-add">+</a>
	  
    </div>


