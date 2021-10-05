    <div class="table-widget">
      <table width="100%" id="feedback_lists" class="table">
        <thead>
        <tr>
		    <th width="30" class="text-center">#</th>
		    <th scope="col">Survey Name {{__('Language1')}}</th>
	        <th scope="col">Survey Name {{__('Language2')}}</th>
	        <th scope="col">Total Count</th>
	        <th scope="col">Total Response</th>
			<th scope="col">Created On</th>
		    <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
			@php  $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp
			@if(count($results)>0)
				@foreach ($results as $val)

				<tr>
				<td class="text-center">{{$i++}}</td>
				<td >{{ $val['survey_mast']['survey_name_lang1'] ?? '' }} </td>
	        	<td >{{ $val['survey_mast']['survey_name_lang2'] ?? '' }} </td>
	        	<td >{{$val->process_count}}</td>
	        	<td >{{count($val['survey_det'])}}</td>
			    <td >@if(!empty($val->created_at))
			        {{ $val->created_at->format('d-m-Y H:i:s A') }}
			        @endif</td>
		        <td class="text-center" ><a href="javascript:void(0)" onclick="more_survey_det({{$val->survey_id}},{{$val->process_count}},{{count($val['survey_det'])}})" class="btn btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a><a href="javascript:void(0)" onclick="export_survey_report({{$val->survey_id}},{{$val->process_count}},{{count($val['survey_det'])}})" class="btn btn-default"><i class="fa fa-download" aria-hidden="true"></i></a><a href="javascript:void(0)" onclick="survey_customer_report({{$val->survey_id}},{{$val->process_count}},{{count($val['survey_det'])}})" class="btn btn-default"><i class="fa fa-download" aria-hidden="true"></i></a></td>
				</tr>
				@endforeach
			@else
				<tr>
				<td colspan="7">No Data Found</td>
				</tr>
			@endif
		</tbody>
				
				
				
      </table>
    </div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
