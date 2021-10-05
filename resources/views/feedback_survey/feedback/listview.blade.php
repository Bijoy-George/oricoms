    <div class="table-widget">
      <table width="100%" id="feedback_lists" class="table">
        <thead>
        <tr>
		    <th width="30" class="text-center">#</th>
		    <th>Type</th>
		    <th>Query Type</th>
		    <th>Status</th>
		    <th class="text-center">Action Time</th>
        </tr>
        </thead>
        <tbody>
			@php  $i = ($results->currentpage()-1) * $results->perpage() +  1; 	@endphp
			@if(count($results)>0)
			@foreach ($results as $val)
			<tr>
				<td class="text-center">{{$i++}}</td>
				<td>@foreach($fb_type as $key => $type)
		             @if($val->fb_type == $key) {{ $type }} @endif
		          @endforeach</td>
				<td>@foreach($query_type as $key => $type)
		             @if($val->query_type == $type->id) {{ $type->query_type }} @endif
		          @endforeach</td>
		        <td>@php 
		          $fb_status=$val->fb_status;
		          $res=array();
		          if(!empty($fb_status)){
		            foreach ($fb_status as $key => $value) {
		              $res[]=$value->name;

		            }
		             $status=implode(",",$res);
		           }else{
		             $status='Nil';
		           }@endphp
		           {{$status}}</td>
		          <td class="text-center"> @if($val->action_time !='') {{$val->action_time}} minutes @endif</td>
				
			</tr>
			@endforeach
			@else
				<tr >
				<td colspan="5">No Data Found</td>
				</tr>
			@endif
		</tbody>
				
				
				
      </table>
	 
    </div>

<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>