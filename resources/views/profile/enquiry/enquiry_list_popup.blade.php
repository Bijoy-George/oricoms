  <div class="table-widget" > <span id="no_data"></span>
    <table border="0" cellspacing="0" cellpadding="0" class="table table-striped">
      <thead>
      <tr>
        <th scope="col">Docket Number</th>
        <th scope="col">Enquiry</th>
        <th scope="col">Lead Source</th>
		<th scope="col">Last Followup Date</th>
    	<th scope="col">Next Followup Date</th>
      </tr>
      </thead>
      <tbody>
      @if(count($results)>0)
	  @foreach ($results as $result)
      <tr id="default" class="default">
        <td >{{$result->docket_number}}</td>
	    <td >{{$result->req_title}}</td>
	    <td >@if(isset($result->lead_source_id)){{$result->GetLeadSource->name}}@else
		@endif</td>
		<td >@if(!empty($result->updated_at) && $result->updated_at != '0000-00-00 00:00:00'){{Helpers::common_date_conversion($result->updated_at,3) }}
		@endif
		</td>    
        <td >@if(!empty($result->remainder_date) && $result->remainder_date != '0000-00-00 00:00:00'){{Helpers::common_date_conversion($result->remainder_date,3) }}
		@endif
		</td> 
      </tr>
      @endforeach
      @else
	  <tr><td colspan="7">No Data Found</td></tr>
	  @endif
      </tbody>
     
    </table>
  </div>