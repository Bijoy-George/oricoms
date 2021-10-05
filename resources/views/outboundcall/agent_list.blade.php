<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="table-widget table-responsive " id="product_container1">
     <table class="table" id="leads_table">
      <thead>
      <tr>
        <th width="30">#</th>
        <th>Customer Name</th>
		    <th>Docket Number</th>
        <th>Enquiry Title</th>
        <th>Enquiry status</th>
        <th>Priority</th>
        <th>Lead Source</th>
        <th>Followup Date</th>
        <th>Action</th>       
      </tr>
      </thead>
      <tbody>
      <?php 
     if(isset($followups) && (count($followups) > 0)){
      $i = ($followups->currentpage()-1) * $followups->perpage() +  1; ?>
      @foreach($followups as $lead)
      
      <tr id="default" class="default">
        <td >{{$i++}}</td>
        <td >{{$lead->first_name}} {{$lead->last_name}}</td>
		    <td >{{$lead->id}}</td>
        <td >{{$lead->req_title}}</td> 
       <td >  {{$lead->status_name}}</td>  
        <td> @if(!empty($lead->priority) && ($lead->priority == 1 )) 
    
        <span class="label label-info">low</span>@endif
       @if(!empty($lead->priority) && ($lead->priority == 2 )) 
    
        <span class="label label-warning">Medium</span>
        @endif
        @if(!empty($lead->priority) && ($lead->priority == 3 )) 
    
        <span class="label label-danger">High</span>
        @endif
      </td>         
		    <td > @foreach($cus_lead_source as $key => $country)
            @if($lead->lead_source_id == $key) {{$country}}@endif
            @endforeach</td>
        <td >@if(!empty($lead->remainder_date))
        {{helpers::common_date_conversion($lead->remainder_date) }}
        @endif </td>              
        
        <td ><a href="{{url('profile')}}/0/{{$lead->profile_id}}/0/0/{{$lead->id}}" class="btn btn-default"><i class="fa fa-phone" aria-hidden="true"></i></a></td>
        
      </tr>
      @endforeach
       <?php }else{ ?>
       <tr id="default" class="default"><td style="text-align: center;" colspan="10">No Data Found</td></tr>
       <?php }?>
      </tbody>
    </table>

    <div class="col-md-12 text-right first" >

      {!! $followups->render() !!}</div>
  </div>