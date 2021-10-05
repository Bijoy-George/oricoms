<div class="widget">
  <h2>{{__('Escalation Email / SMS')}}</h2>


	<div class="table-widget table-responsive mt-0 pt-0 subtable">  
	    <h5>{{__('Escalation Email Listing')}}</h5>
		<table width="100%" id="officer_email_history_req" class="table height-small history-table m-0">
		  <thead>
			<tr>
			  <th>#</th>
			  <th scope="col">Date</th>
			  <th scope="col">Docket Number</th>
			  <th scope="col">Subject </th>
			  <th scope="col">Email To</th>
			  <th scope="col" width="10%">Response</th> 
			</tr>
		  </thead>
		  <tbody>
		  
		  @php  $i = 1; 	 @endphp 
		  @if(count($escalation_email_array)>0)
		  @foreach($escalation_email_array as $row)
		  <tr class="anchor-wrap">
			<td scope="col">{{$i}} </td>
			<td scope="col">{{$row->created_at}}</td>
			<td scope="col">{{$row['docket_number_det']['docket_number']}}</td>
			<td scope="col">{{$row->subject}}</td>
			<td scope="col">{{$row->email}}</td>
			<td scope="col">{{$row->response}}</td>
		  </tr>
		  @php $i++ @endphp
		  @endforeach
		  @else
		  <tr>
			<td colspan="6" class="text-center">No Data Found</td>
		  </tr>
		  @endif
		  </tbody>
		  
		</table>
	</div>

	  <div class="table-widget table-responsive mt-0 pt-0 subtable">
	    <h5>{{__('Escalation SMS Listing')}}</h5>
		<table width="100%" id="officer_sms_history_req" class="table table-striped history-table m-0">
		  <thead>
			<tr >
			  <th>#</th>
			  <th scope="col">Date</th>
			  <th scope="col">Docket Number</th>
			  <th scope="col">Subject</th>
			  <th scope="col">SMS To</th>
			  <th scope="col" width="10%">Response</th> 
			</tr>
		  </thead>
		  <tbody>
		  
		  @php  $i = 1; 	 @endphp 
		  @if(count($escalation_sms_array)>0)
		  @foreach($escalation_sms_array as $row_sms)
		  <tr class="anchor-wrap">
			<td scope="col">{{$i}} </td>
			<td scope="col">{{$row_sms->created_at}}</td>
			<td scope="col">{{$row_sms['docket_number_det']['docket_number']}}</td>
			<td scope="col">{{$row_sms->subject}}</td>
			<td scope="col">{{$row_sms->mobile}}</td>
			<td scope="col">{{$row_sms->response}}</td>
		  </tr>
		  @php $i++ @endphp
		  @endforeach
		  @else
		  <tr>
			<td colspan="6" class="text-center">No Data Found</td>
		  </tr>
		  @endif
		  </tbody>
		  
		</table>
	  </div>

</div>