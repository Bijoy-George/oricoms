@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add Status
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('query_status')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Query Status')}}</h2>
        <div class="widget-content pt-3"> 
            @if(isset($query_status))
                    {!! Form::model($query_status, ['method' => 'POST', 'class' => 'form-common', 'route' => ['query_status.store']]) !!}
            @else
                    {!! Form::open(array('route' => 'query_status.store', 'class' => 'form-common', 'method'=>'POST')) !!}
            @endif
          {{ csrf_field() }}
          <div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
            <div class="col-md-6 form-group">
                <label for="name" class="control-label mb-1">{{__('Name')}}</label>
                {{ Form::text('name', null, array('class' => 'form-control','id' => 'name')) }}	
                <span class="error" id ="name_err"></span>	
                <label for="color" class="control-label mb-1">{{__('Colour')}}</label>
                {{ Form::text('color', null, array('class' => 'jscolor form-control','id' => 'color')) }}	
                <span class="error" id ="color_err"></span>
            </div>
            <div class="col-md-6 form-group">
                <label for="query_type_id" class="control-label mb-1">{{__('Query Type')}}</label>
                    <select name="query_type_id[]" id="query_type_id" class="form-control" multiple="multiple" size="5">
                            @foreach ($query_types as $key => $value)
                                    @php $sel=''; @endphp
                                    @if(isset($type_relation))
                                    @foreach($type_relation as $type_key => $val)
                                            @if($key == $val) 
                                                    @php $sel='selected'; @endphp 
                                            @endif 
                                    @endforeach
                                    @endif 
                                    <option  value="{{$key}}" @if($sel != ''){{'selected'}} @endif>{{$value}}</option>
                            @endforeach 
                    </select>
            <span class="error" id="query_type_id_err"></span>
            </div>
            <div class="col-md-6 form-group">
                <label for="sort_order" class="control-label mb-1">{{__('Sort Order')}}</label>
                @if(isset($query_status)) 	
                                {{ Form::number('sort_order', null, array('class' => 'form-control' ,'id' => 'sort_order','max' =>'99','min'=>'0')) }}
                @else
                                {{ Form::number('sort_order', 0, array('class' => 'form-control' ,'id' => 'sort_order','max' =>'99','min'=>'0')) }}	
                @endif	
                <span class="error" id ="sort_order_err"></span>						
            </div>
            <div class="col-md-6 form-group">	
                <label for="status" class="control-label mb-1">{{__('Status')}}</label>
                            {{ Form::select('status', array(config('constant.ACTIVE')=> 'Active', config('constant.INACTIVE')=>'Inactive'), null, ['id' => 'status', 'class' => 'form-control']) }}	
                    <span class="error" id ="status_err"></span>
            </div>
            <div class="col-md-6 mb-2">
                <input type="checkbox" name="is_close" class="check_list custom-checkbox" id="is_close" @if(isset($query_status->is_close) AND $query_status->is_close == 1) checked="true" @endif>
                <label for="is_close" class="custom-checkbox-label text-capitalize">{{__('is_close')}}</label>
                 <span class="error" id ="is_close_err"></span>
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