@extends('layouts.app')
@section('title')
{{config('constant.site_title')}} - leads
@endsection
@section('content')
<div class="content-area">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="text-right"><a href="{{url('leadlist')}}" class="btn btn-danger"><img src="{{ asset('img/ic_arrow_back.svg') }}"  alt=""/></a> </div>
      <div class="widget mt-3">
        <h2 class="m-0">{{ __('Import Leads') }}</h2>
        <div class="widget-content p-3">
        	@if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert"> {{ Session::get('success') }} </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger" role="alert"> {{ Session::get('error') }} </div>
            @endif
            <h6>Map fields from file:</h6>
            {!! Form::open(array('url' => '/customer_excel_import_batch', 'method'=>'POST', 'class' => 'form-common', 'name' => 'form-common')) !!}
            {{ Form::hidden('file_name', $filename) }}
            {{ Form::hidden('comment', $comment) }}
          <div class="row"> @foreach ($excel_headings as $heading)
              <div class="form-group col-md-6"> {{ Form::label($heading, ucwords(str_replace('_', ' ', $heading))) }}
                {{ Form::select($heading, ['' => 'Select Corresponding Customer Field'], '', ['id' => $heading, 'class' => 'form-control headings']) }} </div>
              @endforeach </div>
            <div class="text-right">{{ Form::submit('Import', ['class' => 'btn btn-primary px-4', 'id' => 'import-btn']) }}</div>
{!! Form::close() !!} </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer-custom-css-js') 
<script src="{{ asset('js/groups/map_excel_fields.js') }}"></script> 
@endsection