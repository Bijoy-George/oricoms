@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add customer nature
@endsection
@section('header-custom-css-js')
<link href="{{ asset('css/multiselect/main.css') }}" rel="stylesheet">
<script src="{{ asset('js/multiselect/picker.js') }}"></script>
@endsection
@section('content')

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('project_task_pm')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Task')}}</h2>
        <div class="widget-content pt-3">  

		
				@if(isset($project_task))
					{!! Form::model($project_task, ['method' => 'POST', 'class' => 'form-common', 'route' => ['project_task_pm.store']]) !!}
				@else
					{!! Form::open(array('route' => 'project_task_pm.store', 'class' => 'form-common', 'method'=>'POST')) !!}
				@endif
				
				{{ csrf_field() }}
				<div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
			
						<div class="col-md-12 form-group">
						{{ Form::label('title', 'Title')}} 						
						{{ Form::text('title', null, array('class' => 'form-control','id' => 'title', 'required' => true)) }}	
						<span id ="title_err" class="error"></span>							
						</div>
						
						<div class="col-md-12 form-group">
						{{ Form::label('description', 'Description')}}
						{{ Form::textarea('description', null, array('id' => 'description', 'class' => ' tinymce form-control' )) }} 						
						<span id ="description_err" class="error"></span>							
						</div>
						
						<div class="col-md-6 form-group">
						{{ Form::label('project_id', 'Project')}}	
						{{ Form::select('project_id', [null=>'Please Select'] +$project, null, ['id' => 'project_id', 'class' => 'form-control project_id','required'=>true]) }}
						<span id ="project_id_err" class="error"></span>							
						</div>
						<?php $tomorrow = date("d/m/Y", strtotime("+2 day")); ?>
						<div class="col-md-6 form-group">
						{{ Form::label('due_date', 'Due date')}}
						{{ Form::text('due_date', $tomorrow, array('id' => 'due_date','class' => 'date_picker form-control','placeholder' => 'Due Date','autocomplete' => 'off')) }}
						<span id ="due_date_err" class="error"></span>							
						</div>
						
						<div class="col-md-6 form-group">
						<label for="required_time" class="control-label mb-1">{{__('Required Time (In hours)')}}</label>
						{{ Form::number('required_time', 8, array('id' => 'required_time','class' => 'form-control', 'min' => 0))  }}		
						<span id ="required_time_err"></span>
						</div>
						
						<div class="col-md-6 form-group">
						{{ Form::label('version', 'Version')}}
						{{ Form::number('version', 1, ['id' => 'version', 'class' => 'form-control', 'min' => 0]) }}						
						<span id ="version_err" class="error"></span>							
						</div>
						
						
						<div class="col-md-6 form-group">
						{{ Form::label('priority', 'Priority')}}
						{{ Form::select('priority',$priority, null, ['id' => 'priority', 'class' => 'form-control']) }}
						<span id ="priority_err" class="error"></span>							
						</div>
						
						
						<div class="col-md-6 form-group">
						{{ Form::label('category', 'Category')}}
						 {{ Form::select('category',$category, null, ['id' => 'category', 'class' => 'form-control']) }}
						<span id ="category_err" class="error"></span>							
						</div>
							
						
						<div class="col-sm-6 form-group">
						<label for="members" class="control-label mb-1">{{__('Assign Members :')}}</label>
						<select name="members[]" id="members" class="form-control members" multiple="multiple" required="true">
						@if(isset($project_task->project_id))
								<?php 
					           		$all_members = Helpers::get_members_by_project_id($project_task->project_id); 
									$pjct_members = $project_task->members;
					            ?>
									@if(count($all_members)){
										@foreach ($all_members as $key => $val)
											 <option value="{{$key}}" <?php if(strpos($pjct_members, ':"'.$key.'";') !== false) { echo 'selected'; } ?> >{{$val}}</option>
										@endforeach
									@endif
						@endisset
						</select>
						<span class="error" id="members_err" class="error"></span>
						</div>
					
						<div class="col-md-6 form-group">
						<label for="status" class="control-label mb-1">{{__('Status')}}</label>
						{{ Form::select('status', array(config('constant.ACTIVE')=> 'Active', config('constant.INACTIVE')=>'Inactive'), null, ['id' => 'status', 'class' => 'form-control']) }}		
						<span id ="status_err"></span>
						</div>
						
						 <div class="col-md-6 form-group">
            {{ Form::label('from_time', 'From')}}
            {{ Form::text('from_time', null, array('id' => 'from_time','class' => 'datetimepicker form-control','placeholder' => 'From time','autocomplete' => 'off','required'=>true)) }}
            <span id ="from_time_err" class="error"></span>             
            </div>
            
            <div class="col-md-6 form-group">
            {{ Form::label('to_time', 'To')}}
            {{ Form::text('to_time', null, array('id' => 'to_time','class' => 'datetimepicker form-control','placeholder' => 'To time','autocomplete' => 'off','required'=>true)) }}
            <span id ="to_time_err" class="error"></span>             
            </div>

            <div class="col-md-6 form-group">
						{{ Form::label('task_status', 'Task Status')}}
						 {{ Form::select('task_status',$task_status, null, ['id' => 'task_status', 'class' => 'form-control']) }}
						<span id ="task_status_err" class="error"></span>							
						</div>
						
					<!--<div class="col-sm-12 form-group">
		          	<div class="advancedUpload">Upload</div>-->
					<!-- <input type="hidden" value="" id="batchId" /> -->
					<!-- <input type="hidden" value="" id="emailId" /> -->
					<!-- <input type="hidden" value="" id="emailType"> -->
					<!--<input type="hidden" value="" name="attachments" id="attach">
					<input type="hidden" value="" id="callbackFunc">
					</div>	-->
						
				
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
<script src="{{ asset('js/tiny_mce/tiny_mce.js') }}"></script> 
<script src="{{ asset('js/tinymce.js') }}"></script> 
<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
<script src="{{ asset('js/translation.js') }}"></script> 
<link rel="stylesheet" type="text/css" href="{{ asset('css/uploadfile.min.css') }}">
<script src="{{ asset('js/jquery.uploadfile.min.js') }}" type="text/javascript"></script>

<script> 
	var vars = {};
  var successFiles  = [];
var errorFiles    = [];
 var uploadObj = $(".advancedUpload").uploadFile({
  url:"/mail_attachment_upload",
  multiple:true,
  autoSubmit:false,
  fileName:"file",
  allowedTypes:"jpg,png,jpeg,pdf",
  maxFileSize:1024*1024*2,
  maxFileCount:20,
  returnType:'json',
  multiple:true,
  dragDrop:true,
  showStatusAfterSuccess:true,
  showDelete:false,
  showDone:false,
  onSelect:function(files) {
    console.log('Submitted:');
    console.log('Submitted Files:');
    console.log(files);
    // uploadObj.reset();
    setTimeout(function() {
      $("div.ajax-file-upload-error").remove();
    }, 5000);
  },
  onSuccess:function(files,data,xhr)
  {
    console.log(123);
    console.log('Files:');
    console.log(files);
    console.log('Data:');
    console.log(data);
    console.log('XHR:');
    console.log(xhr);
    successFiles.push({
      originalName: data.original_name,
      mimeType: data.mime_type,
      savedName: data.saved_name
    });

     attachments = JSON.stringify(successFiles);

     //$("#attachments").val(attachments);
     $("#attach").val(attachments);
    return;

    //$("#mesg").addClass('alert');
    //$("#mesg").addClass('alert-success');
    //$("#mesg span").html('Query added successfully.');
  },
  onError: function(files, status, errMsg, pd)
  {
    console.log('Error');
    console.log('Files:');
    console.log(files);
    console.log('Status:');
    console.log(status);
    console.log('Error Message:');
    console.log(errMsg);
    console.log('pd:');
    console.log(pd);
    errorFiles.push(files[0]);
    return;
  },
  afterUploadAll: function(obj)
  {
    console.log('Upload finished');
    console.log('Obj');
    console.log(obj);
    console.log('Error Files');
    console.log(errorFiles);
    console.log('Successful Files');
    console.log(successFiles);
    setTimeout(function() {
      $(".ajax-file-upload-statusbar").has(".ajax-file-upload-error").remove();
    }, 5000);
    if (errorFiles.length !== 0)
    {
      console.log('Failure123');
    }
    else {
      console.log('Success123');
      var callbackFunc  = $("#callbackFunc").val();
      if (callbackFunc !== '' && typeof callbackFunc != "undefined")
      {
        window[callbackFunc](2);
      }
    }
   
    }

});


  /*var successFiles1  = [];
var errorFiles1    = [];
i = 2;
 vars['uploadObj'+i] = $(".advancedUpload"+i).uploadFile({
  url:"/mail_attachment_upload",
  multiple:true,
  autoSubmit:false,
  fileName:"file2",
  allowedTypes:"jpg,png,jpeg,pdf",
  maxFileSize:1024*1024*2,
  maxFileCount:5,
  returnType:'json',
  multiple:true,
  dragDrop:true,
  showStatusAfterSuccess:true,
  showDelete:false,
  showDone:false,
  onSelect:function(files) {
    console.log('Submitted:');
    console.log('Submitted Files:');
    console.log(files);
    // uploadObj.reset();
    setTimeout(function() {
      $("div.ajax-file-upload-error").remove();
    }, 5000);
  },
  onSuccess:function(files,data,xhr)
  {
    console.log(123);
    console.log('Files:');
    console.log(files);
    console.log('Data:');
    console.log(data);
    console.log('XHR:');
    console.log(xhr);
    successFiles1.push({
      originalName: data.original_name,
      mimeType: data.mime_type,
      savedName: data.saved_name
    });

     attachments = JSON.stringify(successFiles1);

     $("#attach1").val(attachments);
    return;

    //$("#mesg").addClass('alert');
    //$("#mesg").addClass('alert-success');
    //$("#mesg span").html('Query added successfully.');
  },
  onError: function(files, status, errMsg, pd)
  {
    console.log('Error');
    console.log('Files:');
    console.log(files);
    console.log('Status:');
    console.log(status);
    console.log('Error Message:');
    console.log(errMsg);
    console.log('pd:');
    console.log(pd);
    errorFiles.push(files[0]);
    return;
  },
  afterUploadAll: function(obj)
  {
    console.log('Upload finished');
    console.log('Obj');
    console.log(obj);
    console.log('Error Files');
    console.log(errorFiles1);
    console.log('Successful Files');
    console.log(successFiles1);
    setTimeout(function() {
      $(".ajax-file-upload-statusbar").has(".ajax-file-upload-error").remove();
    }, 5000);
    if (errorFiles.length !== 0)
    {
      console.log('Failure123');
    }
    else {
      console.log('Success123');
      var callbackFunc  = $("#callbackFunc").val();
      if (callbackFunc !== '' && typeof callbackFunc != "undefined")
      {
        window[callbackFunc](2);
      }
    }
   
    }

});*/
</script>
@endsection