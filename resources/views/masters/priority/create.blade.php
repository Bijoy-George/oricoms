@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add Priority
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('priority')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">

                <h2>{{__('Priority')}}</h2>
				<div class="widget-content pt-3"> 
              	
	
				@if(isset($res))
					{!! Form::model($res, ['method' => 'POST', 'class' => 'form-common', 'route' => ['priority.store']]) !!}
				@else
					{!! Form::open(array('route' => 'priority.store', 'class' => 'form-common', 'method'=>'POST')) !!}
				@endif
				
				{{ csrf_field() }}
				<div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
					
					
					<div class="col-md-6 form-group">
					<label for="priority" class="control-label mb-1">{{__('Priority')}}</label>
						 {{ Form::text('name', null, array('class' => 'form-control','id' => 'name','required' => true)) }}	
					<span id ="name_err" class="error"></span>
					</div>
						
					<div class="col-md-6 form-group">	
					<label for="sort_order" class="control-label mb-1">{{__('Sort Order')}}</label>
					@if(isset($res)) 	
						 {{ Form::number('sort_order', null, array('class' => 'form-control' ,'id' => 'sort_order','max' =>'99','min'=>'0')) }}
					@else
						{{ Form::number('sort_order', 0, array('class' => 'form-control' ,'id' => 'sort_order','max' =>'99','min'=>'0')) }}	
					@endif	
					<span id ="sort_order_err"></span>						
					</div>
					
					
					<div class="col-md-6 form-group">	
					<label for="status" class="control-label mb-1">{{__('Status')}}</label>					
						{{ Form::select('status', array('1'=> 'Active', '2'=>'Inactive'), null, ['id' => 'status', 'class' => 'form-control']) }}	
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
