@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add customer nature
@endsection
@section('content')

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('pm_master')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('PM Master Data')}}</h2>
        <div class="widget-content pt-3">  

	
				@if(isset($pm_master))
					{!! Form::model($pm_master, ['method' => 'POST', 'class' => 'form-common', 'route' => ['pm_master.store']]) !!}
				@else
					{!! Form::open(array('route' => 'pm_master.store', 'class' => 'form-common', 'method'=>'POST')) !!}
				@endif
				
				{{ csrf_field() }}
				<div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
			
						<div class="col-md-6 form-group">	
						<label for="type" class="control-label mb-1">{{__('Type')}}</label>
						{{ Form::select('type', [null=>'Please Select'] + config('constant.pm_master_types'), null, ['id' => 'type', 'class' => 'form-control']) }}
						<span id ="type_err" class="error"></span>							
						</div> 
						
						
				
						<div class="col-md-6 form-group">
						{{ Form::label('name', 'Name')}} 						
						{{ Form::text('name', null, array('class' => 'form-control','id' => 'name', 'required' => true)) }}	
						<span id ="name_err" class="error"></span>							
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
