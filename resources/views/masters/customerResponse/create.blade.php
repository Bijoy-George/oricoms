@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - New Customer Response
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('customer_response')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Add Customer Response')}}</h2>
        <div class="widget-content pt-3"> 
           @if(isset($cust_response))
                    {!! Form::model($cust_response, ['method' => 'POST', 'class' => 'form-common', 'route' => ['customer_response.store']]) !!}
            @else
                    {!! Form::open(array('route' => 'customer_response.store', 'class' => 'form-common', 'method'=>'POST')) !!}
            @endif
          {{ csrf_field() }}
         <div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>

<div class="col-sm-6 form-group">
                    <label for="customer_response" class="control-label mb-1">{{__('Customer Response')}}</label>
                                {{ Form::text('customer_response', null, array('class' => 'form-control','id' => 'customer_response', 'required' => true)) }}	
                                <span id ="customer_response_err" class="error"></span>							
                </div>
                <div class="col-sm-6 form-group">		
                    <label for="parent_id" class="control-label mb-1">{{__('Parent Customer Response ')}}</label>
                                {{ Form::select('parent_id', $parent_responses, null, ['id' => 'parent_id', 'class' => 'parent_id form-control']) }}
                                <span id ="parent_id_err"></span>								
                </div>
                <div class="col-sm-6 form-group">	
                    <label for="sort_order" class="control-label mb-1">{{__('Sort Order')}}</label>
                        @if(isset($res)) 	
                                 {{ Form::number('sort_order', null, array('class' => 'form-control' ,'id' => 'sort_order','max' =>'99','min'=>'0')) }}
                        @else
                                {{ Form::number('sort_order', 0, array('class' => 'form-control' ,'id' => 'sort_order','max' =>'99','min'=>'0')) }}	
                        @endif		
                        <span id ="sort_order_err"></span>					
                </div>


                <div class="col-sm-6 form-group">
                    <label for="status" class="control-label mb-1">{{__('Status')}}</label>
                    {{ Form::select('status', array(config('constant.ACTIVE')=> 'Active', config('constant.INACTIVE')=>'Inactive'), null, ['id' => 'status', 'class' => 'form-control']) }}	
                    <span class="error" id ="status_err"></span>
                </div>
				
				<div class="col-sm-6 form-group">
                    <label for="is_other" class="control-label mb-1">{{__('Other Category')}}</label>
                    {{ Form::select('is_other', array(0=> 'Select Option', config('constant.ACTIVE')=>'Set as other category'), null, ['id' => 'is_other', 'class' => 'form-control']) }}	
                    <span class="error" id ="is_other_err"></span>
                </div>
				
        {{ Form::hidden('id', null, array('class' => 'form-control' )) }}
        <div class="col-md-12 form-group text-right">
            <button type="reset" class="btn btn-outline-danger px-4" > {{__('Reset')}} </button>
            <button type="submit" class="btn btn-primary px-4"> {{__('Save')}} </button>
        </div>
        </div>
    </div>
  </div>
</div>
@endsection