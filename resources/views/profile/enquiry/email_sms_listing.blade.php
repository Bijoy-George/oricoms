<div class="widget">
  <h2>{{__('EMAIL / SMS ')}}</h2>


<div class="table-widget table-responsive mt-0 pt-0 subtable">   


	   <h5>{{__('EMAIL Listing')}}</h5>
<table width="100%" id="chat_history_req" class="table height-small history-table m-0">
		  <thead>
			<tr>
			  <th>#</th>
			  <th scope="col">Date</th>
			  <th scope="col">Subject </th>
			  <th scope="col">Source</th>  
			  <th scope="col">Type</th>  
			  <th scope="col" width="10%">Response</th>
			  <th scope="col" width="10%">Status</th>
			  <th scope="col">Last Action Time</th>

			</tr>
		  </thead>
		  <tbody>
		  
		  @php  $i = 1; 	 @endphp 
		  @if(count($email_array)>0)
		  @foreach($email_array as $row)
		  <tr class="anchor-wrap" onclick="get_email_sms_details({{$row->id}});" data-toggle="modal" data-target="#commModal">
			<td scope="col">{{$i}} </td>
			<td scope="col">{{$row->created_at}}</td>
			<td scope="col">
			<a class="btn">{{$row->subject}}</a>
			</td>
			<td scope="col">@if($row['LeadSource']['name'] !=''){{$row['LeadSource']['name']}} @else {{'CRM.'}} @endif</td>
			<td scope="col">{{$row->sms_type}}</td>
			<td scope="col">{{$row->response}}</td>
			<td scope="col">{{config('constant.EMAIL_DELIVERY_STATUS_REV')[$row->status] ?? ''}}({{count($row->sendgrid_open_response)}})</td>
			<td scope="col">{{$row->updated_at}}</td>
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
	  

	


	    <h5>{{__('SMS Listing')}}</h5>
		<table width="100%" id="chat_history_req" class="table table-striped history-table m-0">
		  <thead>
			<tr>
			  <th>#</th>
			  <th scope="col">Date</th>
			  <th scope="col">Subject </th>
			  <th scope="col">Source</th>  
			  <th scope="col">Type</th>  
			  <th scope="col" width="10%">Response</th> 
			</tr>
		  </thead>
		  <tbody>
		  
		  @php  $i = 1; 	 @endphp 
		  @if(count($mobile_array)>0)
		  @foreach($mobile_array as $row_sms)
		   <?php if(!empty($row_sms->content))
                           {
                              $sub= strlen($row_sms->content)<=30 ? $row_sms->content : substr($row_sms->content,0,30).'...';
                              $sub = str_replace("+", " ", $sub);
                           }else
                           {
                              $sub='';
                           }
                           ?>
                            @if(!empty($sub))
		  <tr>
		  <tr>

		  <tr class="anchor-wrap" onclick="get_email_sms_details({{$row_sms->id}});" data-toggle="modal" data-target="#commModal">
			<td scope="col">{{$i}} </td>
			<td scope="col">{{$row_sms->created_at}}</td>


			<td scope="col"><a class="btn">{{$sub}}</a>@endif</td>
			<td scope="col">@if($row_sms['LeadSource']['name'] !=''){{$row_sms['LeadSource']['name']}} @else {{'CRM.'}} @endif</td>
			<td scope="col">{{$row_sms->sms_type}}</td>
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
<div class="modal fade" id="commModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Details</h4>
        </div>
        <div class="modal-body" id="popupContainer">
          <small><span id="subject_email"></span></small>
          <small><span id="created_date" class="pull-right btn-primary btn-xs"></span></small><br>
          <span id="descrip"></span>
          <hr id="delivery-report-divider">
          <div id="delivery-report-wrapper">
          	<h6>Delivery Reports</h6>
          	<div>No. of times opened: <span id="opened_count"></span></div>
          	<div>Last Action Time: <span id="last_action_time"></span></div>
          	<div>Initiated Time: <span id="initiated_time"></span></div>
          	<div>Delivered Time: <span id="delivered_time"></span></div>
          </div>
          <hr id="delivery-history-divider">
          <div id="delivery-history-wrapper">
          	<h6>Delivery History</h6>
          	<ul class="timeline"></ul>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 

</div>
