@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add Extension
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('settings')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">

                <h2>{{__('Set Extention')}}</h2>
				<div class="widget-content pt-3"> 
              	@if($flash = session('success'))
					<div id="flash-msg" class="alert alert-success">{{$flash}}</div>
					@endif
	
				<form id="form-change-password" role="form" method="post" action="{{ url('setextension') }}" novalidate class="form-horizontal" autocomplete="off" >
				
				<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
				<div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
					
					
					<div class="col-md-6 form-group">
					<label for="setextension" class="control-label mb-1">{{__('Set Extention')}}</label>
						 <input type="text" class="form-control" id="extension" name="extension" placeholder="Logged in Extension" value="{{ Auth::user()->extension }}" autocomplete="off">
								@if ($errors->has('extension')) <span class="help-block"> <strong>{{ $errors->first('extension') }}</strong> </span> @endif 
					</div>
						
					{{ Form::hidden('id', null, array('class' => 'form-control' )) }}
							<div class="col-md-12 form-group text-right">
						<button type="reset" class="btn btn-outline-danger px-4" > {{__('Reset')}} </button>
						<button type="submit" class="btn btn-primary px-4"> {{__('Save')}} </button>
							</div>
					</div>
					
					</form>
					
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
