@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add project
@endsection
@section('header-custom-css-js')
<link href="{{ asset('css/multiselect/main.css') }}" rel="stylesheet">
<!--<link href="{{ asset('css/multiselect/prism.css') }}" rel="stylesheet">
<script src="{{ asset('js/multiselect/libs.js') }}"></script>  -->
<script src="{{ asset('js/multiselect/picker.js') }}"></script>
<!--<script src="{{ asset('js/multiselect/prism.js') }}"></script> -->
@endsection
@section('content')

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-9 text-right"><a href="{{url('projects')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-9 mt-3">
      <div class="widget">
        <h2>{{__('Project')}}</h2>
        <div class="widget-content pt-3">  

	
				@if(isset($project))
					{!! Form::model($project, ['name' => 'prjt_form', 'method' => 'POST', 'class' => 'form-common', 'route' => ['projects.store']]) !!}


					<?php $assigned_members = ($project->members != NULL AND $project->members != 'N;')?unserialize($project->members):array(); ?>
				@else
					<?php $assigned_members = array(); ?>
					{!! Form::open(array('name' => 'prjt_form', 'route' => 'projects.store', 'class' => 'form-common', 'method'=>'POST')) !!}
				@endif
				
				{{ csrf_field() }}

				<div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
				<input type="hidden" name="vendor_count" id="vendor_count" value="@if(isset($project)){{Helpers::get_contact_count($project->id)}}@else {{'1'}} @endif">
						<div class="col-md-12 form-group">
						{{ Form::label('Project', 'Name')}} 						
						{{ Form::text('prjt_name', null, array('class' => 'form-control','id' => 'prjt_name')) }}	
						<span id ="prjt_name_err" class="error"></span>							
						</div>

						<div class="col-md-12 form-group">
						{{ Form::label('description', 'Description')}}
						{{ Form::textarea('description', null, array('id' => 'description', 'class' => 'lang_trans tinymce form-control' )) }} 						
						<span id ="description_err" class="error"></span>							
						</div>

						<div class="col-md-6 form-group">
						<?php $users = Helpers::getUserByPermission('project management','yes'); ?>
						<label for="project_lead" class="control-label mb-1">{{__('Project Lead')}}</label>
						{{ Form::select('project_lead', $users_array, null, ['id' => 'project_lead', 'class' => 'form-control']) }}		
						<span id ="project_lead_err"></span>
						</div>

						<div class="col-md-6 form-group">
						{{ Form::label('Budget', 'Budget')}} 						
						{{ Form::text('budget', null, array('class' => 'form-control','id' => 'budget')) }}	
						<span id ="budget_err" class="error"></span>							
						</div>	
						
						<div class="col-md-6 form-group">
						{{ Form::label('category', 'Category')}}
						 {{ Form::select('category', [null=>'Select Category'] +$category, null, ['id' => 'category', 'class' => 'form-control']) }}
						<span id ="category_err" class="error"></span>							
						</div>
						
						<div class="col-md-6 form-group">
						{{ Form::label('framework', 'Framework')}}
						 {{ Form::select('framework', [null=>'Select Framework'] +$framework, null, ['id' => 'framework', 'class' => 'form-control']) }}
						<span id ="category_err" class="error"></span>							
						</div>
						
						<div class="col-md-6 form-group">
						<label for="required_time" class="control-label mb-1">{{__('Required Time (In hours)')}}</label>
						{{ Form::number('required_time', null, array('id' => 'required_time','class' => 'form-control', 'min' => 0))  }}		
						<span id ="required_time_err"></span>
						</div>

						<div class="col-md-6 form-group">
						{{ Form::label('due_date', 'Due date')}}
						{{ Form::text('due_date', null, array('id' => 'due_date','class' => 'date_picker form-control','placeholder' => 'Due Date','autocomplete' => 'off')) }}
						<span id ="due_date_err" class="error"></span>							
						</div>		
						
						<div class="col-md-6 form-group">
						<label for="sort_order" class="control-label mb-1">{{__('Sort Order')}}</label>
						@if(isset($project)) 	
						{{ Form::number('sort_order', null, array('class' => 'form-control' ,'id' => 'sort_order','max' =>'99','min' =>'0')) }}
						@else
						{{ Form::number('sort_order', 0, array('class' => 'form-control' ,'id' => 'sort_order','max' =>'99','min' =>'0')) }}	
						@endif
						<span id ="sort_order_err"></span>						
						</div>
					
						<div class="col-md-6 form-group">
						{{ Form::label('project_status', 'Project Status')}}
						 {{ Form::select('project_status', [null=>'Select status'] +$project_status, null, ['id' => 'project_status', 'class' => 'form-control']) }}
						<span id ="project_status_err" class="error"></span>							
						</div>
						
						<div class="col-md-6 form-group">
						<label for="status" class="control-label mb-1">{{__('Status')}}</label>
						{{ Form::select('status', array(config('constant.ACTIVE')=> 'Active', config('constant.INACTIVE')=>'Inactive'), null, ['id' => 'status', 'class' => 'form-control']) }}		
						<span id ="status_err"></span>
						</div>

						<div class="col-md-12 form-group">
					           <label for="members" class="control-label mb-1">{{__('Assign Members : ')}}</label>
					            <select name="assign_members[]" class="form-control" id="assign_members" multiple>
					                	@if(count($users))
					                		@foreach ($users as $user)
					                			@if(!in_array($user['id'], $assigned_members))
					               				 	<option value="{{$user['id']}}">{{$user['name']}}</option>
					               				@endif
					                		@endforeach
					                	@endif
					            </select>
					            
						</div>
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
					<span id ="server_credentials_err" class="error"></span>							
					</div>
					
					<div class="field_wrapper_projectmeta">
					<div>
						<div class="row row-eq-height">               
							<div class="col-sm-4 form-group">
								{{ Form::label('vendor1', 'Vendor') }}
								<input type="text" name="vendor[]" id="vendor1" class="form-control" value="{{isset($vendor1)?$vendor1:''}}">
							</div>
							<div class="col-sm-4 form-group">
								{{ Form::label('vendor_email1', 'Vendor Email') }}
								<input type="text" name="vendor_email[]" id="vendor_email1" class="form-control" value="{{isset($vendor_email1)?$vendor_email1:''}}">
							</div>
							<div class="col-sm-4 form-group">
								{{ Form::label('vendor_phone1', 'Vendor Phone') }}
								<input type="text" name="vendor_phone[]" id="vendor_phone1" class="form-control" value="{{isset($vendor_phone1)?$vendor_phone1:''}}">
							</div>
						</div>
						<a href="javascript:void(0);" class="add_button_projectmeta" title="Add field"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/add.png"/></a>
						<?php  if($vendor_count>1) { for($i=2;$i<=$vendor_count;$i++) { 
						$vendor = 'vendor'.$i; 
						$vendor_email = 'vendor_email'.$i; 
						$vendor_phone = 'vendor_phone'.$i; 
						
						?>
						<div>
						<div class="row row-eq-height">               
							<div class="col-sm-4 form-group">
								<input type="text" name="vendor[]" id="vendor<?php echo $i; ?>" class="form-control" value="{{isset($$vendor)?$$vendor:''}}">
							</div>
							<div class="col-sm-4 form-group">
								<input type="text" name="vendor_email[]" id="vendor_email<?php echo $i; ?>" class="form-control" value="{{isset($$vendor_email)?$$vendor_email:''}}">
							</div>
							<div class="col-sm-4 form-group">
								<input type="text" name="vendor_phone[]" id="vendor_phone<?php echo $i; ?>" class="form-control" value="{{isset($$vendor_phone)?$$vendor_phone:''}}">
							</div>
						</div>	
					<a href="javascript:void(0);" class="remove_button" id="remove_<?php echo $i; ?>"><img style="width:20px;height:20px;" src="{{ URL::to('/') }}/img/remove.png"/></a>
						</div>   	
						<?php  }  }  ?>
					</div>
					</div>
				</div>
					
					{{--NEW TAB ENDS--}}
					
					
					
					{{ Form::hidden('id', null, array('class' => 'form-control' )) }}
				
				
				<div class="col-md-12 form-group text-right">
					<input type="hidden" name="callback" class="callback" value="form_basic_reload" />

					<button type="reset" class="btn btn-outline-danger px-4" > {{__('Reset')}} </button>
					<button id="save_btn" type="submit" class="btn btn-primary px-4"> {{__('Save')}} </button>
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
		
		
		$(wrapper).on('click', '.remove_button', function(e){
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
</script>
@endsection
