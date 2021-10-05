@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} -Package Permission
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('packages')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
			
                <h2>{{__('Package Permission Management')}}</h2>
                <div class="widget-content pt-3"> 	
	
				@if(isset($package))
					{!! Form::model($package, ['method' => 'POST', 'class' => 'form-common', 'route' => ['packages.store']]) !!}
				@else
					{!! Form::open(array('route' => 'packages.store', 'class' => 'form-common', 'method'=>'POST')) !!}
				@endif
				
				{{ csrf_field() }}
				{{ Form::hidden('id', null, array('class' => 'form-control','id' => 'id' )) }}
				<div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
					
				
				<div class="col-md-6 form-group">
				{{ Form::label('package_name', 'Package Name') }}
						{{ Form::text('package_name', null, array('class' => 'form-control','id' => 'package_name')) }}	
				<span class="error" id ="package_name_err"></span>							
				</div>
				
				<div class="col-md-6 form-group">
				{{ Form::label('package_type', 'Plan Type') }}
						{{ Form::select('package_type', $plans, null, array('class' => 'form-control','id' => 'package_type', 'required' => true)) }}
				<span class="error" id ="package_type_err"></span>							
				</div>
				
				<div class="col-md-12 mb-3"></div>
				@isset($package->permission_under_package)
                    @php
                        $access_permission = unserialize($package->permission_under_package);
                        foreach ($access_permission as $row)
                        {
                                $access_permission_id[]=$row['permission_id'];
                        }
                    @endphp
                @endisset
				<?php $i=0; ?>
				@foreach($permission as $data)
                    <div class="col-md-4 mb-2">
                        <input type="checkbox" name="check_list[]" class="check_list custom-checkbox" id="check_list-<?php echo $i; ?>" value="{{ $data->name.'-'.$data->id }}" 
                           <?php if(!empty($access_permission_id) && in_array($data->id,$access_permission_id)){ echo 'checked="checked"';} ?>> &nbsp; <label for="check_list-<?php echo $i; ?>" class="custom-checkbox-label text-capitalize">{{ $data->name }}</label>
                    </div>
				<?php $i++; ?>	
                 @endforeach							
				
				
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