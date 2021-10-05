@extends('layouts.app')



@section('content')
	<div>
		
		<h5>Map Excel Fields</h5>
		<div>
			{!! Form::open(array('url' => '/groups/' . $group->id . '/start_excel_import', 'method'=>'POST', 'class' => 'form-common', 'name' => 'form-common')) !!}
			<div class="message"></div>
			<div class="row">
				{{ Form::hidden('file_name', $filename) }}
				{{ Form::hidden('lead_source', $lead_source) }}
				{{ Form::hidden('comment', $comment) }}]) }}
				@foreach ($excel_headings as $heading)
					<div class="form-group col-md-6"> 
						{{ Form::label($heading, ucwords(str_replace('_', ' ', $heading))) }}
						{{ Form::select($heading, ['' => 'Select Corresponding Customer Field'], '', ['id' => $heading, 'class' => 'form-control headings']) }}
					</div>
				@endforeach
			</div>
			<div class="form-group form-check">
				{{ Form::checkbox('skip_existing_contacts', '1', false, ['class' => 'form-check-input']) }}
				{{ Form::label('skip_existing_contacts', 'Skip already existing contacts', ['class' => 'form-check-label']) }}
			</div>
			<div class="form-group form-check">
				{{ Form::checkbox('add_to_leads', '1', false, ['class' => 'form-check-input']) }}
				{{ Form::label('add_to_leads', 'Add to leads', ['class' => 'form-check-label']) }}
			</div>
			{{ Form::submit('Import', ['class' => 'btn btn-primary', 'id' => 'import-btn']) }}
		</div>
	</div>
@endsection

@section('footer-custom-css-js')
	<script src="{{ asset('js/groups/map_excel_fields.js') }}"></script>
@endsection