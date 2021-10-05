<div class="widget">
	<h2>{{__('Survey Listing')}}</h2><?php //var_dump($query_type); exit;?>
	
 
   <div class="table-widget table-responsive mt-0 pt-0">
    <table width="100%" id="faq_lists" class="table height-small history-table m-0">
        <thead>
        <tr>
		    <th>#</th>
		    <th>Survey Name</th>
		    <th>Expiry Date</th>
		    <th>Created On</th>
		    <th>Action</th>
        </tr>
        </thead>

		<tbody>
			@php  $i = 1; 	@endphp 
			@if(count($survey_det)>0)
			@foreach ($survey_det as $res)
		
	<?php
	if($p_survey_id == $res->id)
    {
      //$new_class="panel-collapse in";
    }else
    {
      //$new_class="panel-collapse collapse";
    }
    	  $new_class='';	
          $survey_id=$res['survey_id'];
          $href_status='';//'#s_collapse'.$i;
          $toggle='collapse';
          $target='';
          $action='fa fa-pencil-alt';
          $click='#';
             
    
    
	?>
	
			<tr class="anchor-wrap">
				<td>{{$i}}
				</td>
				<td>@if(!empty($res['survey_details']['survey_name_lang1'])){{$res['survey_details']['survey_name_lang1']}}@elseif(!empty($res['survey_details']['survey_name_lang2'])){{$res['survey_details']['survey_name_lang2']}}@else {{''}}@endif</td>
				<td>{{$res['survey_details']['expiry_date']}}</td>
				<td>{{$res['created_at']}}</td>
				<td>
				

				<a href="{{$href_status}}"  class="btn toggle-tabs"><i class="fas fa-chevron-right"></i></a>

				</td>
			</tr>
			<tr>
				<td colspan="8" class="p-0">
				<div id="{{$target}}" class=" text-left acco-content p-3">
                    

				 
					 <form class="form-common-profile" role="form" id="survey_forms{{$i}}" method="POST" action="{{ url('api/survey_insertion') }}" autocomplete="off">
    				
						
						
						<?php $survey_qstn =$res['question_ans'];?>
						@if($survey_qstn)
				        <div class="row">
				            <div class="col-sm-12 form-group" id="qstn">
				            @php 
				            $j=1; @endphp
				            @foreach($survey_qstn as $value)
				           
				            @if(!empty($value['survey_eng_qstn']['questions']))
				            <br>   
				            <label for="name"> <?php echo $j.'. '.$value['survey_eng_qstn']['questions'];?></label>
				            <input type="hidden" name="qstn[<?php echo $value['id'];?>]" value="<?php echo $value['qstn_id_lang1'];?>" >
				            <br>
				            <?php if(isset($value['survey_eng_qstn']['option1']) && !empty($value['survey_eng_qstn']['option1'])){?>
				             <input  type="radio" name="questions[<?php echo $value['id'];?>]"  value="option1" > <?php echo $value['survey_eng_qstn']['option1']; ?>

				             <br>
				             <?php } ?>
				             <?php if(isset($value['survey_eng_qstn']['option2']) && !empty($value['survey_eng_qstn']['option2'])){?>
				             <input  type="radio" name="questions[<?php echo $value['id'];?>]"  value="option2" > <?php echo $value['survey_eng_qstn']['option2']; ?><br>
				             <?php } ?>
				             <?php if(isset($value['survey_eng_qstn']['option3']) && !empty($value['survey_eng_qstn']['option3'])){?>
				             <input  type="radio" name="questions[<?php echo $value['id'];?>]"  value="option3" > <?php echo $value['survey_eng_qstn']['option3']; ?><br>
				             <?php } ?>
				             <?php if(isset($value['survey_eng_qstn']['option4']) && !empty($value['survey_eng_qstn']['option4'])){?>
				             <input  type="radio" name="questions[<?php echo $value['id'];?>]"  value="option4"> <?php echo $value['survey_eng_qstn']['option4']; ?><br>
				             <?php } ?>
				             <?php if(isset($value['survey_eng_qstn']['option5']) && !empty($value['survey_eng_qstn']['option5'])){?>
				             <input  type="radio" name="questions[<?php echo $value['id'];?>]"  value="option5" > <?php echo $value['survey_eng_qstn']['option5']; ?><br>
				             <?php } ?>
				             <?php if(isset($value['survey_eng_qstn']['option6']) && !empty($value['survey_eng_qstn']['option6'])){?>
				             <input  type="radio" name="questions[<?php echo $value['id'];?>]"  value="option6" > <?php echo $value['survey_eng_qstn']['option6']; ?><br>
				             <?php } ?>
				                 
				           @php $j++; @endphp
				           @endif
				           @endforeach
				            </div>
				            
				        </div>
						@endif
						
						
						<div class="form-group text-right">
							
							<input type="hidden" class="callback" value="show_survey_listing" name="callback">
							<input type="hidden" class="arg" value="0" name="arg">
							
							
                            <button type="submit" id="update_survey" class="btn btn-primary btn-sm px-4">
								{{__('Save')}}
							</button>  
							
							{{ Form::hidden('campaign_id',$res->campaign_id) }}
        					{{ Form::hidden('agent_id',Auth::user()->id) }}
					        {{ Form::hidden('langtype',$res['lang_type']) }}
					        
					        {{ Form::hidden('contact_id',$res->contact_id) }}
					       
					        {{ Form::hidden('batch_id',$res->batch_id) }}
					       
					        {{ Form::hidden('common_id',$res->common_id) }}
					        
					        {{ Form::hidden('survey_id',$survey_id) }}
					        
					        {{ Form::hidden('customer_id',$res->customer_id) }}
					       
					        {{ Form::hidden('company_id',$res->cmpny_id) }}
					        
					        {{ Form::hidden('authentication_key',$authentication) }}
							

						</div>
					</form>
	  
				</div>
				</td>
			</tr>
			@php $i++ @endphp
			@endforeach
			@else
				<tr><td colspan="8" class="text-center">No Data Found</td></tr>
			@endif
		</tbody>
				
      </table>

</div>
</div>




