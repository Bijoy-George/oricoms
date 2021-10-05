@extends('layouts.outsidepage')
@section('title')
{{config('constant.site_title')}}  - Feedback
@endsection
@section('content')
<style type="text/css">
  body {
    background-color: #2d333d;
}
</style>
<form class="listing form-common" role="form" method="POST" action="{{ url('api/feedback_api') }}" autocomplete="off">
  {{ Form::hidden('company_id',$db_det->cmpny_id) }}
  {{ Form::hidden('authentication_key',$authentication) }}
  {{ Form::hidden('fid',$fid) }}
  {{ Form::hidden('ltype',$ltype) }}
  {{ Form::hidden('type',$channel_type) }} 
  {{ Form::hidden('random_code',$randomcode) }}
  <input type="submit" id="get_feedback_det" class="btn btn-primary" value="SAVE" style="display:none">
</form>
<div class="row m-0 align-items-center justify-content-center feedback-survey text-white">
  <div class="col-md-6 text-center py-4 ">
    <h2>{{__('Feedback Form')}}</h2>
  </div>
  <div class="col-md-12"></div>
  <div class="col-md-6">
    <div class="form-container p-3">
    	<div id="msg" role="alert"></div>
        <div id="list"></div>
    </div>
  </div>
</div>
@endsection 