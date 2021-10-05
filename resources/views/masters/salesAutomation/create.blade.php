@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Sales Automation
@endsection
@section('content')

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('sales_automation')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Add Auto Process')}}</h2>
			<div class="widget-content pt-3">
				@if(isset($automated_process))
					{!! Form::model($automated_process, ['method' => 'POST', 'class' => 'form-common', 'route' => ['sales_automation.store']]) !!}
				@else
					{!! Form::open(array('route' => 'sales_automation.store', 'class' => 'form-common', 'method'=>'POST')) !!}
				@endif
				{{ csrf_field() }}
				<div class="row m-0 align-items-center">
				<div class="col-md-12"> <span class="response"></span>
				  <div class="message"></div>
				</div>
				
		
				
				
				<div class="col-sm-6 form-group">	
					<label for="process_name" class="control-label mb-1">{{__('Process Name')}}</label>
						{{ Form::text('process_name', null, array('class' => 'form-control','id' => 'process_name')) }}	
						<span class="error" id ="process_name_err"></span>							
				</div>
				
				
				<div class="col-sm-6 form-group">
				<label for="action" class="control-label mb-1">{{__('Communication')}}</label>
						<select class="form-control" id="action" name="action">
						<option value="">Please Select</option>
						@foreach($results as $data)
                        <option value="{{ $data['GetTemplateType']['id'] }}" <?php if(isset($automated_process->action) && ($automated_process->action==$data['GetTemplateType']['id'])) { echo "selected"; }  ?>>{{ $data['GetTemplateType']['name'] }}</option>
						@endforeach
						</select>
						<span class="error" id="action_err"></span>	
				</div>
				
				
				<div class="col-sm-6 form-group">
				<label for="response_pos" class="control-label mb-1">{{__('Positive Response')}}</label>
						{{ Form::select('response_pos', [null=>'Please Select'] +$process, null, ['id' => 'response_pos', 'class' => 'form-control']) }}
						<span class="error" id="response_pos_err"></span>	
				</div>
				
				
				<div class="col-sm-6 form-group">
				<label for="response_neg" class="control-label mb-1">{{__('Negative Response')}}</label>
						{{ Form::select('response_neg', [null=>'Please Select'] +$process, null, ['id' => 'response_neg', 'class' => 'form-control']) }}
						<span class="error" id="response_neg_err"></span>	
				</div>
				
				
				<div class="col-sm-6 form-group">	
				<label for="action_time" class="control-label mb-1">{{__('Action Time')}}</label>
						{{ Form::text('action_time', null, array('class' => 'form-control','id' => 'action_time')) }}	
						<span class="error" id ="action_time_err"></span>							
				</div>
				
			
				
				
				<div class="col-sm-6 form-group">
				<label for="action_time_param" class="control-label mb-1">{{__('Action Time In')}}</label>
						<select class="form-control" id="action_time_param" name="action_time_param">
						<option value="">Please Select</option>
                        <option value="1" <?php if(isset($automated_process->action_time_param) && ($automated_process->action_time_param==1)) { echo "selected"; }  ?>>Minutes</option>
						<option value="2" <?php if(isset($automated_process->action_time_param) && ($automated_process->action_time_param==2)) { echo "selected"; }  ?>>Hours</option>
						<option value="3" <?php if(isset($automated_process->action_time_param) && ($automated_process->action_time_param==3)) { echo "selected"; }  ?>>Days</option>
						</select>
						<span class="error" id="action_time_param_err"></span>	
				</div>
				
				
				
				<div class="col-sm-6 form-group">	
				<label for="expiry_time" class="control-label mb-1">{{__('Expiry Time')}}</label>
						{{ Form::text('expiry_time', null, array('class' => 'form-control','id' => 'expiry_time')) }}	
						<span class="error" id ="expiry_time_err"></span>							
				</div>
				
				
				
				<div class="col-sm-6 form-group">
				<label for="expiry_time_param" class="control-label mb-1">{{__('Expiry Time In')}}</label>
						<select class="form-control" id="expiry_time_param" name="expiry_time_param">
						<option value="">Please Select</option>
                        <option value="1" <?php if(isset($automated_process->expiry_time_param) && ($automated_process->expiry_time_param==1)) { echo "selected"; }  ?>>Minutes</option>
						<option value="2" <?php if(isset($automated_process->expiry_time_param) && ($automated_process->expiry_time_param==2)) { echo "selected"; }  ?>>Hours</option>
						<option value="3" <?php if(isset($automated_process->expiry_time_param) && ($automated_process->expiry_time_param==3)) { echo "selected"; }  ?>>Days</option>
						</select>
						<span class="error" id="action_time_param_err"></span>	
				</div>
				
				
				<div class="col-sm-6 form-group">
				<label for="expiry_flag" class="control-label mb-1">{{__('Expiry Selection From')}}</label>
						<select class="form-control" id="expiry_flag" name="expiry_flag">
						<option value="">Please Select</option>
                        <option value="1" <?php if(isset($automated_process->expiry_flag) && ($automated_process->expiry_flag==1)) { echo "selected"; }  ?>>From helpdesk due date</option>
						<option value="0" <?php if(isset($automated_process->expiry_flag) && ($automated_process->expiry_flag==0)) { echo "selected"; }  ?>>From stage settings</option>
						</select>
						<span class="error" id="expiry_flag_err"></span>	
				</div>
				
				
				<div class="col-sm-6 form-group">
				<label for="intimation_to_param" class="control-label mb-1">{{__('Intimation To Parameter')}}</label>
						<select class="form-control" id="intimation_to_param" name="intimation_to_param">
						<option value="">Please Select</option>
                        <option value="1" <?php if(isset($automated_process->intimation_to_param) && ($automated_process->intimation_to_param==1)) { echo "selected"; }  ?>>From helpdesk only</option>
						<option value="0" <?php if(isset($automated_process->intimation_to_param) && ($automated_process->intimation_to_param==0)) { echo "selected"; }  ?>>Only from stage settings</option>
						<option value="2" <?php if(isset($automated_process->intimation_to_param) && ($automated_process->intimation_to_param==2)) { echo "selected"; }  ?>>From helpdesk and stage settings</option>
						</select>
						<span class="error" id="intimation_to_param_err"></span>	
				</div>
			
				
				
		
				
				<div class="col-sm-6 form-group">
				<label for="is_first" class="control-label mb-1">{{__('First Stage In Department')}}</label>
						<select class="form-control" id="is_first" name="is_first">
						<option value="">Please Select</option>
                        <option value="1" <?php if(isset($automated_process->is_first) && ($automated_process->is_first==1)) { echo "selected"; }  ?>>Set as first stage</option>
						</select>
						<span class="error" id="is_first_err"></span>	
				</div>
				
				
				<div class="col-sm-6 form-group">
				<label for="closed" class="control-label mb-1">{{__('Closing Stage')}}</label>
						<select class="form-control" id="closed" name="closed">
						<option value="">Please Select</option>
						<option value="0" <?php if(isset($automated_process->closed) && ($automated_process->closed==0)) { echo "selected"; }  ?>>Not a closing stage</option>
                        <option value="1" <?php if(isset($automated_process->closed) && ($automated_process->closed==1)) { echo "selected"; }  ?>>Set as closed stage</option>
						</select>
						<span class="error" id="closed_err"></span>	
				</div>
				
				<div class="col-sm-6 form-group">
				<label for="closed" class="control-label mb-1">{{__('Additional CC Flag')}}</label>
						<select class="form-control" id="additional_cc_flag" name="additional_cc_flag">
						<option value="">Please Select</option>
                        <option value="1" <?php if(isset($automated_process->additional_cc_flag) && ($automated_process->additional_cc_flag==1)) { echo "selected"; }  ?>>Enable flag</option>
						</select>
						<span class="error" id="closed_err"></span>	
				</div>
			
				
				<div class="col-sm-6 form-group">
				<label for="content" class="control-label mb-1">{{__('Content')}}</label>
				{{ Form::select('content', [null=>'Please Select'] +$templates, null, ['id' => 'content', 'class' => 'form-control']) }}
				<span class="error" id="content_err"></span>	
				</div>
								
				
				<div class="col-sm-6 form-group">
				<label for="department" class="control-label mb-1">{{__('Department')}}</label>
				{{ Form::select('department', [null=>'Please Select'] +$department, null, ['id' => 'department', 'class' => 'form-control']) }}
				<span class="error" id="department_err"></span>	
				</div>
				
				
				<div class="col-sm-6 form-group">				
				</div>
				<div class="clearfix"></div>
				<div class="row"></div>
				
				@if(isset($automated_process))
					
					@php $intimations_to = $automated_process->intimation_to  @endphp
					<div class='field_wrapper col-sm-6'><b>Intimation To</b>
					<div class="form-group">
				<a href="javascript:void(0);" class="add_button" title="Add field"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/add.png"/></a></div>
					<?php    
					
					$intimations_to = explode("||",$intimations_to);
					foreach($intimations_to as $intimations)
					{
						$intimation_arr = explode("||",$intimations);
						foreach($intimation_arr as $i_arr)
						{
							$i_val = explode(",",$i_arr);
							echo "<div><div>";
							foreach($i_val as $value)
							{
								$f_arr = explode("-",$value);
								//echo $f_arr[0].'<br>';
								
								?>
							<div>	
				
				<?php if($f_arr[0]==1){  ?>
				<div class="form-group">
				<input type="hidden" name="district[]" class="form-control" value="1">
				<label for="district_sel" class="control-label mb-1">{{__('District condition')}}</label>
				<select name="district_sel[]" class="form-control">
				<option value="0" <?php if($f_arr[1]==0) { echo "selected"; } ?>>District condition not included</option>
				<option value="1" <?php if($f_arr[1]==1) { echo "selected"; } ?>>District condition included</option>
				</select>	
				</div>
				<?php  }  if($f_arr[0]==2){  ?>
				<div class="form-group">
				<input type="hidden" name="deptmt[]" class="form-control" value="2">
				<label for="deptmt_sel" class="control-label mb-1">{{__('Department')}}</label>
				<select name="deptmt_sel[]" class="form-control">
				<option value="">Select Department</option>
				<?php   foreach($department as $key=>$value){ ?>
				<option value="{{$key}}" <?php if($f_arr[1]==$key) { echo "selected"; } ?>>{{$value}}</option>
				<?php }	 ?>	
				</select>	
				</div>
				<?php  } if($f_arr[0]==3){  ?>
				<div class="form-group">
				<input type="hidden" name="designation[]" class="form-control" value="3">
				<label for="designation_sel" class="control-label mb-1">{{__('Designation')}}</label>
				<select name="designation_sel[]" class="form-control">
				<option value="">Select Designation</option>
				<?php   foreach($designations as $key=>$value){ ?>
				<option value="{{$key}}" <?php if($f_arr[1]==$key) { echo "selected"; } ?>>{{$value}}</option>
				<?php }	 ?>	
				</select>	
				</div>
				<?php  }  if($f_arr[0]==4){  ?>
				<div class="form-group">
				<input type="hidden" name="taluk[]" class="form-control" value="4">
				<label for="taluk_sel" class="control-label mb-1">{{__('Taluk condition')}}</label>
				<select name="taluk_sel[]" class="form-control">
				<option value="0" <?php if($f_arr[1]==0) { echo "selected"; } ?>>Taluk condition not included</option>
				<option value="1" <?php if($f_arr[1]==1) { echo "selected"; } ?>>Taluk condition included</option>
				</select>	
				</div>
				<?php  } ?>
				
				</div>
				
								
								<?php
								
							} ?>
						</div><a href="javascript:void(0);" class="remove_button"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/remove.png"/></a></div>
						<?php
						}
					}
					
					?>
					
				</div>	
				@else
				<div class="field_wrapper col-sm-6"><b>Intimation To</b>
				<div>
				<div class="form-group">
				<input type="hidden" name="district[]" class="form-control" value="1">
				<label for="district_sel" class="control-label mb-1">{{__('District condition')}}</label>
				<select name="district_sel[]" class="form-control">
				<option value="0">District condition not included</option>
				<option value="1">District condition included</option>
				</select>	
				</div>
				<div class="form-group">
				<input type="hidden" name="deptmt[]" class="form-control" value="2">
				<label for="deptmt_sel" class="control-label mb-1">{{__('Department')}}</label>
				<select name="deptmt_sel[]" class="form-control">
				<option value="">Select Department</option>
				<?php   foreach($department as $key=>$value){ ?>
				<option value="{{$key}}">{{$value}}</option>
				<?php }	 ?>	
				</select>	
				</div>
				<div class="form-group">
				<input type="hidden" name="designation[]" class="form-control" value="3">
				<label for="designation_sel" class="control-label mb-1">{{__('Designation')}}</label>
				<select name="designation_sel[]" class="form-control">
				<option value="">Select Designation</option>
				<?php   foreach($designations as $key=>$value){ ?>
				<option value="{{$key}}">{{$value}}</option>
				<?php }	 ?>	
				</select>	
				</div>
				<div class="form-group">
				<input type="hidden" name="taluk[]" class="form-control" value="4">
				<label for="taluk_sel" class="control-label mb-1">{{__('Taluk condition')}}</label>
				<select name="taluk_sel[]" class="form-control">
				<option value="0">Taluk condition not included</option>
				<option value="1">Taluk condition included</option>
				</select>	
				</div>
				<a href="javascript:void(0);" class="add_button" title="Add field"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/add.png"/></a>
				</div>
				</div>
				@endif
				
				@if(isset($automated_process))
				
					@php $intimations_cc_to = $automated_process->intimation_cc_to  @endphp
					<div class='col-sm-6 field_wrapper_cc'><b>Intimation CC To</b>
					<div class="form-group">
				<a href="javascript:void(0);" class="add_button_cc" title="Add field"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/add.png"/></a></div>
					<?php    
					
					$intimations_cc_to = explode("||",$intimations_cc_to);
					foreach($intimations_cc_to as $intimations_cc)
					{
						$intimation_arr_cc = explode("||",$intimations_cc);
						foreach($intimation_arr_cc as $i_arr_cc)
						{
							$i_val_cc = explode(",",$i_arr_cc);
							echo "<div><div>";
							foreach($i_val_cc as $value_cc)
							{
								$f_arr_cc = explode("-",$value_cc);
								//echo $f_arr[0].'<br>';
								
								?>
							<div>	
				
				<?php if($f_arr_cc[0]==1){  ?>
				<div class="form-group">
				<input type="hidden" name="district_cc[]" class="form-control" value="1">
				<label for="district_sel_cc" class="control-label mb-1">{{__('District condition')}}</label>
				<select name="district_sel_cc[]" class="form-control">
				<option value="0" <?php if($f_arr_cc[1]==0) { echo "selected"; } ?>>District condition not included</option>
				<option value="1" <?php if($f_arr_cc[1]==1) { echo "selected"; } ?>>District condition included</option>
				</select>	
				</div>
				<?php  }  if($f_arr_cc[0]==2){  ?>
				<div class="form-group">
				<input type="hidden" name="deptmt_cc[]" class="form-control" value="2">
				<label for="deptmt_sel_cc" class="control-label mb-1">{{__('Department')}}</label>
				<select name="deptmt_sel_cc[]" class="form-control">
				<option value="">Select Department</option>
				<?php   foreach($department as $key=>$value){ ?>
				<option value="{{$key}}" <?php if($f_arr_cc[1]==$key) { echo "selected"; } ?>>{{$value}}</option>
				<?php }	 ?>	
				</select>	
				</div>
				<?php  } if($f_arr_cc[0]==3){  ?>
				<div class="form-group">
				<input type="hidden" name="designation_cc[]" class="form-control" value="3">
				<label for="designation_sel_cc" class="control-label mb-1">{{__('Designation')}}</label>
				<select name="designation_sel_cc[]" class="form-control">
				<option value="">Select Designation</option>
				<?php   foreach($designations as $key=>$value){ ?>
				<option value="{{$key}}" <?php if($f_arr_cc[1]==$key) { echo "selected"; } ?>>{{$value}}</option>
				<?php }	 ?>	
				</select>	
				</div>
				<?php  }  if($f_arr_cc[0]==4){  ?>
				<div class="form-group">
				<input type="hidden" name="taluk_cc[]" class="form-control" value="4">
				<label for="taluk_sel_cc" class="control-label mb-1">{{__('Taluk condition')}}</label>
				<select name="taluk_sel_cc[]" class="form-control">
				<option value="0" <?php if($f_arr_cc[1]==0) { echo "selected"; } ?>>Taluk condition not included</option>
				<option value="1" <?php if($f_arr_cc[1]==1) { echo "selected"; } ?>>Taluk condition included</option>
				</select>	
				</div>
				<?php  } ?>
				
				</div>
				
								
								<?php
								
							} ?>
						</div><a href="javascript:void(0);" class="remove_button_cc"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/remove.png"/></a></div>
						<?php
						}
					}
					
					?>
					
				</div>	
				@else
				<div class="col-sm-6 field_wrapper_cc"><b>Intimation CC To</b>
				<div>
				<div class="form-group">
				<input type="hidden" name="district_cc[]" class="form-control" value="1">
				<label for="district_sel_cc" class="control-label mb-1">{{__('District condition')}}</label>
				<select name="district_sel_cc[]" class="form-control">
				<option value="0">District condition not included</option>
				<option value="1">District condition included</option>
				</select>	
				</div>
				<div class="form-group">
				<input type="hidden" name="deptmt_cc[]" class="form-control" value="2">
				<label for="deptmt_sel_cc" class="control-label mb-1">{{__('Department')}}</label>
				<select name="deptmt_sel_cc[]" class="form-control">
				<option value="">Select Department</option>
				<?php   foreach($department as $key=>$value){ ?>
				<option value="{{$key}}">{{$value}}</option>
				<?php }	 ?>	
				</select>	
				</div>
				<div class="form-group">
				<input type="hidden" name="designation_cc[]" class="form-control" value="3">
				<label for="designation_sel_cc" class="control-label mb-1">{{__('Designation')}}</label>
				<select name="designation_sel_cc[]" class="form-control">
				<option value="">Select Designation</option>
				<?php   foreach($designations as $key=>$value){ ?>
				<option value="{{$key}}">{{$value}}</option>
				<?php }	 ?>	
				</select>	
				</div>
				<div class="form-group">
				<input type="hidden" name="taluk_cc[]" class="form-control" value="4">
				<label for="taluk_sel_cc" class="control-label mb-1">{{__('Taluk condition')}}</label>
				<select name="taluk_sel_cc[]" class="form-control">
				<option value="0">Taluk condition not included</option>
				<option value="1">Taluk condition included</option>
				</select>	
				</div>
				<a href="javascript:void(0);" class="add_button_cc" title="Add field"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/add.png"/></a>
				</div>
				</div>
				
				@endif
				
			
				
				
				
						
						{{ Form::hidden('id', null, array('class' => 'form-control' )) }}
						<div class="col-md-12 form-group text-right">
							<button type="reset" class="btn btn-outline-danger px-4" > {{__('Reset')}} </button>
							<button type="submit" class="btn btn-primary px-4"> {{__('Save')}} </button>
						</div>
						
						
			</div>
						
						
						
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-custom-css-js')

<script type="text/javascript">
$(document).ready(function () {
  

var dept = '{{Helpers::get_department()}}';
var desg = '{{Helpers::get_designation()}}';

		var url = $("#base_url").val();
		//var qry_type = $("#qry_type").val();
	//	var get_dept = $("#get_dept").val();
	//	var get_desig = $("#get_desig").val();
		var maxField = 10; 
		var addButton = $('.add_button'); 
		var wrapper = $('.field_wrapper'); 
		var fieldHTML = '<b>Intimation To</b><div><div class="form-group"><input type="hidden" name="district[]" class="form-control" value="1"><label for="district_sel" class="control-label mb-1">District condition</label><select name="district_sel[]" class="form-control"><option value="0">District condition not included</option><option value="1">District condition included</option>	</select></div>	<div class="form-group"><input type="hidden" name="deptmt[]" class="form-control" value="2"><label for="deptmt_sel" class="control-label mb-1">Department</label><select class="form-control" name="deptmt_sel[]">'+dept+'</select></div><div class="form-group">	<input type="hidden" name="designation[]" class="form-control" value="3"><label for="designation_sel" class="control-label mb-1">Designation</label><select class="form-control" name="designation_sel[]">'+desg+'</select>	</div><div class="form-group"><input type="hidden" name="taluk[]" class="form-control" value="4"><label for="taluk_sel" class="control-label mb-1">Taluk condition</label><select class="form-control" name="taluk_sel[]"><option value="0">Taluk condition not included</option><option value="1">Taluk condition included</option></select></div><a href="javascript:void(0);" class="remove_button"><img style="width:20px;height:20px;" src="'+url+'/img/remove.png"/></a></div>';  
		var x = 1; 
		
		
		$(addButton).click(function(){ 
			if(x < maxField){ 
				x++; console.log(fieldHTML);
				$(wrapper).append(fieldHTML); 
			}
		});
		
		
		$(wrapper).on('click', '.remove_button', function(e){
			e.preventDefault();
			$(this).parent('div').remove(); 
			x--; 
		});
		
		
		var addButton_cc = $('.add_button_cc');
		var wrapper_cc = $('.field_wrapper_cc'); 
		var fieldHTML_cc = '<b>Intimation CC To</b><div><div class="form-group"><input type="hidden" name="district_cc[]" class="form-control" value="1"><label for="district_sel_cc" class="control-label mb-1">District condition</label><select name="district_sel_cc[]" class="form-control"><option value="0">District condition not included</option><option value="1">District condition included</option>	</select></div>	<div class="form-group"><input type="hidden" name="deptmt_cc[]" class="form-control" value="2"><label for="deptmt_sel_cc" class="control-label mb-1">Department</label><select name="deptmt_sel_cc[]" class="form-control">'+dept+'</select></div><div class="form-group">	<input type="hidden" name="designation_cc[]" class="form-control" value="3"><label for="designation_sel_cc" class="control-label mb-1">Designation</label><select class="form-control" name="designation_sel_cc[]">'+desg+'</select>	</div><div class="form-group"><input type="hidden" name="taluk_cc[]" class="form-control" value="4"><label for="taluk_sel_cc" class="control-label mb-1">Taluk condition</label><select class="form-control" name="taluk_sel_cc[]"><option value="0">Taluk condition not included</option><option value="1">Taluk condition included</option></select></div><a href="javascript:void(0);" class="remove_button_cc"><img style="width:20px;height:20px;" src="'+url+'/img/remove.png"/></a></div>'; 
		var x = 1; 
		
		
		$(addButton_cc).click(function(){
			if(x < maxField){ 
				x++; 
				$(wrapper_cc).append(fieldHTML_cc); 
			}
		});
		
		
		$(wrapper_cc).on('click', '.remove_button_cc', function(e){
			e.preventDefault();
			$(this).parent('div').remove(); 
			x--; 
		});
	});

</script>
@endsection