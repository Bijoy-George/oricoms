    <div class="table-widget">
      <table width="100%" id="feedback_lists" class="table">
        <thead>
        <tr>
		    <th width="30" class="text-center">#</th>
		    <th>Survey Name {{__('Language1')}} </th>
		    <th>Survey Name {{__('Language2')}}</th>
		    <th>Expiry Date</th>
		    <th>Created By</th>
		    <th>Created On</th>
		    <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
			@php  $i = ($results->currentpage()-1) * $results->perpage() +  1; 	@endphp
			@if(count($results)>0)
			@foreach ($results as $val)
			<tr>
				<td class="text-center">{{$i++}}</td>
				<td><strong>@if($val->survey_name_lang1	 !='') {{$val->survey_name_lang1	}} @endif</strong></td>
				<td><strong>@if($val->survey_name_lang2	 !='') {{$val->survey_name_lang2	}} @endif</strong></td>
				 <td> @if(!empty($val->expiry_date))
		        {{date('d-m-Y', strtotime($val->expiry_date)) }}
		        @endif</td>
		        <td>@if(!empty($val['survey_author']['name'])) {{ $val['survey_author']['name'] }} @endif</td>
	            <td> @if(!empty($val->created_at))
		        {{ $val->created_at->format('d-m-Y H:i:s A') }}
		        @endif</td>
				<td class="text-center">
				<a href="{{route('survey.edit', $val->id)}}"  class="btn btn-outline-secondary btn-sm"><i class="far fa-edit"></i></a></td>
			</tr>
			@endforeach
			@else
				<tr >
				<td colspan="7">No Data Found</td>
				</tr>
			@endif
		</tbody>
				
				
				
      </table>
    </div>
<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>

