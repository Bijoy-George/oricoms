@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add customer nature
@endsection
@section('content')

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right">
	@if(isset($res))
	<a href="{{url('userstoryList')}}/{{$project_id}}/{{$sprint_id}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a>
	@else
	<a href="{{url('sprint')}}/{{$project_id}}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a>
    @endif
	</div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('User Story')}}</h2>
        <div class="widget-content pt-3">  

        @if(isset($res))
				  {!! Form::model($res, ['method' => 'POST', 'name' => 'frm-plan-discount', 'class' => 'form-common form-offer', 'route' => ['userstory.store']]) !!}
				  @else
				  {!! Form::open(array('route' => 'userstory.store', 'class' => 'form-common form-offer', 'method'=>'POST')) !!}
				@endif

        {{ csrf_field() }}
        <div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
			@if(isset($res))
            <input type="hidden" value="{{$res->id}}" name="id" id="id">
		    @endif
			<div class="col-md-6 form-group">
				<label for="title" class="control-label">{{__('Title')}}</label>						
					{{ Form::text('title', null, array('class' => 'form-control','id' => 'title', 'required' => true)) }}	
					<span class="error" id="title_err"></span>
			</div>
			
			@if(isset($res))
			<div class="col-md-6 form-group">
				<label for="priority" class="control-label">{{__('Priority')}}</label>
                    {{ Form::select('priority',$priority,$res->priority,['class' => 'escalate_to form-control', 'id' => "priority"]) }}				
						
					<span class="error" id="priority_err"></span>
			</div>
			@else
				<div class="col-md-6 form-group">
				<label for="priority" class="control-label">{{__('Priority')}}</label>
                    {{ Form::select('priority',$priority,null,['class' => 'escalate_to form-control', 'id' => "priority"]) }}				
						
					<span class="error" id="priority_err"></span>
			</div>
		    @endif
							<div class="col-md-6 form-group">
					<label for="estimate" class="control-label">{{__('Estimate')}}</label>						
							{{ Form::text('estimate', null, array('class' => 'form-control','id' => 'estimate')) }}	
							<span class="error" id="estimate_err"></span>
				</div>
				
				@if(isset($res))
				<div class="col-sm-6 form-group">
					<label for="user" class="control-label">{{__('User')}}<span class="red_star">*</span></label>
					{{ Form::select('user',$users,$res->user, ['class' => 'escalate_to form-control', 'id' => "user"]) }}
				 	<span class="error" id="user_err"></span>
				</div>
				@else
				<div class="col-sm-6 form-group">
					<label for="user" class="control-label">{{__('User')}}<span class="red_star">*</span></label>
					{{ Form::select('user',$users,null,['class' => 'escalate_to form-control', 'id' => "user"]) }}
				 	<span class="error" id="task_err"></span>
				</div>
			    @endif
               
				<div class="col-md-6 form-group">
					<label for="goal" class="control-label">{{__('Goal')}}</label>						
							{{ Form::text('goal', null, array('class' => 'form-control','id' => 'goal')) }}	
							<span class="error" id="goal_err"></span>
				</div>
				<div class="col-md-6 form-group">
					<label for="given" class="control-label">{{__('Given')}}</label>						
							{{ Form::text('given', null, array('class' => 'form-control','id' => 'given')) }}	
							<span class="error" id="given_err"></span>
				</div>
				<div class="col-md-6 form-group">
					<label for="when" class="control-label">{{__('When')}}</label>						
							{{ Form::text('when', null, array('class' => 'form-control','id' => 'when')) }}	
							<span class="error" id="when_err"></span>
				</div>
				<div class="col-md-6 form-group">
					<label for="then" class="control-label">{{__('Then')}}</label>						
							{{ Form::text('then', null, array('class' => 'form-control','id' => 'then')) }}	
							<span class="error" id="then_err"></span>
				</div>
				
        <div class="col-md-12 form-group text-right">
		  <input type="hidden" name="project_id" id="project_id" value="{{$project_id}}">
		  <input type="hidden" name="sprint_id" id="sprint_id" value="{{$sprint_id}}">
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
