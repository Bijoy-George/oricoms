@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Question
@endsection
@section('content')
@php
$class_1='';
$class_2='';

if(isset($res->language_type) && $res->language_type == 1)
{
  $class_1='checked';
}else if(isset($res->language_type) && $res->language_type == 2)
{
  $class_2='checked';
}else{
  $class_2='checked';
}
@endphp
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('questions')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">

                <h2>{{__('Add Question')}}</h2>
                <div class="widget-content pt-3"> 
	
				@if(isset($res))
					{!! Form::model($res, ['method' => 'POST', 'class' => 'form-common', 'route' => ['questions.store']]) !!}
				@else
					{!! Form::open(array('route' => 'questions.store', 'class' => 'form-common', 'method'=>'POST')) !!}
				@endif
				
				{{ csrf_field() }}
				<div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
				<span class="red_star">NOTE : Type in Malayalam , Press Ctrl+g to toggle between English and Malayalam
					Please preferred a language before entering questions</span><br><br>


				@if(session('message'))
				 <div class="alert alert-danger"> {{session('message')}}</div>
				@endif
				
				@if(session('success'))
				 <div class="alert alert-success"> {{session('success')}}</div>
				@endif
				
					
					
				
						
					<!--{{ Form::radio('language_type', 1,array('id' => 'language_type', 'class' => 'form-control' )) }} {{__('English')}} 
					{{ Form::radio('language_type', 2,array('id' => 'language_type', 'class' => 'form-control' )) }} {{__('Malayalam')}} -->
					 <div class="col-md-10 form-group">
                        <input  type="radio"  name="language_type" {{ $class_2 }}  value="2" > {{__('Malayalam')}}
                        <input  type="radio"  name="language_type" {{ $class_1 }}   value="1">  {{__('English')}} 
                    </div>
					<span class="error" id="questions_err"></span>
					
					
					<div class="col-md-12 form-group">
					
					<label for="title" class="control-label mb-1">{{__('Questions')}}<span class="red_star">*</span></label>
					{{ Form::text('questions', null, array('id' => 'questions','class' => 'lang_trans form-control' ,'required' => true)) }}
					<span class="error" id="questions_err"></span>
					</div>
					<div class="col-md-6 form-group">
					<label for="option1" class="control-label mb-1">{{__('Option 1')}}</label>
					{{ Form::text('option1', null, array('id' => 'option1', 'class' => 'lang_trans form-control', 'required' => true)) }}
					<span class="error" id="option1_err"></span>
					</div>
					<div class="col-md-6 form-group">
					<label for="option2" class="control-label mb-1">{{__('Option 2')}}</label>
					{{ Form::text('option2', null, array('id' => 'option2', 'class' => 'lang_trans form-control','required' => true )) }}
					<span class="error" id="option2_err"></span>
					</div>	
					<div class="col-md-6 form-group">
					<label for="option3" class="control-label mb-1">{{__('Option 3')}}</label>
					{{ Form::text('option3', null, array('id' => 'option3', 'class' => 'lang_trans form-control' )) }}
					<span class="error" id="option3_err"></span>
					</div>
					<div class="col-md-6 form-group">
					<label for="option4" class="control-label mb-1">{{__('Option 4')}}</label>
					{{ Form::text('option4', null, array('id' => 'option4', 'class' => 'lang_trans form-control' )) }}
					<span class="error" id="option4_err"></span>
					</div>
					<div class="col-md-6 form-group">
					<label for="option5" class="control-label mb-1">{{__('Option 5')}}</label>
					{{ Form::text('option5', null, array('id' => 'option5', 'class' => 'lang_trans form-control' )) }}
					<span class="error" id="option3_err"></span>
					</div>
					<div class="col-md-6 form-group">
					<label for="option6" class="control-label mb-1">{{__('Option 6')}}</label>
					{{ Form::text('option6', null, array('id' => 'option6', 'class' => 'lang_trans form-control' )) }}
					<span class="error" id="option4_err"></span>
					</div>
					@if($exist_flag == 0)
					<div class="col-md-6 form-group">
					<label for="status" class="control-label mb-1">{{__('Status')}}</label>
										
						{{ Form::select('status', array(config('constant.ACTIVE')=> 'Active', config('constant.INACTIVE')=>'Inactive'), null, ['id' => 'status', 'class' => 'form-control']) }}	
					<span class="error" id ="status_err"></span>
					</div>
					@endif
					<div class="col-md-6 mb-2">
	                 <input type="checkbox" name="feedback"  class="custom-checkbox" id="feedback" value="1"  @if(isset($res->feedback) && $res->feedback == 1){{ 'checked'}} @endif>
	                 <label class="custom-checkbox-label" for="feedback"> Question Added to Feedback</label>

					</div>
					<div class="col-md-6 mb-2">
	                 <input type="checkbox" name="survey"  id="survey" value="1" class="custom-checkbox"@if(isset($res->survey) && $res->survey == 1){{ 'checked'}} @endif> 
	                 <label class="custom-checkbox-label" for="survey"> Question Added to Survey</label> 

					</div>
				
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
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="{{ asset('js/translation.js') }}"></script>
@endsection