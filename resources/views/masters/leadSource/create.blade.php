@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add lead source
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('lead_sources')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
			
                <h2>{{__('Lead Source')}}</h2>
                <div class="widget-content pt-3"> 	
	
				@if(isset($LeadSources))
					{!! Form::model($LeadSources, ['method' => 'POST', 'class' => 'form-common', 'route' => ['lead_sources.store']]) !!}
				@else
					{!! Form::open(array('route' => 'lead_sources.store', 'class' => 'form-common', 'method'=>'POST')) !!}
				@endif
				
				@php
				if(isset($LeadSources)){
				$src_key = $LeadSources->source_key;}else{
				$src_key = Helpers::unique_random('ori_mast_lead_sources','source_key','16');}
				@endphp
				
				
				{{ csrf_field() }}
				<div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
					
				
				<div class="col-md-6 form-group">
				{{ Form::label('src_name', 'Lead Source Name') }}
						{{ Form::text('name', null, array('class' => 'form-control','id' => 'name')) }}	
				<span class="error" id ="name_err"></span>							
				</div>
				
				
				<div class="col-md-6 form-group">	
				{{ Form::label('src_key', 'Source key') }}
						<input type="text" name="source_key" value="@if(isset($src_key)){{$src_key}}@endif" id="source_key" readonly class="form-control">
				<span class="error" id ="source_key_err"></span>							
				</div>
				
				
				<div class="form-group col-md-6">
				{{ Form::label('src_type', 'Lead Source Type') }}
					<select name="source_type" id="source_type" class="form-control" required="true" @if($flag==1) {{'readonly'}} @endif>
						 @foreach ($lead_source_types as $key => $value)  
						 	@if($flag==1)         
							<option @if(isset($selected_lead_src_type) && $key == $selected_lead_src_type){{'selected'}} @endif value="{{$key}}">{{$value}}</option>
							@else
							<option @if(isset($LeadSources) && $key == $LeadSources->lead_source_type_id) {{'selected'}} @endif value="{{$key}}">{{$value}}</option>
							@endif
						@endforeach 
					</select> 
					<span class="error" id ="source_type_err"></span>
				</div>
				
		
				
				<div class="col-sm-12 form-group">	
				<label for="status" class="">{{__('Status')}}</label>				
						{{ Form::select('status', array(config('constant.ACTIVE')=> 'Active', config('constant.INACTIVE')=>'Inactive'), null, ['id' => 'status', 'class' => 'form-control']) }}		
					<span class="error" id ="status_err"></span>
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