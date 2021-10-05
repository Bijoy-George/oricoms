@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - User Change Password
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="text-right"><a href="{{url('userDetails')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
      <div class="widget mt-3">
        <h2 class="m-0">{{__('Change password for')}} {{$usr->name}}</h2>
        <div class="widget-content pt-3"> {!! Form::open(array('route' => 'savepassword', 'class' => 'form-common', 'method'=>'POST')) !!} {{ csrf_field() }}
          <div class="row m-0">
            <div class="col-sm-12"><span class="response"></span></div>
            <div class="col-md-12 form-group">
                <label for="password" class="control-label mb-1">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                <span id ="password_err"></span> </div>
            <div class="col-md-12 form-group">
                <label for="password-confirm" class="control-label mb-1">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
			<div class="col-sm-12 form-group text-right"> {{ Form::hidden('userid', $userid, array('class' => 'form-control' )) }}
              <button type="reset" class="btn btn-outline-danger px-4" > {{__('Reset')}} </button>
              <button type="submit" class="btn btn-primary px-4"> {{__('Save')}} </button>
            </div>
          </div>
          {!! Form::close() !!} </div>
      </div>
    </div>
  </div>
</div>
@endsection 