<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
	<div class="table-widget"> <span id="no_data"></span>
		<input type="hidden" name="l_count" id="l_count" value="@isset($results){{$results->total()}}@endisset">
		<table width="100%" class="table" id="leads_table">
		  <thead>
			  <tr>
				<th scope="col" width="30" class="text-center">#</th>
				<th scope="col">Title</th>
				<th scope="col">Subject</th>
				<th scope="col">Type</th>
				<th scope="col">Sort Order</th>
				<th scope="col">Status</th>
				<th scope="col" class="text-center">Action</th>
			  </tr>
		  </thead>
		  <tbody>
			@if(count($results)>0)
			  @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp
			  @foreach($results as $mail)
		  
			  <tr id="default" class="default">
			  
				<td class="text-center">{{$i++}}</td>
				<td ><strong>{{$mail->title}}</strong></td>
				<td >{{$mail->subject}}</td>
				<td>@if($mail->type != NULL) 
				{{$mail->GetTemplate->name}}
				@endif
				</td>
				<td >{{$mail->sort_order}}</td>
				<td>
					@if($mail->status == 1){{__('Active')}}
					@else{{__('Inactive')}}
					@endif</td>
				<!--<td >
				@if($mail->type == config('constant.CO_SMS')) {{ 'SMS' }} 
				@elseif($mail->type == config('constant.CO_EMAIL')) {{'EMAIL'}} 
				@elseif($mail->type == config('constant.CO_PUSH_MESSAGES')) {{'PUSH MESSAGES'}} @endif</td>-->
				
				<td class="text-center" >
				@if( Helpers::checkPermission('template edit'))
				<a href="{{route('templates.edit', $mail->id)}}" class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a>
				@endif
				</td>
				
			  </tr>
			  
			  @endforeach
			  @else
				<tr >
					No Data Found
					</tr>
			  @endif
			   
			   
		  </tbody>
		</table>
 </div>
 <div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
	 {{--	{{ $results->render() }}
		@if( Helpers::checkPermission('template create'))
		<a href="{{route('templates.create')}}" type="button" class="floating-btn btn-add">+</a>
		@endif
		<div class="col-md-12 text-right" >--}}

