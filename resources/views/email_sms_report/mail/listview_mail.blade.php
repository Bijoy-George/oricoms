<input type="hidden" name="list_count" id="list_count" value="@isset($report){{$report->total()}}@endisset">
<div class="table-widget table-responsive">
  <table width="100%" id="faq_lists" class="table m-0">
    <thead>
      <tr>
        <th width="30" class="text-center">#</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Type</th>
        <th>Subject</th>
        <th>Source</th>
        <th>Response</th>
        <th>Created at</th>
       
      </tr>
    </thead>
    <tbody>
    
    <?php 
                $sms_delivery_status = config('constant.SMS_DELIVERY_STATUS'); 
                $email_delivery_val = config('constant.EMAIL_DELIVERY_STATUS'); 
            ?>
        <?php   if(isset($report) && (count($report) > 0)){
        $i = ($report->currentpage()-1) * $report->perpage() +  1; ?>
        @foreach($report as $row)
        <tr id="default" class="default" class="temp_popup" onclick="get_email_sms_detail('{{$row->id}}','2','{{$row->created_at}}')" data-toggle="modal" data-target="#mail_sms_template">
          <td >{{$i++}}</td>
      <td >
        @if ($row->customer_id != '')
        {{ Helpers::find_customer_name($row->customer_id) }}
      @else
        {{ Helpers::find_contact_name($row->contact_id) }}
      @endif
      
      </td>
      <td >{{$row->mobile}}</td>
      <td >{{$row->email}}</td>
      <td >{{Helpers::find_sent_type($row->sent_type) }}</td>
                  <td> 
                      @if(($row->sent_type == 1) && !empty($row->subject))  <a class="btn" onclick=""  data-toggle="modal" data-target="#myModal"> {{ $row->subject }} </a> @endif 
                      @if(($row->sent_type == 2))  <a class="btn" onclick=""  data-toggle="modal" data-target="#myModal" > {{ $row->subject }} </a> @endif
                  </td>        
      <td >{{Helpers::find_source_type($row->source) }}</td>
                   
      <td >{{ config('constant.EMAIL_DELIVERY_STATUS_REV')[$row->status] ?? ''}}
          </td>
          <td >{{helpers::common_date_conversion($row->created_at,3) }}</td>
          
     
    </tr>
    
        @endforeach
        <?php }else{ ?>
       <tr id="default" class="default"><td style="text-align: center;" colspan="10">No Data Found</td></tr>
       <?php }?>
        </tbody>
      </table>    
</div>
<div class="d-flex justify-content-end first"> {{ $report->render() }}</div>
