<div class="col-md-4 px-2  mb-2">
  <div class="widget color-card p-3">
    <h5>Todays Followup</h5>
    <h4 class="count" style="color: #ffc627;">{{ $followup_called_count }} <small class="text-white">/ {{ $followup_all_count }} </small></h4>
    <a href="{{url('/todayfollowup')}}" class="btn btn-primary-outline">Check</a>
    </div>
  </div>

@if(Helpers::checkPermission('todays performance'))
<div class="container card-body">
    <ul id="tabs" class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a id="tab-toady" href="#pane-today" class="nav-link active" data-toggle="tab" role="tab">Todays performance</a>
        </li>
		<li class="nav-item">
            <a id="tab-yesterday" href="#pane-yesterday" class="nav-link" data-toggle="tab" role="tab">Agents performance</a>
        </li>
        
    </ul>

  @if(Helpers::checkPermission('todays performance'))
    <div id="content" class="tab-content" role="tablist">
        <div id="pane-today" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-today">
        
                <div class="card-body">
				
									  <div class="col-md-6 p-2">
									  <div class="widget followup">
										<h2>Today's Performance</h2>
										<div class="widget-scroller table-responsive">
										  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped" id="todays-performance">
											<!--<tr>
											  <td><span>Contacted Customers</span></td>
											  <td><span id="contacted"></span></td>
											</tr>-->
											<tr>
											  <td><span>Valid Customers</span></td>
											  <td><span id="valid"></span></td>
											</tr>
											<tr>
											  <td><span>Success</span></td>
											  <td><span id="success"></span></td>
											</tr>
											<tr>
											  <td><span>Demo Interested</span></td>
											  <td><span id="interested"></span></td>
											</tr>
											<tr>
											  <td><span>Demo Not Interested</span></td>
											  <td><span id="notinterested"></span></td>
											</tr>
											<tr>
											  <td><span>Call Later</span></td>
											  <td><span id="call_later"></span></td>
											</tr>
											<!--<tr>
											  <td><span>Wrong Number</span></td>
											  <td><span id="wrong_number"></span></td>
											</tr>-->
											<tr>
											  <td><span>No Response</span></td>
											  <td><span id="no_response"></span></td>
											</tr>
											<!--<tr>
											  <td><span>Distant Location</span></td>
											  <td><span id="distant_location"></span></td>
											</tr>
											<tr>
											  <td><span>Do Not Disturb</span></td>
											  <td><span id="dnd"></span></td>
											</tr>
											<tr>
											  <td><span>Vehicles Sold</span></td>
											  <td><span id="vehicles_sold"></span></td>
											</tr>
											<tr>
											  <td><span>Miscellaneous</span></td>
											  <td><span id="miscellaneous"></span></td>
											</tr>-->
										  </table>
										</div>
									  </div>
									</div>
						
                </div>
            
        </div>
    @endif
        @if(Helpers::checkPermission('agents performance'))     

        <div id="pane-yesterday" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-yesterday">
                       
                <div class="card-body">
				
                                        <div class="col-md-6 p-2">
										  <div class="widget followup">
											<h2>Agents Performance</h2>
											<div class="widget-scroller table-responsive">
											
											  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped" id="agent-performance">
											   
											   <tbody>    </tbody>
												
											  </table>
											  </td></tr>
											</table>
											</div>
										  </div>
										</div>
										
                </div>
            
        </div>
	@endif	
    </div>
</div>
 @endif
<div class="row">
@if (Helpers::checkPermission('helpdesk summary chart'))
<div class="col-md-4 p-2">
  <div class="widget">
    <h2>Helpdesk Summary <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Summarizes Tickets & Service requests under various status"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-content" id="container-helpdesk-summary" style="height:150px"> </div>
  </div>
</div>
@endif

@if (Helpers::checkPermission('agent wise helpdesk summary chart'))
<div class="col-md-4 p-2">
  <div class="widget">
    <h2>Agent-wise Helpdesk Summary <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Summarizes Tickets & Service requests under various agents"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-content" id="container-agent-helpdesk-summary" style="height:150px"> </div>
  </div>
</div>
@endif

@if (Helpers::checkPermission('escalation summary chart'))
<div class="col-md-4 p-2">
  <div class="widget">
    <h2>Escalation Summary <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Summarizes escalations under various status"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-content" id="container-escalation-summary" style="height:150px"> </div>
  </div>
</div>
@endif
@if(Helpers::checkPermission('lead source conversion graph'))
<div class="col-md-6 p-2">
  <div class="widget">
    <h2>Lead Source Conversion <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Lead Source Conversion statistics"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-content" id="container-lead-source-conversion"> </div>
  </div>
</div>
@endif
@if (Helpers::checkPermission('country wise registration chart'))
<div class="col-md-6 p-2">
  <div class="widget">
    <h2>Country Wise Registration <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Shows top most country wise customer registration count"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-content" id="container-country-registration"> </div>
  </div>
</div>
@endif
@if(helpers::checkPermission('enquiry date wise count'))
<div class="col-md-7 p-2">
  <div class="widget">
    <h2>Enquiry Date Wise Count <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Date wise customer enquiries statistics"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-content" id="leads_line_chart"> </div>
  </div>
</div>
@endif
@if(helpers::checkPermission('enquiry by source graph'))
<div class="col-md-5 p-2">
  <div class="widget">
    <h2>Enquiry By Source <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Enquiry by Source statistics"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-content" id="container-lead-source-week"> </div>
  </div>
</div>
@endif
@if(helpers::checkPermission('daily followup graph'))
<div class="col-md-4 p-2">
  <div class="widget followup">
    <h2>Today's Followup</h2>
    <div class="widget-scroller table-responsive">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped" id="daily-followup-table">
      </table>
    </div>
  </div>
</div>
@endif
@if (isset($cmpny_query_types) && !empty($cmpny_query_types))
    @if(helpers::checkPermission('ticket followup graph'))

      @foreach ($cmpny_query_types as $query_type_id => $query_type_name)
      <div class="col-md-4 p-2">
        <div class="widget">
                <h2>{{ $query_type_name }} <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="@if($query_type_name != 'chat ticket')Customer {{ $query_type_name }} under various status @else Shows status of Customer compalaints raised via chat @endif"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
                <div class="widget-content ticket-followup" id="graph_{{ $query_type_name }}" style="height:250px"> </div>
              </div>
      </div>
      @endforeach
      @endif 

<input type="hidden" id="query_types" value="{{ json_encode($cmpny_query_types) }}">
@endif
@if(helpers::checkPermission('feedback settings'))
<div class="col-md-6 p-2" >
  
  <div class="widget rating-overview">
    <div id="fb_rating_div"></div>
  
  </div>
</div>
@endif
@if(helpers::checkPermission('feedback settings'))
<!-- <div class="col-md-4 p-2">
  <div class="widget">
    <div id="trending_queryies_div"></div>
  </div>
</div> -->
@endif
@if(helpers::checkPermission('survey statistics graph'))
<div class="col-md-6 p-2">
  <div class="widget">
    <h2>Survey Statistics <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Statistics for survey response"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-content" id="container-survey"></div>
  </div>
</div>
@endif
<!--*************** pie chart ends************* --> 
<!--*************** count ends************* -->
@if(helpers::checkPermission('feedback statistics graph'))
<div class="col-md-6 p-2">
  <div class="widget">
    <h2>Feedback Statistics <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="How does you rate our services via various communication channnel"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-content" id="fbcontainer"></div>
  </div>
</div>
@endif
@if(helpers::checkPermission('enquiry by category graph'))
<div class="col-md-6 p-2">
  <div class="widget">
    <h2>Enquiry By Category <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Category wise weekly enquiry statistics"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-content" id="container-query-category-week" style="height:250px"> </div>
  </div>
</div>
@endif

@if(helpers::checkPermission('server management'))
	@if(count($resource)>0)
<div class="col-md-8 p-2">
  <div class="widget" style="height:530px;">
    <h2>Server Resource Alert<a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Shows top most country wise customer registration count"></a></h2>
    <div class="widget-content"  id="container-country-registration" data-highcharts-chart="3" role="region" aria-label="Chart. Highcharts interactive chart." aria-hidden="false" style="height: 510px; overflow: hidden;">
<table class="table table-bordered">
  <thead>
        <tr>
          <th rowspan="2" style="border-bottom:none;" width="30" class="text-center">{{__('#')}}</th>         
          <th rowspan="2" class="text-center" style="border-bottom:none;">{{__('Server Name')}}</th>
          <th colspan="6" class="text-center">{{__('Resources')}}</th>
          <!-- <th style="border-bottom:none;">{{__('Increased')}}</th>
          <th style="border-bottom:none;">{{__('Threshold_value')}}</th> -->
          <th rowspan="2" class="text-center" style="border-bottom:none;">{{__('Time')}}</th>
        </tr>
        <tr>
          <th colspan="2" class="text-center" style="font-size: 10px;">CPU</th>         
          <th colspan="2" class="text-center" style="font-size: 10px;">RAM</th>
          
          
          <th colspan="2" class="text-center" style="font-size: 10px;">Hard Disk</th>
          <!-- <th style="border-top:none;"></th>
          <th></th>
          <th style="border-top:none;"></th> -->
          <!-- <th></th> -->
          <!-- <th style="border-top:none;"></th> -->
          
        </tr>
        <tr>
          <th></th>
          <th></th>
          <th class="text-center" style="font-size: 9px;">Used(GB)</th>
          <th class="text-center" style="font-size: 9px;">Threshold(GB)</th>
          <th class="text-center" style="font-size: 9px;">Used(GB)</th>
          <th class="text-center" style="font-size: 9px;">Threshold(GB)</th>
          <th class="text-center" style="font-size: 9px;">Used(GB)</th>
          <th class="text-center" style="font-size: 9px;">Threshold(GB)</th>
          <th></th>

        </tr>

         @if(count($resource)>0)
          @php $i = ($resource->currentpage()-1) * $resource->perpage() +  1; @endphp 

          @foreach ($resource as $res)
          <?php $resources3 = (unserialize($res->resource3)); ?>
          @if(($res->resource1 > 
          
          $res->getresources->threshold_resource1)||($res->resource2 > $res->getresources->threshold_resource2)||($resources3[0]['used']>$res->getresources->threshold_resource3))
        <tr>
          <th>{{$i++}}</th>
          <th>{{$res->getresources->server_name}}</th>
          
          <th> @if($res->resource1 > $res->getresources->threshold_resource1){{$res->resource1}} @endif </th>
          <th>@if($res->resource1 > $res->getresources->threshold_resource1) {{$res->getresources->threshold_resource1}} @endif</th>
          
          
          <th>@if($res->resource2 > $res->getresources->threshold_resource2)  {{$res->resource2}} @endif </th>
          <th>@if($res->resource2 > $res->getresources->threshold_resource2){{$res->getresources->threshold_resource2}} @endif</th>
          

          
          <th>@if($resources3[0]['used']>$res->getresources->threshold_resource3) {{$resources3[0]['used']}} @endif</th>
          <th>@if($resources3[0]['used']>$res->getresources->threshold_resource3){{$res->getresources->threshold_resource3}} @endif</th>
          
          <!-- <th>{{'4'}}</th>  
          <th>{{'4'}}</th>  --> 
          
          
          
          <th>{{$res->created_at}}</th> 
        </tr>  
        @endif
        @endforeach
          @else
          <tr>
            <td colspan="8"><p class="text-center">No Data Found</p></td>
            </tr>
            @endif
                </thead>
                <tbody>
                 
    
</table>
@if(count($resource)>=3)
<div class="row mt-3 ml-3">
  <a href="{{url('server_resource_alert')}}" class="btn btn-success">View More</a>
</div>
@endif

</div>
  
</div>
</div>
@endif
@endif

<!-- <?php  if(Helpers::checkPermission('escalation summary chart')) { ?>

<div class="col-md-4 p-2">
  <div class="widget">
    <h2>Helpdesk <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Helpdesk"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-content">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table" align="center">
        <?php if(count($helpdesk_status_details) >0)
             { ?>
        <tr>
          <th> # Status</th>
          @foreach ($master_querytype as $value)
          <th align="center">{{$value['name']}}</th>
          @endforeach </tr>
        <?php $all_helpdesk[]=''; ?>
        @foreach ($helpdesk_status_details as $value1)
        <?php 
              $helpdesk_cnt =$value1->counts;
              $helpdesk_lead =$value1->query_status;
              $helpdesk_ty =$value1->query_type;
              $helpdesk_nm =$master_querytype[$helpdesk_ty]['name'];
              $helpdesk_name = str_replace(" ","_",$helpdesk_nm);
              
              if(isset($master_status[$helpdesk_lead]) && !empty($master_status[$helpdesk_lead])) 
              {
                foreach ($master_querytype as $total_mast_val)
                 {
                  $total_mast_nme = str_replace(" ","_",$total_mast_val['name']);
                  if($helpdesk_name == $total_mast_nme)
                  {
                    $master_querytype[$helpdesk_ty][$helpdesk_name.'total_cont'] = $master_querytype[$helpdesk_ty][$helpdesk_name.'total_cont'] + $helpdesk_cnt;
                    $all_helpdesk['Total'][$total_mast_nme]= $master_querytype[$helpdesk_ty][$helpdesk_name.'total_cont'];
                  }
                 }
                
                $val = $all_helpdesk[$helpdesk_lead][$helpdesk_name]=$helpdesk_cnt;
              }
                    ?>
        @endforeach
        @foreach ($all_helpdesk as $key=>$valued)
        <tr class="<?php if($key != '0') {  if($master_status[$key] != '0') { echo $master_status[$key];} } ?>">
          <?php if($key != '0') {  ?>
          <th><?php if($master_status[$key] != '0') { echo $master_status[$key];} ?></th>
          @foreach ($master_querytype as $mast_value)
          <?php $nme = str_replace(" ","_",$mast_value['name']);
                  if(isset($master_querytype_check[$nme]) && !empty($master_querytype_check[$nme])) { ?>
          <td align="center"><a  href="#" >
            <?php if(isset($valued[$nme]) && !empty($valued[$nme])) { echo $valued[$nme];} else { echo 00;}?>
            </a></td>
          <?php  }?>
          @endforeach
          <?php } ?>
        </tr>
        @endforeach
        <?php }else{?>
        <tr>
          <td class="text-center">No Data Found</td>
        </tr>
        <?php  }?>
      </table>
    </div>
  </div>
</div>
<?php } ?> -->
<?php  if(Helpers::checkPermission('escalation summary chart not use')) { ?>
<div class="col-md-4 p-2">
  <div class="widget">
    <h2>Task Summary (Only for escalated) <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Only for escalated"><img src="{{ asset('img/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
    <div class="widget-content">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table" align="center">
        <?php if(count($escalation_status_details) >0)
             { ?>
        <tr>
          <th> # Status</th>
          @foreach ($master_querytype as $value)
          <th align="center">{{$value['name']}}</th>
          @endforeach </tr>

        <?php $all_escalation[]=''; ?>
        @foreach ($escalation_status_details as $value1)
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
                  if(isset($master_querytype_check[$nme]) && !empty($master_querytype_check[$nme])) { ?>
          <td align="center"><a  href="#" >
            <?php if(isset($valued[$nme]) && !empty($valued[$nme])) { echo $valued[$nme];} else { echo 00;}?>
            </a></td>
          <?php  }?>
          @endforeach
          <?php } ?>
        </tr>

        @endforeach
        <?php }else{?>
        
        <tr>
          <td class="text-center">No Data Found</td>
        </tr>

        <?php  }?>
      </table>
    </div>
  </div>
</div>
<?php } ?>
<script src="{{ asset('js/dashboard_api.js') }}"></script>
<!--</div>