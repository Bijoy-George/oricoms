@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Feedback
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="text-right"><a href="{{url('feedback')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
      <div class="widget mt-3">
        <h2 class="m-0">{{__('Add Feedback')}}</h2>
        <div class="widget-content p-3">
          {!! Form::open(array('route' => 'feedback.store', 'class' => 'form-common', 'method'=>'POST')) !!}
            {{ csrf_field() }}
            @if(session('message'))
            <div class="alert alert-danger"> {{session('message')}}</div>
            @endif
            @if(session('success'))
            <div class="alert alert-success"> {{session('success')}}</div>
            @endif
            <div class="message"></div>
            <div class="form-group">
              <label for="title" class="control-label">{{__('Select Channel')}}<span class="red_star">*</span></label>
              {{ Form::select('fb_type', $channels, null, ['id' => 'fb_type', 'class' => 'form-control fb_type_cls']) }} <span class="error" id="fb_type_err"></span> </div>
            <div class="clearfix"></div>
            <div id="final_result"></div>
            <div class="form-group text-right"><br>
              <button type="submit" class="btn btn-primary"> {{__('Save')}} </button>
            </div>
            {{ Form::hidden('id', null, array('class' => 'form-control' )) }} 
            {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('footer-custom-css-js')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dropdown.css') }}">
<script src="{{ asset('js/jquery.dropdown.js') }}"></script> 
@endsection 