@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add Auto Reply
@endsection
@section('content')

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('chat_auto_reply')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Add Auto Reply')}}</h2>
        <div class="widget-content pt-3">  

	
				@if(isset($res))
						{!! Form::model($res, ['method' => 'POST', 'class' => 'form-common', 'route' => ['chat_auto_reply.store']]) !!}
					@else
						{!! Form::open(array('route' => 'chat_auto_reply.store', 'class' => 'form-common', 'method'=>'POST')) !!}
				@endif
				
				{{ csrf_field() }}
				<div class="row m-0 align-items-center">
				<div class="col-md-12"> <span class="response"></span>
				<div class="message"></div>
				</div>
				
						<div class="col-md-6 form-group">
						{{ Form::label('Reply', 'Reply')}} 						
						{{ Form::text('reply', null, array('class' => 'form-control','id' => 'reply', 'required' => true)) }}	
						<span id ="reply_err" class="error"></span>							
						</div>
						
						
						<div class="col-md-6 form-group">
						<label for="auto_reply_category" class="control-label mb-1">{{__('Auto reply category')}}</label>
						<select name="auto_reply_category_id" id="auto_reply_category_id" class="form-control">
									@foreach ($auto_reply_category as $key => $value)
										@php $sel=''; @endphp
										@php 
											if(isset($res) && !empty($res))
											{
												$auto_reply_category_id = $res->auto_reply_category_id;
											}
											else
											{
												$auto_reply_category_id = 0;
											}
										@endphp

										@php
										if(($value->id) == $auto_reply_category_id)
										{
											$sel='selected';
										}
										@endphp 
										<option value="{{$value->id}}" @if($sel != ''){{'selected'}} @endif >{{$value->name}}</option>
									@endforeach
								</select>						
						</div>
					
						
						<div class="col-md-6 form-group">
						<label for="status" class="control-label mb-1">{{__('Status')}}</label>
						{{ Form::select('status', array(config('constant.ACTIVE')=> 'Active', config('constant.INACTIVE')=>'Inactive'), null, ['id' => 'status', 'class' => 'form-control']) }}		
						<span id ="status_err"></span>
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
