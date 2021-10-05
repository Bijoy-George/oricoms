<div class="table-widget table-responsive">
<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div id="product_container1">
    <table class="table" id="leads_table">
      <thead>
      <tr>
        <th width="30">#</th>
        <th>Customer Name</th>
		    <th>Mobile Number</th>
        <th>Email</th>
        <th>Enquiry status</th>
        <th>Priority</th>
        <th>Call status</th>
        <th></th>
        <th scope="col" width="20">
          <div class="checkboxFour">
          <label class="control control--checkbox">
          <input type="checkbox" id="selectall" class="selectall1" onclick="check_all_checkbox()">  
          <div class="control__indicator"></div>
          </label>
          </div>
        </th>
        <th width="50"><button class="btn btn-primary btn-sm"  onclick="choose_agent()" >Assign</button></th>
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
		    <td >{{$lead->mobile_number}}</td>
        <td >{{$lead->email}}</td> 
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
                     
      <td >@if($lead->assigned_agent == 0)<span style="color:red">{{'Not Assigned'}}</span> @else<span style="color:green">{{'Assiged to '.$lead->agent_name}}</span>@endif</td> 
       <td ></td> 
        <td >
           <label class="control control--checkbox">
                <input type="checkbox" class="case" name="customer_id[]" id="customer_id{{$lead->id}}" value="{{$lead->id}}" onclick="clearvalue({{$lead->id}})"><div class="control__indicator"></div>
           </label>

        </td>
        
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
  </div>