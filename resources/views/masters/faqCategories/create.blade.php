@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - New Categories
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('faq_categories')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Add Category')}}</h2>
        <div class="widget-content pt-3"> 
           @if(isset($res))
                    {!! Form::model($res, ['method' => 'POST', 'class' => 'form-common', 'route' => ['faq_categories.store']]) !!}
            @else
                    {!! Form::open(array('route' => 'faq_categories.store', 'class' => 'form-common', 'method'=>'POST')) !!}
            @endif
          {{ csrf_field() }}
         <div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>



               <?php
 /* <div class="col-sm-6 form-group">

<label for="category_name" class="control-label mb-1">{{__('Category')}}</label>
<?php
//dd($array[0]->category_name);
$options = get_options($array);
  echo "<select class='form-control'>";
  foreach($options as $val) {
    echo "<option>".$val."</option>";
  }
  echo "</select>";

  function get_options($array, $parent="", $indent="") {
    $return = array();
    foreach($array as $key => $val) {
      if($val->parent_category == $parent) {
        $return[] = $indent.$val->category_name;
        $return = array_merge($return, get_options($array, $val->category_name, $indent."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"));
      }
    }
    return $return;
  } ?>

</div>
 */
?>















<div class="col-sm-6 form-group">
                    <label for="category_name" class="control-label mb-1">{{__('Category Name')}}</label>
                                {{ Form::text('category_name', null, array('class' => 'form-control','id' => 'category_name', 'required' => true)) }}	
                                <span id ="category_name_err" class="error"></span>							
                </div>
                <div class="col-sm-6 form-group">
                    <label for="slug" class="control-label mb-1">{{__('Slug')}}</label>
                                {{ Form::text('slug', null, array('class' => 'form-control','id' => 'slug')) }}   
                                <span id ="slug_err" class="error"></span>                         
                </div>
                <div class="col-sm-6 form-group">
                    <label for="short_code" class="control-label mb-1">{{__('Short Code')}}</label>
                                {{ Form::text('short_code', null, array('class' => 'form-control','id' => 'short_code')) }}   
                                <span id ="short_code_err" class="error"></span>                         
                </div>
                <div class="col-sm-6 form-group">
                    <label for="query_type_id" class="control-label mb-1">{{__('Query Type')}}</label>
                        <select name="query_type_id[]" id="query_type_id" class="form-control" multiple="multiple" required="true">

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
                <span class="error" id="query_type_id_err" class="error"></span>
                </div>
                <div class="col-sm-6 form-group">		
                    <label for="parent_category_id" class="control-label mb-1">{{__('Parent Category ')}}</label>
                                {{ Form::select('parent_category_id', $categories, null, ['id' => 'parent_category_id', 'class' => 'parent_category_id form-control']) }}
                                <span id ="parent_category_id_err"></span>								
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