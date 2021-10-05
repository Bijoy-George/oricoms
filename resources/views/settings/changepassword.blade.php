@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - Change Password
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{ url()->previous() }}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Change Password')}}</h2>
        <div class="widget-content pt-3"> 
            {!! Form::open(array('url' => 'postCredentials', 'class' => 'form-common', 'method'=>'POST')) !!}
          {{ csrf_field() }}
          <div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
			 
            <div class="col-md-6 form-group">
                <label for="current-password" class="control-label mb-1">{{__('Current Password')}}</label>
                {{ Form::password('current-password', array('class' => 'form-control','id' => 'current-password', 'required' => true)) }}	
				<span id ="current-password_err"></span>	
                
            </div>
            <div class="col-md-6 form-group">
                <label for="password" class="control-label mb-1">{{__('Password')}}</label>
                {{ Form::password('password', array('class' => 'form-control' ,'id' => 'password', 'required' => true)) }}	
				<span id ="password_err"></span>	
            </div>
            <div class="col-md-6 form-group">
                <label for="password_confirmation" class="control-label mb-1">{{__('Re-enter Password')}}</label>
                {{ Form::password('password_confirmation', array('class' => 'form-control' ,'id' => 'password_confirmation', 'required' => true)) }}	
				<span id ="password_confirmation_err"></span>						
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
<script src="{{ asset('js/jscolor.js') }}"></script>
@endsection