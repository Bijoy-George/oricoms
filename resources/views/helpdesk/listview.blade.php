<div class="row mt-3">
<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="col-md-8" id="product_container1">
    <div class="table-widget table-responsive m-0" style="overflow: visible;">
      <table width="100%" id="faq_lists" class="table table-striped">
        <thead>
          <tr>
@if(Auth::User()->cmpny_id == 32)
              <th><input type="hidden" id="select-all" onclick="selectAllCustomers()"></th>
            @endif

            <th>#</th>
            <th>{{__('Docket NO')}}</th>
            <th>{{__('Customer Name')}}</th>
            <th>{{__('Enquiry')}}</th>
             @if(Auth::user()->cmpny_id == 14)<th>Project</th><th>Demo</th>@endif
            <th>{{__('Type')}}</th>
		@if(Auth::user()->cmpny_id != 32)
             <th>{{__('Priority')}}</th>@endif
             <th>{{ !empty(Helpers::get_company_meta('escalated_to_label')) ? Helpers::get_company_meta('escalated_to_label') : 'Escalate To' }}</th>
            <th width="120">{{__('Status')}}</th>
            <th class="text-right">{{__('Action')}}</th>
          </tr>
          </thead>
        
        <tbody>
        @if(count($results)>0)
	 
        @php $i = ($results->currentpage()-1) * $results->perpage() +  1; @endphp 


        @foreach ($results as $res)
        

        <tr class="anchor-wrap">@php 
          if(in_array($res->query_status,$close_status_arr)){
          $is_close = 1;
          }else{ $is_close = 0; }
          @endphp
		@if(Auth::User()->cmpny_id == 32 && $escalted_test == 2)
            <td><input type="checkbox" class="contact-select" name="customer_id[]" id="customer_id[]" value="{{ $res->id }}" onClick="toggleContact(this)"></td>
          @endif
          <td>{{$i++}}</td>
          <td>{{$res->docket_number}}</td>
          <td><strong>@if(isset($res->customer_id)){{$res->GetCustomer->first_name}} {{$res->GetCustomer->middle_name}} {{$res->GetCustomer->last_name}}
            @else @endif</strong></td>
          <td>{{$res->req_title}}</td>
         @if(Auth::user()->cmpny_id == 14)
         <td>{{ $faq_category[$res->sub_query_category] ??''}}</td>
	<td>{{ config('constant.DEMO.'.$res->demo) }}</td>
	@endif
          <td>@if(isset($res->query_type)){{$res->GetQueryType->query_type}}@else @endif</td>
          <td> 
            @if(isset($res->priority))
            <span class="{{$res->GetPriority->name}}" aria-hidden="true" 
            data-toggle="tooltip" data-placement="top" title="Priority {{$res->GetPriority->name}}">    
              {{str_limit($res->GetPriority->name, $limit = 1, $end = '')}}
            </span>
            @endif
          </td>
          <td>{{ $res->GetEscalateUser->name ?? '' }}</td>
          
          <td><!--.........................--> 
            
            
            @if(isset($res->query_status))
            <span class="status_icon" aria-hidden="true" 
					  style="background-color:#{{$res->GetQueryStatus->color}}" data-toggle="tooltip" data-placement="top" title="Status {{$res->GetQueryStatus->name}}">
              {{str_limit($res->GetQueryStatus->name, $limit = 1, $end = '')}}
            </span>
            @endif
            
            
            </td>
          
          <td>
            <div class="dropdown action-btn">
              <a class="dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-h"></i></a>
            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="javascript:void(0)" onclick="get_helpdesk_history('{{$res->docket_number}}',{{$is_close}})"><i class="fas fa-eye"></i> View Enquries </a>
              <a class="dropdown-item" href="{{url('profile')}}/0/{{$res->customer_id}}" ><i class="fas fa-user"></i> View customer profile</a>
              <a class="dropdown-item" href="javascript:void(0)" onclick="enquiry_listing_popup({{$res->customer_id}})"><i class="fas fa-phone-volume"></i> Followups <span class="count-bdge">{{$res->follo_count}}</span> </a>
            </div>
          </div>
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
    <h2>Helpdesk <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Helpdesk"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
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

  <div class="widget">
    <h2>Statuswise Helpdesk <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Statuswise Helpdesk"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-scroller table-responsive">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table escalation-summary" align="center">
        
        <?php if(count($statuswise_helpdesk_count) >0)
             { ?>
          <tr>
            <th>Status</th>
            <th>Count</th>
          </tr>
          @foreach ($statuswise_helpdesk_count as $query_status_name => $query_status_count)
            <tr>
              <th>{{ $query_status_name }}</th>
              <td>{{ $query_status_count }}</td>
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
        @if(Helpers::checkPermission('Followups Reopen'))
        <div class="row">
          {!! Form::open(array('url' => 'helpdesk_reopen', 'id' =>"helpdesk_reopen", 'class' => 'form-common hide_modal', 'method'=>'POST')) !!}
          <div class="col-sm-12">
                <div class="re_open_sec">
                      <input type="hidden" class="modal_name" name="modal_name" value="f_details">
                      <input type="hidden" id="doc_no" name="docket_number" value="">
                      <textarea rows="3" cols="70" placeholder="Reason for Re-open" id="reason_reopen" name="reason_reopen" rows="2" class="form-control"></textarea>
                      <span id="reason_error"></span>
                      <div id="msg" class="alert" role="alert"></div>
                </div>
          </div>
          <div class="col-sm-12"><br>
              <button type="submit" id="h_reopen_btn" class="re_open_sec btn btn-primary">Re-Open</button>
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          {!! Form::close() !!} 
        </div>
        @else
           <div class="col-sm-12"><br>
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        @endif
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
