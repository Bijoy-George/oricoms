@extends('layouts.campaign')

@section('tab-content')
<div class="content-area ">
	  <header class="row align-items-center mb-2">
    <div class="col-sm-5 text-sm-left mb-3 mb-sm-0">
            <h2 class="m-0">{{__('Groups')}}</h2>
      		<small><a href="{{ url('/groups') }}">Groups</a> / @if (isset($campaign)) Edit Campaign @else Add Group @endif</small>
                </div>
		   <div class="col-sm-7 text-sm-right">
		      <a title="Go Back" href="javascript:history.go(-1)" class="btn btn-outline-info ml-1"><i class="fas fa-chevron-left"></i></a>
		    </div>
</header>

    <div class="widget">
  <div class="widget-heading">
    <div class="row">
      <div class="col-12 col-md-6">
        <h2> {{__('Create Group')}} </h2>
      </div>
    </div>
  </div>
  <div class="table-widget table-responsive mt-0 pt-0 p-3">
  	<div class="row justify-content-center">
            <div class="col-md-4">{!! Form::open(array('route' => 'groups.store', 'class' => 'form-common', 'method'=>'POST')) !!}
			<div class="message"></div>
			<div class="form-group">
				{{ Form::label('group_name', __('Group Name')) }}
				{{ Form::text('name', null, array('class' => 'form-control')) }}
				<span class="error" id ="name_err"></span>
			</div>
			<div class="form-group">
				{{ Form::submit(__('Submit'), array('class' => 'form-control btn btn-primary')) }}
			</div>
			{!! Form::close() !!}</div>
          </div>
  </div>
</div>

</div>
@endsection