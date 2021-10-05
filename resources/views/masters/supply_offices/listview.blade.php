<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
    <div class="table-widget" >
      <table width="100%" id="faqcategory_lists" class="table">
        <thead>
                <tr>
					<th width="30" class="text-center">{{__('Id')}}</th>					
					<th>{{__('Supply Office')}}</th>
					<th>{{__('Head Office')}}</th>
					<th>{{__('Email')}}</th>
					<th>{{__('Sort Order')}}</th>
					<th>{{__('Status')}}</th>
					<th class="text-center">{{__('Action')}}</th>
				</tr>
                </thead>
                <tbody>
					@if(count($results)>0)
					@php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp
					@foreach ($results as $faqCategory)
					<tr>
						<td class="text-center">{{$i++}}</td>
						<td><strong>{{$faqCategory->supply_office}}</strong></td>
						<td>
						@if($faqCategory->parent_id != NULL) 					{{$faqCategory->GetParent->supply_office}} 
						@endif</td>
						<td><strong>{{$faqCategory->email}}</strong></td>

						<!--<td>{{$faqCategory->parent_category_id}}</td>-->
						<td>{{$faqCategory->sort_order}}</td>
						<td>
						@if($faqCategory->status == 1){{__('Active')}}
						@else{{__('Inactive')}}
						@endif</td>
						<td class="text-center">
						<!--<a href="javascript:void(0)" onclick="deletePop('faq_categories/' + {{ $faqCategory->id }},{{ $faqCategory->id }})" class="btn btn-default">
						<i class="fa fa-trash" aria-hidden="true"></i></a>-->
						<a href="{{route('supply_offices.edit', $faqCategory->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a></td>
						

					</tr>
					@endforeach
					@else
						<tr >
						<td class="text-center" colspan="8">No Data Found</td>
						</tr>
					@endif
				</tbody>

        </tbody>
      </table>
	</div>
	<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>

	  
    


