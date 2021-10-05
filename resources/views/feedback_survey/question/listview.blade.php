    <div class="table-widget">
      <table width="100%" id="question_lists" class="table">
        <thead>
        <tr>
		    <th width="30" class="text-center">#</th>
		    <th>Questions</th>
		   <!-- <th>Created On</th>-->
		    <th class="text-center">Action</th>
        </tr>
        </thead>
        
		
		
		<tbody>
			@php  $i = ($results->currentpage()-1) * $results->perpage() +  1; 	@endphp
			@if(count($results)>0)
			@foreach ($results as $res)
			<tr>
				<td class="text-center">{{$i++}}</td>
				<td><strong>{{strip_tags($res->questions)}}</strong></td>
				<td class="text-center" >
<a href="{{route('questions.edit', $res->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a></td>
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
