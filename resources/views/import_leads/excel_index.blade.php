@extends('layouts.app')

@section('content')
	<div class="col-md-12 widget">
		

		<br>

		<div class="col-sm-10">
			<div class="widget">
				<h2>{{ __('Group Excel Import') }}</h2>
				<div>
					@if ($message = Session::get('success'))
        				<div class="alert alert-success" role="alert"> {{ Session::get('success') }} </div>
    				@endif
				</div>

				<h5>{{ __('Import excel(xls or xlsx) file into database against group') }} {{ $group->name }}</h5>

				@if (!empty(session('error')))
    		  <div class="alert alert-danger alert-dismissible">
    			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    			 {{ session('error') }}
      		</div>
    		@endif

    		{!! Form::open(array('url' => '/leadlist/map_excel_fields', 'method'=>'POST', 'name' => 'form-upload', 'files' => true)) !!}
    			<div class="row">
    				<div class="form-group col-md-6">
    					{{ Form::label('source_type', __('Lead Source Type')) }}
    					{{ Form::select('source_type', $lead_source_types, '', ['id' => 'source_type', 'class' => 'form-control', 'onchange' => 'leadSourceDropDownList(this.value)']) }}
              @if ($errors->has('source_type'))
                <span class="error" id ="source_type_err">{{ $errors->first('source_type') }}</span>
              @endif
    				</div>

    				<div class="form-group col-md-6">
    					{{ Form::label('lead_source', __('Lead Source')) }}
    					{{ Form::select('lead_source', ['' => 'Select Lead Source'], '', ['id' => 'lead_source', 'class' => 'form-control']) }}
              @if ($errors->has('lead_source'))
                <span class="error" id ="lead_source_err">{{ $errors->first('lead_source') }}</span>
              @endif
    				</div>

    				<div class="form-group col-md-8">
    					{{ Form::label('comments', __('Comments')) }}
    					{{ Form::textarea('comments', '', ['id' => 'comments', 'class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
              @if ($errors->has('comments'))
                <span class="error" id ="comments_err">{{ $errors->first('comments') }}</span>
              @endif
    				</div>

    				<div class="form-group col-md-6">
    					<a href="/Import_Leads_sample.xls" class="form-control">
    						<i class="material-icons">cloud_download</i>
    						<span>{{ __('Download Sample File') }}</span>
    					</a>
    				</div>

    				<div class="form-group col-md-12">
    					{{ Form::label('file', __('Excel File')) }}
    					{{ Form::file('file', ['id' => 'file', 'class' => 'form-control']) }}
              @if ($errors->has('file'))
                <span class="error" id ="file_err">{{ $errors->first('file') }}</span>
              @endif
    				</div>

    				<div class="form-group col-md-12 text-right">
    					<button class="btn btn-primary">Import</button>
    				</div>
    			</div>
    		{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection

@section('footer-custom-css-js')
	<script src="{{ asset('js/groups/group.js') }}"></script>
@endsection