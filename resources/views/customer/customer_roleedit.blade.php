 @extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - Role Permission
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="text-right"><a href="{{url('roles')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
      <div class="widget mt-3">
        <h2 class="m-0">{{__('Role Permission')}}</h2>
        <div class="widget-content pt-3">

          @if(isset($usr))
          {!! Form::model($usr, ['method' => 'POST', 'class' => 'form-common', 'url' => ['customerRoleStore']]) !!} 
          @endif
          {{ csrf_field() }}
          
          <div class="row m-0">
          <div class="col-md-12"><div class="response"></div><div class="message"></div></div>
           {{ Form::hidden('customer_id', $usr->id, array('class' => 'form-control','id' => 'customer_id' )) }}
            <div class="row m-0 align-items-center ">
            <label for="name" class="col-sm-2 control-label text-right m-0">{{__('User Name')}}</label>
                <div class="col-sm-6">
					{{ Form::text('name', null, array('class' => 'form-control','id' => 'name' )) }} <span id="role_err"></span> 
			    </div>
              @if(isset($usr->access_permission) && !empty($usr->access_permission))
              <?php
                        $access_permission = unserialize($usr->access_permission);
                        foreach ($access_permission as $row)
                        {
                                $access_permission_id[]=$row['permission_id'];
                        }
                    ?>
              @endif
              <div class="col-md-12 mb-3"></div>
              <?php $i=0; ?>
              @foreach($permission as $data)
              <div class="col-md-3 mb-2">
                <input type="checkbox" name="check_list[]" class="check_list custom-checkbox" id="check_list-<?php echo $i; ?>" value="{{ $data['name'].'-'.$data['id'] }}" 
                           <?php if(!empty($access_permission_id) && in_array($data['id'],$access_permission_id)){ echo 'checked="checked"';} ?>>
                <label for="check_list-<?php echo $i; ?>" class="custom-checkbox-label">{{ $data['name'] }}</label>
              </div>
              <?php $i++; ?>
              @endforeach </div>
          
          {{ Form::hidden('id', null, array('class' => 'form-control' )) }} 
          
          <!-- <input id="id" type="hidden" class="form-control" name="id" value="@if(!empty($id)){{ $id }} @endif">-->
          <div class="col-md-12 text-right py-3">
              <button type="reset" class="btn btn-outline-danger" > {{__('Reset')}} </button>
              <button type="submit" class="btn btn-primary"> {{__('Save')}} </button>
          </div>
          </div>
        {!! Form::close() !!} </div>
      </div>
    </div>
  </div>
</div>
@endsection 