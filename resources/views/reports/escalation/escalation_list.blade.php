<input type="hidden" name="list_count" id="list_count" value="@isset($list_count){{$list_count}}@endisset">
	<div class="widget followup">
        <h2>Escalation Summary <a class="help-tooltip" data-toggle="tooltip" data-placement="top" title="Other Task Summary"><img src="{{ asset('images/ic_help_outline.svg') }}" height="20" alt="Help"/></a></h2>
        <div class="widget-scroller">
	<?php if(isset($set_re_open_category) && !empty($set_re_open_category) && isset($set_closed_category_arr) && !empty($set_closed_category_arr))
		{ 
			?>
		<?php if(count($other_task) >0)
			{ ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive table-bordered escalation-summary" align="center">
						<tr>
							<th scope="col"> # Escalation FROM</th>
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
							$all_escalation3[$esc]['esc_frm'] = $esc_frm;
							//$all_escalation3['Total']['esc_frm']= '';
							
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
							   <th rowspan="2" scope="row"><?php if(isset($esc_master_status[$value3['esc_frm']]) && !empty($esc_master_status[$value3['esc_frm']])) { echo $esc_master_status[$value3['esc_frm']];} else {echo '#'.$value3['esc_frm'];} ?></th>
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
			<?php }
			else
			{ ?>
			<div> 
			    @if(empty($set_re_open_category))
				<center> 
				{{'You must map Re-Open Category .'}} <a  href="company_meta">Please go to setting</a>
				</center>
				@endif
				@if(empty($set_closed_category_arr))
				<center> 
				{{'You must map is cloded Category in Query Status.'}} <a  href="query_status">Please go to setting</a>
				</center>
				@endif
			</div>
			<?php  }?>
        </div>
    </div>
    


