@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add lead source
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('lead_source_type')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">

                <h2>{{__('Lead Source Type')}}</h2>
                <div class="widget-content pt-3"> 
	
				@if(isset($LeadSources))
					{!! Form::model($LeadSources, ['method' => 'POST', 'class' => 'form-common', 'route' => ['lead_source_type.store']]) !!}
				@else
					{!! Form::open(array('route' => 'lead_source_type.store', 'class' => 'form-common', 'method'=>'POST')) !!}
				@endif
				
				{{ csrf_field() }}
				<div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
				
				
				<div class="col-md-6 form-group">	
				{{ Form::label('name', 'Lead Source Type Name') }}				
						{{ Form::text('source_type', null, array('class' => 'form-control','id' => 'source_type','required' => true)) }}	
				<span class="error" id ="source_type_err"></span>							
				</div>
				
				
				<div class="col-md-6 form-group">	
				<label for="status" class="control-label mb-1">{{__('Status')}}</label>
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