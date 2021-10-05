<div class="row mt-3">
<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
<div class="col-md-8 table-responsive" id="product_container1">
<div class="table-widget table-responsive m-0" style="overflow: visible;">
<table width="100%" id="faq_lists" class="table table-striped">
        <thead>
        <tr>
		    <th>#</th>
		    <th>{{__('Docket Number')}}</th>
		    <th>{{__('Customer Name')}}</th>
		    <th>{{__('Escalated To')}}</th>
		    <th>{{__('Escalation Due Date')}}</th>
		    <th>{{__('Enquiry')}}</th>
		    <th>{{__('Enquired on')}}</th>
		    <th>{{__('Priority')}}</th>
		    <th width="130">{{__('Status')}}</th>
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
				<td>
					@if(isset($res->customer_id))
						@if(!Helpers::checkPermission('show hidden details') AND $res->GetCustomer->hide_details == 1)
						{{"___"}}					
						@else
							{{$res->GetCustomer->first_name}} {{$res->GetCustomer->middle_name}} {{$res->GetCustomer->last_name}}						
						@endif
					@endif
				</td>
				<td>@if($res->GetEscalateUser != NULL){{$res->GetEscalateUser->name}}
				@else {{__('Null')}}@endif</td>
				<td>{{$res->escalation_due_date}}</td>
				<td>{{$res->req_title}}</td>
				<td>{{$res->created_at}}</td>
				<td>
					@if(isset($res->priority))
				<span class="{{$res->GetPriority->name}}" aria-hidden="true" 
					  data-toggle="tooltip" data-placement="top" title="Priority {{$res->GetPriority->name}}">	 	
					  {{str_limit($res->GetPriority->name, $limit = 1, $end = '')}}
				</span>
				@endif
				</td>
				<td>
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
				<td colspan="9" class="text-center">{{__('No Data Found')}}</td>
				</tr>
			@endif
		</tbody>
	</table>
    </div>
	<div class="d-flex justify-content-end first"> {{ $results->render() }}</div>
</div>

<div class="col-md-4 pl-sm-0">
<div class="widget">
        <h2>Task Summary(Only for escalated) <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Only for escalated"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
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
							    if(isset($master_querytype_check[$nme]) && !empty($master_querytype_check[$nme])) { ?><td align="center"><a  href="#" onclick="summary_count_click({{$master_querytype_check[$nme]}},'{{$key}}','task_list_con');"><?php if(isset($valued[$nme]) && !empty($valued[$nme])) { echo $valued[$nme];} else { echo 00;}?></a></td> <?php  }?>
							   @endforeach
							 <?php } ?>
							</tr>
							@endforeach
						<?php }else{?>
						<tr>
						  <td colspan="" class="text-center">No Data Found</td>
						</tr>
				<?php  }?>

            </table>
        </div>
</div>
<div class="widget">
        <h2>MY Task Summary <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="MY Task Summary"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
        <div class="widget-scroller table-responsive">
            <?php if(count($my_task) >0)
			{ ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive table-bordered escalation-summary" align="center">
						<tr>
							<th scope="col"> # Me</th>
							@foreach ($master_querytype as $value)
							<th colspan="3" align="center">{{$value['name']}}</th>
							@endforeach
						</tr> 
						<?php  $all_escalation2[]='';?>
						
						@foreach ($my_task as $values2)
						    <?php 
							$my_cnts =$values2->counts;
							$my_ty =$values2->query_type;
							$my_lead =$values2->query_status;
							$my_nm =$master_querytype[$my_ty]['name'];
							$my_name = str_replace(" ","_",$my_nm);
							
                        $my_conts_c1 = 0;  $my_conts_p1 = 0; $my_conts_r1 = 0;
							
						if(isset($master_status[$my_lead]) && !empty($master_status[$my_lead])) 
						{
							foreach ($master_querytype as $my_total_mast_val)
								 {
									$my_total_mast_nme = str_replace(" ","_",$my_total_mast_val['name']);
									if($my_name == $my_total_mast_nme)
									{
										$master_querytype[$my_ty][$my_name.'total_cont'] = $master_querytype[$my_ty][$my_name.'total_cont'] + $my_cnts;
										
										if(in_array($my_lead,$set_closed_category_arr))
										{
											$my_conts_c1 = $my_conts_c1 + $my_cnts;
											$all_escalation2[$my_name]['c']=$my_conts_c1;
										}
										else if($my_lead == $set_re_open_category)
										{
											$my_conts_r1 = $my_conts_r1 + $my_cnts;
											$all_escalation2[$my_name]['r']=$my_conts_r1;
										}
										else
										{
											$my_conts_p1 = $my_conts_p1 + $my_cnts;
											$all_escalation2[$my_name]['p']=$my_conts_p1;
										}
									}
								 }
							$val2 = $all_escalation2[$my_name]['t']=$my_cnts;
						}
		                ?>
						@endforeach
                                            
						@foreach ($all_escalation2 as $key=>$value)
							<?php if($key != '0') {  ?>
							<tr class="<?php if($key != '0') { echo 'Total';} ?>">
							  <th rowspan="2" scope="row"><?php if($key != '0') { echo 'My Tasks';} ?></th>
							  @foreach ($master_querytype as $mast_value)
							    <?php $nme = str_replace(" ","_",$mast_value['name']);
										if(isset($master_querytype_check[$nme]) && !empty($master_querytype_check[$nme])) 
										{ ?>
										 <td colspan="3" align="center"><?php if(isset($value2[$nme]['t']) && !empty($value2[$nme]['t'])) { echo $value2[$nme]['t'];} else { echo 0;}?></td>
								<?php   }?>
								@endforeach
							</tr>
							<tr class="<?php if($key != '0') {echo 'Closed';} ?>">
								@foreach ($master_querytype as $mast_value)
							    <?php $nme = str_replace(" ","_",$mast_value['name']);
										if(isset($master_querytype_check[$nme]) && !empty($master_querytype_check[$nme])) 
										{ ?>
										<td title="Processing" align="center"><?php if(isset($value2[$nme]['p']) && !empty($value2[$nme]['p'])) { echo $value2[$nme]['p'].'-P';} else { echo '0-P';}?></td>
										<td title="Closed" align="center"><?php if(isset($value2[$nme]['c']) && !empty($value2[$nme]['c'])) { echo $value2[$nme]['c'].'-C';} else { echo '0-C';}?></td>
										<td title="Re Open" align="center"><?php if(isset($value2[$nme]['r']) && !empty($value2[$nme]['r'])) { echo $value2[$nme]['r'].'-R';} else { echo '0-R';}?></td>
								<?php   }?>
								@endforeach
							</tr>
							<?php } ?>
							@endforeach
            </table>
			<?php }else{?>
						<tr>
						  <td><center>
							  <h4>No Data Found</h4>
							</center></td>
						</tr>
			<?php  }?>
        </div>
    </div>
	<div class="widget">
        <h2>Other Task Summary <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Other Task Summary"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
        <div class="widget-scroller table-responsive">
            <?php if(count($other_task) >0)
			{ ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive table-bordered escalation-summary" align="center">
						<tr>
							<th scope="col"> # Escalation To</th>
							@foreach ($master_querytype as $value)
							<th colspan="3" align="center">{{$value['name']}}</th>
							@endforeach
						</tr> 
						<?php  $all_escalation3[]='';?>
						@foreach ($other_task as $values3)
						    <?php 
							$esc_cnts =$values3->counts;
							$esc_ty =$values3->query_type;
							$esc_lead =$values3->query_status;
							$esc =$values3->escalate;
							$esc_frm =$values3->created_by;
							$esc_nm =$master_querytype[$esc_ty]['name'];
							$esc_name = str_replace(" ","_",$esc_nm);
							
                        $othr_conts1 = 0; $othr_conts_c1 = 0;  $othr_conts_p1 = 0; $othr_conts_r1 = 0;
							
						if(isset($master_status[$esc_lead]) && !empty($master_status[$esc_lead])) 
						{
							foreach ($master_querytype as $total_mast_val)
								 {
									$total_mast_nme = str_replace(" ","_",$total_mast_val['name']);
									if($esc_name == $total_mast_nme)
									{
										$master_querytype[$esc_ty][$esc_name.'total_cont'] = $master_querytype[$esc_ty][$esc_name.'total_cont'] + $esc_cnts;
										//$all_escalation3['Total'][$total_mast_nme]= $master_querytype[$esc_ty][$esc_name.'total_cont'];
										
										if(in_array($esc_lead,$set_closed_category_arr))
										{
											$othr_conts_c1 = $othr_conts_c1 + $esc_cnts;
											$all_escalation3[$esc][$esc_name]['c']=$othr_conts_c1;
										}
										else if($esc_lead == $set_re_open_category)
										{
											$othr_conts_r1 = $othr_conts_r1 + $esc_cnts;
											$all_escalation3[$esc][$esc_name]['r']=$othr_conts_r1;
										}
										else
										{
											$othr_conts_p1 = $othr_conts_p1 + $esc_cnts;
											$all_escalation3[$esc][$esc_name]['p']=$othr_conts_p1;
										}
									}
								 }
							$val3 = $all_escalation3[$esc][$esc_name]['t']=$esc_cnts;
						}
		                ?>
						@endforeach
						@foreach ($all_escalation3 as $key=>$value3)
							<?php if($key != '0') {  ?>
							<tr class="<?php if($key != '0') { echo 'Total';} ?>">
							   <th rowspan="2" scope="row"><?php if(isset($esc_master_status[$key]) && !empty($esc_master_status[$key])) { echo $esc_master_status[$key];} else {echo 'No name- id:'.$key;} ?></th>
							  @foreach ($master_querytype as $mast_value)
							    <?php $nme = str_replace(" ","_",$mast_value['name']);
										if(isset($master_querytype_check[$nme]) && !empty($master_querytype_check[$nme])) 
										{ ?>
										 <td colspan="3" align="center"><?php if(isset($value3[$nme]['t']) && !empty($value3[$nme]['t'])) { echo $value3[$nme]['t'];} else { echo 0;}?></td>
								<?php   }?>
								@endforeach
							</tr>
							<tr class="<?php if($key != '0') {echo 'Closed';} ?>">
								@foreach ($master_querytype as $mast_value)
							    <?php $nme = str_replace(" ","_",$mast_value['name']);
										if(isset($master_querytype_check[$nme]) && !empty($master_querytype_check[$nme])) 
										{ ?>
										<td title="Processing" align="center"><?php if(isset($value3[$nme]['p']) && !empty($value3[$nme]['p'])) { echo $value3[$nme]['p'].'-P';} else { echo '0-P';}?></td>
										<td title="Closed" align="center"><?php if(isset($value3[$nme]['c']) && !empty($value3[$nme]['c'])) { echo $value3[$nme]['c'].'-C';} else { echo '0-C';}?></td>
										<td title="Re Open" align="center"><?php if(isset($value3[$nme]['r']) && !empty($value3[$nme]['r'])) { echo $value3[$nme]['r'].'-R';} else { echo '0-R';}?></td>
								<?php   }?>
								@endforeach
							</tr>
							<?php } ?>
							@endforeach
            </table>
			<?php }else{?>
						<tr>
						  <td><center>
							  <h4>No Data Found</h4>
							</center></td>
						</tr>
			<?php  }?>
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
        <h5 class="modal-title">{{__('Details')}}</h5>
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
