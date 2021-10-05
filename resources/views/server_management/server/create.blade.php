@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add server
@endsection
@section('header-custom-css-js')
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-9 text-right"><a href="{{url('server')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-9 mt-3">
      <div class="widget">
        <h2>{{__('Server')}}</h2>
        <div class="widget-content pt-3">  
				@if(isset($server_list))P
					{!! Form::model($server_list, ['name' => 'server_form', 'method' => 'POST', 'class' => 'form-common', 'route' => ['server.store']]) !!}	
				@else
					<?php $assigned_members = array(); ?>
					{!! Form::open(array('name' => 'server_form', 'route' => 'server.store', 'class' => 'form-common', 'method'=>'POST')) !!}
				@endif
				{{ csrf_field() }}
				<div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
				<input type="hidden" name="vendor_count" id="vendor_count" value="@if(isset($server_list)){{Helpers::get_contact_count($server_list->id)}}@else {{'1'}} @endif">
						<div class="col-md-12 form-group">
						{{ Form::label('Server', 'Name')}} 						
						{{ Form::text('server_name', null, array('class' => 'form-control','id' => 'server_name', 'required')) }}	
						<span id ="server_name_err" class="error"></span>			</div>
						<div class="col-md-12 form-group">
						{{ Form::label('description', 'Description')}}
						{{ Form::textarea('description', null, array('id' => 'description', 'class' => 'lang_trans tinymce form-control' )) }} 						
						<span id ="description_err" class="error"></span>		</div>					
						<div class="col-md-6 form-group">
						{{ Form::label('ip', 'Server ip')}} 						
						{{ Form::text('server_ip', null, array('class' => 'form-control','id' => 'server_ip','required')) }}	
						<span id ="server_ip_err" class="error"></span>			</div>		
						<div class="col-md-6 form-group">
						<label for="status" class="control-label mb-1">{{__('Stage')}}</label>
						{{ Form::select('status', ['' => 'Select Status'] + config('constant.server_stages'),null,['id' => 'status','required', 'class' => 'form-control']) }}		
						<span id ="status_err"></span>
						</div>
						<div class="col-md-6 form-group">
						{{ Form::label('Cpu', 'CPU')}} 						
						{{ Form::text('threshold_resource1', null, array('class' => 'form-control','id' => 'threshold_resource1')) }}Ghz	
						<span id ="threshold_resource1_err" class="error"></span>			</div>
						<div class="col-md-6 form-group">
						{{ Form::label('Ram', 'RAM')}} 						
						{{ Form::number('threshold_resource2', null, array('class' => 'form-control','id' => 'threshold_resource2')) }}GB	
						<span id ="threshold_resource2_err" class="error"></span>			</div>
						<div class="col-md-12 form-group">
{{ Form::label('HDD', 'HDD')}} 	
						<div class="row">
							<div class="col-md-3">
	<select id="dropdownlist" class="form-control">
					  <option>A to Z</option>
					  <option value="1">A</option>
					  <option value="2">B</option>
					  <option value="3">C</option>
					  <option value="4">D</option>
					  <option value="5">E</option>
					  <option value="6">F</option>
					  <option value="7">G</option>
					  <option value="8">H</option>
					  <option value="9">I</option>
					  <option value="10">J</option>
					  <option value="11">K</option>
					  <option value="12">L</option>
					  <option value="13">M</option>
					  <option value="14">N</option>
					  <option value="15">O</option>
					  <option value="16">P</option>
					  <option value="17">Q</option>
					  <option value="18">R</option>
					  <option value="19">S</option>
					  <option value="20">T</option>
					  <option value="21">U</option>
					  <option value="22">V</option>
					  <option value="23">W</option>
					  <option value="24">X</option>
					  <option value="25">Y</option>
					  <option value="26">Z</option>
					</select>
</div>
							<div class="col-md-5">
<input type="text" name="" class="form-control" value="Total">
</div>
							<div class="col-md-2"><select class="form-control">
						<option>TB/GB</option>
					</select></div>
							
						</div>
						
					
					
					
					
					@if(isset($threshold_resource3))
					@foreach($threshold_resource3 as $resource)
					<?php $my_alphabet = strtoupper($resource['drive']);
					$number = ord(strtoupper($my_alphabet)) - ord('A') + 1;
					 ?>
					<div class="row mt-2">
					<div class="col-md-3">
<input class="form-control" type="text" name="inputs{{$number}}" value="{{$resource['drive']}}">
					</div>

					<div class="col-md-5">
<input class="form-control" type="text" name="total{{$number}}" value="{{$resource['total']}}">
					</div>

					<div class="col-md-2">
					<!-- <input select  value="{{$resource['tbgb']}}"> -->
					<select class="form-control" name = "size{{$number}}"><option value="{{$resource['tbgb']}}">{{$resource['tbgb']}}</option><option value="TB">TB</option></option><option value="GB">GB</option></select>
					</div>

					
					
					
					</div>
@endforeach
					@endif
					<div id="inputArea"></div>	
						<span id ="first_drive_err" class="error"></span>			</div>
						<!-- <div class="col-md-2 form-group">
							{{ Form::label('Hard Disk', 'D(GB)')}} 						
						{{ Form::text('second_drive', $threshold_resource3['second_drive'] ?? NULL, array('class' => 'form-control','id' => 'second_drive')) }}
						<span id ="second_drive_err" class="error"></span>
						</div>
												<div class="col-md-3 form-group">
							{{ Form::label('B', 'E(GB)')}} 						
						{{ Form::text('third_drive', $threshold_resource3['third_drive'] ?? NULL, array('class' => 'form-control','id' => 'third_drive')) }}
						<span id ="third_drive_err" class="error"></span>
						</div>
												<div class="col-md-3 form-group">
							{{ Form::label('B', 'F(GB)')}} 						
						{{ Form::text('fourth_drive', $threshold_resource3['fourth_drive'] ?? NULL, array('class' => 'form-control','id' => 'fourth_drive')) }}
						<span id ="fourth_drive_err" class="error"></span>	
						</div>
												<div class="col-md-3 form-group">
							{{ Form::label('B', 'G(GB)')}} 						
						{{ Form::text('fifth_drive', $threshold_resource3['fifth_drive'] ?? NULL, array('class' => 'form-control','id' => 'fifth_drive')) }}
						<span id ="fifth_drive_err" class="error"></span>	
						</div>
												<div class="col-md-3 form-group">
							{{ Form::label('B', 'H(GB)')}} 						
						{{ Form::text('sixth_drive', $threshold_resource3['sixth_drive'] ?? NULL, array('class' => 'form-control','id' => 'sixth_drive')) }}
						<span id ="sixth_drive_err" class="error"></span>	
						</div>
 -->
				    	<div class="col-md-12 form-group">
				    		@if(isset($project)) 
								{{ Form::hidden('members123', null, array('class' => 'form-control')) }}

				    			@foreach($assigned_members as $mem)
				    				<?php $res = Helpers::get_user($mem); ?>
				    				<span class="mem_con">{{$res->name}}<span id="{{$mem}}" data-update="assign_members" data-uname="{{$res->name}}" class="mem_delete"><i class="fas fa-times"></i></span></span>
				    			@endforeach
				    			<select style="display:none;" name="members[]" class="form-control" id="members" multiple>
				    				@foreach($assigned_members as $mem)
				    					<option selected class="{{$mem}}" value="{{$mem}}">name here</option>
				    				@endforeach
				    			</select>
				    		@else	
				    		@endif
				    		
				    	</div>
					{{--NEW TAB STARTS--}}
					<div style="display:none;">
					<div class="col-md-12 form-group">
					{{ Form::label('server_credentials', 'Server Credentials')}}
					{{ Form::textarea('server_credentials', null, array('id' => 'server_credentials', 'class' => 'lang_trans tinymce form-control' )) }} 						
					<span id ="server_credentials_err" class="error"></span>	</div>
					<div class="field_wrapper_projectmeta">
					</div>
				</div>
</div>


<div class="row m-0">
				<?php $i=0; ?>
					@if(isset($permission))

					 <div class="col-md-4 mb-2">				<label for="Services" class="control-label mb-1">Sheduler Services</label>
				</div>	
					 @foreach($permission as $data)		
				@if($data['service_flag'] == 1 )
						<div class="col-md-4 mb-2">
							<input type="checkbox" name="check_list[]" class="check_list custom-checkbox" id="check_list-<?php echo $i; ?>" value="{{$data['id'] }}" 
                          <?php if(!empty($service_id) && in_array($data['id'],$service_id)){ echo 'checked="checked"';} ?>> &nbsp; 
							<label for="check_list-<?php echo $i; ?>" class="custom-checkbox-label">{{ $data['name'] }}</label>
					    </div>


					    <?php $i++; ?>
					    @endif
				    @endforeach
				    @endif

</div>	
<div class="row m-0">			   
					@if(isset($permission))

					 <div class="col-md-4 mb-2">				<label for="Services" class="control-label mb-1">Windows Services</label>
				</div>		
					 @foreach($permission as $data)		
				@if($data['service_flag'] == 2 )
						<div class="col-md-4 mb-2">
							<input type="checkbox" name="check_list[]" class="check_list custom-checkbox" id="check_list-<?php echo $i; ?>" value="{{$data['id'] }}" 
                          <?php if(!empty($service_id) && in_array($data['id'],$service_id)){ echo 'checked="checked"';} ?>> &nbsp; 
							<label for="check_list-<?php echo $i; ?>" class="custom-checkbox-label">{{ $data['name'] }}</label>
					    </div>


					    <?php $i++; ?>
					    @endif
				    @endforeach
				    @endif
</div>
<div class="row m-0">
				    
					@if(isset($permission))


					 <div class="col-md-4 mb-2">				<label for="Services" class="control-label mb-1">IIS Services</label>
				</div>		
					 @foreach($permission as $data)		
				@if($data['service_flag'] == 3 )
			
						<div class="col-md-4 mb-2">
							<input type="checkbox" name="check_list[]" class="check_list custom-checkbox" id="check_list-<?php echo $i; ?>" value="{{$data['id'] }}" 
                          <?php if(!empty($service_id) && in_array($data['id'],$service_id)){ echo 'checked="checked"';} ?>> &nbsp; 
							<label for="check_list-<?php echo $i; ?>" class="custom-checkbox-label">{{ $data['name'] }}</label>
					    </div>


					    <?php $i++; ?>
					    @endif

				    @endforeach
				    @endif
				   </div>
<div class="row m-0">
					@if(isset($permission))

					 <div class="col-md-4 mb-2">				<label for="Services" class="control-label mb-1">Database Cluster status</label>
				</div>		
					 @foreach($permission as $data)		
				@if($data['service_flag'] == 4 )
						<div class="col-md-4 mb-2">
							<input type="checkbox" name="check_list[]" class="check_list custom-checkbox" id="check_list-<?php echo $i; ?>" value="{{$data['id'] }}" 
                          <?php if(!empty($service_id) && in_array($data['id'],$service_id)){ echo 'checked="checked"';} ?>> &nbsp; 
							<label for="check_list-<?php echo $i; ?>" class="custom-checkbox-label">{{ $data['name'] }}</label>
					    </div>


					    <?php $i++; ?>
					    @endif
				    @endforeach
				    @endif
				   </div>
<div class="row m-0">
					@if(isset($permission))

					 <div class="col-md-4 mb-2">				<label for="Services" class="control-label mb-1">Node Server Status</label>
				</div>		
					 @foreach($permission as $data)		
				@if($data['service_flag'] == 5 )
						<div class="col-md-4 mb-2">
							<input type="checkbox" name="check_list[]" class="check_list custom-checkbox" id="check_list-<?php echo $i; ?>" value="{{$data['id'] }}" 
                          <?php if(!empty($service_id) && in_array($data['id'],$service_id)){ echo 'checked="checked"';} ?>> &nbsp; 
							<label for="check_list-<?php echo $i; ?>" class="custom-checkbox-label">{{ $data['name'] }}</label>
					    </div>


					    <?php $i++; ?>
					    @endif
				    @endforeach
				    @endif
</div>
<div class="row m-0">
				   
					@if(isset($permission))

					 <div class="col-md-4 mb-2">				<label for="Services" class="control-label mb-1">Mail Server Status</label>
				</div>		
					 @foreach($permission as $data)		
				@if($data['service_flag'] == 6 )
						<div class="col-md-4 mb-2">
							<input type="checkbox" name="check_list[]" class="check_list custom-checkbox" id="check_list-<?php echo $i; ?>" value="{{$data['id'] }}" 
                          <?php if(!empty($service_id) && in_array($data['id'],$service_id)){ echo 'checked="checked"';} ?>> &nbsp; 
							<label for="check_list-<?php echo $i; ?>" class="custom-checkbox-label">{{ $data['name'] }}</label>
					    </div>


					    <?php $i++; ?>
					    @endif
				    @endforeach
				    @endif
</div>
<div class="row m-0">
					@if(isset($permission))

					 <div class="col-md-4 mb-2">				<label for="Services" class="control-label mb-1">Ping Status</label>
				</div>		
					 @foreach($permission as $data)		
				@if($data['service_flag'] == 7 )
						<div class="col-md-4 mb-2">
							<input type="checkbox" name="check_list[]" class="check_list custom-checkbox" id="check_list-<?php echo $i; ?>" value="{{$data['id'] }}" 
                          <?php if(!empty($service_id) && in_array($data['id'],$service_id)){ echo 'checked="checked"';} ?>> &nbsp; 
							<label for="check_list-<?php echo $i; ?>" class="custom-checkbox-label">{{ $data['name'] }}</label>
					    </div>


					    <?php $i++; ?>
					    @endif
				    @endforeach
				    @endif
</div>
<div class="row m-0">
					@if(isset($permission))

					 <div class="col-md-4 mb-2">				<label for="Services" class="control-label mb-1">IQTrack Chat Services</label>
				</div>		
					 @foreach($permission as $data)		
				@if($data['service_flag'] == 8 )
						<div class="col-md-4 mb-2">
							<input type="checkbox" name="check_list[]" class="check_list custom-checkbox" id="check_list-<?php echo $i; ?>" value="{{$data['id'] }}" 
                          <?php if(!empty($service_id) && in_array($data['id'],$service_id)){ echo 'checked="checked"';} ?>> &nbsp; 
							<label for="check_list-<?php echo $i; ?>" class="custom-checkbox-label">{{ $data['name'] }}</label>
					    </div>


					    <?php $i++; ?>
					    @endif
				    @endforeach
				    @endif
</div>

						
					{{--NEW TAB ENDS--}}	
					{{ Form::hidden('id', null, array('class' => 'form-control' )) }}
				<div class="col-md-12 form-group text-right">
					<input type="hidden" name="callback" class="callback" value="form_basic_reload" />
					<button type="reset" class="btn btn-outline-danger px-4" > {{__('Reset')}} </button>
					<button  type="submit" class="btn btn-primary px-4"> {{__('Save')}} </button>

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
<script src="{{ asset('js/tiny_mce/tiny_mce.js') }}"></script> 
<script src="{{ asset('js/tinymce.js') }}"></script> 
<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
<script src="{{ asset('js/translation.js') }}"></script> 
<script type="text/javascript">
	$(document).on('click', '.mem_delete', function(){ 
	    var uname       = $(this).data('uname');
	    //$('#members').removeAttr('style');
	    //$('#members').attr('id','members2');
	    //$('.picker').remove();
	    var res = confirm("Remove "+uname+" from this project.");
	    if(res == true){
	        var uid        = $(this).attr('id');
	        var update_id   = $(this).data('update');
	        $("#members ."+uid).removeAttr("selected");
	        var order = $('.pc-list ul li:last-child').data('order'); 
	        opt = "<li data-id='"+uid+"' data-order='"+(++order)+"'>"+uname+"</li>";
	        $('.pc-list ul').append(opt);
	        opt = "<option value='"+uid+"'>"+uname+"</option>";
	        $('#'+update_id).append(opt);
	        $(this).parent().remove();
	        
	        //$('#members').picker({containerWidth: 465, search: true}); 
	        //$('#save_btn').trigger('click');
	       
	    }
	});
	$(document).ready(function () {
		
		add_multiplefields_projectmeta();
	});
	function add_multiplefields_projectmeta()
	{
		var url = $("#base_url").val();
		var vendor_count = $("#vendor_count").val();
		var maxField = 10; 
		var addButton = $('.add_button_projectmeta'); 
		var wrapper = $('.field_wrapper_projectmeta'); 
		var i = 2;	
		if(vendor_count >= i)
		{
			i = parseInt(vendor_count)+1;
		}
		var x = 1; 
		$(addButton).click(function(){
			if(x < maxField){ 
				var fieldHTML = '<div><div class="row row-eq-height"><div class="col-sm-4 form-group"><input type="text" name="vendor[]" id="vendor'+i+'" class="form-control"></div><div class="col-sm-4 form-group"><input type="text" name="vendor_email[]" id="vendor_email'+i+'" class="form-control"></div><div class="col-sm-4 form-group"><input type="text" name="vendor_phone[]" id="vendor_phone'+i+'" class="form-control" ></div></div><a href="javascript:void(0);" class="remove_button" id="remove_'+i+'"><img style="width:20px;height:20px;" src="'+url+'/img/remove.png"/></a></div>'; 
				x++; i++;
				$(wrapper).append(fieldHTML); 
			}
		});
		
		
		$(wrapper).on('click', '.remove_button111', function(e){
			e.preventDefault();
			var ids = $(this).attr('id');
			var res = ids.substring(7);//alert(res);
			if(res>=2)
			{
				/*$.ajax({
					type: "post",
					url: url+'/remove_mail_server',
			 
					data: {
							"res": res,
						  },
						
					})
					.done(function(data)
					{ 
						console.log("removed");
					})
					.fail(function(jqXHR, ajaxOptions, thrownError)
					{						 
						console.log("error");
					});*/
			}
				$(this).parent('div').remove(); 
				x--; i--;
			});
	}

	$("#dropdownlist").change(function () {
  var numInputs = $(this).val();
  var nameopt = $(this).find(':selected').text();
  // for (var i = 0; i < numInputs; i++)
    $("#inputArea").append('<div class="row mt-2"><div class="col-md-3"><input class="form-control" name="inputs'+numInputs+'" value='+nameopt+' /></div><div class="col-md-5"><input type="number" class="form-control" name ="total'+numInputs+'"/><span id ="total'+numInputs+'_err" class="error"></span></div><div class="col-md-2"><select class="form-control" name = "size'+numInputs+'"><option value="TB">TB</option> <option value="GB">GB</option></select></div><div class="col-md-2"><a href = "#"  id="remove_drive"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/remove.png"/></a></div></div>');
});
	$(document).on('click', '#remove_drive', function () {
	
    $(this).parent('div').parent('div').remove();

});
</script>

@endsection
