@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - New Supply Offices
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('supply_offices')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Add Supply Office')}}</h2>
        <div class="widget-content pt-3"> 
           @if(isset($res))
                    {!! Form::model($res, ['method' => 'POST', 'class' => 'form-common', 'route' => ['supply_offices.store']]) !!}
            @else
                    {!! Form::open(array('route' => 'supply_offices.store', 'class' => 'form-common', 'method'=>'POST')) !!}
            @endif
          {{ csrf_field() }}
         <div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
                <div class="col-sm-6">
                    <?php
//dd($array[0]->category_name);
/*$options = get_options($array);
  echo "<select class='form-control'>";
  foreach($options as $val) {
    echo "<option>".$val."</option>";
  }
  echo "</select>";

  function get_options($array, $parent="", $indent="") {
    $return = array();
    foreach($array as $key => $val) {
      if($val->parent_category == $parent) {
        $return[] = $indent.$val->supply_office;
        $return = array_merge($return, get_options($array, $val->supply_office, $indent."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"));
      }
    }
    return $return;
  }*/?>
                </div>
            </div>



            <div class="row m-0 align-items-center">

                <div class="col-sm-6 form-group">
                    <label for="supply_offices" class="control-label mb-1">{{__('Category Name')}}</label>
                                {{ Form::text('supply_office', null, array('class' => 'form-control','id' => 'supply_offices', 'required' => true)) }}	
                                <span id ="supply_offices_err" class="error"></span>							
                </div>
                
                
                <div class="col-sm-6 form-group">		
                    <label for="parent_id" class="control-label mb-1">{{__('Parent Office ')}}</label>
                                {{ Form::select('parent_id', $categories, null, ['id' => 'parent_id', 'class' => 'parent_id form-control']) }}
                                <span id ="parent_id_err"></span>								
                </div>

                 <div class="col-sm-6 form-group">
                    <label for="email" class="control-label mb-1">{{__('Email')}}</label>
                                {{ Form::text('email', null, array('class' => 'form-control','id' => 'email')) }}  
                                <span id ="email_err" class="error"></span>                            
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