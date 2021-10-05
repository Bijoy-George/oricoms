<div class="row mt-3">
<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="col-md-8" id="product_container1">
    <div class="table-widget m-0">
      <table width="100%" id="faq_lists" class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>{{__('Docket NO')}}</th>
            <th>{{__('Customer Name')}}</th>
            <th>{{__('Title')}}</th>
            <th>{{__('Type')}}</th>
            <th>{{__('Ticket Channel')}}</th>
            <th width="120">{{__('Status')}}</th>
            <th>{{__('Action')}}</th>
          </tr>
          </thead>
        
        <tbody>
        @if(count($results)>0)
        @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 
        @foreach ($results as $res)
        <tr>@php 
          if(in_array($res->query_status,$close_status_arr)){
          $is_close = 1;
          }else{ $is_close = 0; }
          @endphp
          <td>{{$i++}}</td>
          <td>{{$res->docket_number}}</td>
          <td><strong>@if(isset($res->customer_id)){{$res->GetCustomer->first_name}} {{$res->GetCustomer->middle_name}} {{$res->GetCustomer->last_name}}
            @else @endif</strong></td>
          <td>{{$res->req_title}}</td>
          <td>@if(isset($res->query_type)){{$res->GetQueryType->query_type}}@else @endif</td>
          <td>@if(isset($res->lead_source_id)){{$res->GetLeadSource->name}}
            @else @endif</td>
          
          <td><!--.........................--> 
            <a href="javascript:void(0)" onclick="enquiry_listing_popup({{$res->customer_id}})"class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Followup count"><span class="btn-img">{{$res->follo_count}}</span></a>
            
            <a href="javascript:void(0)" onclick="get_followup_history('{{$res->docket_number}}',{{$is_close}})" class="ss btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Followup History"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
            
            @if(isset($res->query_status))
            <span class="status_icon" aria-hidden="true" 
					  style="background-color:#{{$res->GetQueryStatus->color}}" data-toggle="tooltip" data-placement="top" title="Status {{$res->GetQueryStatus->name}}">
              {{str_limit($res->GetQueryStatus->name, $limit = 1, $end = '')}}
            </span>
            @endif
            
            @if(isset($res->priority))
            <span class="{{$res->GetPriority->name}}" aria-hidden="true" 
					  data-toggle="tooltip" data-placement="top" title="Priority {{$res->GetPriority->name}}">	 	
              {{str_limit($res->GetPriority->name, $limit = 1, $end = '')}}
            </span>
            @endif
            </td>
          
          <td><a href="{{url('profile')}}/0/{{$res->customer_id}}" class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="View customer profile"><i class="fas fa-user"></i></a>
            </td>
          </tr>
        @endforeach
        @else
        <tr >
          <td colspan="8" class="text-center">{{__('No Data Found')}}</td>
          </tr>
        @endif
        </tbody>
      </table>
    </div>
	<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
</div>

<div class="col-md-4 pl-sm-0">
  <div class="widget">
    <h2>Followups <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Followups"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-scroller table-responsive">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table escalation-summary" align="center">
        
        <?php if(count($dds) >0)
					   { ?>
        <tr>
          <th> # Status</th>
          @foreach ($master_querytype as $value)
          <th align="center">{{$value['name']}}</th>
          @endforeach
          </tr> 
        <?php $all_escalation[]=''; ?>
        @foreach ($dds as $value1)
        <?php 
							$cnt =$value1->counts;
							$lead =$value1->query_status;
							$ty =$value1->query_type;
							$nm =$master_querytype[$ty]['name'];
							$name = str_replace(" ","_",$nm);
							
							if(isset($master_status[$lead]) && !empty($master_status[$lead])) 
							{
								foreach ($master_querytype as $total_mast_val)
								 {
									$total_mast_nme = str_replace(" ","_",$total_mast_val['name']);
									if($name == $total_mast_nme)
									{
										$master_querytype[$ty][$name.'total_cont'] = $master_querytype[$ty][$name.'total_cont'] + $cnt;
										$all_escalation['Total'][$total_mast_nme]= $master_querytype[$ty][$name.'total_cont'];
									}
								 }
								
								$val = $all_escalation[$lead][$name]=$cnt;
							}
		                ?>
        @endforeach
        @foreach ($all_escalation as $key=>$valued)
        <tr class="<?php if($key != '0') {  if($master_status[$key] != '0') { echo $master_status[$key];} } ?>">
          <?php if($key != '0') {  ?>
          <th><?php if($master_status[$key] != '0') { echo $master_status[$key];} ?></th>
          @foreach ($master_querytype as $mast_value)
          <?php $nme = str_replace(" ","_",$mast_value['name']);
							    if(isset($master_querytype_check[$nme]) && !empty($master_querytype_check[$nme])) { ?><td align="center"><a  href="#" onclick="summary_count_click({{$master_querytype_check[$nme]}},'{{$key}}','help_desk_con');"><?php if(isset($valued[$nme]) && !empty($valued[$nme])) { echo $valued[$nme];} else { echo 00;}?></a></td> <?php  }?>
          @endforeach
          <?php } ?>
          </tr>
        @endforeach
        <?php }else{?>
        <tr>
          <td colspan="2" class="text-center">{{__('No Data Found')}}</td>
          </tr>
        <?php  }?>
        
        </table>
    </div>
  </div>
</div>
</div>

<!-- Model popup Starts -->
					
<div class="modal" id="f_details"  role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">History Details</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" >
        <div id="follo_popup" class="follo_popup"></div>
        <div class="col-md-12">
          <div id="msg_err" style=""></div>
        </div>
      </div>
      <div class="modal-footer">
       
           <div class="col-sm-12"><br>
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>
</div>
<!-- Model popup Ends   -->
<!-- Model popup Starts -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered"> 
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="popupContainer"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Model popup Ends   -->
