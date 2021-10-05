<div class="row">
  <div class="col-12">
<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div" id="product_container1">
 <table class="table" id="leads_table">
    <thead>
      <tr>
        <th width="30">#</th>
        <th>Phone</th>
        <th>Call Type</th>
        <th>Time</th>
        <th>Status</th>
		<th width="30" >
          <div class="checkboxFour">
          <label class="control control--checkbox">
          <input type="checkbox" id="selectall" class="selectall1" onclick="check_all_checkbox()">  
          <div class="control__indicator"></div>
          </label>
          </div>
        </th>
         <th width="50"><button class="btn btn-primary"  onclick="choose_agent()" >Assign</button></th>
      </tr>
    </thead>
    <tbody>
      <?php   if(isset($call_detail) && (count($call_detail) > 0)){
        $i = ($call_detail->currentpage()-1) * $call_detail->perpage() +  1; ?>
    @foreach($call_detail as $calls)
    <tr id="default" class="default">
      <td >{{$i++}}</td>
      <td >{{$calls->phone}}</td>
      <td >{{$calls->type}}</td>
      <td ><?php if($calls->created_at !='1970-01-01 00:00:00'){ ?>
        {{Helpers::common_date_conversion(($calls->created_at),3) }}
        <?php }else { echo '--';} ?></td>
     <!-- <td ><?php
          $status_type= $calls->status;
            if($status_type==0){
                echo "Unattended";
           }
           else if($status_type==1){
                echo "Attended";
           }
           else if($status_type==2){
                echo "Call back";
           }
           ?></td>-->
	    <td >@if($calls->assigned_agent == 0)<span style="color:red">{{'Not Assigned'}}</span> @else<span style="color:green">{{'Assiged to '.$calls->agent_name}}</span>@endif</td> 
        <td >
           <label class="control control--checkbox">
                <input type="checkbox" class="case" name="customer_id[]" id="customer_id{{$calls->id}}" value="{{$calls->id}}" onclick="clearvalue({{$calls->id}})"><div class="control__indicator"></div>
           </label>
        </td>
    </tr>
    @endforeach
    <?php }else{ ?>
    <tr id="default" class="default">
      <td style="text-align: center;" colspan="7">No Data Found</td>
    </tr>
    <?php }?>
      </tbody>
    
  </table>
  <div class="col-md-12 text-right first">{!! $call_detail->render() !!}</div>
  </div>
</div>