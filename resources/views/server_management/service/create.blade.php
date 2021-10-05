@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add customer nature
@endsection
@section('content')

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('services')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Service Data')}}</h2>
        <div class="widget-content pt-3">  

  
        @if(isset($service))
          {!! Form::model($service, ['method' => 'POST', 'class' => 'form-common', 'route' => ['services.store']]) !!}
        @else
          {!! Form::open(array('route' => 'services.store', 'class' => 'form-common', 'method'=>'POST')) !!}
        @endif
        
        {{ csrf_field() }}
        <div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
            
            
        
            <div class="col-md-6 form-group">
            {{ Form::label('name', 'Name')}}            
            {{ Form::text('service_name', null, array('class' => 'form-control','id' => 'service_name', 'required' => true)) }} 
            <span id ="service_name_err" class="error"></span>              
            </div>

            <div class="col-md-6 form-group">
            <label for="status" class="control-label mb-1">{{__('Status')}}</label>
            {{ Form::select('status', array(config('constant.ACTIVE')=> 'Active', config('constant.INACTIVE')=>'Inactive'), null, ['id' => 'status', 'class' => 'form-control']) }}   
            <span id ="status_err"></span>
            </div>

            <div class="col-md-12 form-group">
            {{ Form::label('description', 'Description')}}
            {{ Form::textarea('description', null, array('id' => 'description', 'class' => 'lang_trans tinymce form-control' )) }}            
            <span id ="description_err" class="error"></span>             
            </div>

          <?php $flag_data = config('constant.service_flag');?>
          @foreach($flag_data as $key => $data)
          
            <div class="col-md-3 mb-2">
              <input type="checkbox" name="check_list" class="check_list custom-checkbox" id="check_list{{ $key }}" value="{{ $key }}" 
      <?php if(!empty($service->service_flag) && (($service->service_flag)==$key)){ echo 'checked="checked"';} ?> > &nbsp;   
            <label for="check_list{{ $key }}" class="custom-checkbox-label">{{ $data }}</label>
              </div>
            @endforeach
          
<script type="text/javascript">
  $("input:checkbox").on('click', function() {

  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
</script>



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
</div>
@endsection
