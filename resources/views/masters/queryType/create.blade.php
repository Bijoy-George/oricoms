@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add Querytype
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('query_type')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Add Querytype')}}</h2>
        <div class="widget-content pt-3">
            @if(isset($query_type))
                    {!! Form::model($query_type, ['method' => 'POST', 'class' => 'form-common', 'route' => ['query_type.store']]) !!}
            @else
                    {!! Form::open(array('route' => 'query_type.store', 'class' => 'form-common', 'method'=>'POST')) !!}
            @endif
          {{ csrf_field() }}
          <div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
            <div class="col-sm-6 form-group">
              <label for="query_type" class="control-label mb-1">{{__('QueryType')}}</label>
              {{ Form::text('query_type', null, array('class' => 'form-control','id' => 'query_type','required' =>'true')) }}
              <span class="error" id ="query_type_err"></span>
            </div>
            <div class="col-sm-6 form-group">
            <label for="type" class="control-label mb-1">{{__('Type')}}</label>
              {{ Form::select('type', array('0'=>'Select type',config('constant.TICKET')=> 'Ticket', config('constant.FOLLOWUPS')=>'Follow up'), null, ['id' => 'type', 'class' => 'form-control']) }}
              <span class="error" id="type_err"></span> 
            </div>
			<div class="col-sm-6 form-group">
              <label for="query_type" class="control-label mb-1">{{__('Short Code')}}</label>
              {{ Form::text('short_code', null, array('class' => 'form-control','id' => 'short_code')) }}	
						<span class="error" id ="short_code_err"></span>
            </div>
			<div class="col-sm-6 form-group">
              <label for="query_type" class="control-label mb-1">{{__('Slug')}}</label>
              {{ Form::text('slug', null, array('class' => 'form-control','id' => 'slug','readonly'=>'true')) }}	
						<span class="error" id ="slug_err"></span>	
            </div>
			<!--{{--<div class="col-sm-6 form-group">
              
              @if(isset($designations))
				<label for="query_type" class="control-label mb-1">{{__('Department Designations')}}</label>
				<div class="col-md-8 form-groups">
					<select name="designations[]" id="designations" class="form-control select" multiple="multiple" @if(count($designations)>6) size="6" @else size="{{$size=count($designations)+1}}" @endif>
						<option value="">Select</option>
						@foreach ($designations as $key => $value)
							@php $sel=''; @endphp
							@if(isset($dpt_desig_relation))
							@foreach($dpt_desig_relation as $type_key => $val)
								@if($key == $val) 
									@php $sel='selected'; @endphp 
								@endif 
							@endforeach
							@endif 
							<option  value="{{$key}}" @if($sel != ''){{'selected'}} @endif>{{$value}}</option>
						@endforeach 
					</select>
				<span class="error" id="cmplaint_nature_err" class="error"></span>
				</div>
				@endif
            </div> --}}-->
            <div class="col-md-6 form-group">	
                <label for="sort_order" class="control-label mb-1">{{__('Sort Order')}}</label>
                    @if(isset($query_type)) 	
                    {{ Form::number('sort_order', null, array('class' => 'form-control' ,'id' => 'sort_order','max' =>'99','min' =>'0')) }}
                    @else
                    {{ Form::number('sort_order', 0, array('class' => 'form-control' ,'id' => 'sort_order','max' =>'99','min' =>'0')) }}	
                    @endif	
                <span class="error" id ="sort_order_err"></span>						
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
		<!--{{--<div class="row">
					<div class="col-md-6">
					
					
					{!! Form::open(array('route' => 'designations.store', 'class' => 'form-common', 'method'=>'POST','name'=>'nw_desgntn_frm','id'=>'nw_desgntn_frm')) !!}
					
					<input type="hidden" name="_token"  value="{{ csrf_token() }}">
					<div class="message"></div>
					<div class="row">
					<div class="row m-0 align-items-center">
					<div class="col-md-6 form-group">
					
						<input type="text" name="designation" id="designation" class="designation form-control" placeholder="Add Designation">
							<span class="error" id ="designation_err"></span></div>
							<div class="col-md-6 form-group">
							<button type="submit" class="btn btn-primary px-4"> {{__('Submit')}} </button>
							<!--<button type="submit" class="btn btn-primary">
                                    {{__('Submit')}}
                            </button>-->
						</div>
					</div>
					{!! Form::close() !!}	
					</div>
					</div>
					
            </div>--}}-->
        </div>
        </div>
    </div>
  </div>
</div>
@endsection