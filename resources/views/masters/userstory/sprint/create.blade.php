@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add customer nature
@endsection
@section('content')

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('sprint')}}/{{$project_id}}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Sprint')}}</h2>
        <div class="widget-content pt-3">  

        @if(isset($res))
				  {!! Form::model($res, ['method' => 'POST', 'name' => 'frm-plan-discount', 'class' => 'form-common form-offer', 'url' => ['sprint_store']]) !!}
				  @else
				  {!! Form::open(array('url' => 'sprint_store', 'class' => 'form-common form-offer', 'method'=>'POST')) !!}
				@endif

        {{ csrf_field() }}
	    
        <div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
			
			<div class="col-md-6 form-group">
				<label for="title" class="control-label">{{__('Title')}}</label>						
					{{ Form::text('name', null, array('class' => 'form-control','id' => 'name', 'required' => true)) }}	
					<span class="error" id="title_err"></span>
			</div>
			
		
			<div class="col-md-6 form-group">
				<label for="goal" class="control-label">{{__('Goal')}}</label>
                    {{ Form::text('goal', null, array('class' => 'form-control','id' => 'goal', 'required' => true)) }}		
						
					<span class="error" id="goal_err"></span>
			</div>
		    
			<div class="col-sm-6 form-group ">
					<label for="duedate" class="control-label">{{__('Due Date')}}<span class="red_star">*</span></label>
					{{ Form::text('duedate', null, array('id' => "duedate", 'class' => 'form-control date_picker', 'autocomplete' => 'off' )) }}
					
					<span class="error" id="duedate_err"></span>
				</div>	
				
        <div class="col-md-12 form-group text-right">
		<input type="hidden" id="project_id" name="project_id" value="{{$project_id}}">
		@if(isset($res))
		<input type="hidden" id="id" name="id" value="{{$res->id}}">
	    @endif
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
         $(document).ready(function () {
		$('.date_picker').datepicker({
			format: 'YYYY/MM/DD'
		});
	 
		$("#duedate").datepicker(
		{
             minDate:new Date()
			 //format: 'YYYY/MM/DD'
        });
		
</script>		
