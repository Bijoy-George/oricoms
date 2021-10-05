@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - {{Auth::user()->getCompany->ori_cmp_org_name}} - Add customer nature
@endsection
@section('header-custom-css-js')
<link href="{{ asset('css/multiselect/main.css') }}" rel="stylesheet">
<script src="{{ asset('js/multiselect/picker.js') }}"></script>
@endsection
@section('content')

<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-sm-7 text-right"><a href="{{url('tracker_list')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
    <div class="col-sm-7 mt-3">
      <div class="widget">
        <h2>{{__('Task')}}</h2>
        <div class="widget-content pt-3">  

	
				@if(isset($tracker_data))
					{!! Form::model($tracker_data, ['method' => 'POST', 'class' => 'form-common', 'route' => ['tracker.store']]) !!}
				@else
					{!! Form::open(array('route' => 'tracker.store', 'class' => 'form-common', 'method'=>'POST')) !!}
				@endif
				
				{{ csrf_field() }}
				<div class="row m-0 align-items-center">
            <div class="col-md-12"> <span class="response"></span>
              <div class="message"></div>
            </div>
			<input type="hidden" name="pageno" id="pageno" value="1">
			<input type="hidden" name="callback" class="callback" value="form_basic_reload" />
			<input type="hidden" class="callback-path" value="/tracker">
			<!--<input type="hidden" name="from_create" id="from_create" value="1">-->
						<input type="hidden" id="task_id" name="task_id" value="@if(isset($tracker_data)){{$tracker_data->task_id}}@else{{$task_id}}@endif">
						
						<div class="col-md-12 form-group" style="text-align:right;">
						<b>{{Helpers::get_tasktime_left($task_id) }}</b>
						</div>
						<div class="col-md-12 form-group">
						<strong style="color: #00adef;">Task : 
						@if(isset($tracker_data))
						{{Helpers::get_task_details($tracker_data->task_id)->title}}
						@else
						{{Helpers::get_task_details($task_id)->title}}
						@endif
						</strong>
						</div>
						
						<div class="col-md-12 form-group">
						{{ Form::label('description', 'Comments')}}
						{{ Form::textarea('description', null, array('id' => 'description', 'class' => 'tinymce form-control' )) }} 						
						<span id ="description_err" class="error"></span>							
						</div>
						
						<div class="col-md-12 form-group table-widget">
						<table class="table" id="table_row">
						<?php  if(count($tracker_array)>0){ ?> 
						<thead>
						<tr><td colspan="6" style="text-align:center;color:#dfdfd;"><b>Your History On Task</b></td></tr>
						
						
						<tr><th>#</th><th>From</th><th>To</th><th>Hours</th><th>Description</th><th>Action</th></tr>
						</thead>
						<tbody>
						@php $i = 1; @endphp
						@foreach($tracker_array as $t_array)
						<?php  
							$t1 = \Carbon\Carbon::parse($t_array->from_time);
							$t2 = \Carbon\Carbon::parse($t_array->to_time);
							$diff = $t1->diffInMinutes($t2);  
							$diff = $diff/60;  
						?>
						<tr>
						<td>{{$i}}</td>
						<td>{{date('d/m/Y H:i', strtotime($t_array->from_time))}}</td>
						<td>{{date('d/m/Y H:i', strtotime($t_array->to_time))}}</td>
						<td>{{$diff}}</td>
						<td>{!!$t_array->description!!}</td>
						<td>
						<a class="dropdown-item" href="javascript:void(0)" title="Delete"onclick="deletePop('tracker/' + {{ $t_array->id }},'','/tracker','1')" style="color:f40029;">X</a></td>
						</tr>
						@php $i++ @endphp
						@endforeach
						</tbody>
						<?php } ?>
						</table>
						</div>
						
						<div class="col-md-6 form-group">
						{{ Form::label('from_time', 'From')}}
						{{ Form::text('from_time', null, array('id' => 'from_time','class' => 'datetimepicker form-control','placeholder' => 'From time','autocomplete' => 'off')) }}
						<span id ="from_time_err" class="error"></span>							
						</div>
						
						<div class="col-md-6 form-group">
						{{ Form::label('to_time', 'To')}}
						{{ Form::text('to_time', null, array('id' => 'to_time','class' => 'datetimepicker form-control','placeholder' => 'To time','autocomplete' => 'off')) }}
						<span id ="to_time_err" class="error"></span>							
						</div>
						
									
						
						<div class="col-md-6 form-group">
						<label for="status" class="control-label mb-1">{{__('Status')}}</label>
						{{ Form::select('status', [null=>'Select Task Status'] +$status_arr, null, ['id' => 'status', 'class' => 'form-control']) }}		
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
@section('footer-custom-css-js') 
<script src="{{ asset('js/tiny_mce/tiny_mce.js') }}"></script> 
<script src="{{ asset('js/tinymce.js') }}"></script> 
<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
<script src="{{ asset('js/translation.js') }}"></script>
@endsection