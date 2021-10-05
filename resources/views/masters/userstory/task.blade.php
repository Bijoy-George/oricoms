@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add Task
@endsection
@section('content')

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right">
	
	@if(isset($res))
	<a href="{{url('taskList')}}/{{$project_id}}/{{$sprint_id}}/{{$userstory_id}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a>
	@else
	<a href="{{url('userstoryList')}}/{{$project_id}}/{{$sprint_id}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a>
	@endif
	</div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Task')}}</h2>
        <div class="widget-content pt-3">  

        @if(isset($res))
				  {!! Form::model($res, ['method' => 'POST', 'name' => 'frm-plan-discount', 'class' => 'form-common form-offer', 'url' => 'taskstore']) !!}
				  @else
				  {!! Form::open(array('url' => 'taskstore', 'class' => 'form-common form-offer', 'method'=>'POST')) !!}
				@endif

        {{ csrf_field() }}
			
		@if(isset($task_id))
		<input type="hidden" id="task_id" name="task_id" value="{{$task_id}}">
	    @endif
		@if(isset($userstory_id))
		<input type="hidden" id="id" name="id" value="{{$userstory_id}}">
	    @endif
        <div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
            @if(isset($user_story))
			<div class="col-md-12 form-group">
				<label for="title" class="control-label">{{__('User Story')}}<span class="red_star">*</span></label>
                    @foreach ($user_story as $story)				
					{{ Form::text('title', $story->title, array('class' => 'form-control','id' => 'title', 'required' => true)) }}
              		@endforeach			
					<span class="error" id="title_err"></span>
			</div>
			@endif
			
				
			
			<div class="col-md-12 form-group">
				<label for="task" class="control-label">{{__('Task')}}<span class="red_star">*</span></label>						
					{{ Form::text('task[]', null, array('class' => 'form-control','id' => 'task')) }}	
					<span class="error" id="task_err"></span>
			</div>
			@if(isset($res))
			<div class="col-sm-12 form-group">
					<label for="user" class="control-label">{{__('Asigned To')}}<span class="red_star">*</span></label>
					{{ Form::select('user',$users,$res->asigned_to, ['class' => 'escalate_to form-control', 'id' => "user"]) }}
				 	<span class="error" id="user_err"></span>
				</div>
		    @else
				<div class="col-sm-12 form-group">
					<label for="user" class="control-label">{{__('Asigned To')}}<span class="red_star">*</span></label>
					{{ Form::select('user',$users,null, ['class' => 'escalate_to form-control', 'id' => "user"]) }}
				 	<span class="error" id="user_err"></span>
				</div>
			@endif
            <div class="col-sm-12 form-group">
					<label for="hour" class="control-label">{{__('Hour')}}<span class="red_star">*</span></label>
					{{ Form::text('hour', null, array('class' => 'form-control','id' => 'hour')) }}	
				 	<span class="error" id="hour_err"></span>
			</div>		
			 @if(isset($res))
				 <div class="col-sm-12 form-group">
					<label for="status" class="control-label">{{__('Status')}}<span class="red_star">*</span></label>
					{{ Form::select('status',$status,$res->status, ['class' => 'escalate_to form-control', 'id' => "status"]) }}
				 	<span class="error" id="status_err"></span>
				</div>
             @endif				 
			<div class="col-md-12 form-group text-right">
			  <input type="hidden" name="project_id" id="project_id" value="{{$project_id}}">
		      <input type="hidden" name="sprint_id" id="sprint_id" value="{{$sprint_id}}">
		      <input type="hidden" name="userstory_id" id="userstory_id" value="{{$userstory_id}}">
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
</div>
@endsection
<script type="text/javascript">  

	  
function add_task_fun(res_id=null){  
   
        i=1;
      $("#dynamic_field_task"+ res_id).append('<tr id="task_new'+i+'"><td><input type="text" name="task[]" placeholder="Enter Task" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" onclick="remove_new_task_fun();" class="btn btn-danger res_remove">X</button></td></tr>');  
      
}
   	  
 function remove_task_fun(res_id=null){  
     
     
     $("#task_old"+res_id).remove();  
      
}



 function remove_new_task_fun(res_id=null){   
           var button_id = 1; 
		   //alert(button_id);
          	$("#task_new"+button_id).remove();  
      }
 
  
 </script>

 
